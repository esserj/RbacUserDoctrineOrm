<?php


namespace RbacUserDoctrineOrm\Service;

use ZfcRbac\Service\Rbac as ZfcRbac;

/**
 * Zfc Rbac service is not compatible with doctrine ORM PersistantCollection
 * so we either need to enforce getValues() on the role entities or fix the zfcRbac service
 * the latter should have less impact on performance, but has a higher maintenance cost
 * Class Rbac
 * @package RbacUserDoctrineOrm\Service
 */
class Rbac extends ZfcRbac {

    /**
     * Returns true if the user has the role (can pass an array).
     *
     * @param string|array $roles
     * @return bool
     */
    public function hasRole($roles)
    {
        if (!$this->getIdentity()) {
            return false;
        }

        if (!is_array($roles)) {
            $roles = array($roles);
        }

        $rbac = $this->getRbac();

        // Have to iterate and load roles to verify that parents are loaded.
        // If it wasn't for inheritance we could just check the getIdentity()->getRoles() method.
        foreach($roles as $role) {
            foreach($this->getIdentity()->getRoles() as $userRole) {
                $event = new Event;
                $event->setRole($userRole)
                    ->setRbac($rbac);

                $this->getEventManager()->trigger(Event::EVENT_HAS_ROLE, $event);

                if (!$this->getRbac()->hasRole($role)) {
                    continue;
                }

                // Fastest - do they match directly?
                if ($userRole == $role) {
                    return true;
                }

                // Last resort - check children from rbac.
                $it = new RecursiveIteratorIterator($rbac->getRole($userRole), RecursiveIteratorIterator::CHILD_FIRST);
                foreach($it as $leaf) {
                    if ($leaf->getName() == $role) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
}
