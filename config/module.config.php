<?php
return array(
    'rbac-user-doctrine-orm' => array(
        'mapper' => array(
            'role' => array(
                'entityClass' => 'RbacUserDoctrineOrm\Entity\Role'
            )
        )
    ),
    'zfcrbac' => array(
        'providers' => array(
            'RbacUserDoctrineOrm\Provider\AdjacencyList\Role\DoctrineORM' => array(),
        ),
        /**
         * have identities provided by zfc-user module
         */
        'identity_provider' => 'zfcuser_auth_service'
    ),
    'zfcuser' => array(
        'userEntityClass' => 'RbacUserDoctrineOrm\Entity\User'
    ),
    'doctrine' => array(
        'driver' => array(
            'RbacUserDoctrineEntity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => __DIR__ . '/xml/doctrine'
            ),

            'orm_default' => array(
                'drivers' => array(
                    'RbacUserDoctrineOrm\Entity'  => 'RbacUserDoctrineEntity'
                )
            )
        )
    )
);