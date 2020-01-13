# LMS-Laravel
[![Latest Stable Version](https://poser.pugx.org/lms-laravel/lms-laravel/v/stable)](https://packagist.org/packages/lms-laravel/lms-laravel)
[![Total Downloads](https://poser.pugx.org/lms-laravel/lms-laravel/downloads)](https://packagist.org/packages/lms-laravel/lms-laravel)
[![Latest Unstable Version](https://poser.pugx.org/lms-laravel/lms-laravel/v/unstable)](https://packagist.org/packages/lms-laravel/lms-laravel)
[![License](https://poser.pugx.org/lms-laravel/lms-laravel/license)](https://packagist.org/packages/lms-laravel/lms-laravel)

- [About](#about)
- [License](#license)

### About
LMS-laravel is a management system of educational content, want to facilitate the creation of a platform simple and intuitive.
LMS-laravel is based as its name indicates in the framework laravel 5, and uses various packages created by other developers.
* This application is still in development, if you want to collaborate with the development you can write to angelkurten@hotmail.com

### Installation
1. Run `git clone https://github.com/LMS-Laravel/LMS-Laravel.git LMS-Laravel`
2. Run `composer install` (install composer beforehand)
3. From the projects root run `cp .env.example .env`
4. Configure your `.env` file
5. Run `php artisan key:generate`
6. Run `php artisan migrate`
7. Run `npm i`
8. For auth api `php artisan passport:install`
8. Websocket server for chat `php artisan websockets:serve`
9. Configurate credentials mailgun in .env
10. For disable Captcha add `ENABLE_CAPTCHA=false` in `.env` file

### Laravel Auth License
LMS-Laravel is licensed under the MIT license. Enjoy!
