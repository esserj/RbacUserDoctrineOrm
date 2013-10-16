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


class Permission {

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

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

}