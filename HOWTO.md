# Deployment

Application is dockerized and deployment of local environment pretty simple

* Install `docker` and `docker-compose` on machine
* Build and deploy containers by next command
```shell
docker-compose up --build -d
```
* Install application dependencies
```shell
docker exec centra_php composer install
```
* create `.env` from `.env.example`
```shell
cp html/.env.example html/.env
```
* change `APP_SECRET`
* create `github` oauth application and change next environment variable
```dotenv
GH_CLIENT_ID=
GH_CLIENT_SECRET=
```
on local environment application will be able on url [http://centra.docker.localhost:88](http://centra.docker.localhost:88)