Cookie Meet
=====
Cookie Meet is an API which can calculate the distance between multiples adresses, find the nearest users and contact him. We are using OAuth2 to propulse the API. Users can add a dish and the result will be displayed in the user details. 
To sum it simply, the goal of Cookie Meet would be to become a service between people who want to order food and people who want to sell their foods.

# Usage

## How to install composer

> Open your terminal
> navigate into the SymfoHetic folder
> type php composer-setup.php --install-dir=bin
> then type composer update

## Check requirements

Before using our API, you will need to verify that composer and php =< 5.6 are installed.

## Start the symfony server

It's simple, just verify that you are into the symfoHetic folder, that Apache and MySQL are running and then type :
> php app/console server:run

## Watch it on your web browser

Once you started the symfony server, and do see the confirmation message on your terminal, just navigate to http://127.0.0.1:8000


- OAuth2 connexion :
Create a new client : php app/console backy:oauth-server:client:create --redirect-uri="127.0.0.1:8000" --grant-type="authorization_code" --grant-type="password" --grant-type="refresh_token" --grant-type="token" --grant-type="client_credentials"
It generates a client ID and a secret ID to be entered on Postman

In Postman :
- Access Token URL : http://127.0.0.1:8000/oauth/v2/token
Don't forget, you have to request Client Credentials !
When you have your token, enter the desired url (e.g. http://127.0.0.1:8000/api/geocode.json)
And add the token obtained before !
Now you can log in and do whatever you want !

"Don't forget to generate fixtures with Alice Bundle : php app/console hautelook_alice:fixtures:load
Thanks and I hope you'll enjoy our API !

