<?php

namespace AppBundle\Event;

use AppBundle\Entity\Link;
use Symfony\Component\EventDispatcher\Event;

class LinkVisitedEvent extends Event
{
    /**
     * Event name
     */
    const NAME = 'link.visited';

    /**
     * @var Link
     */
    protected $link;

    /**
     * LinkVisitedEvent constructor.
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