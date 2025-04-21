<?php
namespace ApolloIo\ApiClient\Http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface ClientInterface
{
    public function send(RequestInterface $request): ResponseInterface;
}

// src/Http/GuzzleClient.php
namespace ApolloIo\Http;

use Psr\Http\Client\ClientInterface as PsrClient;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GuzzleClient implements ClientInterface
{
    public function __construct(private PsrClient $client) {}

    public function send(RequestInterface $request): ResponseInterface
    {
        return $this->client->sendRequest($request);
    }
}
