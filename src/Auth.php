<?php
namespace Restoo;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \GuzzleHttp\Client;

class Auth
{
    public function __construct()
    {

    }

    public function __invoke($request, $response, $next)
    {
        // Implement your Auth Function here or change the Auth Middleware in /app/middleware.php
        return $next($request, $response);
    }
}
