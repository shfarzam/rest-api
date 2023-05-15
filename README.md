# JSON REST API Project Documentation

This document outlines the project details and specifications for developing a JSON REST API for managing news articles.

## Objective

The objective of this project is to create a JSON REST API that allows users to perform various operations on news articles, such as creating, editing, listing, viewing, and deleting articles. The API should be able to store article data in a MySQL database and provide necessary validation for input parameters. Additional features, such as integrating an external API and implementing article expiration and tagging functionalities, should also be considered.

## Implementation Steps

1. **Setup**:
   - Install one of the following frameworks on your computer: Laravel (https://laravel.com/docs/9.x)

2. **API Implementation**:
   - Implement a JSON REST API with the following features:
     - Create: Allow users to create new news articles by providing necessary parameters such as title, author, text, creation date, publication date, and expiration date.
     - Edit: Enable users to update existing news articles by providing the article ID and the updated parameters.
     - List: Provide an endpoint to retrieve a list of news articles, excluding the article text but including the article ID, title, author, creation date, publication date, and the estimated age of the author.
     - View: Allow users to retrieve a specific news article by providing the article ID, including all details such as title, author, text, creation date, publication date, expiration date, and the estimated age of the author.
     - Delete: Implement an endpoint to delete a news article by providing the article ID.
   - Apply appropriate input validation for all API endpoints to ensure the provided data is valid and meets the required criteria.
   - Integrate an external API (e.g., https://agify.io) to fetch and display the estimated age of the author for each article when listing and viewing.

3. **Article Expiration**:
   - Add an expiration date field to the article model in the database.
   - Modify the listing endpoint to exclude expired articles from the response.

4. **Tagging Articles**:
   - Allow articles to be assigned tags from a predefined set of categories, such as Food, Lifestyle, Programming, Work, Life, Sleep, etc.
   - Implement the ability to add new tags via the API.

5. **Filtering by Tags and Author**:
   - Enhance the listing endpoint to support filtering articles by tags and author.
   - Allow users to filter articles based on specific tags or authors by providing appropriate query parameters.

## Conclusion

The JSON REST API project aims to provide a robust and efficient solution for managing news articles. By following the implementation steps outlined above, you can create an API that allows users to create, edit, list, view, and delete articles. Additionally, features such as input validation, article expiration, tagging, and filtering enhance the functionality and usability of the API.

   > **Part 2**

# docker-compos
e-laravel
A pretty simplified Docker Compose workflow that sets up a LEMP network of containers for local Laravel development.

## Usage

To get started, make sure you have [Docker installed](https://docs.docker.com/docker-for-mac/install/) on your system, and then clone this repository.

Next, navigate in your terminal to the directory you cloned this, and spin up the containers for the web server by running `docker-compose up -d --build app`.

After that completes, follow the steps from the [src/README.md](src/README.md) file to get the Laravel project added in (or create a new blank one).

**Note**: Your MySQL database host name should be `mysql`, **not** `localhost`. The username and database should both be `homestead` with a password of `secret`. 

Bringing up the Docker Compose network with `app` instead of just using `up`, ensures that only our site's containers are brought up at the start, instead of all of the command containers as well. The following are built for our web server, with their exposed ports detailed:

- **nginx** - `:80`
- **mysql** - `:3306`
- **php** - `:9000`
- **redis** - `:6379`
- **mailhog** - `:8025` 

Three additional containers are included that handle Composer, NPM, and Artisan commands *without* having to have these platforms installed on your local computer. Use the following command examples from your project root, modifying them to fit your particular use case.

- `docker-compose run --rm composer update`
- `docker-compose run --rm npm run dev`
- `docker-compose run --rm artisan migrate`

## Permissions Issues

If you encounter any issues with filesystem permissions while visiting your application or running a container command, try completing one of the sets of steps below.

**If you are using your server or local environment as the root user:**

- Bring any container(s) down with `docker-compose down`
- Replace any instance of `php.dockerfile` in the docker-compose.yml file with `php.root.dockerfile`
- Re-build the containers by running `docker-compose build --no-cache`

**If you are using your server or local environment as a user that is not root:**

- Bring any container(s) down with `docker-compose down`
- In your terminal, run `export UID=$(id -u)` and then `export GID=$(id -g)`
- If you see any errors about readonly variables from the above step, you can ignore them and continue
- Re-build the containers by running `docker-compose build --no-cache`

Then, either bring back up your container network or re-run the command you were trying before, and see if that fixes it.

## Persistent MySQL Storage

By default, whenever you bring down the Docker network, your MySQL data will be removed after the containers are destroyed. If you would like to have persistent data that remains after bringing containers down and back up, do the following:

1. Create a `mysql` folder in the project root, alongside the `nginx` and `src` folders.
2. Under the mysql service in your `docker-compose.yml` file, add the following lines:

```
volumes:
  - ./mysql:/var/lib/mysql
```

## Usage in Production

While I originally created this template for local development, it's robust enough to be used in basic Laravel application deployments. The biggest recommendation would be to ensure that HTTPS is enabled by making additions to the `nginx/default.conf` file and utilizing something like [Let's Encrypt](https://hub.docker.com/r/linuxserver/letsencrypt) to produce an SSL certificate.

## Compiling Assets

This configuration should be able to compile assets with both [laravel mix](https://laravel-mix.com/) and [vite](https://vitejs.dev/). In order to get started, you first need to add ` --host 0.0.0.0` after the end of your relevant dev command in `package.json`. So for example, with a Laravel project using Vite, you should see:

```json
"scripts": {
  "dev": "vite --host 0.0.0.0",
  "build": "vite build"
},
```

Then, run the following commands to install your dependencies and start the dev server:

- `docker-compose run --rm npm install`
- `docker-compose run --rm --service-ports npm run dev`

After that, you should be able to use `@vite` directives to enable hot-module reloading on your local Laravel application.

Want to build for production? Simply run `docker-compose run --rm npm run build`.

## MailHog

The current version of Laravel (9 as of today) uses MailHog as the default application for testing email sending and general SMTP work during local development. Using the provided Docker Hub image, getting an instance set up and ready is simple and straight-forward. The service is included in the `docker-compose.yml` file, and spins up alongside the webserver and database services.

To see the dashboard and view any emails coming through the system, visit [localhost:8025](http://localhost:8025) after running `docker-compose up -d site`.

   > **Part 3**

## Endpoints

### [](https://github.com/shfarzam/rest-api/tree/dev/src#create-article)Create article

`POST /articles`

Creates a new news article. Requires the following parameters:

-   `title`  (string): the title of the article
-   `author`  (string): the author of the article
-   `text`  (string): the content of the article
-   `creation_date`  (datetime): the date the article was created
-   `publication_date`  (datetime): the date the article was published
-   `expiration_date`  (datetime): the date the article will expire

Returns the created article object with its unique  `id`.

### [](https://github.com/shfarzam/rest-api/tree/dev/src#edit-article)Edit article

`PUT /articles/{id}`

Updates an existing news article. Requires the following parameters:

-   `title`  (string): the title of the article
-   `author`  (string): the author of the article
-   `text`  (string): the content of the article
-   `creation_date`  (datetime): the date the article was created
-   `publication_date`  (datetime): the date the article was published
-   `expiration_date`  (datetime): the date the article will expire

Returns the updated article object.

### [](https://github.com/shfarzam/rest-api/tree/dev/src#list-articles)List articles

`GET /articles`

Returns a list of news articles, each with the following properties:

-   `id`  (integer): the unique identifier of the article
-   `title`  (string): the title of the article
-   `author`  (string): the author of the article
-   `creation_date`  (datetime): the date the article was created
-   `publication_date`  (datetime): the date the article was published
-   `age`  (integer, optional): the estimated age of the author based on the API at  [https://agify.io](https://agify.io/)

Note that the  `text`  property is not included in the response.

### [](https://github.com/shfarzam/rest-api/tree/dev/src#view-article)View article

`GET /articles/{id}`

Returns a specific news article with the following properties:

-   `id`  (integer): the unique identifier of the article
-   `title`  (string): the title of the article
-   `author`  (string): the author of the article
-   `text`  (string): the content of the article
-   `creation_date`  (datetime): the date the article was created
-   `publication_date`  (datetime): the date the article was published
-   `expiration_date`  (datetime): the date the article will expire
-   `age`  (integer, optional): the estimated age of the author based on the API at  [https://agify.io](https://agify.io/)

### [](https://github.com/shfarzam/rest-api/tree/dev/src#delete-article)Delete article

`DELETE /articles/{id}`

Deletes a news article with the given  `id`. Returns a 204 No Content response on success.
