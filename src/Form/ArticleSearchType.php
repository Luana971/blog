<?php
/**
 * Created by PhpStorm.
 * User: luana
 * Date: 15/11/18
 * Time: 11:18
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('searchField');
    }
}