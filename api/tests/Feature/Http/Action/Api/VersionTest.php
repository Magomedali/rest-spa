<?php
declare(strict_types=1);
namespace Test\Feature\Http\Action\Api;

use Test\Feature\WebTestCase;

class VersionTest extends WebTestCase
{


    public function testNoAuth(): void
    {

        $response = $this->get('/',[]);
        

        self::assertEquals(401, $response->getStatusCode());
    }


    public function testSuccess(): void
    {
        $this->authorize();

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