<?php

namespace RusLan\ResolveTest\Site\AppBundle\Provider\Client;

use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ClientProvider
{
    protected HttpClientInterface $client;
    protected string $url;

    /**
     * @param HttpClientInterface $client
     * @param string $url
     */
    public function __construct(HttpClientInterface $client, string $url)
    {
        $this->client = $client;
        $this->url = $url;
    }

    public function fetch(string $method, int $id, array $params): ?array
    {
        try {
            $response = $this->client->request('POST', $this->url, [
                'body' => json_encode([
                    'jsonrpc' => '2.0',
                    'method' => $method,
                    'params' => $params,
                    'id' => $id,
                ]),
            ]);

            if (Response::HTTP_OK === $response->getStatusCode()) {
                $data = json_decode($response->getContent(), true);
            }
        } catch (TransportException $exception) {
            // send to log and return exception
        }

        return $data ?? null;
    }
}
