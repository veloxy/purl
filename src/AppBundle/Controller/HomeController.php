<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Link;
use AppBundle\Form\LinkType;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/")
     * @View()
     * @param Request $request
     * @return array
     */
    public function homeAction(Request $request)
    {
        $link = new Link();
        $form = $this->createForm(LinkType::class, $link);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($link);
            $em->flush();
        }

        return [
            'link' => $link,
            'form' => $form->createView(),
        ];
    }
}