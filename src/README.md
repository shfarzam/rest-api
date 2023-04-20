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



# Task 1.5 and 1.6 Conception

## Task 1.5 - Tagging Articles

In order to implement the ability to assign tags to articles, we will need to make some changes to our database structure. Specifically, we will need to create a new table to hold the available tags, and then create a join table to associate tags with articles.

### Database Changes

We will create a `tags` table with the following columns:

-   `id` - auto-incrementing ID of the tag
-   `name` - string name of the tag

Next, we will create a `article_tags` join table with the following columns:

-   `article_id` - ID of the article being tagged
-   `tag_id` - ID of the tag being assigned to the article

### API Changes

We will need to update our API to allow tags to be assigned to articles. This will involve creating new endpoints to manage tags, as well as modifying the existing endpoints for creating and updating articles to accept tags.

#### Endpoints

The following endpoints will be added to manage tags:

-   `GET /tags` - returns a list of all available tags
-   `POST /tags` - creates a new tag with the given name
-   `PUT /tags/{id}` - updates the name of the tag with the given ID
-   `DELETE /tags/{id}` - deletes the tag with the given ID

We will also need to modify the existing endpoints for creating and updating articles to accept tags. The request bodies for these endpoints will include a new field, `tags`, which will be an array of tag names to assign to the article.

## Task 1.6 - Filtering by Tags and Author

In order to implement filtering by tags and author, we will need to modify the `GET /articles` endpoint to accept query parameters for filtering.

### API Changes

#### Query Parameters

The following query parameters will be added to the `GET /articles` endpoint:

-   `author` - filters articles by the given author
-   `tags` - filters articles by the given tags (comma-separated list)

#### Example Usage

To filter articles by author, a user could send a request to `GET /articles?author=john_doe`.

To filter articles by tags, a user could send a request to `GET /articles?tags=food,lifestyle`.

## Conclusion

By implementing the changes outlined above, we will be able to assign tags to articles and filter articles by tags and author. These changes will provide users with a more powerful and flexible way to browse and search for articles.