<?php
session_start();
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
unset($_SESSION['login_member_role']);
unset($_SESSION['login_member_name']);
unset($_SESSION['login_member_no']);


unset($_SESSION['err_msg']);
unset($_SESSION['suc_msg']);

unset($_SESSION['barcode']);
Redirect::to('login.php')
?>