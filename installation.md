# Инструкция по установке
### 0. Установить docker, docker-compose, добавить docker в группы юзера
* [Docker installation](https://docs.docker.com/engine/install/ubuntu/)
* [Docker-compose installation](https://docs.docker.com/compose/install/)
* [Add docker to user`s groups](https://linoxide.com/linux-how-to/use-docker-without-sudo-ubuntu/)
### 1. Отключить всех демонов, кто может занимать 80 порт
```bash
sudo service nginx stop
sudo service apache2 stop
```
### 2. Клонировать проект
```bash
git clone --recursive https://github.com/kaizzzoku/dust.git dust
```
### 3. Поднять контейнеры
```bash
docker-compose up -d --build
```
Возможно выскочит ошибка что прав на изменение бд в `docker/db/data` недостаточно,  
в таком случае сделать `sudo chmod -R 777 docker/db/data`
### теперь всё должно работать
