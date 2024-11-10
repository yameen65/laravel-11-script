## About Laravel 11 Script

In this Repository, you will get a complete Laravel 11 application with roles and auth. you can clone this repository and boom you set up your Laravel application. In this application, we have created components for reusable code.

If you want to add any frontend then **please use components already created. Card, Input Fields, Forms, Buttons, Links and Layouts** 

## System Requirements

* Windows 10
* XAMPP, WAMPP, Laragon server **I use Laragon** [Download](https://laragon.org/download/)
* PHP 8.1 or better
* nodejs [Download](https://nodejs.org/en/download/)
* composer [Download](https://getcomposer.org/Composer-Setup.exe)
* git bash [Download](https://git-scm.com/downloads)

**Note:** If you have already setup then skip the installation part and simply clone the repository

## 1. Install Git Bash

* Download git bash from this link -> [Download](https://git-scm.com/downloads)
* Simply install
* After installation process complete
* open the folder where you want to install your Laravel application
* right-click in the folder and click in the project folder and click on the **Git Bash Here** option then run this command

## 2. install composer

* Download composer from this lnik -> [Download](https://getcomposer.org/Composer-Setup.exe)
* simply install

## 3. install nodeJs

* download link for nodejs -> [Download](https://nodejs.org/en/download/)
* simple install

# Setup Application

## 1. Create application

Open git-bash into your **laragon/www** directory and run this command

    git clone https://github.com/inaam-ul-haq/laravel-11-script.git

## 2. Change Directory

go to this directory **cd laravel-11-script** directory

    cd laravel-11-script
    
## 3. Create database

* open your laragon and go to databse
* create new database

## 4. Edit .env
First copy your **.env.example** file in your project and rename it with **.env** then edit your databse name

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=database_name
    DB_USERNAME=root
    DB_PASSWORD=

## 5. Create your table migration files if needed otherwise run this command

* Go to **AppServiceProvider** file
* Comment the **$this->configSet();** on line 51
* After this run this command

    php artisan migrate:fresh --seed

* When this command run successfully then uncomment the code you have commented before **$this->configSet();** otherwise you face errors

## 5. Now install composer

Run this command in your git-bash in the project directory

    composer install

# New Module in Application

If you need to create a new module like you need to add the Reviews Module into the system then run this command

    php artisan class Review

### What does this command do?

* Make Controller
* Create Model
* Create Migration file
* Create Dto class
* Create FormRequest file
* Create Repository Class

After this command you need to change into your **migrations**, **model**, **dto**

Now Create blades and routes and then enjoy your CRUD that is already created. Just you have to set up blade files.

**Auther**: [Inaam ul haq](https://github.com/Inaam-ul-haq)
**YouTube:** [Inaam ul haq](https://www.youtube.com/c/techzhub)
**Instagram:** [Inaam ul haq](https://www.instagram.com/inaamul_hak)
