<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Link;
use FOS\RestBundle\Controller\Annotations\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class LinksController extends Controller
{
    /**
     * @Route("/v1/links.{_format}", methods={"GET"})
     * @View()
     * @ApiDoc(
     *     description="Get all links",
     *     authentication=true,
     *     requirements={
     *          {
     *               "name"="apiKey",
     *               "dataType"="string",
     *               "description"="Your API key"
     *          }
     *     }
     * )
     */
    public function getLinksAction()
    {
        $links = $this->getDoctrine()->getRepository('AppBundle:Link')->getAllLinks();
        return ['links' => $links];
    }

    /**
     * @Route("/v1/link/{code}.{_format}", methods={"GET"})
     * @View()
     * @param string $code
     * @return array
     * @internal param Link $link
     * @ApiDoc(
     *     description="Get link by code",
     *     authentication=true,
     *     requirements={
     *          {
     *               "name"="apiKey",
     *               "dataType"="string",
     *               "description"="Your API key"
     *          },
     *          {
     *               "name"="code",
     *               "dataType"="string",
     *               "description"="Short URL code"
     *          }
     *     }
     * )
     */
    public function getLinkAction(string $code) : array
    {
        $link = $this->getDoctrine()->getRepository('AppBundle:Link')->getLink($code);

        return [
            'link' => $link
        ];
    }
}