## Here will Laravel app goes

- Clone your project or copy all of the files directly into this `src` directory.
- Spin up the Docker network by following the instructions on the main [README.md](../README.md), and install a brand new Laravel project by running `docker-compose run --rm composer create-project laravel/laravel .` in your terminal.


## Tasks

#Task 1 - JSON REST API

Implementation

* Task 1.0:
    * Install one of the follwing frameworks on your computer
        * Laravel: https://laravel.com/docs/9.x
        * Nest.js https://docs.nestjs.com/first-steps
    * If you get stuck at any point here, please ask us for help.
* Task 1.1:
    * Implement a JSON REST API through which you can create, edit, list, view and delete news articles.
    * An article has a title, an author, a text (plaintext, html not needed), a creation date and a publication date.
    * The listing of articles should not contain the text (list endpoint)
    * The data should be stored in a MySQL database
    * No authentication with the api is needed
* Task 1.2:
    * Use appropriate input validations for all of your api endpoints.
* Task 1.3:
    * Your API should indicate for each article when listing and viewing whether it has a positive or rather negative sentiment (“positive”, “neutral”, “negative”). Use the API at https://sentim-api.herokuapp.com/ (which hopefully works) and integrate it into the application in a meaningful way.
        * Alternative: Your API should respond with an estimated age of the author for each article when listing and viewing. Use the API at https://agify.io (which hopefully works) and integrate it into the application in a meaningful way.
* Task 1.4:
    * Add an expiration date to the articles model. Expired articles should not be shown requesting the listing endpoint.

Conception (Implementation optional)

You don’t have to implement the following tasks. Please use your time to do the conception (database structure, API design) and write it down (in any kind of text document). If you have some time left, you are welcome to start with the implementation.

* Task 1.5 :
    * An article should be able to be assigned tags, possible tags are: Food, Lifestyle, Programming, Work, Life, Sleep, ...
    * New tags should be able to be added via the API.
* Task 1.6:
    * In the listing of articles it should be possible to filter by tags and author.

