<?php
/**
 * Created by PhpStorm.
 * User: luana
 * Date: 12/11/18
 * Time: 11:43
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Article;
use App\Entity\Category;
use App\Form\ArticleSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * Show all row from article's entity
     *
     * @Route("/blog", name="blog_index")
     * @return Response A response instance
     */

    public function index(Request $request) : Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }

        $searchForm = $this->createForm(ArticleSearchType::class);
        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted()) {
            $data = $searchForm->getData();
            // $data contient les données du $_POST
            // Faire une recherche dans la BDD avec les infos de $data...
        }

        return $this->render('index.html.twig', ['articles' => $articles, 'searchForm' => $searchForm->createView()]);
    }

    /**
     * Getting a article with a formatted slug for title
     *
     * @param string $slug The slugger
     *
     * @Route("/{slug<^[a-z0-9-]+$>}",
     *     defaults={"slug" = null},
     *     name="show_article")
     *  @return Response A response instance
     */
    public function show($slug) : Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an article in article\'s table.');
        }

        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);

        $articleCategory = $article->getCategory();

        $articleTag = $article->getTags();


        return $this->render(
            'blog/show.html.twig', ['article' => $article, 'slug' => $slug, 'category' => $articleCategory, 'tags' => $articleTag]);
    }

    /**
     * @Route("/category/{category}", name="blog_show_category")
     */
    public function showByCategory(string $category)
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneByName($category);

        $articles = $category->getArticles();

        return $this->render('blog/category.html.twig', ['articles' => $articles, 'category' => $category]);
    }

    /* /**
     * @Route("/categories/showAll", name="blog_categories")
     */

    /* public function showCategories()
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();


        /* $articles = $this->getDoctrine()
            ->getRepository(Category::class)
            ->getArticles();


        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(
                array('category' => $categories)
            );

        return $this->render('blog/showCategories.html.twig', ['categories' => $categories, 'articles' => $articles]);
    } */

    /* public function showArticles(string $category)
    {
        $articles = $this->getDoctrine()
            ->getRepository(Category::class)
            ->getArticles($category);

        return $this->render('blog/showCategories.html.twig', ['articles' => $articles]);
    } */
}
