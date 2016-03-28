<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Link;
use AppBundle\Form\LinkType;
use FOS\RestBundle\Controller\Annotations\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     */
    public function postLinkAction(Request $request)
    {
        $link = new Link();
        $link->setUser($this->get('security.token_storage')->getToken()->getUser())
            ->setClicks(0)
            ->setUrl('http://test.com')
            ->setCode('duiwduw');

        $form = $this->createForm(LinkType::class, $link);

        $form->handleRequest($request);
dump($link);
        if ($form->isValid()) {
            dump('valid form'); exit;
        } else {
            dump('invalid form'); exit;
        }

        $errors = $this->get('validator')->validate($link);
        if (count($errors) > 0) {
            dump('error'); exit;
        } else {
            dump('not error'); exit;
        }
    }
}