# Vrann Magebot

**Vrann Magebot** is an extension which implements simple Chat Bot for Facebook Messenger backed by Magento.



It configures Magento to read messages from the RabbitMQ with the text from Facebook Messenger. Messages should be written to RabbitMQ by https://github.com/vrann/http-rabbitmq-writer installed on public web endpoint and registered for webhook in Facebook.

While processing message, Magebot invokes handler which generates response to the message and writes it to the RabbitMQ. https://github.com/vrann/http-rabbitmq-writer will read messages from the RabbitMQ and send them to the Facebook.

## Presentation
[http://www.slideshare.net/vrann/mage-titans-usa-2016-magentofacebookrabbitmq](http://www.slideshare.net/vrann/mage-titans-usa-2016-magentofacebookrabbitmq)

## Installation
1. Install https://github.com/vrann/http-rabbitmq-writer on public endpoint. Install RabbitMQ. Register callback.php to listen messages from the Facebook Messenger. Start response.php in daemon mode, to send responses back to the Facebook.
2. Install magebot extension on Magento:
```
composer require vrann/magechatbot
```
3. Start RabbitMQ consumer on Magento which will listen the queue with the messages from Facebook
```
bin/magento queue:consumers:start basic.consumer
```

## Testing
Invoke vrann/magebot API through the Web API:
```
curl -XPOST -H "Content-Type: application/json" -d '{
  "messageText": {
    "object": "page",
    "entry": [
      {
        "id": "287630798278680", 
        "time": 1471371304751, 
        "messaging": [
          {
            "sender": {
              "id":"1011665925607547"
            }, 
            "recipient": {
              "id":"287630798278680"
            }, 
            "timestamp":1471371209420, 
            "message": {
              "mid": "mid.1471371209330:af0fa0dd167d847914", 
              "seq": 12, 
              "text": "Hi!"
            }
          }
        ]
      }
    ]
  }
}' http://{magento.url}/rest/V1/facebook-bot-message
```
