# wordpress-docker-dev

## Requirements

* [Docker](https://www.docker.com/)
* [docker-compose](https://docs.docker.com/compose/)

## How to use

```sh
# clone this repository
git clone https://github.com/iyonaga/wordpress-docker-dev.git <project-name>
cd <project-name>

# edit .env
cp .env.sample .env
vi .env

# start containers
docker-compose up -d
```
### Using blade templates
See [this branch](https://github.com/iyonaga/wordpress-docker-dev/tree/template-blade)
