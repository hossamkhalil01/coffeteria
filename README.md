# Coffeteria

[![MIT license](https://img.shields.io/badge/License-MIT-blue.svg)](https://lbesson.mit-license.org/)
[![Open Source? Yes!](https://badgen.net/badge/Open%20Source%20%3F/Yes%21/blue?icon=github)](https://github.com/Naereen/badges/)
[![Ask Me Anything !](https://img.shields.io/badge/Ask%20me-anything-1abc9c.svg)](https://GitHub.com/Naereen/ama) 


![logo](https://github.com/hossamkhalil01/coffeteria/blob/main/public/images/logo.png?raw=true)

**Coffeteria** is a SPA (single page application) that organizes ordering from our institute's cafeteria, where the admin can add products and categorizes them, he can manage his running order and checks. The user can place an order if he is registered or he can log in using his favorite social media account.

The project is developed using **PHP** (**Laravel Framework**) with **MySQL** DBMS for the back-end, and **Vue.js Framework** for the front-end.


## Demo

---

You can find a demo for the project deployed in the following link:

http://coffeteria.herokuapp.com/


## Table of Contents

---

<!-- TOC -->

  - [Getting Started](#getting-started)
      - [Setup Your Environment](#setup-your-environment)
  - [Configurations](#-configurations)
      - [Application](#-application)
      - [Database](#-database)
      - [Mail Server](#-mail-server)
      - [Social Authentication](#-social-authentication)
  - [Dependencies](#-dependencies)
  - [Limitations](#-limitations)
  - [Possible Improvements](#-possible-improvements)
  - [About Us](#about-us)

<!-- /TOC -->


## Getting Started

---

To use and run this project you need to:

Before executing the following commands, please make sure that you have all [dependencies](#-dependencies).


### Setup Your Environment

---

1- Run the following command to install the project locally.

```bash
git clone https://github.com/hossamkhalil01/coffeteria.git

cd coffeteria/ 

npm install 
```

#### Note: for only one time you may need to run the following command to generate the static files.


```bash
npm run dev
```
you may also run the following to start the live watch for laravel-mix so that you don't have to run dev on every change.
```bash
npm run watch
```

2- Apply the database migrations 
First you will have to add your database credentials as mentioned in [configurations](#configurations) section

```bash
php artisan migrate
```

3- Run the server

```
php artisan serve
```

4- Go to the browser and go to the following URL: **http://localhost:8000**

#### Note: Make sure that your database is up and configured properly for the application to work.


## Configurations
---

For the project to work as expected, you will have copy the **.env.example** file with a name of **.env** to fill it with your own credentials.



### Application
---


The following variables represents your applications' configurations where you can setup the application name, URL or debug mode.

The URLs are used by the front-end to send requests to the back-end, while the application name is used by Laravel to use as a data whenever needed.

#### Note: you'll have to edit bot **APP_URL** and **MIX_APP_URL** with your application's URL by default it's set to the localhost.


```PHP
APP_NAME=Coffeteria
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000
MIX_APP_URL=http://localhost:8000
LOG_CHANNEL=stack
LOG_LEVEL=debug
```

### Database 
---

For your database you need to fill the following variables with the credentials of your database.

```PHP
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

### Mail Server 
---

Mail server is used for various reasons such as sending verification emails or password reset emails to users.
by default it's configured to use gmail with smtp server on port 587.

You may want to change those values to suite your needs as well as putting in the email credentials such as username and password.
```PHP
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME="${APP_NAME}"
```

### Social Authentication 
---

The application uses the social media accounts as a way to authenticate users, currently three providers are supported (Facebook, GitHub and Google).

If you want to use this feature you will have to insert your social app ID and Secret Key to the following variables.

```PHP
GITHUB_CLIENT_ID=""
GITHUB_CLIENT_SECRET=""

GOOGLE_CLIENT_ID=""
GOOGLE_CLIENT_SECRET=""

FACEBOOK_CLIENT_ID=""
FACEBOOK_CLIENT_SECRET=""
```

## Dependencies
---

- [PHP 7.4](https://www.php.net/)
- [npm](https://www.npmjs.com/)

## Limitations
---

- Admins only are made by other admins which means the first admin user has to be created manually (through tinker shell or database directly)


## Possible Improvements
---

- Allowing payment system so that user don't have to always pay in cash.



## About Us
---

We are a team of software engineering students at ITI intake 41, Smart Village branch, Open-source application track.
We built this application for learning purposes which is free to share and use.

- Hossam Khalil
- Leena Sherif
- Mai Maher
- Sarah Magdy
