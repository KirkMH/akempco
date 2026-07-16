<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';
  $table = 'tbl_productprice';
  $filter = 'prod_no';
  $sup_no =0;
?>

?> 
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12"> 

     

        <!-- UPLOAD CSV FILE -->
        <div class="box">
          <!-- <form > -->
            <div class="box-header">
              <h3>Upload Purchases</h3>
              <div class="box-tools pull-right">
                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
              </div>
            </div>

          <form enctype='multipart/form-data' action='purchases.php' method='post'>
            <div class="box-body">
              <div class="col-lg-10">
                  <div class="form-group">
                    <label for="">Supplier</label>
                    <select class="form-control" name="sup_no" id="sup_no">
                      <option value="">Select Supplier</option>

                        <?php
                          $sqlResult = $db->select('sup_no, sup_name', 'tbl_supplier', 'WHERE active=1 ORDER BY sup_name');

                          while ($extractData = $sqlResult->fetch_assoc()) {
                            echo "<option value=".$extractData['sup_no'];
                            if ($extractData['sup_no'] == $sup_no) echo " selected='selected'";
                            echo ">".$extractData['sup_name']."</option>";
                          }
                        ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <a href="javascript:void(0);" onclick="getdownload('prodlist');">Click here to download the template for purchases.</a>
                  </div>

              <?php  
              
              //connect to the database 
              
              // $connect = mysqli_connect("localhost","root",""); 
              // mysqli_select_db("akempcodb",$connect); //select the table 


              //Upload File
              if (isset($_POST['submit'])) {
                if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
                  echo "<h3>" . "File ". $_FILES['filename']['name'] ." uploaded successfully." . "</h3>";
                }

                // save details
                $sup_no = $_POST['sup_no'];
                $ref_no = $_POST['ref_no'];
                $ref_date = $_POST['ref_date'];
                $purchase_id = 0;

                $data = array(
                  'sup_no' => $sup_no,
                  'ref_no' => $ref_no,
                  'invoice_date' => $ref_date,
                  'user_no' => $_SESSION['login_member_no'],
                  );

                if ($db->insert('tbl_purchases', $data)) {
                  $purchase_id = $db->insert_id;
                }

                //Import uploaded file to Database
                $handle = fopen($_FILES['filename']['tmp_name'], "r");


                $ctr = 0;
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                  if ($ctr == 0) {
                    $type = ($data[0] == "Group Credit Payment" ? "g" : "m");
                    print "<br><h4>Supplier: $data[0] - $data[1]</h4>";
                  }
                  else if ($ctr == 1) {
                    print "<table border='1' cellpadding = '3'>\n";
                    print "<tr>";
                    print "<th>$data[0]</th>";
                    print "<th>$data[1]</th>";
                    print "<th>$data[2]</th>";
                    print "<th>$data[3]</th>";
                    print "<th>$data[4]</th>";
                    print "<th>$data[5]</th>";
                    print "<th>$data[6]</th>";
                    print "</tr>\n";
                  }
                  else {

                      if ($data[3] > 0) {

                        print "<tr>";
                        print "<td>$data[0]</td>";
                        print "<td>$data[1]</td>";
                        print "<td>$data[2]</td>";
                        print "<td align='right'>$data[3]</td>";
                        print "<td align='right'>$data[4]</td>";
                        print "<td align='right'>$data[5]</td>";
                        print "<td align='right'>$data[6]</td>";
                        print "</tr>\n";

                        $data2 = array(
                          'purchase_id' => $purchase_id,
                          'prod_no' => $data[0],
                          'qty_delivered' => $data[3],
                          'supplier_price' => $data[4],
                          'retail_price' => $data[5],
                          'wholesale_price' => $data[6]
                          );
                        $db->insert('tbl_purchasedetail', $data2);

                      }

                    //$import="UPDATE tbl_product SET qty_onhand = (qty_onhand+$data[3]) WHERE prod_no = $data[0]";
                    //mysql_query($import) or die(mysql_error());  
                  }
                    $ctr = $ctr + 1;
                }
                print "</table>\n";
                fclose($handle);

                print "\n\nImport completed.";

                //view upload form
              }else {

                print "<div>Upload CSV file by browsing the file and clicking on Upload.<br /><br /></div>";
              ?>
                

                  <div class="form-group ">
                    <label>Reference Number</label>
                    <input required value="<?php echo Input::get('ref_no') ?  Input::get('ref_no') : ''; ?>"  name="ref_no"  type="text" class="form-control" id="" placeholder="" maxlength="15">
                  </div>

                  <div class="form-group ">
                    <label>Invoice Date</label>
                    <input required value="<?php echo Input::get('ref_date') ?  Input::get('ref_date') : ''; ?>"  name="ref_date"  type="date" class="form-control" id="" placeholder="">
                  </div>

                  <div class="form-group ">
                    <label>File to import</label>
                    <input required size='50' type='file' name='filename'>
                  </div>

                  <div class="form-group ">
                    <input type='submit' name='submit' value='Upload'>
                  </div>


              <?php } ?>


<!--                 <div class="input-group">
                  <input type="hidden" value="100000" name="MAX_FILE_SIZE">
                  <label for="">Upload CSV File</label>
                  <input type="file" name="file" id="file"> -->
                <!-- </div> --><!-- /input-group -->
              </div>
            </div><!-- /.box-body -->
          </form>

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

<script language="javascript">
function getdownload(what) {
  var sup_no = document.getElementById('sup_no').value;
  if (sup_no == "") {
    alert("Please select supplier first.");
  }
  else {
    window.location.href = "download.php?what=".concat(what,"&sup_no=",sup_no);
  }
    
  //alert("download.php?what="+what+ "&sup_no="+document.getElementById('sup_no').value);
}
</script>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>