<?php
/**
 * Created by PhpStorm.
 * User: luana
 * Date: 15/11/18
 * Time: 15:11
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @param Request $request
     * @return Response
     * @Route("/blog/category", name="create_category")
     */
    public function categoryForm(Request $request) : Response
    {
        $category = new Category();

        //....
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $name = $category->getName();
            $category->setName($name);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
        }

        return $this->render('blog/searchCategory.html.twig', ['form' => $form->createView()]);
    }
}
