@REM isso aqui é para quando for testar na sala, isso aqui deixa tudo mais automatico

@echo off
echo Instalando as bibliotecas necessárias...
pip install -r requirements.txt

@REM coloque o local do servidor

echo Iniciando o servidor Flask...
python C:\"COLOQUE O LOCAL"\"DO ARQUIVO AQUI"\TCC-LB\Python\Scanner e servidor\app.py
