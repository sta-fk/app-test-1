#!/bin/sh

docker exec -it app_php /bin/bash -c "php bin/console $*"
