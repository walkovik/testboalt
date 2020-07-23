# About Testboalt

Testboalt Application was built to cover the following specifications

## Requirements
- Use Laravel/Passport.
- REST Endpoints:
  - Register (should be validated).
  - Login (should be validated).
  - Return current user information (protected route).
  - REST for notifications: create a set of REST endpoints to manage notifications per user (protected routes): These notifications need a direct relationship with users, and a status (unread/read) which should be updateable via the endpoints.
  - Create a seeder/faker that creates 100 different users.
  - Create an endpoint that connects to an external api and returns basic information (you can use YELP api to return info about a business, but you can use a more complicated api to show your skills) (protected route).
- Create a command that clears all notifications for all users.
- Document all the endpoints and how to run the environment thoroughly.
- Endpoints have to be turned in as a postman file (I should be able to import your file into postman and see all the endpoints).

## Non Functional Requirements
- Use Git for version control, add your code to Github public and send the link (this repo).
- Code documentation (this file and swagger documentation).


## Installation

### Clone the repository into your web root (i.e. /Volumes/Sites/)
```
git clone git@github.com:walkovik/testboalt.git
```

### Install External Dependencies
Composer is used as a dependency manager and autoloader

To install external dependencies and setup the autoloader, make sure composer is installed and run the following command from the application root:
```
composer install
```

### Another one


### Swagger documentation
Swagger have been used to display the documentation of the application. Although there are better ways to display this rather than adding all this code to the DocBlock, for time reason I will add this code there.

First, run 
```
php artisan serve
```
Then, go to
```
http://localhost:8000/api/documentation
```

### Running tests
Some functional tests have been added to verify the proper behaviour of the application, you can run those tests using the following command
```
php artisan ???
```

