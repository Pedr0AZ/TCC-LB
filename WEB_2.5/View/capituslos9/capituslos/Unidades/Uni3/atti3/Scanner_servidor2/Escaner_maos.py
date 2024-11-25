import pickle
import cv2
import mediapipe as mp
import numpy as np
import requests

# Tente carregar o dicionário do arquivo pickle
#Se não funcionar, coloque o caminho absoluto ou mude o nome do arquivo app.py ou do model.p
try:
    modal_dict = pickle.load(open('./model.p', 'rb'))
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

labels_dict = {0: 'A', 1: 'B', 2: 'C'}

# Inicialização das variáveis fora do loop
score = 0
current_question = 0

questions = [
    {"question": "Qual é a letra A?", "answer": "A"},
    {"question": "Qual é a letra B?", "answer": "B"},
    {"question": "Qual é a letra C?", "answer": "C"},
    {"question": "Qual é a letra A?", "answer": "A"}
]

# Função para enviar a pontuação para o Flask
def enviar_pontuacao(score):
    try:
        response = requests.post('http://127.0.0.1:5000/update-score', json={'score': score})
        response.raise_for_status()  # Levanta um erro para códigos de resposta 4xx/5xx
        print("Pontuação enviada com sucesso.")
    except requests.exceptions.RequestException as e:
        print(f"Erro ao enviar a pontuação: {e}")

while True:
    data_aux = []

    ret, frame = cap.read()

    # Verificação se o frame foi lido corretamente
    if not ret:
        print("Falha ao capturar a imagem da câmera")
        break

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
                score += 25  # incrementa a pontuação em 25 pontos por resposta certa
                print("Você acertou!")
                enviar_pontuacao(score)  # Envia a pontuação para o servidor Flask

            # Exibir a resposta da mão e a pontuação na tela
            cv2.putText(frame, f"Pontuação: {score}", (10, 20), cv2.FONT_HERSHEY_SIMPLEX, 0.8, (255, 255, 255), 2, cv2.LINE_AA)
            cv2.putText(frame, f"Letra detectada: {predicted_character}", (10, 50), cv2.FONT_HERSHEY_SIMPLEX, 0.8, (255, 255, 255), 2, cv2.LINE_AA)

    # Mostrar a pergunta atual
    cv2.putText(frame, questions[current_question]["question"], (10, 80), cv2.FONT_HERSHEY_SIMPLEX, 0.8, (255, 255, 255), 2, cv2.LINE_AA)

    # Mostrar o frame com as landmarks desenhadas
    cv2.imshow('Reconhecimento de Sinais', frame)

    # Verificar se o usuário pressionou a tecla "P" para próxima pergunta
    key = cv2.waitKey(25) & 0xFF
    if key == ord('p'):
        current_question += 1
        if current_question < len(questions):
            print("Próxima pergunta:", questions[current_question]["question"])
        else:
            print("Você terminou o quiz! Sua pontuação foi:", score)
            break
    elif key == ord('q'):
        break

# Liberar a captura e destruir todas as janelas
cap.release()
cv2.destroyAllWindows()
