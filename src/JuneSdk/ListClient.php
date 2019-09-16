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
    public function __construct(string $token = null) {
        parent::__construct("https://engagement.juneapp.com/", $token);
    }

    /**
     * Get the list Collection for the specified list id.
     * @param string $listId
     * @return mixed
     */
    public function getListContent(string $listId) {
        return $this->get('collection/list/'.$listId);
    }

    /**
     * @param string $projectId
     * @return array
     */
    public function getListIdsByProjectId(string $projectId): array {
        $listIds = [];
        $listsByProject = $this->get("lists");
        if($listsByProject){
            foreach($listsByProject as $list){
                array_push($listIds, $list["id"]);
            }
        }
        return $listIds;
    }

    /**
     * @param string $listId
     */
    public function deleteListFromProject(string $listId) {
        $this->delete('collection/list/'.$listId);
    }

    /**  The request model has to look like this, if list items are being included
     * {
    "list_name":    <list_name>
    "list_items":[
            {
                "item_type":    <list_item_type>
                "item_name":    <list_item_name>
                "item_label":   <list_item_label>
                "item_class":   <list_item_class>
                "item_values":  <list_item_values>
                "item_options": <list_item_options>
                "item_config":  <list_item_config>
                "item_public_ro": <item_public_ro>
                "item_validator":{
                    "required":     <item_validator_required>
                    "values":       <item_validator_values>
                    "min_length":   <item_validator_min_length>
                    "max_length":   <item_validator_max_length>
                    "pattern":      <item_validator_pattern>
            },
        },
     ],
     * @param string $listName
     * @param array|null $listItems
     */
    public function createNewListForProject(string $listName, array $listItems = null) {
        $list["list_name"] = $listName;

        if ($listItems){
            $list["list_items"] = $listItems;
        }

        $this->post('/lists', $list);
    }

}