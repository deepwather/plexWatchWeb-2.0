<?php include("../login.php"); ?>
<?php

header('Content-Type: application/json; charset=UTF-8');
echo json_encode(shell_exec('/bin/hostname'));
