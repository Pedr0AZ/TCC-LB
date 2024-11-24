from flask import Flask, render_template, jsonify, request
import subprocess
import os
import signal

app = Flask(__name__)

# Variável global para armazenar o processo e a pontuação
process = None
pontuacao_atual = 0

@app.route('/')
def index():
    return render_template('index.php')

@app.route('/run-script', methods=['POST'])
def run_script():
    global process
    if process is not None:
        return jsonify({'status': 'Script já está em execução.'})

    try:
        # Executa o script em um processo separado
        process = subprocess.Popen(['python', 'Scanner_servidor2\Escaner_maos.py'])
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
    print(f"Pontuação atualizada: {pontuacao_atual}")  # Adicionei um print para depuração
    return jsonify({'status': 'Pontuação atualizada', 'score': pontuacao_atual})

@app.route('/get-score', methods=['GET'])
def get_score():
    global pontuacao_atual
    return jsonify({'score': pontuacao_atual})

if __name__ == '__main__':
    app.run(debug=True)
