<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Link;
use AppBundle\Event\LinkVisitEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Routing\Annotation\Route;

class RedirectController extends Controller
{
    /**
     * @Route("/{code}")
     * @param $code
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToFullUrl($code)
    {
        /**
         * @var $link Link
         */
        $link = $this->getDoctrine()->getRepository('AppBundle:Link')->findOneBy([
            'code' => $code
        ]);

        $event = new LinkVisitEvent($link);
        $dispatcher = $this->get('event_dispatcher');
        $dispatcher->dispatch(LinkVisitEvent::NAME, $event);

        return $this->redirect($link->getUrl(), 301);
    }
}