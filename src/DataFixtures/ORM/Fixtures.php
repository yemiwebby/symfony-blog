<?php
/**
 * Created by PhpStorm.
 * User: webby
 * Date: 01/08/2018
 * Time: 12:04 PM
 */

namespace App\DataFixtures\ORM;

use App\Entity\Author;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class Fixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
       $author = new Author();
       $author
           ->setName('Olususi Oluyemi')
           ->setTitle('Software Engineer')
           ->setUsername('yemiwebby')
           ->setShortBio('A tech enthusiast, programming freak and web development junkie')
           ->setPhone('+2348066417364')
           ->setFacebook('https://web.facebook.com/yemiwebby')
           ->setTwitter('https://twitter.com/yemiwebby')
           ->setGithub('https://github.com/yemiwebby');

       $manager->persist($author);

       $post = new Post();
       $post
           ->setTitle('Sample blog post')
           ->setSlug('sample-post')
           ->setDescription('A new blog post as a sample')
           ->setBody('ust as you would have it in any application with a lot of request and responses, we will set up a couple of controllers to handle actions and redirect or return the appropriate response required for this application to function properly. We already have the maker bundle generated earlier on, let us make use of it to automatically generate the controllers.')
           ->setAuthor($author)
           ->setCreatedAt(new \DateTime());


       $manager->persist($post);

       $manager->flush();
    }
}