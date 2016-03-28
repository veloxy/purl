<?php

namespace AppBundle\Controller;


use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/")
     * @View()
     */
    public function homeAction()
    {
//        dump('ok'); exit;
//        return ;
    }
}