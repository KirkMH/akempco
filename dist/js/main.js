/*
* Author: herminio yatar jr
* Date: 30 Jun 2016
* Description:
*      This is a a js file obviously.  You are allowed to read but not copy!
**/

$(function () {

      $('#addUOM').click(function (e) {
        e.preventDefault();
        compOperator = $('#noUOM').val();
        if($.isNumeric( compOperator )){
          while( compOperator != 0 ){
            $( "#groupUOM" ).append( 
              '<div class="form-group form-inline">'
              + '<div class="form-group ">'
              + '<label style="padding-right: 5px">From</label> '
              + '<input value=""  type="text" class="form-control" name="fromUOM[]" id="" placeholder="">'
              + '</div>'
              + '<div class="form-group" style="padding-left: 20px">'
              + '<label style="padding: 5px">To</label> '
              + '<input value=""  type="text" class="form-control" name="toUOM[]" id="" placeholder="">'
              + '</div>'                    
              +'</div>'
              );
            compOperator--
          }
        }else{
          alert("This is not a number.")
        }


      })

      $('#saveGroup').click(function (e) {
        $( "#entryTable" ).empty()
      })



      $('#followbtn').on('click', function(e){
/*        e.preventDefault();

        $.ajax({
          url: '/akempco/includes/processor.php',
          type: 'post',
          data: {'action': 'follow', 'userid': '11239528343'},
          success: function(data, status) {
            if(data == "ok") {
              $('#followbtncontainer').html('<p><em>Following!</em></p>');
              var numfollowers = parseInt($('#followercnt').html()) + 1;
              $('#followercnt').html(numfollowers);
            }
          },
          error: function(xhr, desc, err) {
            console.log(xhr);
            console.log("Details: " + desc + "\nError:" + err);
          }
        }); */// end ajax call
      });

/*    $.ajax({                                      
      url: 'api.php',                  //the script to call to get data          
      data: "",                        //you can insert url argumnets here to pass to api.php
                                       //for example "id=5&parent=6"
      dataType: 'json',                //data format      
      success: function(data)          //on recieve of reply
      {
        var id = data[0];              //get id
        var vname = data[1];           //get name
        //--------------------------------------------------------------------
        // 3) Update html content
        //--------------------------------------------------------------------
        $('#output').html("<b>id: </b>"+id+"<b> name: </b>"+vname); //Set output element html
        //recommend reading up on jquery selectors they are awesome 
        // http://api.jquery.com/category/selectors/
      } 
    });*/

});
