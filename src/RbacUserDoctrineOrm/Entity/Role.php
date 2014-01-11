<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */
namespace RbacUserDoctrineOrm\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use RecursiveIterator;
use Rbac\Role\HierarchicalRoleInterface;
use Rbac\Role\RoleInterface;
use Rbac\Role\HierarchicalRole;

/**
 * Role
 * 
 * @ORM\Entity
 * @ORM\Table(name="roles")
 */
class Role extends HierarchicalRole
{
    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=48, unique=true)
     */
    protected $name;

    /**
     * @var HierarchicalRoleInterface[]|\Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="roles_roles",
     *     joinColumns={@ORM\JoinColumn(name="role_parent", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_child", referencedColumnName="id")}
     *     )
     */
    protected $children = [];

    /**
     * @var PermissionInterface[]|\Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Permission", indexBy="name", fetch="EAGER")
     * @ORM\JoinTable(name="roles_permissions",
     *     joinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="permission_id", referencedColumnName="id")}
     *     )
     */
    protected $permissions;

    /**
     * Init the Doctrine collection
     */
    public function __construct($name)
    {
        $this->children    = new ArrayCollection();
        $this->permissions = new ArrayCollection();
        parent::__construct($name);
    }

    /**
     * Get the role identifier
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the role name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
