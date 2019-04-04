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

        //lamp.ms.wits.ac.za/~s1712776/src_member.php?action=postActivity&member_username=srcpresident&activity_title=a&activity_desc=abc&activity_date=10/20/2019&activity_time=20:40
        $activity_id = 0;
        $member_username = $_REQUEST[Constants::SRC_MEMBER_USER];
        $activity_title = $_REQUEST[Constants::ACTIVITY_TITLE];
        $activity_desc = $_REQUEST[Constants::ACTIVITY_DESC];
        $activity_date = $_REQUEST[Constants::ACTIVITY_DATE];
        $activity_time = $_REQUEST[Constants::ACTIVITY_TIME];

        $stmt = "INSERT INTO ".Constants::ACTIVITY_TABLE." VALUES( :ID, :MU, :ATT, :AD, :APD, :APT)";
        $args = array(':ID' => $activity_id, ':MU' => $member_username, ':ATT' => $activity_title, ':AD' => $activity_desc, ':APD' => $activity_date, ':APT' => $activity_time);
        $databaseManager -> executeStatement($stmt, $args);

        break;

    case Constants::READ_ALL_ACTIVITIES:
        $stmt = "SELECT * FROM ".Constants::ACTIVITY_TABLE." ORDER BY ".Constants::ACTIVITY_ID." DESC";
        $args = array();
        $databaseManager -> executeFetchStatement($stmt, $args);

        break;

    case Constants::UPDATE_ACTIVITY:
        //test3
        //test4
        break;

    //http://lamp.ms.wits.ac.za/~s1712776/src_poll.php?action=postPoll&member_username=srcpresident&poll_title=abc&poll_desc=dfdf1&poll_choices=12,34&poll_type=0&poll_date=as&poll_time=abc
    case Constants::POST_POLL;
        $poll_id = 0;
        $member_username = $_REQUEST[Constants::SRC_MEMBER_USER];
        $poll_title = $_REQUEST[Constants::POLL_TITLE];
        $poll_desc = $_REQUEST[Constants::POLL_DESC];
        $poll_choices = $_REQUEST[Constants::POLL_CHOICE];
        $poll_type = $_REQUEST[Constants::POLL_TYPE];
        $poll_date = $_REQUEST[Constants::POLL_DATE];
        $poll_time = $_REQUEST[Constants::POLL_TIME];

        $stmt = "INSERT INTO ".Constants::SRC_POLL_TABLE." VALUES (:PI, :MU, :PT, :PD, :PC, :PTY, :PDD, :PTT)";
        $args = array(":PI" => $poll_id, ":MU" => $member_username, ":PT" => $poll_title, ":PD" => $poll_desc,
            ":PC" => $poll_choices, ":PTY" => $poll_type, ":PDD" => $poll_date, ":PTT" => $poll_time);
        $databaseManager -> executeStatement($stmt, $args);

        break;
}