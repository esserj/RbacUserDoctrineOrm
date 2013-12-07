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

use Doctrine\ORM\Mapping as ORM;
use RecursiveIterator;
use IteratorIterator;
use ZfcRbac\Permission\PermissionInterface;

/**
 * Role
 *
 * @ORM\Table(name="rbac_permission")
 * @ORM\Entity
 */
class Permission implements PermissionInterface{

    /**
     * @var int
     * 
     * @ORM\Column(name="perm_id", type="integer", length=11, nullable=false, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     * 
     * @ORM\Column(name="perm_name", type="string", length=32, nullable=true)
     */
    protected $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="perm_desc", type="text", nullable=true)
     */
    protected $description;
    
    
    protected $roles;

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

    public function __toString()
    {
        return $this->name;
    }
	/* (non-PHPdoc)
	 * @see \ZfcRbac\Permission\PermissionInterface::getRoles()
	 */
	public function getRoles($recursive=false) {
		if (!$recursive) {
			return $this->roles;
		}
		$roles =  $this->roles->getValues();
		$it = new IteratorIterator($this);
		foreach ($it as $leaf) {
			$roles = array_merge($roles, $leaf->getRoles(true));
		}
		return $roles;
	}

}