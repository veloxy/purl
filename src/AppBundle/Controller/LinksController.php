<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Link;
use AppBundle\Form\LinkType;
use FOS\RestBundle\Controller\Annotations\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
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
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $links = $this->getDoctrine()->getRepository('AppBundle:Link')->getAllLinksByUserId($user->getId());
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

    /**
     * @Route("/v1/link.{_format}", methods={"POST", "GET"})
     * @View()
     * @param Request $request
     * @return array
     */
    public function postLinkAction(Request $request)
    {
        $link = new Link();
        $link->setUser($this->get('security.token_storage')->getToken()->getUser());

        $form = $this->createForm(LinkType::class, $link);
        $form->submit(json_decode($request->getContent(), true));
        $form->handleRequest($request);

        if (!$form->isValid()) {
            return ['form' => $form];
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($link);
        $em->flush();

        $linkResponse = $this->getDoctrine()->getRepository('AppBundle:Link')->getLink($link->getCode());

        return [
            'link' => $linkResponse,
            'url' => sprintf('%s/%s', $this->getParameter('host'), $link->getCode()),
        ];
    }
}