<?php
require_once("WitsSrcConnectDatabaseManager.php");
require_once("Constants.php");

$databaseManager = new WitsSrcConnectDatabaseManager();

$choice = $_REQUEST[Constants::ACTION];

switch ($choice){

    case Constants::POST_COMMENT:
        //lamp.ms.wits.ac.za/~s1712776/student_comment.php?action=postLikeOrDislike&activity_id=1&student_username=asdf&activity_like_dislike=0

        //Declarations:
        $activity_id = $_REQUEST[Constants::ACTIVITY_ID];
        $student_username = $_REQUEST[Constants::STUDENT_USERNAME];
        $stud_comment = $_REQUEST[Constants::STUDENT_COMMENT];
        $stud_date = $_REQUEST[Constants::STUDENT_DATE];
        $stud_time = $_REQUEST[Constants::STUDENT_TIME];
        //Insert the following values in the table
        $stmt = "INSERT INTO ".Constants::STUD_COMMENT." VALUES (:AI, :SU, :SC, :SD, :ST)";

        $args = array(":AI" => $activity_id, ":SU" => $student_username, ":SC" => $stud_comment, ":SD" => $stud_date, ":SI" => $stud_time);
        $databaseManager -> executeStatement($stmt, $args);
        break;

        //comment only

}
