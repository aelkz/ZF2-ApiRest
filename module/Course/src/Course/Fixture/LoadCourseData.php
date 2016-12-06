<?php 
namespace Course\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;

use Course\Entity\Course;

class LoadCourseData extends AbstractFixture 
{
    public function load(ObjectManager $manager)
    {        
        $dateInsert = new \Datetime();
        
        for ($i=0; $i <= 10; $i++) {
        	$post = new Course();
            $post->setName('Course Name');
            $post->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');
            $post->setDateInsert($dateInsert);
        	$post->setDateUpdate(null);
        	$manager->persist($post);
        }
        $manager->flush();
    }
}