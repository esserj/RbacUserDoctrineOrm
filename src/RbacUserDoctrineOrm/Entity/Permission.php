<?php
namespace RbacUserDoctrineOrm\Entity;

use Rbac\Permission\PermissionInterface;

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
     * Constructor
     */
    public function __construct($name)
    {
        $this->name  = (string) $name;
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
     * {@inheritDoc}
     */
    public function __toString()
    {
        return $this->name;
    }
}
