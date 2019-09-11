<?php

namespace JuneSdk;

/**
 * Class CollectionClient
 * @package JuneSdk
 */
class CollectionClient extends BaseClient
{
    /**
     * EngagementClient constructor.
     * @param string|null $token
     */
    public function __construct($token = null) {
        parent::__construct("https://engagement.juneapp.com/", $token);
    }

    /**
     * @param string $collectionToken
     * @param mixed $data
     */
    public function createItem($collectionToken, $data) {
        $this->post('collect/'.$collectionToken, $data);
    }

    /**
     * @param string $collectionToken
     * @param string $collectionId
     * @return mixed
     */
    public function getItem($collectionToken, $collectionId) {
        return $this->get('collect/'.$collectionToken.'/'.$collectionId);
    }

    /**
     * @param string $collectionToken
     * @param string $collectionId
     * @param mixed $data
     */
    public function updateItem($collectionToken, $collectionId, $data) {
        $this->put('collect/'.$collectionToken.'/'.$collectionId, $data);
    }

}