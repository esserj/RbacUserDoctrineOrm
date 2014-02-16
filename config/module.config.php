<?php
return [
	
    'zfc_rbac' => [  
    	'identity_provider' => 'ZfcRbac\Identity\AuthenticationIdentityProvider',
    	'role_provider' => [
    		'ZfcRbac\Role\ObjectRepositoryRoleProvider' => [
                'object_manager' 		=> 'doctrine.entitymanager.orm_default',
                'class_name'     		=> 'RbacUserDoctrineOrm\Entity\Role',
    			'role_name_property' 	=> 'name'
            ]
    	]
    ],
    'zfcuser' => [
        'user_entity_class' => 'RbacUserDoctrineOrm\Entity\User',
        'enable_default_entities'	=>	false
    ],
    'doctrine' => [
        'driver' => [
            'RbacUserDoctrineEntity' => [
            	'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
            	'paths' => __DIR__ . '/xml/doctrine'
            ],
            'orm_default' => [
                'drivers' => [
                    'RbacUserDoctrineOrm\Entity'  => 'RbacUserDoctrineEntity',
                ]
            ],
        	'zfcuserdoctrineorm_entity' => [
        		'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
        		'cache' => 'array',
        		'paths' => [__DIR__ . '/../src/RbacUserDoctrineOrm/Entity']
        	],
        ],'authentication' => [
			'orm_default' => [
				'object_manager' => 'Doctrine\ORM\EntityManager',
				'identity_class' => 'RbacUserDoctrineOrm\Entity\User',
				'identity_property' => 'email',
				'credential_property' => 'password',
			],
		],
    ],
    'view_manager' => [
        'template_map' => [
            'error/403' => __DIR__ . '/../view/error/403.phtml',
        ]
    ],
    'data-fixture' => [
    	'RbacUserDoctrineOrmFixture' => __DIR__ . '/../src/RbacUserDoctrineOrm/Fixture',
    ]
];