<?php
namespace RbacUserDoctrineOrm\Entity;

use Doctrine\ORM\Mapping as ORM;
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
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=128, unique=true)
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
