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


namespace RbacUserDoctrineOrm\Mapper;


use Doctrine\ORM\EntityManager;
use RbacUserDoctrineOrm\Options\RoleMapperOptions;

class Role {

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var RoleMapperOptions
     */
    protected $options;


    public function __construct(EntityManager $em, RoleMapperOptions $options)
    {
        $this->em      = $em;
        $this->options = $options;
    }

    public function findAll()
    {
        $er = $this->em->getRepository($this->options->getEntityClass());
        return $er->findAll();
    }
}