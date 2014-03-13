<?php
/**
 * RoleOptions.php file
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


namespace RbacUserDoctrineOrm\Options;


use Zend\Stdlib\AbstractOptions;

class RoleMapperOptions extends AbstractOptions {

    /**
     * the class to use as a role entity
     * @var string
     */
    protected $entityClass;

    /**
     * @param string $entityClass
     * @return self
     */
    public function setEntityClass($entityClass)
    {
        $this->entityClass = $entityClass;
        return $this;
    }

    /**
     * @return string
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }



}