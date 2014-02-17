<?php
namespace RbacUserDoctrineOrm\Entity;

use Rbac\Role\HierarchicalRoleInterface;
use Rbac\Role\RoleInterface;
use Rbac\Role\HierarchicalRole;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Role
 * 
 */
class Role extends HierarchicalRole
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
     * @var HierarchicalRoleInterface[]|\Doctrine\Common\Collections\Collection
     *
     */
    protected $children = [];

    /**
     * @var PermissionInterface[]|\Doctrine\Common\Collections\Collection
     *
     */
    protected $permissions;

    /**
     * Init the Doctrine collection
     */
    public function __construct($name)
    {
        $this->children    = new ArrayCollection();
        $this->permissions = new ArrayCollection();
        parent::__construct($name);
    }

    /**
     * Get the role identifier
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the role name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * 
     * @return string
     */
    public function __toString(){
    	return $this->name;
    }
}
