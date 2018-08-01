<?php

namespace App\Filter;

use Doctrine\Common\Annotations\Reader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class Configurator
 *
 * @package App\Filter
 */
class Configurator
{

    /**
     *
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     *
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     *
     * @var Reader
     */
    protected $reader;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * Configurator constructor.
     *
     * @param EntityManagerInterface        $em
     * @param TokenStorageInterface         $tokenStorage
     * @param Reader                        $reader
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(
        EntityManagerInterface $em,
        TokenStorageInterface $tokenStorage,
        Reader $reader,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
        $this->reader = $reader;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     *
     * @param GetResponseEvent $request
     *
     * @throws \InvalidArgumentException
     */
    public function onKernelRequest(GetResponseEvent $request): void
    {
        if ($this->tokenStorage->getToken() !== null && !$this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            /**
             *
             * @var RoleFilter $filter
             */
            $filter = $this->em->getFilters()->enable('role_filter');
            $filter->setAnnotationReader($this->reader);
        }
    }
}
