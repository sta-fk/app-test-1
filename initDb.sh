#!/bin/bash

trimmed_query=$(cat ./docker/init_db/mysql/init_db.sql | grep -v '^#' | sed '/^$/d')

docker exec -t app_db mysql -uroot -p123456 -e "$trimmed_query"
