<?php
/**
 * Role.php file
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

use Doctrine\ORM\PersistentCollection;
use Doctrine\ORM\Mapping as ORM;
use RecursiveIterator;
use IteratorIterator;
use Zend\Permissions\Rbac\RoleInterface;

/**
 * Role
 *
 * @ORM\Table(name="rbac_role")
 * @ORM\Entity
 */
class Role implements RoleInterface{

    /**
     * @var int
     * 
     * @ORM\Column(name="role_id", type="integer", length=1, nullable=false, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var Role
     * 
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="children")
     * @ORM\JoinColumn(name="parent_role_id", referencedColumnName="role_id")
     */
    protected $parent;

    /**
     * @var PersistentCollection|Role[]
     * 
     * @ORM\OneToMany(targetEntity="Role", mappedBy="parent")
     */
    protected $children;

    /**
     * @var string
     * 
     * @ORM\Column(name="role_name", type="string", length=32, nullable=true)
     */
    protected $name;
    
    /**
     * @var PersistentCollection
     *
     * @ORM\ManyToMany(targetEntity="Permission")
     * @ORM\JoinTable(name="rbac_role_permission",
     *      joinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="role_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="perm_id", referencedColumnName="perm_id")}
     *      )
     */
    protected $permissions;

    /**
     * current position in the children array
     * @var int
     */
    protected $childrenPosition=0;

    /**
     * @param int $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param Role $parent
     * @return self
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param PersistentCollection $children
     * @return $this
     */
    public function setChildren($children)
    {
        $this->children = $children;
        return $this;
    }

    /**
     * @return Role[]|RecursiveIterator[]
     */
    public function getChildren()
    {
        $children = $this->children->getValues();
        return $children[$this->childrenPosition];
    }

    /**
     * @param PersistentCollection $permissions
     * @return self
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
        return $this;
    }

    /**
     * @param bool $recursive when true child permissions of a role are returned as well
     * @return PersistentCollection|Permission[]
     */
    public function getPermissions($recursive=false)
    {
        if (!$recursive) {
            return $this->permissions;
        }
        $permissions =  $this->permissions->getValues();
        $it = new IteratorIterator($this);
        foreach ($it as $leaf) {
            $permissions = array_merge($permissions, $leaf->getPermissions(true));
        }
        return $permissions;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        $children = $this->children->getValues();
        return $children[$this->childrenPosition];
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        $this->childrenPosition++;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->childrenPosition;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     *       Returns true on success or false on failure.
     */
    public function valid()
    {
        $children = $this->children->getValues();
        return isset($children[$this->childrenPosition]);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->childrenPosition=0;
    }

    /**
     * Add permission to the role.
     *
     * @param $name
     * @return RoleInterface
     */
    public function addPermission($name)
    {
        $permission = new Permission();
        $permission->setName($name);
        $this->getPermissions()->add($permission);
        return $this;
    }

    /**
     * Checks if a permission exists for this role or any child roles.
     *
     * @param  string $name
     * @return bool
     */
    public function hasPermission($name)
    {
        foreach ($this->getPermissions(true) as $permission) {
            if ($permission->getName() == $name) {
                return true;
            }
        }

        return false;
    }


    /**
     * Add a child.
     *
     * @param  RoleInterface|string $child
     * @return RoleInterface
     */
    public function addChild($child)
    {
        $this->children->add($child);
        return $this;
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Returns if an iterator can be created for the current entry.
     * @link http://php.net/manual/en/recursiveiterator.haschildren.php
     * @return bool true if the current entry can be iterated over, otherwise returns false.
     */
    public function hasChildren()
    {
        return ($this->children->count() > 0);
    }
    
    public function __toString()
    {
        return $this->name;
    }
}
