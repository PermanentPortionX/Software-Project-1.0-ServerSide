<?php

require_once("WitsSrcConnectDatabaseManager.php");
require_once("Constants.php");

$databaseManager = new WitsSrcConnectDatabaseManager();

$choice = $_REQUEST[Constants::ACTION];

switch ($choice){
    case Constants::POST_POLL;
        $member_username = $_REQUEST[Constants::SRC_MEMBER_USER];
        $poll_id = $_REQUEST[Constants::POLL_ID];

    break;
}
