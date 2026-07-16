      <?php  
        if(Session::exists('msg')){
            session_unset('msg');
        }
        if(Session::exists('err')){
            session_unset('err');
        }

      ?>
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2016-2017 <a href="http://f1itsystemsolutions.com">F1 IT System Solutions</a>.</strong> All rights reserved.
      </footer>


    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php  ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php  ?>plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?php  ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- my js file -->
    <script src="<?php  ?>dist/js/main.js"></script>
    <!-- FastClick -->
    <script src="<?php  ?>plugins/fastclick/fastclick.min.js"></script>
   <!-- iCheck 1.0.1 -->
    <script src="<?php  ?>plugins/iCheck/icheck.min.js"></script>    
    <!-- InputMask -->
    <script src="<?php  ?>plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?php  ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?php  ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- DataTables -->
    <script src="<?php  ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php  ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- jQueryUI-->
    <script src="<?php  ?>plugins/jQueryUI/jquery-ui.min.js"></script>
    <!-- Include jTable script file. -->
    <script src="<?php  ?>plugins/jtable.2.4.0/jquery.jtable.min.js" type="text/javascript"></script>
    <!-- modal window -->
    <script src="<?php  ?>dist/js/simplemodal.js"></script>       
    <!-- AdminLTE App -->
    <script src="<?php  ?>dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php  ?>dist/js/demo.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="<?php  ?>plugins/daterangepicker/daterangepicker.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php  ?>plugins/chartCanvasJS/jquery.canvasjs.min.js"></script>
    <!-- DATEP PICKER -->
    <script type="text/javascript">
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();
    </script>

<script>
 $(function() 
 {   $( ".datepicker" ).datepicker({
         changeMonth:true,
         changeYear:true,
         yearRange:"-0:+10",
         dateFormat:"yy-mm-dd" });
 });
 </script>    
<script type="text/javascript">
    window.onload = function () {
        //Better to construct options first and then pass it as a parameter
        var options1 = {
            title: {
                text: "Sales Report for the date: May 1, 2016 - May 31, 2016 "
            },
                    animationEnabled: true,
            data: [
            {
            type: "column", //change it to line, area, bar, pie, etc
                dataPoints: [
                    {label: "1", y: 10000 },
                    {label: "2", y: 6000 },
                    {label: "3", y: 1400 },
                    {label: "4", y: 12000 },
                    {label: "5", y: 1900 },
                    {label: "6", y: 1400 },
                    {label: "7", y: 26000 },
                    {label: "8", y: 1000 },
                    {label: "9", y: 22000 },
                    {label: "10", y: 1000 },
                    {label: "11", y: 100 },
                    {label: "12", y: 600 },
                    {label: "13", y: 1004 },
                    {label: "14", y: 10002 },
                    {label: "15", y: 19000 },
                    {label: "16", y: 1040 },
                    {label: "17", y: 20060 },
                    {label: "18", y: 1000 },
                    {label: "19", y: 2200 }                    
                ]
            }
            ]
        };

        $("#resizable").resizable({
            create: function (event, ui) {
                //Create chart.
                $("#chartContainer1").CanvasJSChart(myOptions);
            },
            resize: function (event, ui) {
                //Update chart size according to its container's size.
                $("#chartContainer1").CanvasJSChart().render();
            }
        });

    }
</script>

<script type="text/javascript">
$(document).ready(function () {
/*        
        $('#PersonTableContainer').jtable({
            title: 'Accounts Payable Voucher Entry',
            actions: {
                listAction: 'PersonActions.php?action=list',
                createAction: 'PersonActions.php?action=create',
                updateAction: 'PersonActions.php?action=update',
                deleteAction: 'PersonActions.php?action=delete'
            },
            fields: {
                PersonId: {
                    key: true,
                    list: false
                },
                Name: {
                    title: 'Author Name',
                    width: '40%'
                },
                Age: {
                    title: 'Age',
                    width: '20%'
                },
                RecordDate: {
                    title: 'Record date',
                    width: '30%',
                    type: 'date',
                    create: false,
                    edit: false
                }
            }
        });
        $('#PersonTableContainer').jtable('load');        

*/

    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });

    //add row below the tables
    $("#addRowTable").click(function(){
        $("#accountsPayableVoucherTbl").append('<tr><td contenteditable="true"></td><td contenteditable="true"></td><td contenteditable="true"></td><td contenteditable="true"></td><td contenteditable="true"></td><td contenteditable="true"></td><td contenteditable="true"></td></tr>');
    });

    // add row in product registration in retail items
    $('#addRowRetailItem').click(function(){
        $("#retial-items-table").append('<tr>'
                                            +'<td>'
                                              +'<div class="form-group">'
                                                +'<input type="text" id="" name="" value="" class="form-control">'
                                              +'</div>'
                                            +'</td>'
                                            +'<td><label class="" style="font-size: 15px;" for="">No. of</label></td>'
                                            +'<td>'
                                              +'<div class="form-group">'
                                                +'<select class="form-control">'
                                                  +'<option selected="selected">Select</option>'
                                                  +'<option>UOM1</option>'
                                                  +'<option>UOM2</option>'
                                                +'</select>'
                                              +'</div>'
                                            +'</td>'
                                            +'<td width=50><label class="" style="font-size: 15px;" for="">/ Sack</label></td>'
                                            +'<td>'
                                              +'<div class="form-group">'
                                                +'<input type="text" id="" name="" value="" class="form-control">'
                                              +'</div>'
                                            +'</td>'
                                            +'<td>'
                                              +'<div class="form-group">'
                                                +'<input type="text" id="" name="" value="" class="form-control">'
                                              +'</div>'
                                            +'</td>'
                                            +'<td>'
                                              +'<div class="form-group">'
                                                +'<input type="text" id="" name="" value="" class="form-control">'
                                              +'</div>'
                                            +'</td>'
                                          +'</tr>'
                                        )
    })//end of add rowRetailItem

    // group credit table if click a row, modal windwow appear with members table and info
    $(function () {
        $(".sorttable").DataTable();
    // $('#example2').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": false,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false
    // });
    });

    // $('.sorttable tbody tr').click(function () {
        
    // })

    $('#ok-modal').click(function (e) {//ok in modal window
      $.modal.close();
    })      

    var table = $(".sorttable").DataTable();
             
    $('.sorttable tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        var dataID = $(this).attr('id')
        var dbTable = $(this).closest('table').attr('id')
        // alert('ano ra nga id: ' +data[0]+ 'You clicked on '+$(this).attr('id')+'\'s row' +  "table id is: " + $(this).closest('table').attr('id'));

/*            $.ajax({
                type: "POST",
                url: "selectOne.php",
                dataType:"json",
                data: "dbTable="+dbTable+"dataID="+dataID,
                success: function(data)
                {
                    var arrayLength = data.length;
                    for (var i = 0; i < arrayLength; i=i+6) 
                    {
                        str ="";
                        str+="<tr class='trmessage' id=" + data[i+5] + ">";
                        str+="<td id='firstcolumnmob'>"+(data[i+3])+"</td>";
                        str+="<td id='secondcolumnmob'>"+(data[i+2])+"</td>";
                        str+="<td id='thirdcolumnmob'>"+(data[i+4])+"</td>";
                        str+="</tr>";
                        $('#inboxdashboard').append(str);
                    }
                    $("#inboxdashboard").show();

                }
            });*/


        // $('#modal-window').modal();
    });
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}
//COPY THE CREDIT LIMIT TO TOTAL CHARGE
path = location.pathname.split('/').slice(-1)[0]
if(!getParameterByName('member_no') && path == "regMember.php" && !getParameterByName('success')){
    $( "#credit_limit" ).change(function() {
        // $('#charge_total').val($('#credit_limit').val())//copy credit limit content and put it to remaining credit this will save in db
    });
}

});//end of document ready
</script>

    <!-- full featured tables -->
    <script>

    $("#modal-update-product").change(function(){
        var selectedAction = $("#modal-update-product option:selected").val()
        selected = $('.modal-update-col').eq(selectedAction)
        $('.modal-update-col').not(selected).slideUp('fast');
        selected.delay('fast').slideToggle();
    });

//this will check checkbox if check in product registration repack or not
        $('#repacking-chbox').click(function(){
            if($(this).prop("checked") == true){
                $("#not-repack").toggle();
                $("#repack").toggle();
            }

            else if($(this).prop("checked") == false){
                $("#repack").toggle();
                $("#not-repack").toggle();
            }

        });      



        //Date range picker
        $('#dateRangeBox').daterangepicker();
        //Date range picker
        $('#dateRangeBox2').daterangepicker();

    </script>

        <script type="text/javascript">
        <!--
        function updateTime() {
          var currentTime = new Date();
          var hours = currentTime.getHours();
          var minutes = currentTime.getMinutes();
          var seconds = currentTime.getSeconds();
          if (minutes < 10){
            minutes = "0" + minutes;
          }
          if (seconds < 10){
            seconds = "0" + seconds;
          }
          if(hours > 12){
            hours -=12;
          }
          var v = hours + ":" + minutes + ":" + seconds + " ";
          if(hours > 11){
            v+="PM";
          } else {
            v+="AM"
          }
          setTimeout("updateTime()",1000);
          $('#time')[0].innerHTML=v;
        }
        updateTime();
            //-->
        </script>     
  </body>
  </html>
