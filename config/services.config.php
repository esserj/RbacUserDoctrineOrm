<?php 
return array(
	'factories' => array(
		'Zend\Authentication\AuthenticationService' => function($serviceManager) {
			return $serviceManager->get('doctrine.authenticationservice.orm_default');
		}
	)
);