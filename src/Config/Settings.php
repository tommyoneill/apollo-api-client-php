<?php
namespace ApolloIo\ApiClient\Config;

final class Settings
{
    private string $apiKey;
    private string $baseUri;

    public function __construct(string $apiKey, string $baseUri = 'https://api.apollo.io/v1/')
    {
        $this->apiKey  = $apiKey;
        $this->baseUri = rtrim($baseUri, '/') . '/';
    }

    public function apiKey(): string
    {
        return $this->apiKey;
    }

    public function baseUri(): string
    {
        return $this->baseUri;
    }
}
