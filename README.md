# The Teaching Wizard

A Database of Pedagogical Strategies and Search Interface.

**Project:** https://onlinelearning.aalto.fi/aol/pilot/the-teaching-wizard

**Demo:** https://luis.leiva.name/atm/

## Installation

### Configuration

Create a copy of the `sample.env` as `.env`:
```
~$ cp sample.env .env
```

You can adjust the configuration in this file.

Edit the authentication options `AUTH_USER` and `AUTH_HASH`
that must be changed before the admin interface can be accessed.

To do so, run the following command with a new password:
```
~$ php -r 'echo password_hash("<NEW_PASS>", PASSWORD_DEFAULT) . "\n";'
```
Copy the result into `AUTH_HASH` (make sure not to copy any unrelated characters).

### Database

Currently both SQLite and MySQL engines are supported.

This sections doesn't assume a Dockerized system,
though it is highly encouraged.

#### SQLite installation

Ensure you have SQLite installed:
```
~$ sudo apt-get install php-sqlite3
~$ php -r 'var_dump(class_exists("SQLite3"));'
```

Export the DB definition:
```
~$ php -f data/tsv2sqlite.php > data/sqlite.sql
```

Initialize DB via:
```
~$ sqlite3 data/methods.db < data/sqlite.sql
```

And set `PDO_URI=sqlite:data/methods.db` in your `.env` file.


##### Docker

If running on Docker, set `PDO_URI=sqlite:/usr/data/methods.db` in your `.env` file.

Be sure to uncomment the volume includes for the `api` and `admin` services.
The lines are marked before with 

`# If using SQLite, include volume to database file`.

You can comment out the `db` service (MySQL) in that case.

#### MySQL installation

Ensure you have a MySQL server installed:
```
~$ sudo apt install mysql-server
```

Export the DB definition:
```
~$ php -f data/tsv2mysql.php > data/mysql.sql
```

Set the auth credentials (`PDO_USER` and `PDO_PASS`) in your `.env` file.

Initialize DB via:
```
~$ mysql -u $PDO_USER -p'$PDO_PASS' < data/mysql.sql
```
where `$PDO_USER` and `$PDO_PASS` are the values you set before in your `.env` file.

And set `PDO_URI="mysql:host=localhost;dbname=teaching_wizard"` in your `.env` file.

##### Docker

If running on Docker, use the database host name `db` in the connection URI in your `.env` file,
like so: `PDO_URI="mysql:host=db;dbname=teaching_wizard"`.

Also, you must set the variables `PDO_USER`, `PDO_PASS`, `MYSQL_ROOT_PASS`,
and `PDO_DATABASE` (make sure it matches the `dbname=` property of the `PDO_URI`).

You may want to customize the forwarded port of the Docker database to your host machine with the
`DB_PORT` setting (e.g., if you have a local MySQL database running as well).
This is just to enable the usage of other MySQL clients to connect to the database server.

These settings must be set before starting the MySQL container for the first time.

Initializing the database must be done after it has started for the first time, see below.

### HTTPS support

You can enable HTTPS support by uncommenting the line
```
#;NGINX_CONF=site-ssl.conf
```
in the `.env` file.
By default, it uses a self-signed certificate for `localhost`.

You can replace the provided certificates in `./docker/nginx/ssl/server.{crt,key}`
either with your own self-generated one
by running the `./docker/ssl-generate.sh` script,
or with a proper SSL certificate.

Adjust accordingly the settings `SERVER_NAME` to match the certificate domain
 and `HTTPS_PORT` if desired.

Rebuild the `nginx` container after changing these settings via `docker-compose build nginx`.

#### Using Let's Encrypt

The certbot docker image is available but disabled in the current config.
Enable it by uncommenting the lines in `docker-compose.yml` to be able to use it.

If you are running on a proper server, at this point the SSL option from above should not be enabled yet.

To retrieve a certificate from Let's Encrypt,
run the command `docker-compose run --rm certbot certonly`.
You should be able to select the second option as the default nginx config serves the certbot challenge.

You will need to do additional changes, to integrate the certificate after retrieving it.
The certificate will be saved in a different file (most likely in `./docker/nginx/ssl/certbot/live/<domain>`),
so adjust the nginx config accordingly.

Also, don't forget to renew it regularly.
You can take a look at https://medium.com/@pentacent/nginx-and-lets-encrypt-with-docker-in-less-than-5-minutes-b4b8a60d3a71
for an example on how to integrate the automatic renewal properly into a docker-compose setup.

## Dockerized web services

Ensure [Docker](https://docs.docker.com/get-docker/) is installed.

Build the containers via:
```
~$ docker-compose build
```

Then you can run them in composition:
```
~$ docker-compose up
```

When using mysql, make sure it has successfully initialized the server,
and then run the script `import-db.sh` in your root directory to import the default data:

```
~$ bash docker/import-db.sh
```

The services are now available at:
* Main interface: http://localhost:8080/
* API: http://localhost:8080/api/
* Admin: http://localhost:8080/admin/

## Team

- Luis Leiva
- Martin Andraud
- Pantelis Lioumis
- Floran Martin
- Lukas Brückner
