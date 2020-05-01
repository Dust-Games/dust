# Инструкция по установке
### 1. Отключить всех демонов, кто может занимать 80 порт
```bash
sudo service nginx stop
sudo service apache2 stop
```
### 2. Установить docker, docker-compose
### 3. Клонировать проект
```bash
git clone https://github.com/kaizzzoku/dust.git dust
```
### 4. Поднять контейнеры
```bash
docker-compose up -d --build
```
Возможно выскочит ошибка что прав на изменение бд в `docker/db/data` недостаточно,
в таком случае сделать `sudo chmod -R 777 docker/db/data`
### теперь всё должно работать
