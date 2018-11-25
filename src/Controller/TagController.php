<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Form\TagType;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
    /**
     * @Route("/blog/tag", name="tag_index", methods="GET")
     */
    public function index(TagRepository $tagRepository): Response
    {
        return $this->render('tag/index.html.twig', ['tags' => $tagRepository->findAll()]);
    }

    /**
     * @Route("/blog/tag/new", name="tag_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();

            return $this->redirectToRoute('tag_index');
        }

        return $this->render('tag/new.html.twig', [
            'tag' => $tag,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/blog/tag/{id}", name="tag_show", methods="GET")
     */
    public function show(Tag $tag): Response
    {
        return $this->render('tag/show.html.twig', ['tag' => $tag]);
    }

    /**
     * @Route("/blog/tag/{id}/edit", name="tag_edit", methods="GET|POST")
     */
    public function edit(Request $request, Tag $tag): Response
    {
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tag_index', ['id' => $tag->getId()]);
        }

        return $this->render('tag/edit.html.twig', [
            'tag' => $tag,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/blog/tag/{id}", name="tag_delete", methods="DELETE")
     */
    public function delete(Request $request, Tag $tag): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tag->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tag);
            $em->flush();
        }

        return $this->redirectToRoute('tag_index');
    }

    /* /**
     * @Route("/tag/{tag}", name="tag_list")
     */

    /* public function showByTag(string $tag)
    {
        $tag = $this->getDoctrine()
            ->getRepository(Tag::class)
            ->findOneByName($tag);

        $articles = $tag->getArticles();

        return $this->render('blog/tag.html.twig', ['articles' => $articles, 'tag' => $tag]);
    } */
}
