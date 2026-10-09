from flask import Flask, request
import base64

app = Flask(__name__)

@app.route('/log')
def log():
    ip = request.remote_addr
    data = request.args.get('data')
    status = request.args.get('status')
    
    log_entry = f"IP: {ip} | "
    
    if data:
        decoded = base64.b64decode(data).decode('utf-8')
        log_entry += f"Dados: {decoded}"
    if status:
        log_entry += f"Status: {status}"
    
    print(log_entry) # Mostra no terminal em tempo real
    with open("logs.txt", "a") as f:
        f.write(log_entry + "\n")
        
    return "OK", 200

if __name__ == "__main__":
    app.run(host='0.0.0.0', port=80)
