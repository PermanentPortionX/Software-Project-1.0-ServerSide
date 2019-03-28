<?php

class Constants {
    //project
    const ACTION = "action";
    const SUCCESS = "1";
    const FAILED = "0";
    const DEFAULT_JSON = "{}";

    //SRC MEMBER ACTIONS(DEFAULTS)
    const LOG_IN = "login";
    const UPDATE_PASS = "updatePass";

    //SRC MEMBER ACTION(ACTIVITY)
    const POST_ACTIVITY = "postActivity";
    const UPDATE_ACTIVITY = "updateActivity";
    const DELETE_ACTIVITY = "deleteActivity";
    const READ_ALL_ACTIVITIES = "readAllActivities";

    //SRC MEMBER ACTION(POLL)
    const POST_POLL = "postPoll";
    const DELETE_POLL = "deletePoll";
    const UPDATE_POLL = "updatePoll";
    const READ_ALL_POLLS = "readAllPolls";

    //SRC MEMBER_TABLE
    const SRC_MEMBER_TABLE = "SRC_MEMBER";
    const SRC_MEMBER_USER = "member_username";
    const SRC_MEMBER_PASS = "member_password";
    const SRC_MEMBER_NEW_PASS = "member_new_pass";

    //SRC ACTIVITIES
    const ACTIVITY_TABLE = "SRC_ACTIVITY";
    const ACTIVITY_ID = "activity_id";
    const ACTIVITY_TITLE = "activity_title";
    const ACTIVITY_DESC = "activity_desc";
    const ACTIVITY_POST_DATE = "activity_post_date";
    const ACTIVITY_POST_TIME = "activity_post_time";

    //ACTIVITIES LIKE AND DISLIKE
    const ACTIVITIES_LIKE_DISLIKE_TABLE = "ACTIVITIES_LIKE_DISLIKE";
    const ACTIVITY_LIKE_DISLIKE = "activity_like_dislike";

    //ACTIVITIES COMMENTS
    const STUD_COMMENT_TABLE = "STUD_COMMENT";
    const STUDENT_USERNAME = "stud_username";
    const STUDENT_COMMENT = "stud_comment";
    const STUDENT_ANONYMITY = "stud_anonymity";
    const STUDENT_DATE = "stud_date";
    const STUDENT_TIME = "stud_time";

    //ACTIVITIES COMMENTS ACTIONS
    const POST_COMMENT = "postComment";
    const POST_LIKE_OR_DISLIKE = "postLikeOrDislike";
}
