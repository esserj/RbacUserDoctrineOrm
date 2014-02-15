<?php
namespace RbacUserDoctrineOrm\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use ZfcRbac\Identity\IdentityInterface;
use ZfcUserDoctrineORM\Entity\User as ZfcUserDoctrineORMUser;

/**
 * User
 * 
 */
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