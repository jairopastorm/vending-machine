# vending-machine

This is a Symfony 5 Command-based application that recreates a vending machine process.

Requirements
------------

* Git
* Docker
* Docker Compose

Installation
------------

1. Clone this repository to your local machine:<br/><br/>
``` $ git clone https://github.com/jairopastorm/vending-machine.git vending-machine ```

2. Build the docker local environment:<br/><br/>
``` $ docker-compose up ```

3. Access to the container that contains the php interpreter:<br/><br/>
``` $ docker exec -it dev_php_1 ```

4. Install dependencies with composer:<br/><br/>
``` $ composer.phar install ```

Documentation
------------

* To run the application, execute the following command in the directory "/var/www/vending-machine":<br/><br/>
``` $ bin/console app:vending-machine ```

* To run the tests, execute the following command in the directory "/var/www/vending-machine":<br/><br/>
``` php vendor/phpunit/phpunit/phpunit [TEST_PATH] ```<br/><br/>
For example:<br/><br/>
``` php vendor/phpunit/phpunit/phpunit tests/Integration/VendingMachine/VendingMachineTest.php  ```<br/><br/>
``` php vendor/phpunit/phpunit/phpunit tests/Unit/VendingMachine/VendingMachineTest.php  ```<br/><br/>

