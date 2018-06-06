<?php
namespace Restoo;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Interop\Container\ContainerInterface;
use \GuzzleHttp\Client;
use \Medoo\Medoo;

class Restoo
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->settings  = $container->get('settings');
        $this->logger    = $container->get('logger');
        $this->db        = new Medoo($this->settings['mysql']);
    }

    public function __invoke($request, $response, $args)
    {
        if (in_array($args['route'], $this->settings['allowed'])) {
            $result = call_user_func_array(array( $this->db, $args['route'] ), $request->getParsedBody());
            if (!$result) {
                $this->logger->error(($this->db->error()) ? json_encode($this->db->error()) : json_encode($this->db->log()));
                $result = $this->db->error();
            }
            return $response->withJson($result, 201);
        } else {
            $this->logger->error('call blocked: '.$args['route']);
            return $response->withJson(['error' => 'function not allowed'], 401);
        }
    }
}
