<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as FOSUser;

/**
 * Class User
 * @package AppBundle\Entity
 * @ORM\Table(name="`user`")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends FOSUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ApiKey[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ApiKey", mappedBy="user")
     */
    private $apiKeys;

    /**
     * @return mixed
     */
    public function getApiKeys()
    {
        return $this->apiKeys;
    }

    /**
     * @param mixed $apiKeys
     * @return User
     */
    public function setApiKeys($apiKeys)
    {
        $this->apiKeys = $apiKeys;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}