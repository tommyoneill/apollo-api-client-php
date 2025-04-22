<?php
namespace ApolloIo\ApiClient;

use ApolloIo\ApiClient\Config\Settings;
use ApolloIo\ApiClient\Http\ClientInterface;
use ApolloIo\ApiClient\Endpoints\PeopleEndpoint;
use ApolloIo\ApiClient\Endpoints\CompaniesEndpoint;

final class ApolloClient
{
    public function __construct(
        private Settings         $settings,
        private ClientInterface  $http,
        private \Psr\Http\Message\RequestFactoryInterface $reqFactory,
        private \Psr\Http\Message\StreamFactoryInterface  $streamFactory,
    ){}

    public function people(): PeopleEndpoint
    {
        return new PeopleEndpoint($this->settings, $this->http, $this->reqFactory, $this->streamFactory);
    }

    public function companies(): CompaniesEndpoint
    {
        return new CompaniesEndpoint($this->settings, $this->http, $this->reqFactory, $this->streamFactory);
    }
}
