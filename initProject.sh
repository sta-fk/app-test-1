#!/bin/bash

docker-compose up -d --build

trimmed_query=$(cat ./docker/init_db/mysql/init_db.sql | grep -v '^#' | sed '/^$/d')
docker exec -it app_db /bin/bash -c "mysql -uroot -p123456 -e '$trimmed_query'"

docker exec -it app_php /bin/bash -c "composer install"
docker exec -it app_php /bin/bash -c "php bin/console doctrine:migrations:migrate"
