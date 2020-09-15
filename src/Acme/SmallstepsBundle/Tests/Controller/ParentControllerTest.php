<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ParentControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'Parent/index');
    }

    public function testCreatechild()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'Parent/createChild');
    }

    public function testEditchild()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'Parent/editChild');
    }

    public function testViewchildren()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'Parent/viewChildren');
    }

    public function testViewparent()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'Parent/viewParent');
    }

    public function testEditparent()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'Parent/editParent');
    }

    public function testMakebooking()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'Parent/makeBooking');
    }

    public function testViewbooking()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'Parent/viewBooking');
    }

    public function testEditbooking()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'Parent/editBooking');
    }

}
