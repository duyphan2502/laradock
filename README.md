#Project Scope
* API
* Test
    + `./tests/Behaviour` refers to functional test
    + `./tests/Unit` refers to Unit Test
    + `./tests/Browser` refers to Frontend Test through Selenium
* Migration `./database/migrations` a
* Docker settings `./images | Dockerfile | docker-compose.yml | php-compose.yml`
* Frontend stuff 
    + VueJS/SCSS `./resources/assets`
    + Component `./resources/assets/js/components`: *on Frontend, application might be developed in separated components*
    + Compile `./compile.sh | webpack.mix.js | package.json` build frontend files

# Install
```ssh
docker-compose build && docker-compose up -d
docker exec -it laradock_php_1 bash
php artisan migrate
```
#Architect
* This Application behaves like Proxy service (`BroadcastingProvider`) in order to coordinate
different Content Delivery System.
* AMS-Api can be one of Content Provider `/app/Astro/Client.php` which extends `/app/Services/ContentProvider`
* Other Content provider can be integrated into our platform by implement interface `ContentProvider` and registered by `BroadcastingProvider->register(ContentProvider)`


#API
* GET:`/api/channels` list all channels
* GET:`/api/channel/{provider}/{channel_id}` get all events from Provider for specific channel
* POST: `/api/channel`
```json
{
  "token": "Token strong",
  "channel": 123412
}
```