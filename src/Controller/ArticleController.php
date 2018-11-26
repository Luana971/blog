<?php

namespace App\Controller;

use App\Entity\Article;
use App\Service\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ArticleType;

class ArticleController extends AbstractController
{
    /**
     * @param Request $request
     * @return Response
     * @Route("/article/create", name="create_article")
     */
    public function articleForm(Request $request, Slugify $slugify) : Response
    {
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $title = $article->getTitle();
            $article->setTitle($title);
            $content = $article->getContent();
            $article->setContent($content);
            $category = $article->getCategory();
            $article->setCategory($category);

            $entityManager = $this->getDoctrine()->getManager();
            $article->setSlug($slugify->generate($article->getTitle()));
            $entityManager->persist($article);
            $entityManager->flush();
        }

        return $this->render('blog/createArticle.html.twig', ['form' => $form->createView()]);
    }
}