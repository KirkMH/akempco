<!-- // FUNCTIONS
function auditInsert ($tablename, $fieldspec, $where, $newarray){
	$oldarray = array();
	
	//USER ACTION TABLE DATA
	$this->auditWrite($tablename, $fieldspec, $where, $newarray, $oldarray);

	$db->insert($table, $data)
	return;
} 

function auditUpdate ($tablename, $fieldspec, $where, $newarray, $oldarray) {
    $this->auditWrite($tablename, $fieldspec, $where, $newarray, $oldarray);
    return;
} // auditUpdate -->
<?php 
class Audit{
	private $db;
	public function __construct($user = null){
		$this->db = Mysqli_Manager::getInstance();
	}
	// Audit::record($_SESSION['login_member_no'], Input::get('action'), $table, $newData, $datedate('Y-m-d'), date('H:i:s'));
	public function record($user, $action, $tablename, $fieldspec, $date, $time){		
		//USER ACTION TABLE DATA
		// $audit->record($_SESSION['login_member_no'], Input::get('action'), $table, $newData, date('Y-m-d'), date('H:i:s'));
		
		$data['user'] = $user;
		$data['action'] = $action;
		$data['table_name'] = $tablename;
		$data['fieldspec'] = $fieldspec;
		$data['date'] = $date;
		$data['time'] = $time;

		$this->db->insert("audit_tbl", $data);
		return;
	}
}







?>