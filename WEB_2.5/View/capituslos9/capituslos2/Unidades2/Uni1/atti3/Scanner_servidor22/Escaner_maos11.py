import pickle
import cv2
import mediapipe as mp
import numpy as np
import requests
import time
import threading

# Tente carregar o dicionário do arquivo pickle
try:
    modal_dict = pickle.load(open('C://xampp//htdocs//TCC-LB//WEB_2.5//View//capituslos9//capituslos2//Unidades2//Uni1//atti3//Scanner_servidor22//model11.p', 'rb'))
    model = modal_dict['model']
except Exception as e:
    print(f"Erro ao carregar o modelo: {e}")
    exit()

# Iniciar a captura de vídeo
cap = cv2.VideoCapture(0)

# Verificação da inicialização da câmera
if not cap.isOpened():
    print("Erro ao abrir a câmera")
    exit()

# Configurar MediaPipe Hands
mp_hands = mp.solutions.hands
mp_drawing = mp.solutions.drawing_utils
mp_drawing_styles = mp.solutions.drawing_styles

# Inicializar a detecção de mãos
hands = mp_hands.Hands(static_image_mode=False, max_num_hands=2, min_detection_confidence=0.3)

labels_dict = {0: '0', 1: '1', 2: '2', 3: '3'}

# Inicialização das variáveis fora do loop
score = 0
current_question = 0
correct_sign_time = 0  # Tempo em que o sinal correto começou a ser detectado
correct_threshold = 5  # Precisamos que o sinal correto seja mantido por 5 segundos
start_time = 0  # Armazenar o tempo quando o sinal correto é detectado

# Função para enviar a pontuação para o Flask
def enviar_pontuacao(score):
    try:
        response = requests.post('http://127.0.0.1:5000/update-score', json={'score': score})
        response.raise_for_status()  # Levanta um erro para códigos de resposta 4xx/5xx
        print("Pontuação enviada com sucesso.")
    except requests.exceptions.RequestException as e:
        print(f"Erro ao enviar a pontuação: {e}")

# Função para sincronizar a pergunta atual
def atualizar_pergunta_atual():
    global current_question
    try:
        response = requests.get('http://127.0.0.1:5000/get-current-question')
        current_question = response.json().get('current_question', 0)
    except requests.exceptions.RequestException as e:
        print(f"Erro ao atualizar a pergunta atual: {e}")

# Função para avançar para a próxima pergunta
def proxima_pergunta():
    global current_question
    current_question += 1
    try:
        requests.post('http://127.0.0.1:5000/next-question', json={'current_question': current_question})
    except requests.exceptions.RequestException as e:
        print(f"Erro ao avançar para a próxima pergunta: {e}")

questions = [
    {"question": "Qual é a número 0?", "answer": "0"},
    {"question": "Qual é a número 1?", "answer": "1"},
    {"question": "Qual é a número 2?", "answer": "2"},
    {"question": "Qual é a número 3?", "answer": "3"}
]

# Atualizar a pergunta atual em uma thread separada
def atualizar_pergunta_thread():
    while True:
        atualizar_pergunta_atual()
        time.sleep(5)  # Atualiza a pergunta a cada 5 segundos

# Iniciar a thread para atualizar a pergunta
threading.Thread(target=atualizar_pergunta_thread, daemon=True).start()

while True:
    data_aux = []
    ret, frame = cap.read()

    # Verificação se o frame foi lido corretamente
    if not ret:
        print("Falha ao capturar a imagem da câmera")
        break

    # Reduzir a resolução do frame
    frame = cv2.resize(frame, (640, 480))

    # Converter a imagem para RGB
    frame_rgb = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)

    # Processar a imagem para detectar as mãos
    results = hands.process(frame_rgb)
    if results.multi_hand_landmarks:
        for hand_landmarks in results.multi_hand_landmarks:
            # Desenhar as landmarks da mão na imagem
            mp_drawing.draw_landmarks(
                frame,
                hand_landmarks,
                mp_hands.HAND_CONNECTIONS,
                mp_drawing_styles.get_default_hand_landmarks_style(),
                mp_drawing_styles.get_default_hand_connections_style()
            )

            # Processar as landmarks da mão
            data_aux = []
            for landmark in hand_landmarks.landmark:
                data_aux.append(landmark.x)
                data_aux.append(landmark.y)
                data_aux.append(landmark.z)

            # Converter data_aux para o formato adequado para o modelo
            prediction = model.predict([np.asarray(data_aux)])

            # Verificar se a resposta é correta
            predicted_character = labels_dict[int(prediction[0])]
            if predicted_character == questions[current_question]["answer"]:
                if start_time == 0:
                    start_time = time.time()  # Iniciar o contador de tempo
                elapsed_time = time.time() - start_time

                # Mostrar o contador na tela (se o tempo for menor que o threshold)
                if elapsed_time <= correct_threshold:
                    remaining_time = correct_threshold - elapsed_time
                    cv2.putText(frame, f"Contagem regressiva: {remaining_time:.1f}s", (10, 120), 
                                cv2.FONT_HERSHEY_SIMPLEX, 0.8, (0, 255, 0), 2, cv2.LINE_AA)

                # Se o sinal correto for mantido por 5 segundos, incrementar a pontuação
                if elapsed_time >= correct_threshold:
                    score += 25  # Incrementa a pontuação em 25 pontos por resposta certa
                    print("Você acertou!")
                    threading.Thread(target=enviar_pontuacao, args=(score,)).start()  # Envia a pontuação em uma thread separada
                    proxima_pergunta()  # Avança para a próxima pergunta
                    start_time = 0  # Reseta o tempo
            else:
                start_time = 0  # Reseta o contador se a resposta for errada

            # Exibir a resposta da mão e a pontuação na tela
            cv2.putText(frame, f"Pontuação: {score}", (10, 20), cv2.FONT_HERSHEY_SIMPLEX, 0.8, (255, 255, 255), 2, cv2.LINE_AA)
            cv2.putText(frame, f"Letra detectada: {predicted_character}", (10, 50), cv2.FONT_HERSHEY_SIMPLEX, 0.8, (255, 255, 255), 2, cv2.LINE_AA)

    # Mostrar a pergunta atual
    cv2.putText(frame, questions[current_question]["question"], (10, 80), cv2.FONT_HERSHEY_SIMPLEX, 0.8, (255, 255, 255), 2, cv2.LINE_AA)

    # Mostrar o frame com as landmarks desenhadas
    cv2.imshow('Reconhecimento de Sinais', frame)

    key = cv2.waitKey(25) & 0xFF
    if key == ord('q'):
        break

# Liberar a captura e destruir todas as janelas
cap.release()
cv2.destroyAllWindows()