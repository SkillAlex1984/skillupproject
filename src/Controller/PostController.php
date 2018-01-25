<?php
/**
 * Created by PhpStorm.
 * User: MY
 * Date: 24.01.2018
 * Time: 21:21
 */

namespace App\Controller;


use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class PostController extends Controller
{

    /**
     * @Route("/exam")
     */
    public function show()
    {
        return $this->render('exm_base.html.twig');
    }

    /**
     * @Route("/exam/general", name="show_post")
     */
    public function homePage()
    {
        $repo = $this->getDoctrine()->getRepository(Post::class);

        $posts = $repo->findAll();

        return $this->render('exam/homepage.html.twig', ['posts'=>$posts]);
    }


    /**
     * @Route("/exam/post-page/{id}", name="post_page")
     *
     * @ParamConverter("id", options={"mapping":{"id": "id"}})
     */
    public function postPage(Post $post, SessionInterface $session)
    {

        $session->set('', $post->getId());

        return $this->render('exam/postpage.html.twig', ['post'=>$post]
        );

    }


    /**
     * @Route("/exam/add-post", name="add_post")
     */
    public function addPostPage(Request $request)
    {
        $post = new Post();

        $form = $this->createFormBuilder($post)
            ->add('dataPost', DateType::class, array('widget' => 'single_text'))
            ->add('heading', TextType::class)
            ->add('textPost', TextType::class)

            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('show_post');
        }

        return $this->render('exam/addpost.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/exam/edit-post/{id}", name = "edit_post")
     *
     * @ParamConverter("id", options={"mapping":{"id": "id"}})
     */
    public function editPostPage(Post $post, SessionInterface $session, Request $request)
    {
        $form = $this->postPage($post, $session);


        $form = $this->createFormBuilder($post)
            ->add('dataPost', DateType::class)
            ->add('heading', TextType::class)
            ->add('textPost', TextType::class)

            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('show_post');
        }

        return $this->render('exam/editpost.html.twig', array(
            'form' => $form->createView(),
        ));



    }
}