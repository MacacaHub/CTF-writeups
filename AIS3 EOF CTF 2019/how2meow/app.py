from flask import Flask, request
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

@app.route('/')
def index():
    cookie = request.args.get('c', None)
    if cookie:
        return cookie
    return 'hELLo'

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=9487)
