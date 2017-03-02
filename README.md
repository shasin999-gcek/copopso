## CO-PO-PSO Accreditation webapp details

Every dependencies used during development will be updated here.I kindly request every one to visit this website frequently.

## Setting up development environment on linux

### Install apache web server

```markdown
  sudo apt-get update
  sudo apt-get install apache2
```
After installation go to http://localhost . It will display an apache conf page, which means your installation is a success.

### Install MySQL
During the installation, your server will ask you to select and confirm a password for the MySQL "root" user. 
Make sure this is a strong, unique password, and do not leave it blank.

  ```markdown
  sudo apt-get install mysql-server
```

### Install PHP
```markdown
sudo apt-get install php7.0 php7.0-fpm php7.0-mysql libapache2-mod-php7.0
sudo service apache2 restart
```

## checking php
first goto terminal and type this
```diff
 php -v
```
If successful, it will show a version number.

Then go to /var/www/html by typing: 

`cd /var/www/html` .

then create a php file by

`touch index.php`

Edit index.php in your favourite text editor.
 
 ```php
  <?php
     echo "Hello World";
   ?>
 ```
 Save the file and goto http://localhost/index.php.
 If you can see only "Hello world" then php is executed successfully
 otherwise there might be error.

## Setting up Adminer.(SQL GUI)
goto [adminer](https://www.adminer.org/) and download adminer.php file
goto `cd /var/www/html` and paste adminer.php file on it.

then goto http://localhost/adminer.php on your browser.
select 
```markdown
System  : mysql	
Server	: localhost
Username: root
Password: "YOUR PASSWORD OF MYSQL CREATED DURING INSTALLATION"	
Database: (LEFT BLANK)
```
and click login.

## Setting development environment on Windows
Goto this site and download XAMP for windows version 7.1.1
[a link](https://www.apachefriends.org/download.html)
After installing open XAMP control panel
click on "start" apache.
goto http://localhost if u c a XAMP intro page your installation is a success.


### Support or Contact

Having trouble with Installing or any doubt..?
Ask on our whatsapp group.

With 
Love
### CO-PO-PSO Team
