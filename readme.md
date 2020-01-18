## Medwing Maps App Server

### A laravel powered application
`As backend for [Medwing Maps App](https://medwing-app-87d6e.web.app)`

## Design Decision
I have taken the following approach to serve the front end on this server
- Provide an implementation to prevent CORS issue on the middleware for requests from any host or url
- Use sqlite database which is quick to setup and use
- 4 simple methods in the MarkerController class to perform CRUD operations
- App can be served with `php artisan serve` or visited at the installation directory in a server. I have used apache.

## Installation
- Clone the repository [here](https://github.com/nwaughachukwuma/medwing-app-server.git)
- Run `composer install`
- Serve the app
  > App is using laravel built in server `php artisan serve`
- Ensure that the app is running on port 800: `http://localhost:8000`. The Maps App will hit the server on that address.
  > If you must change the address, ensure you consolidate by updating the address on the client as well

Laravel is a web application framework with expressive, elegant syntax.

## Author
* **Chukwuma Nwaugha** - [Github](https://github.com/nwaughachukwuma)
