<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';
  $table = 'tbl_productprice';
  $filter = 'prod_no';

if (!isset($_SESSION)) {
  session_start();
}
?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12"> 

      <?php 
        if(Session::exists('msg')){
      ?>
        <div class="alert alert-success alert-dismissable">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <h4>  <i class="icon fa fa-check"></i> <?php  echo Session::flash('msg') ?></h4>
        </div>
      <?php 
      session_unset('msg');
      }

      // determine which month
      $mo = date('m');
      $yr = date('Y');
      $ex = $db->select_one('*', 'tbl_inventorycount', "ORDER BY dyear DESC , dmonth DESC");
      if ($ex !== null) {
        $mo = $ex['dmonth'] + 1;
        $yr = $ex['dyear'];
        if ($mo > 12) {
          $mo = $mo - 12;
          $yr = $yr + 1;
        }
      }
      $smo = getMonthName($mo);
      ?> 

        <!-- UPLOAD CSV FILE -->
        <div class="box">
          <!-- <form > -->
            <div class="box-header">
              <h3>Inventory Count for the month of <?php echo $smo . ", " . $yr;?></h3>
              <div class="box-tools pull-right">
                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
              </div>
            </div>



            <div class="box-body">
              <div class="col-lg-10">
                <a href="download.php?what=invcount">Click here to download the template for inventory count.</a>
              </div>
            </div>

            <div class="box-body">
              <div class="col-lg-10">

              <?php  
              $msg = "";
// if(Session::flash('token')) echo  "----" . Session::flash('token') . "----" ;
                  if(Token::check(Input::get('token'))){
                        //Upload File
                        // if (isset($_POST['submit'])) {
                          if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
                            echo "<h1>" . "File ". $_FILES['filename']['name'] ." uploaded successfully." . "</h1>";
                          }

                          //Import uploaded file to Database
                          $handle = fopen($_FILES['filename']['tmp_name'], "r");

                          $ctr = 0;
                          $arr = "";

                          while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            if ($data[0] > 0 && $ctr > 1) {
                              $arr = $arr . ", ";
                            }
                            if ($ctr > 0) {
                              $dataEntry = array('actual_count' => $data[3]);
                              if($db->update("tbl_product", $dataEntry , "WHERE prod_no =" . $data[0])){
                                $arr = $arr . $data[0];
                              }else{
                                echo Session::flash('msg', $msg);
                                // echo "<script language='javascript'>alert('error')</script>"; //displayer
                              }
                            }
                            $ctr = $ctr + 1;
                          }
                          fclose($handle);

                          #$_SESSION['upProd'] = $arr;

                          $msg = "Import successfully.";
                          Session::flash('msg', $msg);
                          //echo "inventory-adjustment.php?dmonth=$mo&dyear=$yr&which=$arr";
                          echo "<script language='javascript'>location.href='inventory-adjustment.php?dmonth=$mo&dyear=$yr&which=$arr'</script>";
                          //Redirect::to("inventory-adjustment.php");
                          exit();


                          //view upload form
                        // } 
                  }else {
  $token = Token::generate();
                          print "Upload new csv by browsing to file and clicking on Upload<br />\n";

                          print "<form enctype='multipart/form-data' action='inventory-count.php' method='post'>";
                          print "<input class='button orange' type='hidden' name='token' value=" . $token . " />";
                          // print("<br>" . $token);
                          print "File name to import:<br />\n";

                          print "<input size='50' type='file' name='filename'><br />\n";

                          print "<input type='submit' name='submit' value='Upload'></form>";

                        }
              ?>


<!--                 <div class="input-group">
                  <input type="hidden" value="100000" name="MAX_FILE_SIZE">
                  <label for="">Upload CSV File</label>
                  <input type="file" name="file" id="file"> -->
                <!-- </div> --><!-- /input-group -->
              </div>
            </div><!-- /.box-body -->

            <!-- <div class="box-footer"> -->
              <!-- <div class="form-group pull-right"> -->
                <!-- <div class="col-lg-5 input-group"> -->
                  <!-- <span class="input-group-btn"> -->
                    <!-- <button class="btn btn-info" type="submit" name="submit" >Save</button> -->
                  <!-- </span> -->
                <!-- </div> --><!-- /input-group -->
              <!-- </div> --><!-- /.form-group -->                 
            <!-- </div> --><!-- /.box-footer-->
          <!-- </form> -->
        </div>


     </div>
   </section><!-- /.content -->
 </div><!-- /.content-wrapper -->

 <!-- =============================================== -->

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>
