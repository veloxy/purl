<?php

namespace AppBundle\EventSubscriber;

use AppBundle\Entity\Visit;
use AppBundle\Event\LinkVisitEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class LinkVisitEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * LinkVisitEventSubscriber constructor.
     * @param EntityManager $em
     * @param RequestStack $requestStack
     */
    public function __construct(EntityManager $em, RequestStack $requestStack)
    {
        $this->em = $em;
        $this->requestStack = $requestStack;
    }

    /**
     * @param $event LinkVisitEvent
     */
    public function onLinkVisit(LinkVisitEvent $event)
    {

        $visit = new Visit();
        $visit->setLink($event->getLink())
            ->setIpAddress($this->requestStack->getCurrentRequest()->getClientIp())
            ->setVisitedAt(new \DateTime());

        $this->em->persist($visit);
        $this->em->flush();
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            LinkVisitEvent::NAME => 'onLinkVisit',
        ];
    }
}