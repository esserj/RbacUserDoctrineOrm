<?php
/**
 * User.php file
 * 
 * PHP Version 5
 * 
 * @category   ${category}
 * @package    Inventis
 * @subpackage Bricks
 * @author     Inventis Web Architects <info@inventis.be>
 * @license    Copyright © Inventis BVBA  - All rights reserved
 * @link       https://github.com/Inventis/Bricks
 */


namespace RbacUserDoctrineOrm\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use ZfcRbac\Identity\IdentityInterface;
use RbacUserDoctrineOrm\Entity\MappedSuperclassUser;


/**
 * User
 *
 * @ORM\Entity
 */
class User extends MappedSuperclassUser implements IdentityInterface
{
    
}