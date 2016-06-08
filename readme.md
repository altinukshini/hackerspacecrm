# Hackerspace CRM

My friends and I run Prishtina Hackerspace (a hackerspace in Kosovo), and since the beginning of it we always struggled finding the best solution to manage members, payments, keys, etc. I'm not trying to reinvent the wheel, we tried many different software but I think we need a better solutions for this. I think that many hackerspaces face the same problem when dealing with 30+ members. I know we all have different structures, but we could maybe boil down to something common and useful for all of us.

There are many open source CRM software out there like CiviCRM and such (paid ones as well) that actually do have more functionality in them but are hard to use because of their complexity.

Hackerspace CRM tends to be more user friendly and come to use only to Hackerspaces. 
The idea is to have most of the application parameters configurable via the administrator panel. The application should be modular so that other hackerspaces around the world can write their own specific functionalities. Anyone can write a theme for it or even localize the CRM for use in their own language.

So far, I’ve thought of couple of features, most of which I liked in Seltzer CRM, and some that I thought might be useful based on my experience with Prishtina Hackerspace and some local hackerspaces in Balkans.
But, in order for this CRM to be as good as it can (and obviously better than the existing solutions), I need your help to let me know what do you struggle with, and what would you need to have in such application? How do you process this kind of stuff, what services you use and what would be the easiest way to complete your administrative tasks via this CRM.

So far this is what I came up with (call them modules or simply functionalities):
The following need to be more detailed (will document them more soon)
- Membership
  - Members
  - Membership Plans
  - Mentors

- Reports
  - Membership reports
  - Expenses reports
  - Space Frequentation (part of door access control and checkin system)

- Finances
  - Transactions (income and expenses)
  - Billing (charge members / run billing)
  - Online Payment (Pay membership dues with Stripe/Paypal)

- Access Control
  - Keys
  - RFID Cards
  - Alarm Pins
  - Door access Control and Checkin System (API for Raspberry pi/Arduino based solution)

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


# Laravel PHP Framework

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
