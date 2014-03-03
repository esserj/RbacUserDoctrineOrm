<?php
namespace RbacUserDoctrineOrm\Entity;

use Rbac\Permission\PermissionInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Permission
 * 
 */
class Permission implements PermissionInterface
{
    /**
     * @var int|null
     *
     */
    protected $id;

    /**
     * @var string|null
     *
     */
    protected $name;
    
    /**
     * @var Role[]|\Doctrine\Common\Collections\Collection
     */
    protected $roles;

    /**
     * Constructor
     */
    public function __construct($name)
    {
        $this->name  = (string) $name;
        $this->roles    = new ArrayCollection();
    }

    /**
     * Get the permission identifier
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return Role[]|\Doctrine\Common\Collections\Collection
     */
    public function getRoles()
    {
    	return $this->roles;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return $this->name;
    }
}
