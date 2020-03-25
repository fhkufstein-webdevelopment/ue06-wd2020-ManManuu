<?php

require_once('includes/classes/Database.php');

define('DB_HOST', 'localhost');
define('DB_NAME', 'manuelsdb');
define('DB_USER', 'Manuel');
define('DB_PASS', 'test1234');

$db = new Database();

$cryptedPassword = password_hash('testpassword', PASSWORD_BCRYPT);
$username = "test";

$cryptedPassword = $db->escapeString($cryptedPassword);
$username = $db->escapeString($username);

$sql = "SELECT * FROM user WHERE name='".$username."'";
$result = $db->query($sql);
if($db->numRows($result) > 0)
{
    $row = $db->fetchAssoc($result);
    if(password_verify("passwort1234", $row['password']))
    {
        echo "Der Nutzer ".$username." mit der ID ".$row['id']." hat";
        echo " das Passwort testpassword";
    }
    else
    {
        echo "Nutzer gefunden aber falsches Passwort!";
    }
}
else
{
    echo "Keinen Nutzer gefunden";
}

