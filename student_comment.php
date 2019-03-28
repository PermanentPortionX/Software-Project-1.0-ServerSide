<?php
require_once("WitsSrcConnectDatabaseManager.php");
require_once("Constants.php");

$databaseManager = new WitsSrcConnectDatabaseManager();

$choice = $_REQUEST[Constants::ACTION];

switch ($choice){

    case Constants::POST_COMMENT:
        //lamp.ms.wits.ac.za/~s1712776/student_comment.php?action=postComment&activity_id=0&stud_username=asdf&stud_comment=abc&stud_anonymity=1&stud_date=as&stud_time=abc
        //Declarations:
        $activity_id = $_REQUEST[Constants::ACTIVITY_ID];
        $student_username = $_REQUEST[Constants::STUDENT_USERNAME];
        $stud_comment = $_REQUEST[Constants::STUDENT_COMMENT];
        $stud_anonymity = $_REQUEST[Constants::STUDENT_ANONYMITY];
        $stud_date = $_REQUEST[Constants::STUDENT_DATE];
        $stud_time = $_REQUEST[Constants::STUDENT_TIME];
        //Insert the following values in the table
        $stmt = "INSERT INTO ".Constants::STUD_COMMENT_TABLE." VALUES (:AI, :SU, :SC, :SA, :SD, :ST)";

        $args = array(":AI" => $activity_id, ":SU" => $student_username, ":SC" => $stud_comment, ":SA" => $stud_anonymity,
            ":SD" => $stud_date, ":ST" => $stud_time);
        $databaseManager -> executeStatement($stmt, $args);
        break;

    case Constants::READ_COMMENT:
        //lamp.ms.wits.ac.za/~s1712776/student_comment.php?action=readComment
        $activity_id = $_REQUEST[Constants::ACTIVITY_ID];
        //Pull everything from database
        $sql = "SELECT * FROM ".Constants::STUD_COMMENT_TABLE." WHERE ".Constants::ACTIVITY_ID." = :AI";
        //binds AI to activity
        $args = array(":AI" => $activity_id);
        $databaseManager -> executeFetchStatement($sql, $args);
        break;
}