<?php

namespace JuneSdk;


class EngagementClient extends BaseClient {

    public function __construct($token = null) {
        parent::__construct("https://engagement.juneapp.com/", $token);
    }

    public function createCollect($collectToken, $data) {
        $this->post('collect/'.$collectToken, $data);
    }

}