<?php
require_once("WitsSrcConnectDatabaseManager.php");
require_once("Constants.php");

$databaseManager = new WitsSrcConnectDatabaseManager();

$choice = $_REQUEST[Constants::ACTION];

switch ($choice){

    case Constants::POST_LIKE_OR_DISLIKE:
        //lamp.ms.wits.ac.za/~s1712776/student_comment.php?action=postLikeOrDislike&activity_id=1&student_username=asdf&activity_like_dislike=0
        $activity_id = $_REQUEST[Constants::ACTIVITY_ID];
        $student_username = $_REQUEST[Constants::STUDENT_USERNAME];
        $activity_like_dislike = $_REQUEST[Constants::ACTIVITY_LIKE_DISLIKE];

        $stmt = "INSERT INTO ".Constants::ACTIVITIES_LIKE_DISLIKE_TABLE." VALUES (:AI, :SU, :ALD)";
        $args = array(":AI" => $activity_id, ":SU" => $student_username, ":ALD" => $activity_like_dislike);

        $databaseManager -> executeStatement($stmt, $args);
        break;

        //comment only

}
