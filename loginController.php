<?php
include "includer.php";
if (isset($_POST['loginName'])
    && !empty($_POST['loginName'])
    && strlen($_POST['loginName']) > 0
    && isset($_POST['loginPassword'])
    && !empty($_POST['loginPassword'])
    && strlen($_POST['loginPassword']) > 0)
{
    $loginName = htmlspecialchars(trim($_POST['loginName']));
    $loginPassword = htmlspecialchars(trim($_POST['loginPassword']));
    new loginModel($loginName, $loginPassword);
}