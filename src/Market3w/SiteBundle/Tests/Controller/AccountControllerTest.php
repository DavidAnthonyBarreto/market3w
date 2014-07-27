<?php

namespace Market3w\SiteBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AccountControllerTest extends WebTestCase
{
    public function testBilling()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/account/{id}/billing');
    }

    public function testSeo()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/account/{id}/seo');
    }

}
