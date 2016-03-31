<?php

namespace AppBundle\Event;

use AppBundle\Entity\Link;
use Symfony\Component\EventDispatcher\Event;

class LinkVisitEvent extends Event
{
    /**
     * Event name
     */
    const NAME = 'link.visit';

    /**
     * @var Link
     */
    protected $link;

    /**
     * LinkVisitEvent constructor.
     * @param Link $link
     */
    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    public function getLink()
    {
        return $this->link;
    }
}