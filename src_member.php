<?php
require_once("WitsSrcConnectDatabaseManager.php");
require_once("Constants.php");

$databaseManager = new WitsSrcConnectDatabaseManager();

$choice = $_REQUEST[Constants::ACTION];

function memberExists($member_username){
    global $databaseManager;

    $member_Password = $_REQUEST[Constants::SRC_MEMBER_PASS];
    $stmt = "SELECT * FROM ".Constants::SRC_MEMBER_TABLE." WHERE ".Constants::SRC_MEMBER_USER." = :UN AND "
        .Constants::SRC_MEMBER_PASS." = :P";
    $args = array('UN' => $member_username, 'P' => $member_Password);
    return $databaseManager -> exists($stmt, $args);
}

switch($choice){
    case Constants::LOG_IN:

        $member_username = $_REQUEST[Constants::SRC_MEMBER_USER];
        if(memberExists($member_username)) echo Constants::SUCCESS;
        else echo Constants::FAILED;

        break;

    case Constants::UPDATE_PASS:

        $member_username = $_REQUEST[Constants::SRC_MEMBER_USER];
        if(memberExists($member_username)){
            $member_newPassword = $_REQUEST[Constants::SRC_MEMBER_NEW_PASS];
            $stmt = "UPDATE ".Constants::SRC_MEMBER_TABLE." SET ".Constants::SRC_MEMBER_PASS." = :P WHERE "
                .Constants::SRC_MEMBER_USER." = :UN";
            $args = array('P' => $member_newPassword, 'UN' => $member_username);
            $databaseManager -> executeStatement($stmt, $args);
        }
        else echo Constants::FAILED;

        break;

    case Constants::POST_ACTIVITY:

        $activity_id = 0;
        $member_username = $_REQUEST[Constants::SRC_MEMBER_USER];
        $activity_title = $_REQUEST[Constants::ACTIVITY_TITLE];
        $activity_desc = $_REQUEST[Constants::ACTIVITY_DESC];
        $activity_date = $_REQUEST[Constants::ACTIVITY_DATE];
        $activity_time = $_REQUEST[Constants::ACTIVITY_TIME];

        $stmt = "INSERT INTO ".Constants::ACTIVITY_TABLE." VALUES( :ID, :MU, :ATT, :AD, :APD, :APT)";
        $args = array(":ID" => $activity_id, ':MU' => $member_username, 'ATT' => $activity_title, ':AD' => $activity_desc, ':APD' =>
            $activity_date, ':APT' => $activity_time);
        $databaseManager -> executeStatement($stmt, $args);

        break;

    case Constants::READ_ALL_ACTIVITIES:
            $member_username = $_REQUEST[Constants::SRC_MEMBER_USER];



            $stmt = "SELECT * FROM ".Constants::ACTIVITY_TABLE;
            $args = array();
            $databaseManager -> executeFetchStatement($stmt, $args);

        break;

    case Constants::READ_COMMENT:

            $stmt = "SELECT * FROM".Constants::STUD_COMMENT_TABLE;

        break;

    case Constants::UPDATE_ACTIVITY:
        //test3
        //test4
        break;

    case Constants::POST_POLL:

        break;
}