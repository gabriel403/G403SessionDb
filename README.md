ZfcUser
=======
Version 0.0.1 Created by Evan Coury and the ZF-Commons team


Introduction
------------

G403SessionDb is a session storage module for Zend Framework 2.
Out of the box, G403SessionDb works with Zend\Db. G403SessionDb provides the foundations for adding
sessions into the db for your ZF2 site. It is designed to be very
simple and easily to extend.

More information and examples are available on the [ZfcUser Wiki](https://github.com/ZF-Commons/ZfcUser/wiki)

Installation
------------

### Main Setup

#### By cloning project

1. Clone this project into your `./vendor/` directory.

#### With composer

1. Add this project in your composer.json:

    ```json
    "require": {
        "gabriel403/g403-session-db": "dev-master",
    }
    ```

2. Now tell composer to download G403SessionDb by running the command:

    ```bash
    $ php composer.phar update
    ```
OR
```bash
$ php composer.phar require gabriel403/g403-session-db
```

And type `dev-master` when asked for a version to pick.


#### Post installation

1. Enabling it in your `application.config.php`file.

    ```php
    <?php
    return array(
        'modules' => array(
            // ...
            'G403SessionDb',
        ),
        // ...
    );
    ```

2. Then Import the SQL schema located in `./vendor/G403SessionDb/data/schema.sql`.

### Post-Install: Zend\Db

1. If you do not already have a valid Zend\Db\Adapter\Adapter in your service
   manager configuration, you can copy the one from our config directory 
   `config/g403sessiondb.global.php.dist` to the project `./config/autoload/g403sessiondb.local.php`:


2. If you want to edit the session options (rememberme time, name, domain etc) then copy `config/g403session.	global.php.dist` to the project `./config/autoload/g403session.local.php`:


