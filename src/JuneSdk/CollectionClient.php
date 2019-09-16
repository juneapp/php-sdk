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

    /**
     * Needs to be an Array of json object(s). [{"fieldName" : "data"}]
     * Use the Log Token to view the status of your data with.
     * @param string $collectionToken
     * @param array $import
     * @param bool|null $activateTrigger
     * @param bool $erasePreviousData
     * @return string
     */
    public function importJson(string $collectionToken, array $import, bool $activateTrigger = false, $erasePreviousData = false) : string {

        if($erasePreviousData == true){
            $this->deleteListContent($collectionToken);
        }

        $data["json"] = $import;

        $logToken = $this->post('collect/'.$collectionToken.'/import/json', $data);

        return $logToken;
    }

    /**
     * The CSV needs to be formatted as a string. Newline needs to be formatted as \r\n
     * @param string $collectionToken
     * @param string $csvString
     * @param string $delimiter
     * @param bool $erasePreviousData
     * @param bool|null $activateTrigger
     */
    public function importCsv($collectionToken, $csvString, $delimiter = ",", $activateTrigger = false , $erasePreviousData = false) {

        $data["activate_trigger"] = $activateTrigger;
        $data["delimiter"] = $delimiter;
        $data["csv"] = $csvString;

        $logToken = $this->post('collect/'.$collectionToken.'import/csv', $data);
    }

    /**
     * Deletes the whole list content.
     * @param string $collectionToken
     */
    public function deleteListContent($collectionToken) {

        $this->delete('collection/list/'.$collectionToken);
    }

    /**
     * Returns Log Token as array of objects.
     * @param string $logToken
     * @return mixed
     */
    public function viewImportStatus($logToken){

        return $this->get("collection/".$logToken);
    }

}