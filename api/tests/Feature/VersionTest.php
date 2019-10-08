<?php
declare(strict_types=1);
namespace Test\Feature;


class VersionTest extends WebTestCase
{


    public function testNoAuth(): void
    {

        $response = $this->get('/',[]);
        

        self::assertEquals(401, $response->getStatusCode());
    }


    public function testSuccess(): void
    {
        $this->setServerParameters([
            'PHP_AUTH_USER'=>'admin',
            'PHP_AUTH_PW'=>'1',
        ]);

        $response = $this->get('/',[]);
        
        self::assertEquals(200, $response->getStatusCode());
        self::assertJson($content = $response->getBody()->getContents());
        
        $data = json_decode($content, true);
        
        self::assertEquals([
            'name'=>'Shop Api',
            'version'=>'1.0.0'
        ], $data);
    }

}