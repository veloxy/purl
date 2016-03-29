<?php

namespace AppBundle\EventListener;


use AppBundle\Entity\Link;
use AppBundle\Service\CodeGeneratorService;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;

class LinkCodeGenerator implements EventSubscriber
{
    /**
     * @var CodeGeneratorService
     */
    private $codeGeneratorService;

    /**
     * LinkCodeGenerator constructor.
     * @param CodeGeneratorService $codeGeneratorService
     */
    public function __construct(CodeGeneratorService $codeGeneratorService)
    {
        $this->codeGeneratorService = $codeGeneratorService;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Link) {
            return;
        }

        if (!$entity->getCode()) {
            $code = $this->codeGeneratorService->generateCode();
            $entity->setCode($code);
        }
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [
            'prePersist',
        ];
    }
}