<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';
$table = 'tbl_department';
$filter = 'dept_no';
/*  $errorsList = array();
    $validate = new Validate();
    if(Token::check(Input::get('token'))){


    $validation = $validate->check($_GET, array(
      'dept_name' => array(
        'tag_name' => 'Department Name', 
        'required' => true,
        'min' => 6,
        'max' => 60
        )
      
      
      ));

    // if(Input::get('old_pass')){
    //   $validate->addError("Please select where this menu is prepare.");
    // }

    if($validation->passed()){
      require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/processor.php';
    }else{
      foreach ($validation->errors() as $errorKey => $errorVal) {
        $errorsList[$errorKey] = $errorVal;
      }      
    }
  }*/
  $token = Token::generate();
  ?>
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Delisted Departments</h3>
              <div class="box-tools pull-right">
                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="form-group"><input type="button" onclick="location.href='regDepartment.php'" value="View Active Departments" /></div>
              <table id="listTable" class="sorttable table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ACTION</th>
                    <th>Department Name</th>
                    <th>Description</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $sqlResult = $db->select('*', $table, 'WHERE active = 0 ORDER BY dept_name');
                  if($sqlResult){
                    while ($dataAttri = $sqlResult->fetch_assoc()) {
                      $dataID = $dataAttri['dept_no'];
                      ?>
                      <tr>
                         <td><a href="/akempco/includes/processor.php?action=update&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter; ?>&dataID=<?php echo $dataID; ?>&active=1" onclick="return (confirm('Are you sure you want to restore this department?'));">RESTORE</a></td>
                         <td><?php echo ucfirst($dataAttri['dept_name']);?></td>
                         <td><?php echo ucfirst($dataAttri['dept_desc']);?></td>
                       </tr>
                       <?php
                     }
                   }
                   ?>
                 </tbody>
               </table>
             </div><!-- /.box-body -->
           </div><!-- /.box -->              
         </div><!--/.col-md-12  -->


       </div>  
     </div><!-- row-->
   </section><!-- /.content -->
 </div><!-- /.content-wrapper -->

 <!-- =============================================== -->

 <?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
 ?>
