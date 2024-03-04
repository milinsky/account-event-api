# API обработки событий аккаунтов

### Установка и запуск

```shell
curl -L -O https://github.com/milinsky/account-event-api/archive/refs/heads/main.zip
```
```shell
unzip main.zip -d account-event-api
```
```shell
cd account-event-api
```
```shell
make build
```
```shell
make up
```

### Работа с Api

```POST http://localhost/api/account-event```
```
{
    "account_id": 1,
    "event_id": 1
}

```

Панель RabbitMQ http://localhost:15672
