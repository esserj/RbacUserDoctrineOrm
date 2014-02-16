<?php 
namespace RbacUserDoctrineOrm\Fixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use RbacUserDoctrineOrm\Entity\Role as Role;

class LoadData implements FixtureInterface
{
	/**
	 * {@inheritDoc}
	 */
	public function load(ObjectManager $manager)
	{
		$guest = new Role('guest');

		$manager->persist($guest);
		$manager->flush();
	}
}