<?php
namespace RbacUserDoctrineOrm\Entity;

use ZfcRbac\Identity\IdentityInterface;
use ZfcUser\Entity\User as ZfcUserDoctrineORMUser;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 * 
 */
class User extends ZfcUserDoctrineORMUser implements IdentityInterface
{
	/**
	 * @var Role[]|\Doctrine\Common\Collections\Collection
	 */
	protected $roles;
	
	/**
	 * Init the Doctrine collection
	 */
	public function __construct()
	{
		$this->roles    = new ArrayCollection();
	}
	
	/**
	 * @return Role[]|\Doctrine\Common\Collections\Collection
	 */
	public function getRoles()
	{
		return $this->roles;
	}
	
	/**
	 * @param \Doctrine\Common\Collections\Collection $roles
	 * @return self
	 */
	public function setRoles($roles)
	{
		$this->roles = new ArrayCollection();
		if(count($roles)){
			foreach($roles as $role){
				if(!$this->hasRole($role)){
					$this->addRole($role);
				}
			}
		}
		
		return $this;
	}
	
	/**
	 * @param Role $role
	 * @return self
	 */
	public function addRole($role)
	{
		$this->roles[(string) $role] = $role;
		return $this;
	}
	
	/**
	 * @param Role $role
	 * @return bool
	 */
	public function hasRole($role)
	{
		return isset($this->roles[(string) $role]);
	}
}