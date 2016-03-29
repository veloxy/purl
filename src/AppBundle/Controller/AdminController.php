<?php

namespace AppBundle\Controller;


use AppBundle\Entity\ApiKey;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Ramsey\Uuid\Uuid;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends BaseAdminController
{
    public function createNewUserEntity()
    {
        return $this->get('fos_user.user_manager')->createUser();
    }

    public function prePersistUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
    }

    public function preUpdateUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
    }

    /**
     * @Route(path = "/users/generate_api_key", name = "generate_api_key")
     * @Security("has_role('ROLE_ADMIN')")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function generateApiKeyAction(Request $request)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy([
            'id' => $request->query->get('id')
        ]);

        $apiKey = new ApiKey();
        $apiKey->setUser($user)
            ->setApiKey(Uuid::uuid1());

        $em = $this->getDoctrine()->getManager();
        $em->persist($apiKey);
        $em->flush();

        return $this->redirectToRoute('easyadmin', array(
            'action' => 'show',
            'entity' => 'ApiKey',
            'id' => $apiKey->getId()
        ));
    }
}