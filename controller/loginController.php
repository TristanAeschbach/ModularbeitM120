<?php
new includer(__FILE__);
if (isset($_POST['loginName'])
    && !empty($_POST['loginName'])
    && strlen($_POST['loginName']) > 0
    && isset($_POST['loginPassword'])
    && !empty($_POST['loginPassword'])
    && strlen($_POST['loginPassword']) > 0)
{
    $loginName = htmlspecialchars(trim($_POST['loginName']));
    $loginPassword = htmlspecialchars(trim($_POST['loginPassword']));

    if (isset($_POST['loginChecked'])){
        new loginModel($loginName, $loginPassword, true);
    }else{
        new loginModel($loginName, $loginPassword);
    }

}