<?php
require_once dirname(__FILE__) . '/core/init.php';
require_once dirname(__FILE__) . '/includes/metaHeader.php';
require_once dirname(__FILE__) . '/includes/header.php';
require_once dirname(__FILE__) . '/includes/sidebar.php';
?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Default box -->
        <div class="box">

            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div id="PersonTableContainer"></div>                  
                </div>
              </div>
            </div><!-- /.box-body -->

        </div><!-- /.box -->
      </div>  
    </div><!-- row-->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {
/*        
        $('#PersonTableContainer').jtable({
            title: 'Bad Order Records',
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
     */
    });
<!-- =============================================== -->
<?php
require_once dirname(__FILE__) . '/includes/footer.php';
?>
