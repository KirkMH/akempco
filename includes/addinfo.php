
    <input name="action" value="<?php echo isset($_GET['group_no']) ?  'update' : 'insert'; ?>"  type="hidden">
    <input name="page" value="<?php echo basename($_SERVER['PHP_SELF']) ?>"  type="hidden">
    <input name="dataID" value="<?php echo isset($_GET['group_no']) ?  $_GET['group_no'] : ''; ?>"  type="hidden">
    <input name="filter" value="<?php echo isset($_GET['group_no']) ?  'group_no' : ''; ?>"  type="hidden">
    <input name="table" value="tbl_supplier" type="hidden">
    <div class="form-group ">
