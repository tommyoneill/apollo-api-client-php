<?php
namespace ApolloIo\ApiClient\Http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface ClientInterface
{
    public function send(RequestInterface $request): ResponseInterface;
}

