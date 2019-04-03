<?php

    $adServer = "ldap://ss.wits.ac.za:389";

    $ldap = ldap_connect($adServer);
    $username = "1627982";
    $password = "mulisa6854727";

    $ldaprdn = 'student' . "\\" . $username;

    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

    $bind = @ldap_bind($ldap, $ldaprdn, $password);

    if ($bind){
        echo "works";
    }
    else{
        echo "failed";
    }

    /*if ($bind) {
        $filter="(sAMAccountName=$username)";
        $result = ldap_search($ldap,"dc=MYDOMAIN,dc=COM",$filter);
        ldap_sort($ldap,$result,"sn");
        $info = ldap_get_entries($ldap, $result);
        for ($i=0; $i<$info["count"]; $i++)
        {
            if($info['count'] > 1)
                break;
            echo "<p>You are accessing <strong> ". $info[$i]["sn"][0] .", " . $info[$i]["givenname"][0] ."</strong><br /> (" . $info[$i]["samaccountname"][0] .")</p>\n";
            echo '<pre>';
            var_dump($info);
            echo '</pre>';
            $userDn = $info[$i]["distinguishedname"][0];
        }
        @ldap_close($ldap);
    } else {
        $msg = "Invalid email address / password";
        echo $msg;
    }*/

