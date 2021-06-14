
<h3 align="center">An attempt to make Pratical exercise ( Jumia ) with native PHP</h3>


## Features 

- Handle show all customers based on country and regex phone number

- Model Enables Read and where clause.

- Model Enable Using REGEXP to validate regex phone numbers

- load views from controller

- Light Weight

- Doesn't contain fancy features that you don't use anyways.

- Doesn't Use composer.json and doesn't use any external library

- using (spl_autoload_register) to register multiple functions (or static methods from your own Autoload class


## How to use

### Setup
1-Just clone this repository

2-Place it in the `htdocs` equivalent of your server.

3-Edit the `Config/Database.php` inside config folder to connect it to your sql database.

4-I converted sqlite db to mysql and use mysql to make use (REGEXP) on any platform 

5- For using sqlite with (REGEXP) you must install (sqlite3-pcre) you can check this Url ( https://stackoverflow.com/questions/5071601/how-do-i-use-regex-in-a-sqlite-query/8338515#8338515)

6- you can find the new db with mysql in (database_files/test_framework.sql)

7- you can find all queries that used in (database_files/queries.txt)

### How it works

**For Example**
In the following url
http://localhost/task/index.php/customer/all/

- `Task` is the project name
- `index.php` is available for now as it is the start point to the task
- `Customer` is the name of the Controller 
- `all` is the function you want
- rest is passed as arguments 

**Note**
As the function name is `getAll` and not `all` the get means that want this function to handle the get requests.

### Controller

The Controller Implements Controller Interface that injected with model interface ( Dependency inversion principle )

I use constants dynamically when injected with phone key or to get the all regex phone number you can
find the Constants in Enums Folders

### Model

To create your own model copy the `TestModel.php` file in the models directory.
For further examples on using model see the usage in `User.php`

### Views

To create your own view just create simple php views and load it using `loadView` function in the controller

```php
$this->loadView('<view name>', <associative array for variables view>)

```


## Contact


send to me at [samyemad4@gmail.com]







