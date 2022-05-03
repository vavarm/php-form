<?php

function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat)
{
    $result = false;
    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    }
    return $result;
}

function invalidUid($username)
{
    $result = false;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) { //if the username doesn't respect the correct format
        $result = true;
    }
    return $result;
}

function invalidEmail($email)
{
    $result = false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //if the email doesn't respect the correct format of an email
        $result = true;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat)
{
    $result = false;
    if ($pwd !== $pwdRepeat) { //if the password and the password repeat are not equal
        $result = true;
    }
    return $result;
}

//TODO - change SQL requests by PDO

function uidExists($conn, $username, $email)
{
    $sql = "SELECT * FROM user WHERE userUid = ? OR userEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) { // fetch_assoc return 0 if the resultData does not contain any rows
        $result = $row;
    } else {
        $result = false;
    }

    mysqli_stmt_close($stmt);

    return $result;
}

//TODO - change SQL requests by PDO

function createUser($conn, $name, $email, $username, $pwd)
{
    $sql = "INSERT INTO user (userName, userEmail, userUid, userPwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); //TODO - look at the different methods of hash

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();
}

function emptyInputLogin($username, $pwd)
{
    $result = false;
    if (empty($username) || empty($pwd)) {
        $result = true;
    }
    return $result;
}

function loginUser($conn, $username, $pwd)
{
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists == false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["userPwd"];

    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    } else if ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["userId"];
        $_SESSION["useruid"] = $uidExists["userUid"];
        header("location: ../index.php");
        exit();
    }
}

// TODO - create a bunch of functions to verify the values entered by the user