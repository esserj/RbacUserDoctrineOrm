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
use ZfcUserDoctrineORM\Entity\User as ZfcUserDoctrineORMUser;


class User extends ZfcUserDoctrineORMUser implements IdentityInterface
{
	/**
	 * @var Role[]
	 */
	protected $roles;
	
	/**
	 * @return PersistentCollection|Role[]
	 */
	public function getRoles()
	{
		return $this->roles;
	}
	
	/**
	 * @param PersistentCollection $roles
	 * @return self
	 */
	public function setRoles(PersistentCollection $roles)
	{
		$this->roles = $roles;
		return $this;
	}
}