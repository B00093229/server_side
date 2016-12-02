# Server side project - B00093229

## Deprecation Notice

**This project is school project build by Cyril Connan. This project consist to create a shopping website for a movie. For this project I choose Hulk movie.**

## Demo presnetation

You can find a running demo at this lin https://store.connan.pro
 
## Installation

 \#1 - You need to install all dependencies  

- Web Server
- PHP Server
- BDD motor

````bash
sudo apt install apache2 php mysql-server libapache2-mod-php php-mysql
````

\#2 - Clone Git repository 

````bash
git clone https://github.com/B00093229/server_side.git
````

\#3 - Create data base and import sql file

Enter mysql command line:
````bash
mysql -h machine -u utilisateur -p
````

Create new user for website:
````mysql
CREATE USER 'server_side'@'localhost' IDENTIFIED BY 'password';
````
Create new data base:
````mysql
create database server_side;
````

Grant privileges at this user:
````mysql
grant all on server_side.* to 'server_side'@'localhost';
````

Go to the new database:
````mysql
use server_side;
````

And import de sql file:
````mysql
use source path/server_side.sql;
````

\#4 - Configure in php database class, the database connection

Go to the file class/bdd.php and change the ligne 11, 12, 13 as follow:
````php
private $bdd = 'mysql:host=DATABASE_IP;dbname=DATABASE_NAME';
private $user = 'USER_NAME';
private $pass = 'USER_PASSWORD';
````