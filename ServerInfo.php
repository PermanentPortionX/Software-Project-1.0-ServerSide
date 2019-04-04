<?php

class ServerInfo {
    const database = "WITS_SRC_CONNECT_DB";
    const userName = "mulisa";
    const userPassword = "=MV4&X*v3UG&W822";
    const serverProxy = "127.0.0.1";
    const LDAP_HOST = "ldap://ss.wits.ac.za:389";
    const LDAP_DN = "ou=students,ou=wits university,dc=ss,dc=wits,dc=ac,dc=za";
    const LDAP_ATTR = array("distinguishedName","sn", "givenname","mail","telephonenumber");
}