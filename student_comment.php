<?php
require_once("WitsSrcConnectDatabaseManager.php");
require_once("Constants.php");

$databaseManager = new WitsSrcConnectDatabaseManager();

$choice = $_REQUEST[Constants::ACTION];

switch ($choice){

    case Constants::POST_COMMENT:
        //lamp.ms.wits.ac.za/~s1712776/student_comment.php?action=postLikeOrDislike&activity_id=0&stud_username=asdf&stud_comment=abc&stud_date=as&stud_time=abc

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
            ":SD" => $stud_date, ":SI" => $stud_time);
        $databaseManager -> executeStatement($stmt, $args);
        break;

    case Constants::READ_COMMENT:
        $activity_id = $_REQUEST[Constants::ACTIVITY_ID];

        $sql = "SELECT * FROM ".Constants::STUD_COMMENT_TABLE." WHERE ".Constants::ACTIVITY_ID." = :AI";

        break;

        //comment only
        //test
}
