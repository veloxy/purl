<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Link;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class RedirectController extends Controller
{
    /**
     * @Route("/{code}")
     */
    public function redirectToFullUrl($code)
    {
        /**
         * @var $link Link
         */
        $link = $this->getDoctrine()->getRepository('AppBundle:Link')->findOneBy([
            'code' => $code
        ]);

        $link->setClicks($link->getClicks() + 1);

        $em = $this->getDoctrine()->getManager();
        $em->persist($link);
        $em->flush();

        return $this->redirect($link->getUrl(), 301);
    }
}