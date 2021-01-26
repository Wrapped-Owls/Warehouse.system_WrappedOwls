# Warehouse_system@WrappedOlws

## Execution instructions

### Install the necessary tools

-   [Composer](https://getcomposer.org/) - Dependency Manager

-   [PHP](http://php.net/downloads.php) - programming Language

### Download the project from the GitHub repository (Must have git installed)

<pre>git clone https://github.com/Jictyvoo/Warehouse.system_WrappedOwls.git</pre>

### Copy the .env.example file to .env

### Within the project directory, execute the commands

<pre> composer install </pre>
<pre> php artisan key:generate</pre>

### If you are using MySQL, run the following command as the root user of the database

<pre>
DROP DATABASE IF EXISTS warehouse_system__wrappedowls;
CREATE DATABASE warehouse_system__wrappedowls;
CREATE USER IF NOT EXISTS 'user'@'localhost' IDENTIFIED BY 'sqlpassword';
GRANT ALL PRIVILEGES ON warehouse_system__wrappedowls.* To 'user'@'localhost' IDENTIFIED BY 'sqlpassword';
</pre>

### Then run the following command on the terminal

<pre>
php artisan migrate:fresh --seed
</pre>

### Run the server

<pre> php artisan serve </pre>
