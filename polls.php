<?php
require_once("WitsSrcConnectDatabaseManager.php");
require_once("Constants.php");

$databaseManager = new WitsSrcConnectDatabaseManager();

$choice = $_REQUEST[Constants::ACTION];

switch($choice){
    //http://lamp.ms.wits.ac.za/~s1712776/polls.php?action=postPoll&member_username=srcpresident&poll_title=abc&poll_desc=dfdf1&poll_choices=12,34&poll_type=0&poll_date=as&poll_time=abc
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
        $databaseManager -> executeStatement($stmt, $args, false);

        break;

    case Constants::READ_ALL_POLLS:
        $stmt = "SELECT * FROM ".Constants::SRC_POLL_TABLE." ORDER BY ".Constants::POLL_ID." DESC";
        $args = array();
        $databaseManager -> executeFetchStatement($stmt, $args);
        break;

    case Constants::POST_POLL_VOTE:
        $poll_id = $_REQUEST[Constants::POLL_ID];
        $student_id = $_REQUEST[Constants::STUDENT_USERNAME]; //OR IS IT STUDENT_ID? AND WHAT IS THE DIFFERENCE?
        $poll_choices = $_REQUEST[Constants::POLL_CHOICE];

        $stmt = "SELECT * FROM".Constants::STUD_POLL_TABLE."WHERE ".Constants::POLL_ID."= :PI AND ".Constants::STUDENT_USERNAME."= :SI ";

        if(mysqli_num_rows($stmt) > 0){
            echo "Already voted";
        }else{
            $stmt = "INSERT INTO ".Constants::STUD_POLL_TABLE." VALUES(:PI, :SI, :PC) ";
            $args = array(":PI"=> $poll_id, ":SI"=>$student_id, ":PC"=>$poll_choices);
            $databaseManager ->executeStatement($stmt, $args, false);

        }

}