from flask import Flask
from flask_eureka import Eureka
from flask_cors import CORS

from .controller import routes, authorizationRoute
import logging
logging.basicConfig(level=logging.DEBUG, format='%(asctime)s - %(levelname)s - %(message)s')

app = Flask(__name__)
CORS(app)

app.config["EUREKA"] = {
    "SERVICE_NAME": "my-flask-service",
    "SERVICE_PORT": 5001,
    "EUREKA_SERVER": "http://localhost:8761/eureka",
}
eureka = Eureka(app)
app.config["SQLALCHEMY_TRACK_MODIFICATIONS"] = False
CORS(app, resources={r"/api/*": {"origins": "http://localhost:8000"}})

app.register_blueprint(routes)
app.register_blueprint(authorizationRoute)

if __name__ == "__main__":
    app.run(debug=True)
