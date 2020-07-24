# About Testboalt

Testboalt Application was built to cover the following specifications

## Requirements
- Use Laravel/Passport.
- REST Endpoints:
  - Register (should be validated).
  - Login (should be validated).
  - Return current user information (protected route).
  - REST for notifications: create a set of REST endpoints to manage notifications per user (protected routes): 
  These notifications need a direct relationship with users, and a status (unread/read) 
  which should be updateable via the endpoints.
  - Create a seeder/faker that creates 100 different users.
  - Create an endpoint that connects to an external api and returns basic information 
  (you can use YELP api to return info about a business, but you can use a more complicated api 
  to show your skills) (protected route).
- Create a command that clears all notifications for all users.
- Document all the endpoints and how to run the environment thoroughly.
- Endpoints have to be turned in as a postman file (I should be able to import your file into postman 
and see all the endpoints).

## Non Functional Requirements
- Use Git for version control, add your code to Github public and send the link (this repo).
- Code documentation (this file and swagger documentation).


## Installation
Clone the repository into your web root (i.e. /Volumes/Sites/)
```
git clone git@github.com:walkovik/testboalt.git
```

### Install External Dependencies
Composer is used as a dependency manager and autoloader, to install external dependencies 
and setup the autoloader, make sure composer is installed and run the following command 
from the application root:
```
composer install
```

### Create your .env file
```
cp .env.example .env 
```
Now, generate your key so your app can run.
```
php artisan key:generate 
```

### Database
You can use sqlite for fastest and easiest setup of the app. Just follow next steps:

In your console, type the following command
```
touch database/database.sqlite
```
This will create an empty SQLite DB File. Go to the database section lines (near line 9) 
and replace the following lines
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
with
```
DB_CONNECTION=sqlite
```
### Yelp API Key
In order to access to the Yelp functionality, you need to add a valid API Key, 
go to your .env file and add your key in the corresponding line, 
located at the very bottom of the document
```
YELP_API_KEY='Your-Api_Key-Here'
```
### Running migrations
With our DB set, we can run our migrations file and seed our db.
```
php artisan migrate --seed
```

### Passport 
After running your migrations, initialize passport.
```
php artisan passport:install
```
This will create your personal access and grant clients.

### Swagger documentation
Swagger have been used to display the documentation of the application. 
Although there are better ways to display this rather than adding all this code to the DocBlock, 
for time reason I will add this code there.

First, run
```
php artisan l5-swagger:generate
```
Then, go to
```
http://localhost:8000/api/documentation
```
### Using POSTMAN
You can access a set of Postman requests via download from the home screen of the application,
or via the file itself located in the /public/resources folder.
Please make sure to update the sections of the authorization parameter with your Yelp API key,
and your token (generated after login) in order to properly fetch data while requesting through the API.

### Run server
Run 
```
php artisan serve
```
to load the application, this command must be used in order to use postman links, 
if you use another server instance please update postman URL to your server instance.

### Running tests
Some functional tests have been added to verify the proper behaviour of the application. 
These tests have been added to the project to partially show my skills in TDD. 
You can run those tests using the following command:
```
vendor/bin/phpunit 
```
or 
```
php artisan test 
```

### Remove all notifications
If you want to remove all notifications, run
```
php artisan user-notifications:clear
```

And away yo go...!!!!
