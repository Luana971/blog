<?php
/**
 * Created by PhpStorm.
 * User: luana
 * Date: 12/11/18
 * Time: 11:43
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog/{slug}", requirements={"slug"="[a-z0-9-]+"}, name="blog_show")
     */

    public function show($slug = "article-sans-titre")
    {
        $result = str_replace("-", " ", $slug);
        $result = ucwords($result);

        return $this->render('show.html.twig', ['result' => $result]);
    }
}
