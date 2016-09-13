# Vrann Magebot

**Vrann Magebot** is an extension which implements simple Chat Bot for Facebook Messenger backed by Magento 

Minimal functionality configures Magento to read messages containing text from Facebook Messenger from the RabbitMQ and invoke handler which generates response to the message. Response is sent to the RabbitMQ.

It depends on https://github.com/vrann/http-rabbitmq-writer being installed on public web endpoint. The responsibilities of http-rabbitmq-writer are:
- receive messages from the Facebook Messenger and write them to the RabbitMQ
- get responses from the RabbitMQ and send them to Facebook Messanger

## Presentation
[http://www.slideshare.net/vrann/mage-titans-usa-2016-magentofacebookrabbitmq](http://www.slideshare.net/vrann/mage-titans-usa-2016-magentofacebookrabbitmq)

## Installation
```
composer install vrann/magechatbot
```
