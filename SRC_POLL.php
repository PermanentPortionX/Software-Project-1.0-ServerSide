<?php

require_once("WitsSrcConnectDatabaseManager.php");
require_once("Constants.php");

$databaseManager = new WitsSrcConnectDatabaseManager();

$choice = $_REQUEST[Constants::ACTION];

switch ($choice){
    case Constants::POST_POLL;
        $member_username = $_REQUEST[Constants::SRC_MEMBER_USER];
        $poll_id = $_REQUEST[Constants::POLL_ID];
        $poll_message = $_REQUEST[Constants::POLL_MSG];
        $poll_choices = $_REQUEST[Constants::POLL_CHOICE0];
        $poll_date = $_REQUEST[Constants::POLL_DATE];
        $poll_time = $_REQUEST[Constants::POLL_TIME];

        $stmt = "INSERT INTO ".Constants::SRC_POLL_TABLE." VALUES (:MU, :PI, :PM, :PC, :PD, :PT)";
        $args = array(":MU" => $member_username, ":PI" => $poll_id, ":PM" => $member_username, ":PC" => $poll_choices,
            ":PD" => $poll_date, ":PT" => $poll_time);
        $databaseManager -> executeStatement($stmt, $args);

    break;
}
