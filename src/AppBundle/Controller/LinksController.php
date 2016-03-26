<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Link;
use Doctrine\ORM\EntityManager;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class LinksController extends Controller
{
    /**
     * @Route("/v1/links.{_format}")
     * @View()
     */
    public function getLinksAction()
    {
        $links = $this->getDoctrine()->getRepository('AppBundle:Link')->getAllLinks();
        return ['links' => $links];
    }

    /**
     * @Route("/v1/link/{code}.{_format}")
     * @View()
     * @param string $code
     * @return array
     * @internal param Link $link
     */
    public function getLinkAction(string $code) : array
    {
        $link = $this->getDoctrine()->getRepository('AppBundle:Link')->getLink($code);

        return [
            'link' => $link
        ];
    }
}