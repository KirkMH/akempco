<?php 

  if(!isset($_SESSION['login_member_role']))  {
    Redirect::to("login.php");
  }

  function getMonthName($mo) {
    $smo = "";
      switch ($mo) {
        case '01':
          $smo = "January";
          break;

        case '02':
          $smo = "February";
          break;

        case '03':
          $smo = "March";
          break;

        case '04':
          $smo = "April";
          break;

        case '05':
          $smo = "May";
          break;

        case '06':
          $smo = "June";
          break;

        case '07':
          $smo = "July";
          break;

        case '08':
          $smo = "August";
          break;

        case '09':
          $smo = "September";
          break;

        case '10':
          $smo = "October";
          break;

        case '11':
          $smo = "November";
          break;

        case '12':
          $smo = "December";
          break;
        
        default:
          # code...
          break;
      }
    return $smo;
  }
  
  // if(isset($_SESSION['login_member_role']) == "MEMBER")  {
  //   if(isset($_SESSION['barcode'])){
  //     Redirect::to("balance-inquiry.php?id=". $_SESSION['barcode']);
  //   }else{
  //     Redirect::to("logout.php");
  //   }
    
  // }  

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AKEMPCO Point-of-Sale System </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="<?php  ?>plugins/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php  ?>dist/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php  ?>dist/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php  ?>dist/css/AdminLTE.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php  ?>plugins/iCheck/all.css">  
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php  ?>plugins/datatables/dataTables.bootstrap.css">  
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php  ?>plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- JQueryUI style -->
  <link rel="stylesheet" href="<?php  ?>plugins/jQueryUI/jquery-ui.min.css">
  <!-- Include one of jTable styles. -->
  <link href="<?php  ?>plugins/jtable.2.4.0/themes/metro/darkorange/jtable.min.css" rel="stylesheet" type="text/css" />

    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php  ?>dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="<?php  ?>dist/css/addons.css">

<style type="text/css">
#modal-window {display:none;}
/* Overlay */
#simplemodal-overlay {background-color:#000;}

/* Container */
#simplemodal-container {width:100%;}
.modal-dialog{ width: 100%}
/*#simplemodal-container .simplemodal-data {padding:8px;}
#simplemodal-container code {background:#141414; border-left:3px solid #65B43D; color:#bbb; display:block; font-size:12px; margin-bottom:12px; padding:4px 6px 6px;}
#simplemodal-container a {color:#ddd;}
#simplemodal-container a.modalCloseImg {background:url(x.png) no-repeat; width:25px; height:29px; display:inline; z-index:3200; position:absolute; top:-15px; right:-16px; cursor:pointer;}
#simplemodal-container h3 {color:#84b8d9;}  */
</style>        
      </head>
