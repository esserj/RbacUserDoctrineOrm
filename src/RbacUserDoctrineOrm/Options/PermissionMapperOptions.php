<?php

namespace RbacUserDoctrineOrm\Options;


use Zend\Stdlib\AbstractOptions;

class PermissionMapperOptions extends AbstractOptions {

    /**
     * the class to use as a permission entity
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