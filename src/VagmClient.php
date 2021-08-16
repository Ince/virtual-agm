<?php

namespace Ince\VAGM;

use Illuminate\Http\Client\Response;

class VagmClient
{
    /**
     * The HTTP client.
     *
     * @var \Illuminate\Http\Client\PendingRequest
     */
    protected $client;

    /**
     * The VAGM config.
     *
     * @var array $config
     */
    protected $config;

    /**
     * Auth bearer token.
     *
     * @var string $token
     */
    protected $token;

    /**
     * If requests should be logged.
     *
     * @var bool $debug
     */
    protected $debug = false;

    /**
     * VAGMClient constructor.
     */
    public function __construct()
    {
        $this->config = config('vagm');
        $this->token = self::getToken() ?? null;
        $this->client = $this->token
            ? \Http::withToken($this->token)->withHeaders($this->config['headers'])
            : \Http::withHeaders($this->config['headers']);
        $this->debug = $this->config['debug'];
    }

    /**
     * Response for HEAD request.
     *
     * @param  string  $uri
     * @param  array|string|null  $query
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    protected function head(string $uri, $query = null)
    {
        return $this->response(
            $this->client->head($this->fullUrl($uri), $query)
        );
    }

    /**
     * Response for GET request.
     *
     * @param  string  $uri
     * @param  array|string|null  $query
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    protected function get(string $uri, $query = null)
    {
        $response = $this->response(
            $this->client->get($this->fullUrl($uri), $query)
        );

        if ($this->debug) {
            \Log::debug('API GET: '.json_encode([$uri, $query, $response], JSON_PRETTY_PRINT));
        }

        return $response;
    }

    /**
     * Response for POST request.
     *
     * @param  string  $uri
     * @param  array  $data
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    protected function post(string $uri, array $data = [])
    {
        $response = $this->response(
            $this->client->post($this->fullUrl($uri), $data)
        );

        if ($this->debug) {
            \Log::debug('API POST: '.json_encode([$uri, $data, $response], JSON_PRETTY_PRINT));
        }

        return $response;
    }

    /**
     * Response for PATCH request.
     *
     * @param  string  $uri
     * @param  array  $data
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    protected function patch(string $uri, array $data = [])
    {
        $response = $this->response(
            $this->client->patch($this->fullUrl($uri), $data)
        );

        if ($this->debug) {
            \Log::debug('API PATCH: '.json_encode([$uri, $data, $response], JSON_PRETTY_PRINT));
        }

        return $response;
    }

    /**
     * Response for PUT request.
     *
     * @param  string  $uri
     * @param  array  $data
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    protected function put(string $uri, array $data = [])
    {
        $response = $this->response(
            $this->client->put($this->fullUrl($uri), $data)
        );

        if ($this->debug) {
            \Log::debug('API PUT: '.json_encode([$uri, $data, $response], JSON_PRETTY_PRINT));
        }

        return $response;
    }

    /**
     * Response for DELETE request.
     *
     * @param  string  $uri
     * @param  array  $data
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    protected function delete(string $uri, array $data = [])
    {
        $response = $this->response(
            $this->client->delete($this->fullUrl($uri), $data)
        );

        if ($this->debug) {
            \Log::debug('API DELETE: '.json_encode([$uri, $data, $response], JSON_PRETTY_PRINT));
        }

        return $response;
    }

    /**
     * Full URL to make the request to.
     *
     * @param  string  $uri
     * @return string
     */
    private function fullUrl(string $uri) : string
    {
        return sprintf('%s/%s',
            $this->config['url'],
            ltrim($uri, '/')
        );
    }

    /**
     * @param  \Illuminate\Http\Client\Response  $response
     * @return mixed
     * @throws \Illuminate\Http\Client\RequestException
     */
    private function response(Response $response)
    {
        if ($exception = $response->toException()) {
            if ($response->status() >= 400) {
                abort($response->status());
            } elseif ($exception->getCode() >= 400) {
                abort($exception->getCode());
            } elseif ($code = $exception->response->json('code', 400)) {
                abort($code);
            } else {
                abort(400);
            }
        }

        return $response->json()['data'] ?? $response->json() ?? null;
    }
}