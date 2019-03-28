<?php

require_once("WitsSrcConnectDatabaseManager.php");
require_once("Constants.php");

$databaseManager = new WitsSrcConnectDatabaseManager();

$choice = $_REQUEST[Constants::ACTION];



switch ($choice){
    //http://lamp.ms.wits.ac.za/~s1712776/student_comment.php?action=postPoll&poll_id=0&member_username=asdf&poll_title=abc&poll_desc=dfdf1&poll_choices=12,34&stud_date=as&stud_time=abc
    case Constants::postPoll;
        $poll_id = $_REQUEST[Constants::POLL_ID];
        $member_username = $_REQUEST[Constants::SRC_MEMBER_USER];
        $poll_title = $_REQUEST[Constants::POLL_TITLE ];
        $poll_desc = $_REQUEST[Constants::POLL_DESC];
        $poll_choices = $_REQUEST[Constants::POLL_CHOICE];
        $poll_date = $_REQUEST[Constants::POLL_DATE];
        $poll_time = $_REQUEST[Constants::POLL_TIME];

        $stmt = "INSERT INTO ".Constants::SRC_POLL_TABLE." VALUES (:PI, :MU, :PT, :PD, :PC, :PDD, :PTT)";
        $args = array(":PI" => $poll_id, ":MU" => $member_username, ":PT" => $poll_title, ":PD" => $poll_desc,
            ":PC" => $poll_choices, ":PDD" => $poll_date, ":PTT" => $poll_time);
        $databaseManager -> executeStatement($stmt, $args);

    break;
}
