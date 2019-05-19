<?php
require_once("WitsSrcConnectDatabaseManager.php");
require_once("Constants.php");

$databaseManager = new WitsSrcConnectDatabaseManager();

$choice = $_REQUEST[Constants::ACTION];

switch ($choice){

    case Constants::POST_COMMENT:
        //http://1627982.ms.wits.ac.za/~student/student_comment.php?action=postComment&activity_id=0&stud_username=asdf&stud_comment=abc&stud_anonymity=1&stud_date=as&stud_time=abc

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
        $databaseManager -> executeStatement($stmt, $args, false);
        break;

    case Constants::READ_COMMENT:
        //1627982.ms.wits.ac.za/~student/student_comment.php?action=readComment&activity_id=1
        $activity_id = $_REQUEST[Constants::ACTIVITY_ID];

        $stmt = "SELECT * FROM ".Constants::STUD_COMMENT_TABLE." WHERE ".Constants::ACTIVITY_ID." = :AI ORDER BY ".Constants::STUDENT_DATE." , ".Constants::STUDENT_TIME." DESC";
        $args = array(":AI" => $activity_id);
        $databaseManager -> executeFetchStatement($stmt, $args);
        break;

    case Constants::POST_LIKE_OR_DISLIKE:
        $activity_id = $_REQUEST[Constants::ACTIVITY_ID];
        $student_username = $_REQUEST[Constants::STUDENT_USERNAME];
        $like_dislike =  $_REQUEST[Constants::ACTIVITY_LIKE_DISLIKE];
        //Search with this query
        $stmt = "SELECT * FROM".Constants::ACTIVITIES_LIKE_DISLIKE_TABLE." WHERE ".Constants::ACTIVITY_ID." = :AI AND ".Constants::STUDENT_USERNAME." = :UI ";

        if(mysqli_num_rows($stmt) > 0 ){
            $stmt2 = "UPDATE ".Constants::ACTIVITIES_LIKE_DISLIKE_TABLE." SET ".Constants::ACTIVITY_LIKE_DISLIKE." = :LD WHERE ".Constants::ACTIVITY_ID." = :AI AND ".Constants::STUDENT_USERNAME." = :UI ";
            $args = array(":AI" => $activity_id, ":UI" => $student_username, ":LD" => $like_dislike);
            $databaseManager ->executeStatement($stmt2, $args, false);
        }else{
            $stmt3 = "INSERT INTO ".Constants::ACTIVITIES_LIKE_DISLIKE_TABLE." VALUES (:AI, :UI, :LD)";
            $args = array(":AI" => $activity_id,":UI" => $student_username,":LD" => $like_dislike);
            $databaseManager ->executeStatement($stmt3, $args, false);
        }
        break;

}