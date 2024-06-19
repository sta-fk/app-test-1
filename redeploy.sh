#!/bin/bash

docker-compose down
docker-compose up -d --build

#sleep 3
#sh initDb.sh
