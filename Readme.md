# Vue & REST API

## Repository

This project consists of a front-end application and a REST API.

## Getting Started

To start the project, follow these steps:

1. Run the following command to set up the project: `make up` or `docker-compose up`
2. Run `make sh` or `docker compose exec noviti-app bash` to connect to the container and execute `composer install`
3. Once the project is running, you can access the REST API at `http://127.0.0.1:8080/api/noviti`.

### Frontend

1. From root folder run command: `cd front-end`,
2. Once in `front-end` folder run `npm install`,

### Compile and Hot-Reload for Development

```sh
npm run dev
```

### Compile and Minify for Production

```sh
npm run build
```
#### Then forntend will we displayed in url shown in the terminal (http://127.0.0.1:5173/)
## Project Structure

- Front-end directory: The front-end application is located in the `front-end` directory.

- Back-end controller: The back-end controller responsible for handling the REST API requests is located at `/rest-api/src/Controller/NovitiController.php`.


