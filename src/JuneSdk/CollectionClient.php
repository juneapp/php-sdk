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
     * @return mixed
     */
    public function createItem($collectionToken, $data) {
        return $this->post('collect/'.$collectionToken, $data);
    }

    /**
     * @param string $collectionToken
     * @param string $collectId
     * @return mixed
     */
    public function getItem($collectionToken, $collectId) {
        return $this->get('collect/'.$collectionToken.'/'.$collectId);
    }

    /**
     * @param string $collectionToken
     * @param string $collectId
     * @param mixed $data
     * @return mixed
     */
    public function updateItem($collectionToken, $collectId, $data) {
        return $this->put('collect/'.$collectionToken.'/'.$collectId, $data);
    }

    /**
     * @param string $collectionToken
     * @param string $collectId
     * @return mixed
     */
    public function deleteItem($collectionToken, $collectId) {
        return $this->delete('collect/'.$collectionToken.'/'.$collectId);
    }

    /**
     * Needs to be an Array of json object(s). [{"fieldName" : "data"}]
     * Use the Log Token to view the status of your data with.
     * @param string $collectionToken
     * @param array $data
     * @param bool $erasePreviousData
     * @return array
     */
    public function import(string $collectionToken, array $data, $erasePreviousData = false) : array {

        if($erasePreviousData == true){
            $this->eraseCollection($collectionToken);
        }

        return $this->post('collect/'.$collectionToken.'/import/json', ['json' => $data]);
    }

    /**
     * The CSV needs to be formatted as a string. Newline needs to be formatted as \r\n
     * @param string $collectionToken
     * @param string $csvString
     * @param bool $erasePreviousData
     * @return array
     */
    public function importCsv($collectionToken,string $csvString, $erasePreviousData = false) : array {

        if($erasePreviousData == true){
            $this->eraseCollection($collectionToken);
        }

        return $this->post('collect/'.$collectionToken.'/import/csv', ['csv' => $csvString]);
    }

    /**
     * Get the list Collection for the specified list id.
     * $skip defines where the list starts
     * $limit defines the limit of how many items it returns (0 = all)
     * @param string $listKey
     * @param int $skip
     * @param int $limit
     * @return mixed
     */
    public function getCollection(string $listKey, int $skip, int $limit) {
        return $this->get('collection/list/'.$listKey."/".$skip."/".$limit);
    }


    /**
     * Deletes the whole list content.
     * @param string $listKey
     */
    public function eraseCollection($listKey) : void {

        $this->delete('collection/list/'.$listKey);
    }

    /**
     * Returns Log Token as array of objects.
     * @param string $logToken
     * @return mixed
     */
    public function getImportLog($logToken) {

        return $this->get("collection/".$logToken);
    }

    /**
     * $skip defines the amount of results to skip
     * $limit defines the limit of results returned
     * $segmentationFilterId is the id of a possible segmentation filter which was created in the editor
     * $filter needs to be a mongoDB object
     * @param string $listKey
     * @param string $skip
     * @param string $limit
     * @param string|null $segmentationFilterId
     * @param mixed|null $filter
     * @return \Exception|mixed
     */
    public function filter(string $listKey, string $skip, string $limit, $segmentationFilterId = null, $filter = null) {

        $filterOptions['skip'] = $skip;
        $filterOptions['limit'] = $limit;
        $filterOptions['segmentation_filter_id'] = $segmentationFilterId;
        $filterOptions['filter'] = $filter;
        $filterOptions['sorting'] = ["_id" => -1];

        return $this->post('collection/list/'.$listKey.'/filter', $filterOptions);
    }

}