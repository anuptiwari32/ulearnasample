#Ulearna Sample App 

Make you easier to start project.

### Authentications

You can customization this Auth on `\App\Controller\TamhorAuth` and `\App\Controller\AuthController`

- Login
- Register
- RBAC
- Email verifications
- Recover Password


## Server Requirements

PHP version 7.2 or higher is required, with the following extensions installed: 

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)

## Pre Requisites
1. Xampp/Lamp installed
2. Make sure latest version of PHP eg.  8/8.1 is installed 
3. Make sure MySql is installed
4. Code Editor eg. Visual Studio Code/NotePad++
5. Composer should be installed


## Installations

After cloning this repo. Open the repo into Code Editor eg. Visual Studio Code or open project root directory in command prompt or shell and please run this command to install dependencies.

   ```bash
   composer install
   ```

### Creating Database

First, make sure you have a database. If you dont have a database, let's creating :
- `mysql -u root -p`
- `Enter password: [leave blank if you never setup password]`
- mysql> `CREATE DATABASE db_starter;`
- mysql> `quit`
Now, you have a database `db_starter`

### Project Setup

`git clone https://github.com/anuptiwari32/ulearnasample.git`\
`cd ulearnasample`\
`cp env .env`\
`code .` => open with your code editor (for example I use VSCode).

Setup your `.env` file :

Environment :\
`# CI_ENVIRONMENT = production` to `CI_ENVIRONMENT = development`
Databases initial :\
`# database.default.hostname = localhost`\
`# database.default.database = ci4`\
`# database.default.username = root`\
`# database.default.password = root`\
`# database.default.DBDriver = MySQLi`\
to\
`database.default.hostname = localhost`\
`database.default.database = db_starter`\
`database.default.username = root`\
`database.default.password = [leave blank if you never setup password]`\
`database.default.DBDriver = MySQLi`

- Note: Don't forget to remove the `#` tag at the first line.

Setting your \App\Config\Email.php :

`public $protocol = 'smtp';`\
`public $SMTPHost = 'smtp.gmail.com';`\
`public $SMTPUser = 'tamhor.dev@gmail.com';`\
`public $SMTPPass = '[type your password here]';`\
`public $SMTPPort = 465;`\
`public $SMTPTimeout = 60;`\
`public $SMTPCrypto = 'ssl';`\
`public $mailType = 'html';`\

- Note: Better use your secondary email address.

`php spark migrate`\
`php spark db:seed AuthSeeder`\
`php spark db:seed FeedbackSeeder`\
`php spark serve`

### Credentials
`admin`\
 ```bash
   username: admin@admin.com
   password:admin123
   ```

`Trainer`\
 ```bash
   username: trainer1@gmail.com
   password:123456
   ```
`Sample ulearna.sql file added for reference`\