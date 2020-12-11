#!/usr/bin/env bash

# IMPORTANT: Execute in root directory!
if [ ! -f .env ]; then
    echo "Must be run in the root directory where the .env file is present!"
    exit 1
fi

# Generate SQL import file
php -f data/tsv2mysql.php -- -D > data/mysql.sql

# Load connection data
set -a
. .env
set +a

# Import file
docker-compose exec -T db sh -c "exec mysql -u'$PDO_USER' -p'$PDO_PASS' $PDO_DATABASE" < data/mysql.sql
