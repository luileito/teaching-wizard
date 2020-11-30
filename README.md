# The Teaching Wizard

A Database of Pedagogical Strategies and Search Interface.

**Project:** https://onlinelearning.aalto.fi/aol/pilot/the-teaching-wizard

**Demo:** https://luis.leiva.name/atm/

## Installation

### Database

Ensure you have SQLite installed:
```
~$ php -r 'var_dump(class_exists("SQLite3"));'
```

And install DB via:
```
~$ sqlite3 methods.db < create.sql
```

### Web services

See `config.json` and launch each URL via CLI, e.g.:
```
~$ cd web
~$ php -S http://localhost:1102
```

TODO: Add production servers and dockerize these services.

## Team

- Luis Leiva
- Martin Andraud
- Pantelis Lioumis
- Floran Martin
- Lukas Brückner
