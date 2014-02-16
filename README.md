# ORM based RbacUser module for ZF 2

RbacUserDoctrineOrm offers a module that combines ZfcRbac & ZfcUser together with the Doctrine Orm module from ZF2 so that you can focus on getting started.

## Requirements & their dependencies

 - PHP 5.3 or higher
 - [Zend Framework 2](http://www.github.com/zendframework/zf2)
 - [ZfcRbac](https://github.com/ZF-Commons/ZfcRbac)
 - [ZfcUserDoctrineOrm](https://github.com/ZF-Commons/ZfcUserDoctrineORM)
   - [ZfcUser](https://github.com/ZF-Commons/ZfcUser)
     - [ZfcBase](https://github.com/ZF-Commons/ZfcBase)
   - [DoctrineORMModule](https://github.com/doctrine/DoctrineORMModule)
     - [DoctrineModule](https://github.com/doctrine/DoctrineModule)
     - [DoctrineDataFixtures](https://github.com/doctrine/data-fixtures)
   - [Hounddog/DoctrineDataFixtureModule](https://github.com/Hounddog/DoctrineDataFixtureModule)

## Installation

Installation of RbacUserDoctrineOrm uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

#### Installation steps

  1. `cd my/project/directory`
  2. create a `composer.json` file with following contents:

     ```json
     {
         "require": {
             "esserj/zfc-rbac-user-doctrine-orm": "dev-master"
         }
     }
     ```
  3. install composer via `curl -s http://getcomposer.org/installer | php` (on windows, download
     http://getcomposer.org/installer and execute it with PHP)
  4. run `php composer.phar install`
  5. open `my/project/directory/configs/application.config.php` and add the following to your `modules` key:

     ```php
        'DoctrineModule',
        'DoctrineORMModule',
        'DoctrineDataFixtureModule',
        'ZfcBase',
        'ZfcRbac',
        'ZfcUser',
        'ZfcUserDoctrineORM',
        'RbacUserDoctrineOrm',
     ```
  
  6. setup doctrine database parameters by adding the following to your `my/project/config/autoload/local.php`:
  
     ```php
        'doctrine' => array(
            'connection' => array(
                // default connection name
                'orm_default' => array(
                    'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                    'params' => array(
                        'host'     => 'localhost',
                        'port'     => '3306',
                        'user'     => '', //put your user here
                        'password' => '', //put your pass here
                        'dbname'   => '', //put your database here
                    )
                )
            )
        )
    ```
    
  7. Install or Update database
  
  To install database run this commande :
  ```php
  	.\vendor\bin\doctrine-module orm:clear-cache:metadata
	.\vendor\bin\doctrine-module orm:schema-tool:create
  ```
  
  To update database run this commande :
    ```php
  	.\vendor\bin\doctrine-module orm:schema-tool:update --force
  ```
  
  8. Load data in your database with Doctrine fixtures
  
  Run this commande line to load data
  ```php
  	.\vendor\bin\doctrine-module data-fixture:import
  ```
  This commande add the guest role. You can create your own fixture to load data in your bdd.
  
  9. see the ZfcUser & ZfcRbac pages for controller/view plugins to get started
 