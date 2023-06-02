<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Profile;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use EsperoSoft\Faker\Faker;

class BlogFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = new Faker();

        $users = [];

        for ($i = 0; $i < 100; $i++) {
            $user = new User();
            $user->setFullName($faker->full_name());
            $user->setEmail($faker->Email());
            $user->setPassword('password');
            $user->setCreated_at($faker->dateTimeImmutable());

            $address = new Address();
            $address->setStreet($faker->streetAddress());
            $address->setCity($faker->city());
            $address->setPostalCode($faker->postcode());
            $address->setCreatedAt($faker->dateTimeImmutable());
            $address->setCountry($faker->country());

            $profile = new Profile();
            $profile->setCoverPicture($faker->image());
            $profile->setPicture($faker->image());
            $profile->setDescription($faker->description(60));
            $profile->setCreatedAt($faker->dateTimeImmutable());


            $user->addAddress($address);
            $user->setProfile($profile);


            $users[] = $user;

            $manager->persist($user);
            $manager->persist($address);
            $manager->persist($profile);
        }

        $categories = [];

        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->setName($faker->word());
            $category->setDescription($faker->description(30));
            $category->setImageUrl($faker->image());
            $category->setCreatedAt($faker->dateTimeImmutable());

            $categories[] = $category;
            $manager->persist($category);
        }

        for ($i = 0; $i < 300; $i++) {
            $article = new Article();
            $article->setTitle($faker->title(30));
            $article->setImage_url($faker->image());
            $article->setDescription($faker->description(50));
            $article->setCreatedAt($faker->dateTimeImmutable());
            $article->setContent($faker->text(3));
            $article->setAuthor($users[rand(0, count($users) - 1)]);

            if (!empty($categories)) {
                $randomIndex = rand(0, count($categories) - 1);
                $article->addCategory($categories[$randomIndex]);
            }

                $categories[] = $category;
                $manager->persist($article);
            }


            $manager->flush();
        }

}
