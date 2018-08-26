# LaravelBoilerplate-Backend
> Laravel project for LaravelBoilerplate Backend

![project][project-image]

![node][node-image]
![npm][npm-image]
![php][php-image]
![infyom][infyom-image]


### Requirements

What things you need to install the software and how to install them

- VirtualBox
- Vagrant

## Installation

Copy `.env.example` to `.env`.
Copy `Homestead.yaml.example` to `Homestead.yaml`.
Open it and update `map: ~/LaravelBoilerplate-Backend` with path to your project.

Update your hosts file ( `/etc/hosts`) and add this line
```sh  
192.168.10.10  laravel-boilerplate.test  
```  

## Bootstrap   

In order to use homestead, it is necessary to install composer dependencies:  
```sh  
composer install  
```  

Then Start vagrant machine with
```sh  
vagrant up  
```  

Then enter
```sh  
vagrant ssh  
```  

From vagrant machine
```sh  
composer install  
sudo apt-get install -y virtualenv  
./setup_node_env.sh  
```  

Now you can activate the node virtuale environment and install npm dependencies
```sh  
. node-env/bin/activate  
npm install  
```  

## Configuration


### Encryption Key

The first thing we are going to so is set the key that Laravel will use when doing encryption.

`php artisan key:generate`

You should see a green message stating your key was successfully generated. As well as you should see the  **APP_KEY** variable in your  **.env**file reflected.

### Database

We are going to run the built in migrations to create the database tables:

`php artisan migrate`

You should see a message for each table migrated, if you don't and see errors, than your credentials are most likely not correct.

We are now going to set the administrator account information. To do this you need to navigate to (`seeds/Access/UserTableSeeder.php`)  and change the name/email/password of the Administrator account.

You can delete the other dummy users, but do not delete the administrator account or you will not be able to access the backend.

Now seed the database with:

`php artisan db:seed`
You should get a message for each file seeded, you should see the information in your database tables.

#### Allow postgres connection from host machine (Optional)
In order to allow you to connect from your machine you can update `pg_hba.conf`.
```sh sudo nano /etc/postgresql/10/main/pg_hba.conf ``` And add this line
`host    all             all             0.0.0.0/0               md5`
Then restart service with:    
```sh sudo service postgresql restart ```    
## Usage    
After your project is installed and you can access it in a browser ([http://laravel-boilerplate.com](http://laravel-boilerplate.com)), click the login button on the right of the navigation bar.    

The administrator credentials are:    

**Username:** admin@admin.com  

**Password:** secret  

You will be automatically redirected to the backend. If you changed these values in the seeder prior, then obviously use the ones you updated to.    

## Scaffold  

This project includes [InfyOm Generator](http://labs.infyom.com/laravelgenerator/).  


## Xdebug

### Xdebug setup

Add at the end of this file  `/etc/php/7.2/fpm/php.ini`:

```
xdebug.remote_enable = 1
xdebug.idekey = "PHPSTORM"
xdebug.remote_autostart = 1
xdebug.remote_connect_back = 1
xdebug.remote_port = 9000
xdebug.remote_handler=dbgp
xdebug.remote_host=10.0.2.2
```

Restart php-fpm:

```sh
sudo service php7.2-fpm restart
```

### PhpStorm


#### Development environment

In `preferences` open:

Languages & Frameworks > PHP

Select `PHP language level > 7` and create a new CLI Interpreter.
Under `Remote` choose the radio option `Vagrant` and search vagrant machine path.
In `PHP executable` search the path, on vagrant machine, which contains the executable of php7.0 (default `/usr/bin/php`).
Apply and save.

#### Server


Open:

Languages & Frameworks > PHP > Servers

Create a new server called PHPSTORM (important).
Set host `10.10.10.11`, port `80` and debugger `Xdebug`.
Check the option `Use path mappings` and under `Project files` map LaravelBoilerplate-Backend writing in `Absolute path on the server` the absolute path in vagrant machine.


#### Run/Debug Configurations

Add a new configuration `PHP Remote Debug`.
Select the server `PHPSTORM` and set `ide key` > `PHPSTORM`.

## Release History    
* 0.0.1    
* Work in progress

## Authors
Christian Ascone – ascone.christian@gmail.com



<!-- Markdown link & img dfn's -->
[project-image]: https://img.shields.io/badge/project-0.0.1-green.svg
[node-image]: https://img.shields.io/badge/node-9.11.2-blue.svg
[npm-image]: https://img.shields.io/badge/node-5.6.0-blue.svg
[php-image]: https://img.shields.io/badge/php-7.2-red.svg
[infyom-image]: https://img.shields.io/badge/InfyOm-5.6.x_dev-red.svg