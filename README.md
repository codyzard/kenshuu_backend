#Article service
##Initial
    - From root path run "docker composer up"
    - Execute sql src/sql_script.sql in localhost:8080(username = root, password = hoangtu)
    - Access localhost:8000
        + if have "could find driver" error, docker exec -it [ID or NAME (container php-apache:7.4)] bash
        + docker-php-ext-install mysqli pdo pdo_mysql
        + restart docker by command: "docker compose restart"
        + re-access localhost:8000