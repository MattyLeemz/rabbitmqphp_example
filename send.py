#!/usr/bin/env python
import pika

credentials = pika.PlainCredentials(username='admin', password='guest')
connection =  pika.BlockingConnection(pika.ConnectionParameters(host='10.128.0.4',
                                                      credentials=credentials))


channel = connection.channel()

channel.queue_declare(queue='hello')

channel.basic_publish(exchange='', routing_key='hello', body='Hello World!')
print(" [x] Sent 'Hello World!'")
connection.close()
