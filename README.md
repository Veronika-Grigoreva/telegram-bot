<h1 align="center">Telegram bot with Laravel and BotMan</h1>

## About BotMan Studio

While BotMan itself is framework agnostic, BotMan is also available as a bundle with the great [Laravel](https://laravel.com) PHP framework. This bundled version is called BotMan Studio and makes your chatbot development experience even better. By providing testing tools, an out of the box web driver implementation and additional tools like an enhanced CLI with driver installation, class generation and configuration support, it speeds up the development significantly.

## Documentation

You can find the BotMan and BotMan Studio documentation at [http://botman.io](http://botman.io).

## Installing and running _ngrok_

Because Telegram requires a valid and secure URL to set up webhooks and receive messages from your users we will be using **ngrok** or you can deploy your app on a server and set up an SSL certificate, but to for the demo we will stick to ngrok. Bowse to their [Download Page](https://ngrok.com/download) and click the download button that matches your operating system.

Time to run ngrok, cd into the folder where ngrok is and run `./ngrok http 8000`

## Link the Bot to Telegram

The final step is linking our app to the Telegram Bot we created earlier and to do that we will make a POST request to this URL and pass the URL ngrok generated for us:

` https://api.telegram.org/bot{TOKEN}/setWebhook`

You can do this with Postman or CURL by running this command:

`curl -X POST -F 'url=https://{YOU_URL}/botman' https://api.telegram.org/bot{TOKEN}/setWebhook`

If you did that correctly you should receive this exact JSON response:

`{
     "ok": true,
     "result": true,
     "description": "Webhook was set"
 }`