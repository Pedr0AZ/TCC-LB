import pickle
import cv2
import mediapipe as mp
import numpy as np

# Carregar o dicionário do arquivo pickle
modal_dict = pickle.load(open('C:\\Users\\Victhor Coppola\\Desktop\\TCC-LB\\Python\\Scanner_servidor\\model.p', 'rb'))
# Acessar o modelo através do dicionário carregado
model = modal_dict['model']

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

labels_dict = {0: 'X', 1: 'Y', 2: 'Z'}

# Inicialização das variáveis fora do loop
x_ = []
y_ = []
z_ = []
score = 0
current_question = 0

questions = [
    {"question": "Qual é a capital do Brasil?", "answer": "X"},
    {"question": "Qual é o planeta mais próximo do Sol?", "answer": "Y"},
    {"question": "Qual é o autor do livro 'O Senhor dos Anéis'?", "answer": "Z"},
    {"question": "Qual é o ano em que o Brasil ganhou a Copa do Mundo?", "answer": "X"}
]

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
                frame,  # Imagem de desenho
                hand_landmarks,  # Landmarks detectadas
                mp_hands.HAND_CONNECTIONS,  # Conexões das mãos
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
                score += 1
                print("Você acertou!")

            # Exibir a resposta da mão
            cv2.putText(frame, predicted_character, (10, 20), cv2.FONT_HERSHEY_SIMPLEX, 0.5, (0, 0, 0), 2)

    # Mostrar a pergunta atual
    cv2.putText(frame, questions[current_question]["question"], (10, 50), cv2.FONT_HERSHEY_SIMPLEX, 0.5, (0, 0, 0), 2)

    # Mostrar o frame com as landmarks desenhadas
    cv2.imshow('frame', frame)

    # Verificar se o usuário pressionou a tecla "P"
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