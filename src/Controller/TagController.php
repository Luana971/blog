<?php
/**
 * Created by PhpStorm.
 * User: luana
 * Date: 15/11/18
 * Time: 10:02
 */

namespace App\Controller;


use App\Entity\Article;
use App\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
    /**
     * @Route("/tag/{tag}", name="tag_list")
     */

    public function showByTag(string $tag)
    {
        $tag = $this->getDoctrine()
            ->getRepository(Tag::class)
            ->findOneByName($tag);

        $articles = $tag->getArticles();

        return $this->render('blog/tag.html.twig', ['articles' => $articles, 'tag' => $tag]);
    }
}
