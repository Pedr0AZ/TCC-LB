from flask import Flask, render_template, jsonify, request
import subprocess
import os
import signal

app = Flask(__name__)

# Variável global para armazenar o processo e a pontuação
process = None
pontuacao_atual = 0
current_question = 0  # Nova variável para a pergunta atual

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/run-script', methods=['POST'])
def run_script():
    global process
    if process is not None:
        return jsonify({'status': 'Script já está em execução.'})

    try:
        # Executa o script em um processo separado
        process = subprocess.Popen(['python', 'Escaner_maos.py'])
        return jsonify({'status': 'Script rodando...'})
    except Exception as e:
        return jsonify({'status': 'Erro ao rodar o script', 'error': str(e)})

@app.route('/stop-script', methods=['POST'])
def stop_script():
    global process
    if process:
        try:
            # Envia sinal para terminar o processo
            os.kill(process.pid, signal.SIGTERM)
            process = None
            return jsonify({'status': 'Script parado com sucesso'})
        except Exception as e:
            return jsonify({'status': 'Erro ao parar o script', 'error': str(e)})
    else:
        return jsonify({'status': 'Nenhum script em execução'})

# Nova rota para atualizar a pontuação
@app.route('/update-score', methods=['POST'])
def update_score():
    global pontuacao_atual
    data = request.get_json()
    pontuacao_atual = data['score']
    print(f"Pontuação atualizada: {pontuacao_atual}")
    return jsonify({'status': 'Pontuação atualizada', 'score': pontuacao_atual})

# Rota para obter a pontuação atual
@app.route('/get-score', methods=['GET'])
def get_score():
    global pontuacao_atual
    return jsonify({'score': pontuacao_atual})

# Nova rota para obter a pergunta atual
@app.route('/get-current-question', methods=['GET'])
def get_current_question():
    global current_question
    return jsonify({'current_question': current_question})

# Rota para avançar para a próxima pergunta
@app.route('/next-question', methods=['POST'])
def next_question():
    global current_question
    data = request.get_json()
    current_question = data['current_question']
    print(f"Próxima pergunta: {current_question}")
    return jsonify({'status': 'Pergunta avançada', 'current_question': current_question})

if __name__ == '__main__':
    app.run(debug=True)
