<?php
/**
 * Created by PhpStorm.
 * User: luana
 * Date: 13/11/18
 * Time: 10:52
 */

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/articles")
     */

    public function showArticles($id)
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->find($id);

        $articles = $category->getArticles();

        return $this->render('showArticles.html.twig', ['articles' => $articles]);
    }

    /* public function showArticles($id)
    {
        $category = new Category();
        $article = new Article();
        $categories = $category->getArticles();
        $articles = $article->getCategory();

        return $this->render('showArticles.html.twig', ['categories' => $categories, 'articles' => $articles]);
    } */
}