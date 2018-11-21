<?php
/**
 * Created by PhpStorm.
 * User: luana
 * Date: 12/11/18
 * Time: 11:09
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('home.html.twig');
    }
}
