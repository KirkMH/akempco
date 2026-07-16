<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/mars/core/init.php';
 // require_once $_SERVER['DOCUMENT_ROOT'] . '/mars/includes/metaHeader.php';
 // require_once $_SERVER['DOCUMENT_ROOT'] . '/mars/includes/header.php';
 // require_once $_SERVER['DOCUMENT_ROOT'] . '/mars/includes/sidebar.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>FUSE | Marianing Superstore -   Staff 1</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo SITE_URL_FILE; ?>bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo SITE_URL_FILE; ?>dist/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo SITE_URL_FILE; ?>dist/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo SITE_URL_FILE; ?>dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo SITE_URL_FILE; ?>dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL_FILE; ?>dist/css/addons.css">
      
<style type="text/css">
#modal-window {display:none;}
#payment-modes {display:none;}
#c-cash {display:none;}
#c-check {display:none;}
#c-gift_cert {display:none;}
#c-credit_card {display:none;}
#c-charge {display:none;}
#modal-cashout {display:none;}
#modal-check {display:none;}
#modal-credit {display:none;}
#modal-gift {display:none;}
#modal-charge {display:none;}
#modal-discount {display:none;}
#modal-footer-cashout {display:none;}
#modal-footer-check {display:none;}
#modal-footer-credit {display:none;}
#modal-footer-gift {display:none;}
#modal-footer-charge {display:none;}
#modal-footer-discount {display:none;}

/* Overlay */
#simplemodal-overlay {background-color:#000;}

/* Container */
/*#simplemodal-container {height:360px; width:600px; color:#bbb; background-color:#333; border:4px solid #444; padding:12px;}
#simplemodal-container .simplemodal-data {padding:8px;}
#simplemodal-container code {background:#141414; border-left:3px solid #65B43D; color:#bbb; display:block; font-size:12px; margin-bottom:12px; padding:4px 6px 6px;}
#simplemodal-container a {color:#ddd;}
#simplemodal-container a.modalCloseImg {background:url(x.png) no-repeat; width:25px; height:29px; display:inline; z-index:3200; position:absolute; top:-15px; right:-16px; cursor:pointer;}
#simplemodal-container h3 {color:#84b8d9;}  */
</style>
      </head>
      <body class="hold-transition skin-red sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper POS">

          <header class="main-header">
            <!-- Logo -->
            <a href="login.html" class="logo">
              <!-- mini logo for sidebar mini 50x50 pixels -->
              <span class="logo-mini"><b>FUSE</b></span>
              <!-- logo for regular state and mobile devices -->
              <span class="logo-lg"><b>Marianing</b> Superstore</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
              <h4 style="float:left; margin-left:30px; margin-top:16px; color:#fff"><b> 
                <?php 
                    echo date("M d Y") . " | " . date("h:i:sa");
                    ?>
              </b></h4>            

              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                  <!-- User Account: style can be found in dropdown.less -->
                  <li class="dropdown user user-menu">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                      <!-- <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
                      <span class="hidden-xs">Cashier1</span>
                    </a>

                  </li>
                </ul>
              </div>
            </nav>
          </header>

          <!-- =============================================== -->

          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">


            <!-- Main content -->
            <section class="content">
              <div class="row">
                <!-- left column -->
                <div class="col-md-6">          

                  <!-- Default box -->
                  <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Sales Invoice #: 0000120899 </h3>
                      <div class="pull-right">
                        <h3 class="box-title"></h3>
                      </div>
                    </div>

                    <div class="box-body">

                      <!-- CUSTOMER TYPE -->
                      <div class="form-group">
                        <label>Customer Type</label>
                        <select class="form-control" id="customer-type">
                          <option>Walk-in</option>
                          <option>Key Customer</option>
                          <option>Group Credit</option>
                        </select>
                      </div>

                      <!-- ITEMS -->
                      <div class="form-group">
                          <input id="barCode" class="form-control input-sm" type="text" placeholder="ITEM Code">
                      </div><!-- /.box -->                      


                      <div class="table-responsive no-padding">
                        <table id="tableItems" class="table table-hover table-fixed">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Qty</th>
                              <th>UOM</th>
                              <th>Item Desc</th>
                              <th class="text-center">Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr></tr>
                          </tbody>
                        </table>
                        
                      </div><!-- /.box-body -->

                    </div><!-- /.box-body -->

                    <div class="box-footer ">
                      <!-- Footer -->
                    </div><!-- /.box-footer-->

                  </div><!-- /.box -->

                </div><!-- /.col-md-6 -->

                <div class="col-md-6 cashier">
                  <div class="box">
                    <div class="box-header">
                      <h1><b>TOTAL:  </b> <b id="total-price" class="pull-right currency" ></b></h1>
                    </div>
                    <div class="box-body">
                      <h1><b>TENDERED:  </b> <b id="amount-tendered" class="pull-right "></b></h1>
                    </div>
                    <div class="box-footer ">
                      <h1><b>CHANGE:  </b> <b id="change" class="pull-right"></b></h1>
                      <!-- Footer -->
                    </div><!-- /.box-footer-->                    
                  </div>
                  <div class="box" >
                    <div class="box-body">
                      <h4><b>VATable Sales:  </b> <b id="VATable" class="pull-right currency">PhP 1,000.00</b></h4>
                      <h4><b>VAT Exempt Sales:  </b> <b id="VAT_excempt" class="pull-right currency">PhP 1,000.00</b></h4>
                      <h4><b>VAT Zero-Rated Sales:  </b> <b id="VAT_zero" class="pull-right currency">PhP 1,000.00</b></h4>
                      <h4><b>Discount:  </b> <b id="discount" class="pull-right currency">PhP 1,000.00</b></h4>
                      <h4><b>VAT (12%):  </b> <b id="VAT" class="pull-right currency">PhP 1,000.00</b></h4>
                    </div>
                  </div>
                  <div class="box" id="payment-modes" >
                    <div class="box-body">
                      <div class="box-body">
                        <h3><b>MODE OF PAYMENT</b></h3>
                        <h4 id="c-cash"><b>Cash:</b> <b id="cash" class="pull-right currency">PhP 1,000.00</b></h5>
                        <h4 id="c-check"><b>Check:</b> <b id="check" class="pull-right currency">PhP 1,000.00</b></h5>
                        <h4 id="c-gift_cert"><b>Gift Certificate:</b> <b id="gift_cert" class="pull-right currency">PhP 1,000.00</b></h5>
                        <h4 id="c-credit_card"><b>Credit Card:</b> <b id="credit_card" class="pull-right currency">PhP 1,000.00</b></h5>
                        <h4 id="c-charge"><b>Charge:</b> <b id="charge" class="pull-right currency">PhP 1,000.00</b></h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- /.row -->
            </section><!-- /.content -->

    <!-- modal content -->
    <div id="modal-window">
          <div id="" class="">
            <div class="">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                    <h4 class="modal-title" id="display-title">Enter Payment</h4>
                  </div>
                  <div class="modal-body">

                    <!--  modal body content for cashout -->
                    <div id="modal-cashout">
                      <input id="cash-payment" type="number" placeholder="0.00" class="form-control input-lg">
                    </div>


                    <!--  modal body content for check -->
                    <div class="form-group" id="modal-check">
                      <input id="id-no" type="text" placeholder="Check Number" class="form-control input-m">
                      <input id="fname" type="text" placeholder="Full Name" class="form-control input-m">
                      <input id="mdisc" type="number" placeholder="Amount" class="form-control input-m">
                    </div>


                    <!--  modal body content for credit card -->
                    <div class="form-group" id="modal-credit">
                      <label>Credit Card Type</label>
                      <select class="form-control" id="card-type">
                        <option>Visa</option>
                        <option>MasterCard</option>
                        <option>Others</option>
                      </select>
                      <input id="fname" type="text" placeholder="Full Name" class="form-control input-m">
                      <input id="mdisc" type="number" placeholder="Amount" class="form-control input-m">
                    </div>


                    <!--  modal body content for gift certificate -->
                    <div class="form-group" id="modal-gift">
                      <input id="fname" type="text" placeholder="Control Number" class="form-control input-m">
                      <input id="mdisc" type="number" placeholder="Amount" class="form-control input-m">
                    </div>


                    <!--  modal body content for charge  -->
                    <div class="form-group" id="modal-charge">
                      <h4><b>Credit Limit:  </b> <b id="credit-limit" class="pull-right currency">PhP 1,000.00</b></h4>
                      <h4><b>Charged Amount:  </b> <b id="charged-amount" class="pull-right currency">PhP 100.00</b></h4>
                      <h4><b>Remaining Balance:  </b> <b id="remaining-balance" class="pull-right currency">PhP 900.00</b></h4>
                    </div>


                    <!--  modal body content for discount -->
                    <div class="form-group" id="modal-discount">
                      <label for="discount-type">Discount type:</label>
                      <label class="radio-inline"><input type="radio" name="optdiscount" value="sc_pwd">Senior Citizen / PWD</label>
                      <label class="radio-inline"><input type="radio" name="optdiscount" value="outright">Outright</label>
                      <input id="id-no" type="text" placeholder="Identification Number" class="form-control input-m">
                      <input id="fname" type="text" placeholder="Full Name" class="form-control input-m">
                      <input id="mdisc" type="text" placeholder="Discount (suffix with % for percentage)" class="form-control input-m">
                    </div>


                  </div>

                  <!--  modal footer content for cashout -->
                  <div class="modal-footer" id="modal-footer-cashout">
                    <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
                    <button id="ok-modal" class="btn btn-info pull-right" type="button">OK</button>
                  </div>

                  <!--  modal footer content for check  -->
                  <div class="modal-footer" id="modal-footer-check">
                    <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
                    <button id="ok-modal" class="btn btn-info pull-right" type="button">OK</button>
                  </div>

                  <!--  modal footer content for credit card  -->
                  <div class="modal-footer" id="modal-footer-credit">
                    <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
                    <button id="ok-modal" class="btn btn-info pull-right" type="button">OK</button>
                  </div>

                  <!--  modal footer content for gift certificate -->
                  <div class="modal-footer" id="modal-footer-gift">
                    <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
                    <button id="ok-modal" class="btn btn-info pull-right" type="button">OK</button>
                  </div>

                  <!--  modal footer content for gift certificate -->
                  <div class="modal-footer" id="modal-footer-charge">
                    <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
                    <button id="ok-modal" class="btn btn-info pull-right" type="button">OK</button>
                  </div>

                  <!--  modal footer content for discount -->
                  <div class="modal-footer" id="modal-footer-discount">
                    <button id="d-ok-modal" class="btn btn-info pull-right" type="button">OK</button>
                  </div>


                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div><!-- /.example-modal -->
    </div>


          <!-- preload the images -->
<!--           <div style='display:none'>
            <img src='x.png' alt='' />
          </div> -->

          </div><!-- /.content-wrapper -->

          <footer class="main-footer">
            <div class="pull-right hidden-xs">
              <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; 2015-2016 <a href="http://f1itsystemsolutions.com">F1 IT System Solutions</a>.</strong> All rights reserved.
          </footer>


          <div class="control-sidebar-bg"></div>
        </div><!-- ./wrapper -->

        <!-- jQuery 2.1.4 -->
        <script src="<?php echo SITE_URL_FILE; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="<?php echo SITE_URL_FILE; ?>bootstrap/js/bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="<?php echo SITE_URL_FILE; ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="<?php echo SITE_URL_FILE; ?>plugins/fastclick/fastclick.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo SITE_URL_FILE; ?>dist/js/app.min.js"></script>
        <!-- currency formatter -->
        <script src="<?php echo SITE_URL_FILE; ?>plugins/currencyFormatter/jquery.formatCurrency-1.4.0.min.js"></script>
        <script src="<?php echo SITE_URL_FILE; ?>plugins/currencyFormatter/jquery.formatCurrency.en-PH.js"></script>
        
        <!-- modal window -->
        <script src="<?php echo SITE_URL_FILE; ?>dist/js/simplemodal.js"></script>        
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo SITE_URL_FILE; ?>dist/js/demo.js"></script>


<script type="text/javascript">

$(document).ready(function() {
  tbodyHeight = $(".content-wrapper").height()
  $(".table-fixed tbody").css("height", tbodyHeight/2 );

  $('#barCode').focus();

  var computedPrice = 0;
  //START keypress
  // get keypress everytime input barcode
    $.fn.enterKey = function (fnc) {
        return this.each(function () {
            $(this).keypress(function (ev) {
                var keycode = (ev.keyCode ? ev.keyCode : ev.which);
                if (keycode == '13') {
                    fnc.call(this, ev);
                }
            })
        })
    }

    //END keypress

    // START compute price
    //compute all prices from table in cell > .item-price 
    function computePrice(){
      var prices = $('.item-price');
      var total = 0;      
        $.each(prices, function(i, price){
          var pc=$(this).text();  
          if (pc!= 'NA'){
           total = total + parseFloat(pc);
          }
        });
        return total;
    }
    // END compute price


    // START change customer type
    function changeCustomerType(cType) {

      if ('walkin' == cType) {
        $('#customer-type').get(0).selectedIndex = 0;
        $('#barCode').focus();
        $('#barCode').val('');
      }
      else if ('key' == cType) {
        $('#customer-type').get(0).selectedIndex = 1;
        $('#barCode').focus();
        $('#barCode').val('');
      }
      else if ('group' == cType) {
        $('#customer-type').get(0).selectedIndex = 2;
        $('#barCode').focus();
        $('#barCode').val('');
      }
    }
    // END change customer type


    // START change customer type
    function showModal(mType) {
      /*
      $('#modal-window').hide();
      $('#payment-modes').hide();
      $('#c-cash').hide();
      $('#c-check').hide();
      $('#c-gift_cert').hide();
      $('#c-credit_card').hide();
      $('#c-charge').hide();
      */
      $('#modal-cashout').hide();
      $('#modal-check').hide();
      $('#modal-credit').hide();
      $('#modal-gift').hide();
      $('#modal-charge').hide();
      $('#modal-discount').hide();
      $('#modal-footer-cashout').hide();
      $('#modal-footer-check').hide();
      $('#modal-footer-credit').hide();
      $('#modal-footer-gift').hide();
      $('#modal-footer-charge').hide();
      $('#modal-footer-discount').hide();
      

      if ('cashout' == mType) {
        $('#cash-payment').empty();
        $('#modal-window').modal();
        $('#modal-cashout').show();
        $('#modal-footer-cashout').show();
        $('#cash-payment').focus();
      }
      else if ('cashout' == mType) {
        $('#cash-payment').empty();
        $('#modal-window').modal();
        $('#modal-cashout').show();
        $('#modal-footer-cashout').show();
        $('#cash-payment').focus();
      }
      else if ('discount' == mType) {
        $('#id-no').empty();
        $('#fname').empty();
        $('#mdisc').empty();
        $('#id-no').hide();
        $('#fname').hide();
        $('#mdisc').hide();
        $('#discount-modal-window').modal();
        //$('input[type=radio][name=optdiscount]').change();
        $('#modal-discount').show();
        $('#modal-footer-discount').show();

      }
    }
    // END change customer type

    //START FUNCTION

// $("#date").html("<span>"+arr[0] + "</span></br>" + arr[1]+"/"+arr[2]);      
    // add new item in the table and compute for the total cost
      //fetch data from database base on the barcode
      /*
      $('#discount-modal-window').ready(function () {
        $("#discount-type").val("Senior Citizen / PWD").change();
      });
        */ 
    itemCount = 0;
    $("#barCode").enterKey(function () {
      
      var rawbarCode =$(this).val();

      // THIS IS FOR BACKUP STIMULI FOR MODAL FORMS

      if (rawbarCode == "#21") {//cash out
        showModal('cashout');
      }
      else if (rawbarCode == "#22") { // discount
        showModal('discount');
      }


      // FOR SWITCHING BETWEEN CUSTOMER TYPES

      else if (rawbarCode == "#11") { // walkin
        changeCustomerType('walkin');
      }
      else if (rawbarCode == "#12") { // key customer
        changeCustomerType('key');
      }
      else if (rawbarCode == "#13") { // group credit
        changeCustomerType('group');
      }


      // FOR READING BARCODES
      else {
      var splitData = rawbarCode.split('*');
      //spliData[0] is number of items
      //spliData[1] barCode
      // resItemPrice = query database for item price of item splitData[1]
      //multiply number of items splitData[0] to result query price
      itemCount++;//line number

      //erase this later if database is establish
      pricePerPiece = 12.34;

      var data1 = "<tr><td class='item-count'>" + itemCount  + "</td>"
            +"<td  class=''>" + splitData[0] +"</td>"
            +"<td  class=''>pack</td>"
            +"<td>Skyflakes dsfg sdfg dhjr fghf hfgh fghdfgh ertgret erter trete rte jgjdgh dfhgd hdfhdsfh</td>"
            +"<td  class='text-right item-price'  >" + parseFloat(splitData[0]) * parseFloat(pricePerPiece) +"</td></tr>";

      var data2 = "<tr><td class='item-count'>" + itemCount  + "</td>"
            +"<td  class=''>" + splitData[0] +"</td>"
            +"<td  class=''>sachet</td>"
            +"<td>Coke</td>"
            +"<td  class='text-right item-price'  >" + parseFloat(splitData[0]) * parseFloat(pricePerPiece) +"</td></tr>";              

      var data3 = "<tr><td class='item-count'>" + itemCount  + "</td>"
            +"<td  class=''>" + splitData[0] +"</td>"
            +"<td  class=''>sachet</td>"
            +"<td>Creamsilk</td>"
            +"<td  class='text-right item-price'  >" + parseFloat(splitData[0]) * parseFloat(pricePerPiece) +"</td></tr>";  

      var data4 = "<tr><td class='item-count'>" + itemCount  + "</td>"
            +"<td  class=''>" + splitData[0] +"</td>"
            +"<td  class=''>sachet</td>"
            +"<td>Fita</td>"
            +"<td  class='text-right item-price'  >" + parseFloat(splitData[0]) * parseFloat(pricePerPiece) +"</td></tr>";

      var data5 = "<tr><td class='item-count'>" + itemCount  + "</td>"
            +"<td  class=''>" + splitData[0] +"</td>"
            +"<td  class=''>sachet</td>"
            +"<td>Wilkins</td>"
            +"<td  class='text-right item-price'  >" + parseFloat(splitData[0]) * parseFloat(pricePerPiece) +"</td></tr>";

           
      if(splitData[1] == 11111){
        row = data1;
      }else if(splitData[1] == 22222){
        row = data2;
      }else if(splitData[1] == 33333){
        row = data3;
      }else if(splitData[1] == 44444){
        row = data4;
      }else if(splitData[1] == 55555){
        row = data5;
      }//end erase

      $("#tableItems tbody tr:last").after(row); 
      computedPrice = computePrice();
      $('#total-price').text(computedPrice); //.formatCurrency({ region: 'en-PH', colorize:true });
      $(this).val('')
    }
    })
    //END FUNCTION

/* 
  // keyCodes
  f1  112 help
  f2  113 cashout
  f3  114 xxxxx
  f4  115 DISCOUNT
  f5  116 xxxxx
  f6  117 CASH
  f7  118 CHECK
  f8  119 GIFT CERTIFICATE
  f9  120  CREDIT CARD
  f10   121 CHARGED
  f11   122 xxxxx
  f12   123 xxxxx
*/
  window.onkeypress = function(e) {//press f9
      if ((e.which || e.keyCode) == 113) {//cash out
        showModal('cashout');
      }else if ((e.which || e.keyCode) == 112) {  // f1   call help     
          // $('#modal-window').modal();
      } else if ((e.which || e.keyCode) == 115) { // f4   call discount
        showModal('discount');
      }    
  }

  $('#ok-modal').click(function (e) {//ok in modal window: cashout
    $('#payment-modes').show();
    $('#c-cash').show();
    cashPayment = $('#cash-payment').val();
    $('#cash').text(cashPayment);
    alert($('cashPayment').formatNumber());
    $('#amount-tendered').text('P ' + $('cashPayment').formatNumber());
    $.modal.close();
      
      //$('#amount-tendered').text('P ' + cashPayment).formatCurrency({ region: 'en-PH', colorize:true }); // getting error here

      change =parseFloat(cashPayment) - parseFloat(computedPrice)
      $('#change').text(change).formatCurrency({ region: 'en-PH', colorize:true });  // getting error here
      $.modal.close();
  });


  $('#d-ok-modal').click(function (e) {//ok in modal window
      dtype = $('#discount-type').val();

      if (dtype == "Outright") {
        disc = $('#mdisc').val();
        $('#discount').text(disc);
      }
      else {
        total = $('#total-price').val();
        disc = total * 0.12;
        $('#discount').text(disc);
      }
      $.modal.close();
      $('#barCode').focus();
      $('#barCode').val('');
  });

  $('input[type=radio][name=optdiscount]').change(function() {
      if (this.value == 'sc_pwd') {
        $('#id-no').show();
        $('#fname').show();
        $('#mdisc').hide();
      }
      else if (this.value == 'outright') {
        $('#id-no').hide();
        $('#fname').hide();
        $('#mdisc').show();
      }
  });
});

</script>        
</body>
</html>
