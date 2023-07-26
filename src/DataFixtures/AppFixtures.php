<?php

namespace App\DataFixtures;

use App\Entity\Bar;
use App\Entity\Baz;
use App\Entity\Foo;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        // for ($index = 1; $index<=10; $index++){
            $manager->persist(
                (new Foo())
                    ->setName(sprintf ("Foo 1"))
                    ->addBar((new Bar())->setName("Bar 1"))
                    ->addBar((new Bar())->setName("Bar 2"))
                    ->addBaz((new Baz())->setName("Baz 1"))
                    ->addBaz((new Baz())->setName("Baz 2"))
            );
        // }

        $manager->flush();
    }
}
