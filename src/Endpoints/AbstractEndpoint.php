<?php
namespace ApolloIo\ApiClient\Endpoints;

use ApolloIo\ApiClient\Config\Settings;
use ApolloIo\ApiClient\Http\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

abstract class AbstractEndpoint
{
    protected Settings $settings;
    protected ClientInterface $http;
    protected RequestFactoryInterface $reqFactory;
    protected StreamFactoryInterface $streamFactory;

    public function __construct(
        Settings $settings,
        ClientInterface $http,
        RequestFactoryInterface $reqFactory,
        StreamFactoryInterface $streamFactory
    ) {
        $this->settings = $settings;
        $this->http = $http;
        $this->reqFactory = $reqFactory;
        $this->streamFactory = $streamFactory;
    }
}
