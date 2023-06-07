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


        $categoryList = ['Fashion Trends', 'Style Guides', 'Celebrity Fashion', 'Wardrobe Essentials', 'Fashion Tips and Hacks', 'Outfit of the Day (OOTD)', 'Seasonal Collections', 'Fashion Events and News', 'Sustainable Fashion', 'Fashion Inspiration'];
        $categoryDescription = [
            'This category can cover the latest fashion trends, runway looks, and seasonal styles, helping readers stay up-to-date with the latest fashion trends.',
            'Style guides offer tips and advice on how to put together stylish outfits for different occasions, body types, or personal preferences.',
            'This category focuses on celebrity fashion, providing insights into the outfits worn by celebrities, red carpet events, and how to recreate their looks.',
            'Wardrobe essentials articles highlight must-have clothing items that form the foundation of a versatile and functional wardrobe, such as classic white shirts, little black dresses, or denim jackets.',
            'This category shares useful tips, tricks, and hacks related to clothing care, storage, accessorizing, or styling techniques to help readers optimize their fashion choices.',
            'Seasonal collections showcase the latest clothing lines and collections available on the website, featuring new arrivals, trends, and outfit ideas specific to each season.',
            'OOTD posts showcase complete outfits put together by the blog\'s writers or submitted by readers, providing inspiration for various styles and occasions.',
            'This category covers fashion events, news, and updates from the fashion industry, including fashion weeks, designer collaborations, brand launches, and industry insights.',
            'With a growing emphasis on eco-friendly practices, this category focuses on sustainable fashion, featuring articles about ethical clothing brands, eco-friendly materials, and tips for building a sustainable wardrobe.',
            'This category provides inspiration for fashion-forward readers, featuring lookbooks, street style photography, and fashion icons\' profiles, helping readers explore new styles and express their unique fashion sense.',
        ];
        $categories = []; // Initialize the $categories array

        for ($i = 0; $i < count($categoryList); $i++) {
            $category = new Category();
            $category->setName($categoryList[$i]);
            $category->setDescription($categoryDescription[$i]);
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
                $manager->persist($article);
            }


            $manager->flush();
        }

}
