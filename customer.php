<?php
include("includes/db.php");

$sql = new sql();

$req = $sql->requete('SELECT * FROM dbo.Person');
while ($r = $req->fetch())
{
    print_r($r);
}
?>