<?php

namespace JuneSdk;

use GuzzleHttp\Client as GuzzleClient;


class BaseClient {

    protected $apiUrl = '';
    protected $token = '';

    public function __construct($apiUrl, $token = null) {
        $this->apiUrl = $apiUrl;
        $this->token = $token;
    }

    public function get($path) {
        return $this->request('GET', $path);
    }

    public function post($path, $data) {
        return $this->request('POST', $path, $data);
    }

    public function put($path, $data) {
        return $this->request('PUT', $path, $data);
    }

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
        try {
            return json_decode($client->request($type, $this->apiUrl.$path, $options)->getBody()->getContents(), true);
        }
        catch(\Exception $e) {
            return null;
        }
    }
}