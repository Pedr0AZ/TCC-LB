from flask import Flask, render_template, jsonify
from flask_socketio import SocketIO, emit
import subprocess
import os
import signal

app = Flask(__name__)
socketio = SocketIO(app)

# Variável global para armazenar o processo
process = None

@app.route('/')
def index():
    return render_template('index.html')


@socketio.on('start_scanner')
def handle_start_scanner():
    # Aqui você pode chamar sua função de escaneamento
    for i in range(5):  # Exemplo: 5 segundos de escaneamento
        time.sleep(1)
        emit('scanner_update', {'data': f'Escaneando... {i + 1}'})

    emit('scanner_complete', {'data': 'Escaneamento completo!'})

if __name__ == '__main__':
    socketio.run(app, debug=True)

@app.route('/run-script', methods=['POST'])
def run_script():
    global process
    try:
        # Executa o script em um processo separado
        process = subprocess.Popen(['python', 'C:\\Users\\Victhor Coppola\\Desktop\\TCC-LB\\Python\\Scanner e servidor\\Escaner_maos.py'])
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

if __name__ == '__main__':
    app.run(debug=True)

