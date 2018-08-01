<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Form\BlogType;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BlogController
 *
 * @package App\Controller
 *
 * @Route("/blog")
 */
class BlogController extends FOSRestController
{
    /**
     * @param  Request $request
     * @return Response
     *
     * @Route("",
     *     name="blog.create",
     *     methods={"POST"})
     *
     * @SWG\Parameter(
     *     name="post",
     *     in="body",
     *     description="Post info",
     *     @Model(type=BlogType::class)
     * )
     *
     * @SWG\Tag(name="Blog           Post")
     * @SWG\Response(response="201", description="ok")
     */
    public function createAction(Request $request): Response
    {

        $form = $this->createForm(BlogType::class);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var BlogPost $post
             */
            $post = $form->getData();
            $post->setAuthor($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            $view = $this->view(['message' => 'success']);
            return $this->handleView($view);
        }

        $view = $this->view($form);
        return $this->handleView($view);
    }

    /**
     * @param  BlogPost $post
     * @param  Request  $request
     * @return Response
     *
     * @Route("/{post}",
     *     methods={"PATCH"},
     *     name="blog.edit",
     *     requirements={"post": "\d{1,10}"},
     *     defaults={"post": 0})
     *
     * @SWG\Parameter(
     *     name="post",
     *     in="body",
     *     description="Edited post",
     *     @Model(type=BlogType::class)
     * )
     *
     * @SWG\Tag(name="Blog           Post")
     * @SWG\Response(response="200", description="ok")
     */
    public function editAction(BlogPost $post, Request $request): Response
    {
        $form = $this->createForm(BlogType::class, $post);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var BlogPost $post
             */
            $post = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            $view = $this->view(['message' => 'success']);
            return $this->handleView($view);
        }

        $view = $this->view($form);
        return $this->handleView($view);
    }

    /**
     * @param BlogPost $post
     * @param string   $status
     *
     * @return Response
     *
     * @Route("/{post}/{status}",
     *     name="blog.change_status",
     *     methods={"POST"},
     *     requirements={"post": "\d{1,10}", "status": "draft|publish"},
     *     defaults={"post": 0, "status": "draft"})
     *
     * @SWG\Tag(name="Blog Post")
     *
     * @SWG\Parameter(name="post",                    in="path", type="integer")
     * @SWG\Parameter(name="status",                  in="path", type="string")
     * @SWG\Response(response="200",description="ok")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function changeStatusAction(BlogPost $post, string $status): Response
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $post->setStatus($status);

        $this->getDoctrine()->getManager()->flush();

        $view = $this->view(['message' => 'success']);
        return $this->handleView($view);
    }

    /**
     * @param  Request $request
     * @return Response
     *
     * @Route("",
     *     methods={"GET"},
     *     name="blog.list")
     *
     * @SWG\Parameter(name="page",     type="integer", in="query", description="Page")
     * @SWG\Parameter(name="per_page", type="integer", in="query", description="Per Page")
     * @SWG\Tag(name="Blog             Post")
     * @SWG\Response(response="200",   description="list of posts")
     */
    public function listAction(Request $request): Response
    {
        $data = $this->getDoctrine()
            ->getRepository(BlogPost::class)
            ->getList($request->get('page', 1), $request->get('per_page', 25))
            ->getQuery()->getResult();

        $view = $this->view(['data' => $data]);
        $context = new Context();
        $groups = [
                   'user',
                   'published_at',
                  ];

        if ($this->isGranted('ROLE_ADMIN')) {
            $groups[] = 'admin';
        }
        $context->setGroups($groups);

        $view->setContext($context);
        return $this->handleView($view);
    }

    /**
     * @param  BlogPost $post
     * @return Response
     *
     * @Route("/post/{slug}",
     *     methods={"GET"},
     *     requirements={"slud": ".*"})
     *
     * @ParamConverter("post",       options={"mapping": {"slug": "slug"}})
     * @SWG\Response(response="200", description="GEt post by slug")
     * @SWG\Tag(name="Blog           Post")
     */
    public function getPostAction(BlogPost $post): Response
    {
        $view = $this->view(['data' => $post]);
        $context = new Context();
        $groups = [
                   'user',
                   'published_at',
                  ];

        if ($this->isGranted('ROLE_ADMIN')) {
            $groups[] = 'admin';
        }
        $context->setGroups($groups);

        $view->setContext($context);
        return $this->handleView($view);
    }
}
