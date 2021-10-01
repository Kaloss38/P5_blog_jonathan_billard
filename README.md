# P5 OPC - Blog - Jonathan Billard

Here my first blog project with PHP MVC, let's clone to start it !

## Starting project

### requirements

- PHP 7.4+
- MySQL 5.4+

### Packages Installation

First, clone project then install all composer packages with command line : ``composer install``

### import database

For have all posts and users, in your PhpMyAdmin, import p5blog.sql in database folder from root directory

### config.json settings

Then, we need to set configuration file to start project correctly

- In Config folder, rename config-sample.json to config.json
- Set Database and Phpmailer rows with your current configuration

_your config.json, database and phpmailer examples_:

```
            "database":  {
                "name": "p5blog", 
                "dbname": "p5blog",
                "host": "localhost",
                "user": "// HERE YOUR USERNAME //",
                "password": "// HERE YOUR PASSWORD IF NOTHING DONT FILL //"
            },
            "phpmailer": {
                "host": "// HERE YOUR MAIL HOST IF GMAIL => smtp.gmail.com //",
                "username": "// YOUR USERNAME IS YOUR HOST MAIL ADDRESS //",
                "password": "// HERE THE PASSWORD OF YOUR MAIL ADDRESS //",
                "fromMail": "// HERE THE MAIL WHO WANT TO BE SEE AT RECEPTION //",
                "fromName": "// HERE THE NAME WHO WANT TO BE SEE AT RECEPTION //",
                "smtpSecure": "ssl",
                "port": 465
            }
```

### Access to admin dashboard

For access to admin dashboard, you need to switch "isAdmin" to 1 in user table from database on user account wich you want to be admin.

## Libraries use list

- [Pecee Simple Router](https://packagist.org/packages/pecee/simple-router)
- [Twig](https://packagist.org/packages/twig/twig)
- [phpMailer](https://packagist.org/packages/phpmailer/phpmailer)
- [Ramsey uuid](https://packagist.org/packages/ramsey/uuid)
- [cocur slugify](https://packagist.org/packages/cocur/slugify)