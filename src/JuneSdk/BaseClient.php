<?php

namespace JuneSdk;

use Exception;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;


/**
 * Class BaseClient
 * @package JuneSdk
 */
class BaseClient {

    /**
     * @var string
     */
    protected $apiUrl = '';
    /**
     * @var string|null
     */
    protected $token = '';

    /**
     * BaseClient constructor.
     * @param string $apiUrl
     * @param string|null $token
     */
    public function __construct($apiUrl, $token = null) {
        $this->apiUrl = $apiUrl;
        $this->token = $token;
    }

    /**
     * @param string $path
     * @return Exception|mixed
     */
    public function get($path) {
        return $this->request('GET', $path);
    }

    /**
     * @param string $path
     * @param mixed $data
     * @return Exception|mixed
     */
    public function post($path, $data) {
        return $this->request('POST', $path, $data);
    }

    /**
     * @param string $path
     * @param mixed $data
     * @return Exception|mixed
     */
    public function put($path, $data) {
        return $this->request('PUT', $path, $data);
    }

    /**
     * @param string $path
     * @return Exception|mixed
     */
    public function delete($path) {
        return $this->request('DELETE', $path);
    }

    /**
     * @param string $type
     * @param string $path
     * @param mixed|null $data
     * @return Exception|mixed
     */
    protected function request($type, $path, $data = null) {
        $header = ['Accept' => 'application/json'];
        if($this->token != null) {
            $header['Authorization'] = 'Bearer ' . $this->token;
        }
        $options = ['headers' => $header];
        if($data != null) {
            $options['json'] = $data;
        }

        $client = new GuzzleClient();
        try{
            return json_decode($client->request($type, $this->apiUrl.$path, $options)->getBody()->getContents(), true);
        }
        catch (GuzzleException $exception){
            return new Exception($exception->getMessage());
        }
    }
}