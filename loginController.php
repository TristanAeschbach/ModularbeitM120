<?php
include "includer.php";
print_r($_REQUEST);
if (isset($_POST['loginName'])
    && !empty($_POST['loginName'])
    && strlen($_POST['loginName']) > 0
    && isset($_POST['loginPassword'])
    && !empty($_POST['loginPassword'])
    && strlen($_POST['loginPassword']) > 0)
{
    echo "weeh";
    $loginName = htmlspecialchars(trim($_POST['loginName']));
    $loginPassword = htmlspecialchars(trim($_POST['loginPassword']));

    if (isset($_POST['loginChecked'])){
        echo "wee";
        new loginModel($loginName, $loginPassword, true);
    }else{
        echo "woo";
        new loginModel($loginName, $loginPassword);
    }

}