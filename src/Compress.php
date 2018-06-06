<?php
namespace Restoo;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \GuzzleHttp\Client;

class Compress
{
    public function __construct()
    {

    }

    public function __invoke($request, $response, $next) {

        /** @var Response $response */
        $response = $next($request, $response);

        if ($response->hasHeader('Content-Encoding') && $response->hasHeader('encoding')) {
            return $next($request, $response);
        }

        // Compress response data
        $deflateContext = deflate_init(ZLIB_ENCODING_GZIP);
        $compressed = deflate_add($deflateContext, (string)$response->getBody(), \ZLIB_FINISH);

        $stream = fopen('php://memory', 'r+');
        fwrite($stream, $compressed);
        rewind($stream);

        return $response
            ->withHeader('Content-Encoding', 'gzip')
            ->withHeader('Content-Length', strlen($compressed))
            ->withBody(new \Slim\Http\Stream($stream));
    }
  }
