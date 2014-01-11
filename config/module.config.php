<?php
return array(
    'zfc_rbac' => array(  
    	'identity_provider' => 'ZfcRbac\Identity\AuthenticationIdentityProvider',
    	'role_provider' => [
    		'ZfcRbac\Role\ObjectRepositoryRoleProvider' => [
                'object_manager' 		=> 'doctrine.entitymanager.orm_default',
                'class_name'     		=> 'RbacUserDoctrineOrm\Entity\Role',
    			'role_name_property' 	=> 'name'
            ]
    	]
    ),
    'zfcuser' => array(
        'userEntityClass' => 'RbacUserDoctrineOrm\Entity\User'
    ),
    'doctrine' => array(
        'driver' => array(
            'RbacUserDoctrineEntity' => array(
            	//Add Doctrine Xml driver
            	//'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
            	//'paths' => __DIR__ . '/xml/doctrine'
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => __DIR__ . '/../src/RbacUserDoctrineOrm/Entity'
            ),
            'orm_default' => array(
                'drivers' => array(
                    'RbacUserDoctrineOrm\Entity'  => 'RbacUserDoctrineEntity',
                	'ZfcUserDoctrineORM\Entity' =>  'RbacUserDoctrineEntity'
                )
            ),
        	'zfcuserdoctrineorm_entity' => array(
        		'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
        		'cache' => 'array',
        		'paths' => array(__DIR__ . '/../src/RbacUserDoctrineOrm/Entity')
        	),
        ),'authentication' => array(
			'orm_default' => array(
				'object_manager' => 'Doctrine\ORM\EntityManager',
				'identity_class' => 'RbacUserDoctrineOrm\Entity\User',
				'identity_property' => 'email',
				'credential_property' => 'password',
			),
		),
    ),
    'view_manager' => array(
        'template_map' => array(
            'error/403' => __DIR__ . '/../view/error/403.phtml',
        )
    ),
);