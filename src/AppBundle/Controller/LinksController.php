<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Link;
use AppBundle\Form\LinkType;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LinksController extends Controller
{
    /**
     * @Route("/v1/links.{_format}", methods={"GET"})
     * @View()
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
     */
    public function getLinkAction(string $code) : array
    {
        $link = $this->getDoctrine()->getRepository('AppBundle:Link')->getLink($code);

        return [
            'link' => $link
        ];
    }

    /**
     * @Route("/v1/link.{_format}", methods={"POST"})
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