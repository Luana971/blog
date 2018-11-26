<?php
/**
 * Created by PhpStorm.
 * User: luana
 * Date: 26/11/18
 * Time: 09:44
 */

namespace App\DataFixtures;


use App\Entity\Article;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 50; $i++)
        {
            $faker  =  Faker\Factory::create('fr_FR');

            $slug = new Slugify();
            $article = new Article();
            $article->setTitle(mb_strtolower($faker->sentence));
            $article->setContent($faker->text);

            $manager->persist($article);
            $article->setCategory($this->getReference('category_' . rand(0, 4)));
            $article->setSlug($slug->generate($article->getTitle()));
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}