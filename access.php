<?php
require_once "Role.php";
require_once "PrivilegedUser.php";

// connect to database...
// ...

session_start();

if (isset($_SESSION["loggedin"])) {
    $u = PrivilegedUser::getByUsername($_SESSION["loggedin"]);
}

if ($u->hasPrivilege("thisPermission")) {
    // do something
}