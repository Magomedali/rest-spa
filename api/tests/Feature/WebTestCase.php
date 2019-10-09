<?php
declare(strict_types=1);
namespace Test\Feature;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;

use PHPUnit\Framework\TestCase;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Zend\Diactoros\Stream;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Uri;

use Framework\Http\Application;

class WebTestCase extends TestCase
{
	private $fixtures = [];

	private $server = [];

	private $app;

	private $container;

	protected function get(string $uri,array $headers = []): ResponseInterface
	{
		return $this->method($uri, 'GET', [], $headers);
	}



	protected function post(string $uri,array $params, array $headers = []): ResponseInterface
	{
		return $this->method($uri, 'POST', $params, $headers);
	}



	protected function put(string $uri,array $params, array $headers = []): ResponseInterface
	{
		return $this->method($uri, 'PUT', $params, $headers);
	}




	protected function method(string $uri, string $method, array $params, array $headers): ResponseInterface
	{
		$body = new Stream('php://temp', 'r+');
		$body->write(json_encode($params));

		$body->rewind();

		$request = (new ServerRequest($this->server))
							->withHeader('Content-type','application/json')
							->withHeader('Accept','application/json')
							->withUri(new Uri('http://test'.$uri))
							->withMethod($method)
							->withBody($body);

		foreach ($headers as $name => $value) {
			$request = $request->withHeader($name ,$value);
		}

		return $this->request($request);
	}





    protected function setServerParameters(array $server)
    {
        $this->server = $server;
    }

    

    protected function setServerParameter($key, $value)
    {
        $this->server[$key] = $value;
    }



	protected function request(ServerRequestInterface $request): ResponseInterface
	{
		$response = $this->app()->handle($request);
		$response->getBody()->rewind();
		return $response;
	}



	protected function loadFixtures(array $fixtures): void
    {
        $container = $this->getContainer();
        $em = $container->get(EntityManagerInterface::class);
        $loader = new Loader();
        
        foreach ($fixtures as $name => $class) {
            
            if ($container->has($class)) {
                $fixture = $container->get($class);
            } else {
                $fixture = new $class;
            }

            $loader->addFixture($fixture);
            $this->fixtures[$name] = $fixture;
        }

        $executor = new ORMExecutor($em, new ORMPurger($em));
        $executor->execute($loader->getFixtures());
    }



	protected function getFixture($name)
    {
        if (!array_key_exists($name, $this->fixtures)) {
            throw new \InvalidArgumentException('Undefined fixture ' . $name);
        }
        
        return $this->fixtures[$name];
    }


    protected function authorize()
    {
    	$users = $this->getContainer()->get('config')['auth']['users'];
    	
    	if(!is_array($users)) {
    		return;
    	}

    	$this->setServerParameter('PHP_AUTH_USER',key($users));
    	$this->setServerParameter('PHP_AUTH_PW',current($users));
    }


	protected function app(): Application
	{

		if($this->app)
		{
			return $this->app;
		}

		$container = $this->getContainer();
		
		$app = $container->get(Application::class);
		
		require 'config/pipeline.php';
		require 'config/routes.php';

		$this->app = $app;

		return $app;
	}

	protected function getContainer(): ContainerInterface
	{
		if($this->container)
		{
			return $this->container;
		}

		$this->container = $this->container();

		return $this->container;
	}

	private function container(): ContainerInterface
    {
        return require 'config/container.php';
    }
}