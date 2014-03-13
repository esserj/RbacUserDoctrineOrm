<?php 
return array(
	'factories' => array(
		'Zend\Authentication\AuthenticationService' => function($serviceManager) {
			return $serviceManager->get('doctrine.authenticationservice.orm_default');
		},
		'RbacUserDoctrineOrmRoleMapper' => function ($sm) {
			return new RbacUserDoctrineOrm\Mapper\Role(
				$sm->get('zfcuser_doctrine_em'),
				$sm->get('RbacUserDoctrineOrmRoleMapperOptions')
			);
		},
		'RbacUserDoctrineOrmPermissionMapper' => function ($sm) {
			return new RbacUserDoctrineOrm\Mapper\Permission(
				$sm->get('zfcuser_doctrine_em'),
				$sm->get('RbacUserDoctrineOrmPermissionMapperOptions')
			);
		},
		'RbacUserDoctrineOrmRoleMapperOptions' => function ($sm) {
			$config = $sm->get('Configuration');
			return new RbacUserDoctrineOrm\Options\RoleMapperOptions(
					(isset($config['rbac-user-doctrine-orm']['mapper']['role'])
							? $config['rbac-user-doctrine-orm']['mapper']['role']
							: array())
			);
		},
		'RbacUserDoctrineOrmPermissionMapperOptions' => function ($sm) {
			$config = $sm->get('Configuration');
			return new RbacUserDoctrineOrm\Options\PermissionMapperOptions(
					(isset($config['rbac-user-doctrine-orm']['mapper']['permission'])
							? $config['rbac-user-doctrine-orm']['mapper']['permission']
							: array())
			);
		},
		'RbacUserDoctrineOrmRoleMapperOptions' => function ($sm) {
			$config = $sm->get('Configuration');
			return new RbacUserDoctrineOrm\Options\RoleMapperOptions(
					(isset($config['rbac-user-doctrine-orm']['mapper']['role'])
							? $config['rbac-user-doctrine-orm']['mapper']['role']
							: array())
			);
		},
	)
);