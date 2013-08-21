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

## Installation

Installation of ZfcRbac uses composer. For composer documentation, please refer to
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
  5. open `my/project/directory/configs/application.config.php` and add the following key to your `modules`:

     ```php
        'DoctrineModule',
        'DoctrineORMModule',
        'ZfcBase',
        'ZfcRbac',
        'ZfcUser',
        'ZfcUserDoctrineORM',
        'RbacUserDoctrineOrm',
     ```
     
## Providers

Providers are listeners that hook into various events to provide roles and permissions. ZfcRbac ships with
several providers that you can use out of the box, but none support ORM, this is where we come in:

  - Generic Providers:
    - Permissions & Roles (RbacUserDoctrineOrm\Provider\AdjacencyList\Role): uses Doctrine ORM to return a role that has permissions


