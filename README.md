# [![Hackerspace CRM Banner](hscrm-banner.png)](https://github.com/altinukshini/hackerspacecrm)
[logo src](http://ura.al/)

Hackerspace CRM (Community Relationship Management) is a web application that helps to run and manage Hackerspaces/Makerspaces.

## README Contents

* [Description](#description)
* [Features](#features)
* [Contributing](#contributing)
* [Technologies used](#technologies)
* [Installation](#installation)
  * [Server requirements](#requirements)
  * [Cloning the repository](#cloning-the-repository)
  * [Installing composer dependencies](#installing-composer-dependencies)
  * [Configure environment variables](#configure-environment)
  * [Generate application key](#generate-application-key)
  * [Configure application](#configure-application)
  * [Run db migrations](#run-migrations)
  * [Run db seeds](#run-seeds)
  * [Start server](#start-server)
* [Laravel PHP framework](#laravel)

<a name="description" />
## Description

My friends and I run [Prishtina Hackerspace](http://www.prishtinahackerspace.org) (a hackerspace in Kosovo), and since the beginning of it we always struggled finding the best solution to manage members, payments, keys, etc. I'm not trying to reinvent the wheel, we tried many different applications but I think we need a better solutions for this. I think that many hackerspaces face the same problem when dealing with 30+ members. I know all hackerspaces have different structures, but we could maybe boil down to something common and useful for all of us.

There are many open source CRM software out there like CiviCRM and such (paid ones as well) that actually do have more functionality in them but are hard to use because of their complexity.

Hackerspace CRM tends to be more user friendly and come to use only to Hackerspaces. 
The idea is to have most of the application parameters configurable via the administrator panel. The application should be modular so that other hackerspaces around the world can write their own specific functionalities. Anyone can write a theme for it or even localize the CRM for use in their own language.

<a name="features" />
## Features

So far, I’ve thought of couple of features, most of which I liked in [Seltzer CRM](https://github.com/elplatt/seltzer), and some that I thought might be useful based on my experience with Prishtina Hackerspace and some local hackerspaces in Balkans.
But, in order for this CRM to be as good as it can (and obviously better than the existing solutions), I need your help to let me know what do you struggle with, and what would you need to have in such application? How do you process this kind of stuff, what services you use and what would be the easiest way to complete your hackerspace administrative tasks via this CRM.

So far this is what I came up with (call them modules or simply features):
The following need to be more detailed (will document them more soon)
* Membership
  * Members
  * Membership Plans
  * Mentors

* Reports
  * Membership reports
  * Expenses reports
  * Space Frequentation (part of door access control and checkin system)

* Finances
  * Transactions (income and expenses)
  * Billing (charge members / run billing)
  * Online Payment (Pay membership dues with Stripe/Paypal)

* Access Control
  * Keys
  * RFID Cards
  * Alarm Pins
  * Door access Control and Checkin System (API for Raspberry pi/Arduino based solution)


<a name="contributing" />
## Contributing

I would very much appreciate and love any contribution! I encourage you to create a new personal branch after you fork this repository. This branch should be used for content and changes that are specific to your use. However, anything you are willing to push back should be updated in your develop branch, since there is still no stable release (master branch) of this application yet.

Please feel free to check the issues page. I'd love to see any contributions in issues listed there:

* [Issues](https://github.com/altinukshini/hackerspacecrm/issues)

<a name="technologies" />
## Technologies used (planed to be used)

Software:
- Laravel PHP Framework
- MySQL database management system
- BootStrap front-end Framework + Admin LTE control panel and dashboard theme (for the default theme).
- Stripe API for payments over internet (in later versions as module)
- Paypal API for payments over internet (in later versions as module)

Hardware for developing the Checkin System and Door Access control System (in later versions as module):
- RaspberryPi
- Python for managing the GPIO ports and the functionality
- 2x16 LCD Screen
- Electric door strike
- RFID reader and cards

I’ve already done something for this, but will have to adapt and refactor the code so that it’ll work with Hackerspace CRM: https://github.com/altinukshini/HACCSY

<a name="installation" />
##Installation

<a name="requirements" />
### Server requirements

* Memcached (php5-memcached and memcached)

<a name="cloning-the-repository" />
### Cloning the Repository

Clone this project into your working directory.

Example:

```
$ git clone https://github.com/altinukshini/hackerspacecrm.git
Cloning into 'hackerspacecrm'...
remote: Counting objects: 2741, done.
remote: Compressing objects: 100% (161/161), done.
remote: Total 2741 (delta 85), reused 0 (delta 0), pack-reused 2579
Receiving objects: 100% (2741/2741), 6.94 MiB | 1.26 MiB/s, done.
Resolving deltas: 100% (1423/1423), done.
Checking connectivity... done.
```

<a name="installing-composer-dependencies" />
### Installing Composer Dependencies

From the project directory, run the following command. You may need to download `composer.phar` first from http://getcomposer.org

```bash
$ composer install
```

<a name="configure-environment" />
### Configure Environment

You will need to make a copy of the example environment configuration schema and enter your own details into.

Example:

```bash
$ cp .env.example .env
```

Now fill up the DB_ and MAIL_ variables with your details.

Example:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hackerspacecrm
DB_USERNAME=username
DB_PASSWORD=password

MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=username@gmail.com
MAIL_PASSWORD=password
MAIL_ENCRYPTION=tls
MAIL_FROM='Hackerspace CRM'
```

<a name="generate-application-key" />
### Generate application key

From the project directory, run the following command.

```bash
$ php artisan key:generate
```

<a name="configure-application" />
### Configure application

You will need to edit the **config/hackerspacecrm.php** config file and enter your own details into. Please pay attention to the variable comments and follow the instructions in that file.

<a name="run-migrations" />
### Run Migrations

To run migrations, make sure you are in the root directory for the project and run the following:

```bash
$ php artisan migrate
```

<a name="run-seeds" />
### Run Seeds

To run database seeds, make sure you are in the root directory for the project and run the following:

```bash
$ php artisan db:seed
```

<a name="start-server" />
### Start server

To start the server, make sure you are in the root directory for the project and run the following:

```bash
$ php artisan serve
```

<a name="laravel" />
## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
