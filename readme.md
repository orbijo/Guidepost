<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## About Guide

Guidepost is a social media web application that focuses on disaster awareness and funding. Guidepost aims to let create a community where one can alert others, be informed, and help others through donations through posts that are timely, relevant, objective, and important.

## Git Guidepost

The following are required to be downloaded for you to edit code, contribute, and host Guidepost on your device:

- **[Git](https://git-scm.com/downloads)**
- **[Node.js](https://nodejs.org/en/download/)**
- **[XAMPP](https://www.apachefriends.org/download.html)**
- **[Composer](https://getcomposer.org/download/)**
- [Visual Studio Code (Optional)](https://code.visualstudio.com/download)

- Git the repo using this command on your command line:
```git clone https://github.com/orbijo/Guidepost.git```

Setup:

- Access the folder via
```cd Guidepost```
On the command line type the following:
- Update package dependencies
```composer update```
- Frontend Scaffolding
```npm install && npm run dev```
- Run Apache and  MySQL in XAMPP and create your database
- ```cp .env.example .env``` and change the environment variables in your new .env file
- Generate tables and seeders
```php artisan migrate:fresh --seed```
- Serve the application
```php artisan serve```

You are now done! You can access the application using ```localhost:8000/```

## Guidepost Credits

These are the people who made Guidepost possible

TEAM:

- **[Josh Arkane Orbiso](https://www.facebook.com/joshark.orbs)**
- **[Steven Deiparine](https://www.facebook.com/steven.deiparine)**

Special Thanks:

- [Gran Sabandal - CIS 1202 Instructor]()

## Contacts

If you have any concerns please email me at arkorbz13@gmail.com
