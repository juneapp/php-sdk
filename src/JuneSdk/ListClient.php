<?php

namespace JuneSdk;

/**
 * Class ListClient
 * @package JuneSdk
 */
class ListClient extends BaseClient {

    /**
     * EngagementClient constructor.
     * @param string|null $token
     */
    public function __construct($token = null) {
        parent::__construct("https://engagement.juneapp.com/", $token);
    }

    /**
     * Get the list Collection for the specified list id.
     * @param string $listId
     * @return mixed
     */
    public function getCollectionList($listId) {
        return $this->get('collection/list/'.$listId);
    }

    /**
     * @param string $collectionToken
     * @param mixed $json
     * @param bool|null $activateTrigger
     */
    public function importJsonToCollection($collectionToken, $json, $activateTrigger = false) {

        $data["activate_trigger"] = $activateTrigger;
        $data["data"] = [$json];

        $this->post('collect/'.$collectionToken.'/import/json', $data);
    }

    /**
     * The CSV needs to be formatted as a string. Newline needs to be formatted as \r\n
     * @param string $collectionToken
     * @param string $csvString
     * @param string $delimiter
     * @param bool|null $activateTrigger
     */
    public function importCsvToCollection($collectionToken, $csvString, $delimiter = ",", $activateTrigger = false) {

        $data["activate_trigger"] = $activateTrigger;
        $data["delimiter"] = $delimiter;
        $data["csv"] = $csvString;

        $this->post('collect/'.$collectionToken.'import/csv', $data);
    }

    /**
     * @param string $collectionToken
     */
    public function deleteListContent($collectionToken) {

        $this->delete('collection/list/'.$collectionToken);
    }

}