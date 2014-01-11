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


/**
 * User
 *
 * @ORM\MappedSuperclass
 */
abstract class MappedSuperclassUser extends \ZfcUserDoctrineORM\Entity\MappedSuperclassUser implements IdentityInterface
{
    /**
     * @var Role[]
     * 
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="users_roles",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     *      )
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