import pika
import json
from ..models import MainController


class RabbitMQWorker:
    def __init__(self, queue_name: str, response_queue_name: str):
        self.queue_name = queue_name
        self.response_queue_name = response_queue_name

        self.connection = pika.BlockingConnection(
            pika.ConnectionParameters(
                host="localhost",
                port=5672,
                credentials=pika.PlainCredentials("guest", "guest"),
            )
        )
        self.channel = self.connection.channel()
        self.channel.queue_declare(queue=self.queue_name, durable=True)
        self.channel.queue_declare(queue=self.response_queue_name, durable=True)

    def start_consuming(self):
        self.channel.basic_consume(
            queue=self.queue_name, on_message_callback=self.callback, auto_ack=True
        )
        print(f"Started consuming from queue: {self.queue_name}")
        self.channel.start_consuming()

    def callback(self, ch, method, properties, body):
        message = json.loads(body)
        print(f"Received message: {message}")
        self.process_message(message, properties.reply_to, properties.correlation_id)

    def process_message(self, message: dict, reply_to: str, correlation_id: str):
        print(f"Processing message: {message}")
        response_data = {}
        try:
            action = message.get("action")
            if action:
                data = message.get("data")
                if hasattr(MainController, action):
                    response_data, status = getattr(MainController, action, lambda x: {})(data)
                # elif hasattr(MessageHandler, action):
                #     response_data, status = getattr(MessageHandler, action, lambda x: {})(data)
                else:
                    print(f"Action not found: {action}")
                    response_data, status = {"error": f"Action not found: {action}"}

            if reply_to:
                self.send_response(response_data, reply_to, correlation_id)
        except Exception as e:
            print(f"Error processing message: {str(e)}")
            if reply_to:
                self.send_response({"error": str(e)}, reply_to, correlation_id)

    def send_response(self, response_data: dict, reply_to: str, correlation_id: str):
        try:
            response_message = json.dumps(response_data)
            properties = pika.BasicProperties(correlation_id=correlation_id)
            self.channel.basic_publish(
                exchange="",
                routing_key=reply_to,
                body=response_message,
                properties=properties,
            )
            print(f"Sent response: {response_message}")
        except Exception as e:
            print(f"Error sending response: {str(e)}")

    def __del__(self):
        if self.connection:
            self.connection.close()
