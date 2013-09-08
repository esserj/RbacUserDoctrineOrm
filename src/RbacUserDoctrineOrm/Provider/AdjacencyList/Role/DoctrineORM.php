<?php


namespace RbacUserDoctrineOrm\Provider\AdjacencyList\Role;


use RbacUserDoctrineOrm\Mapper\Role AS RoleMapper;
use ZfcRbac\Provider\AbstractProvider;
use ZfcRbac\Provider\Event;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZfcRbac\Provider\ProviderInterface;

class DoctrineORM extends AbstractProvider implements ListenerAggregateInterface, ProviderInterface {

    /**
     * @var RoleMapper
     */
    protected $roleMapper;

    public function __construct(RoleMapper $roleMapper)
    {
        $this->roleMapper = $roleMapper;
    }

    /**
     * Attach one or more listeners
     *
     * Implementers may add an optional $priority argument; the EventManager
     * implementation will pass this to the aggregate.
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function attach(EventManagerInterface $events)
    {
        $events->attach(Event::EVENT_LOAD_ROLES, array($this, 'loadRoles'));
    }

    /**
     * Detach all previously attached listeners
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function detach(EventManagerInterface $events)
    {
        $events->detach($this);
    }

    public function loadRoles(Event $e)
    {
        $roles = $this->roleMapper->findAll();
        $rbac = $e->getRbac();
        foreach ($roles as $role) {
            $rbac->addRole($role);
        }
    }

    /**
     * Factory to create the provider.
     *
     * @static
     * @param \Zend\ServiceManager\ServiceLocatorInterface $sl
     * @param mixed                                        $spec
     * @return mixed
     */
    public static function factory(ServiceLocatorInterface $sl, array $spec)
    {
        /** @var RoleMapper $roleMapper */
        $roleMapper = $sl->get('RbacUserDoctrineOrmRoleMapper');
        return new self($roleMapper);
    }
}
