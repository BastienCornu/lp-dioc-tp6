<?php
/**
 * Created by PhpStorm.
 * User: bastien.cornu
 * Date: 29/11/17
 * Time: 10:18
 */

namespace App\DataFixtures\ORM;


use App\Entity\Tag;
use App\Slug\SlugGenerator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTag extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $tags = [
            new Tag("Cuisine",$this->container->get(SlugGenerator::class)->generate("Cuisine")),
            new Tag("Multimédia",$this->container->get(SlugGenerator::class)->generate("Multimédia")),
            new Tag("Technologie",$this->container->get(SlugGenerator::class)->generate("Technologie")),
            new Tag("Sport",$this->container->get(SlugGenerator::class)->generate("Sport"))
        ];

        foreach ($tags as $tag){
            $manager->persist($tag);
        }
        $manager->flush();

    }
}