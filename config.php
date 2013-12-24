<?php

/*
 * This document configures site wide settings for the SBEP Staff
 * Administration Manager (SAM) and Individual Professional
 * Development Plan System (IPDP).
 * 
 * This program was developed by and is the intellectual property
 * of Ben Schneider.  Please contact him by e-mailing:
 * schneiderbw@gmail.com
 */

/*DB Information*/
    $mysql_host = 'localhost'; //Hostname of the MySQL server
    $mysql_user = 'titanstaff'; //Username of the MySQL user on the server
    $mysql_pass = 'hZW4epAVHcSRxsmY'; //Password of the MySQL user
    $mysql_db = 'titanstaff'; //Database that contains the SAM and IPDP tables

/*LDAP Information*/
    $ldap_basedn1 = 'cn=users,dc=nxserver2,dc=sbepschools,dc=org';
    $ldap_server1 = 'nxserver2.sbepschools.org';
    $ldap_basedn2 = 'cn=users,cn=hccanet,cn=org';
    $ldap_server2 = 'xserver.sbepschools.org';

/*District Information*/
    $district_name = 'St. Bernard-Elmwood Place City School District';
    $district_addy1 = '105 Washington Ave.';
    //$district_addy2 = ''; //Uncomment this line if there is a second line to your street address
    $district_city = 'St. Bernard';
    $district_state = 'Ohio';
    $district_zip = '45217';
    $district_site = 'http://www.sbepschools.org/'; //Your district's website URL goes here, including the protocol
    $district_samsite = 'https://sam.sbepschools.org/'; //Your district's website where SAM & IPDP is installed

/*Do not edit anything under this line */
/*if($_GET['debug'] = "1"){
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(-1);
}*/
?>
