from .config import RabbitMQWorker

if __name__ == '__main__':
    queue_name = 'topic-activities'
    worker = RabbitMQWorker(queue_name, "")
    worker.start_consuming()
