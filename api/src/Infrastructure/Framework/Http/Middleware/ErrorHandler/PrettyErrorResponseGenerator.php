<?php
namespace Infrastructure\Framework\Http\Middleware\ErrorHandler;

use Framework\Http\Middleware\ErrorHandler\ErrorResponseGenerator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Stratigility\Utils;
use Zend\Diactoros\Response\JsonResponse;

class PrettyErrorResponseGenerator implements ErrorResponseGenerator
{
    private $response;


    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }


    public function generate(\Throwable $e, ServerRequestInterface $request): ResponseInterface
    {
        $code = Utils::getStatusCode($e, $this->response);
        
        return new JsonResponse(['error'=>$e->getMessage()],$code);
    }
}