<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Visit
 * @package AppBundle\Entity
 * @ORM\Table(name="visit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VisitRepository")
 */
class Visit
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Link
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Link", inversedBy="visit")
     * @ORM\JoinColumn(name="link_id", referencedColumnName="id")
     */
    private $link;

    /**
     * @var string
     * @ORM\Column(name="ip_address", length=45, type="string")
     */
    private $ipAddress;

    /**
     * @var datetime
     *
     * @ORM\Column(name="visited_at", type="datetime")
     */
    private $visitedAt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Visit
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Link
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param Link $link
     * @return Visit
     */
    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return datetime
     */
    public function getVisitedAt()
    {
        return $this->visitedAt;
    }

    /**
     * @param datetime $visitedAt
     * @return Visit
     */
    public function setVisitedAt($visitedAt)
    {
        $this->visitedAt = $visitedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @param string $ipAddress
     * @return Visit
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
        return $this;
    }
}