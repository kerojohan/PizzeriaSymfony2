<?php

// src/Cupon/CiudadBundle/DataFixtures/ORM/Ciudades.php

namespace Cupon\CiudadBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Pizzeria\TestBundle\Entity\Ingredient;

class Ingredients implements FixtureInterface {

    public function load(ObjectManager $manager) {
        $ingredients = array(
            array('name' => 'tomato', 'price' => '0.5'),
            array('name' => 'sliced mushrooms', 'price' => '0.5'),
            array('name' => 'feta cheese', 'price' => '1.0'),
            array('name' => 'sausages', 'price' => '1.0'),
            array('name' => 'sliced onion', 'price' => '0.5'),
            array('name' => 'mozzarella cheese', 'price' => '0.5'),
            array('name' => 'oregano', 'price' => '1'),
        );
        foreach ($ingredients as $ingredient) {
            $entidad = new Ingredient();
            $entidad->setName($ingredient['name']);
            $entidad->setCost($ingredient['price']);
            $manager->persist($entidad);
        }
        $manager->flush();
      }
}
  