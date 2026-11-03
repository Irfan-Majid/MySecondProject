<?php
class crud{
	private $conn;
	
	public function __construct($host='localhost',$user='root',$password='',$database='my_project'){
		
		$this->conn=new mysqli($host,$user,$password,$database);
	}
	
	public function common_select($table,$fields="*",$where=false,$orderfield=false,$order="DESC"){
		
		$q="select $fields from $table ";
		if(is_array($where)){
			$q.="where ";
			foreach($where as $f=>$v){
				$q.="$f = '$v' and ";
			}
			$q=rtrim($q,' and ');
		}
		if($orderfield){
			$q.=" order by $orderfield $order";
		}
		/* for error */
		$error=0;
		/* for success */
		$success=0;
		
		$rs=$this->conn->query($q);
		if($rs->num_rows>0){
			$msg=array();
			while($data=$rs->fetch_object()){
				$msg[]=$data;
			}
			$success=1;
		}else{
			$msg=$this->conn->error;
			$error=1;
		}
		
		$jaher=array('error'=>$error,'success'=>$success,'msg'=>$msg);
		
		return $jaher;
	}
	
	public function common_insert($table,$data){
		/* for error */
		$error=0;
		/* for success */
		$success=0;
		$q="insert into $table set ";
		if(is_array($data)){
			foreach($data as $f=>$v){
				$q.="$f = '$v',";
			}
			$q=rtrim($q,',');
		}else{
			$msg="Data should be array";
			$error=1;
		}
		
		if($this->conn->query($q) === TRUE) {
			$msg=$this->conn->insert_id;
			$success=1;
		}else{
			$msg=$this->conn->error;
			$error=1;
		}
		
		$jaher=array('error'=>$error,'success'=>$success,'msg'=>$msg);
		
		return $jaher;
	}
	
	public function common_update($table,$data,$where=false){
		/* for error */
		$error=0;
		/* for success */
		$success=0;
		$q="update $table set ";
		if(is_array($data)){
			foreach($data as $f=>$v){
				$q.="$f = '$v',";
			}
			$q=rtrim($q,',');
		}else{
			$msg="Data should be array";
			$error=1;
		}
		if(is_array($where)){
			$q.="where ";
			foreach($where as $f=>$v){
				$q.="$f = '$v' and ";
			}
			$q=rtrim($q,' and ');
		}
		
		if($this->conn->query($q) === TRUE) {
			$msg=$this->conn->affected_rows;
			$success=1;
		}else{
			$msg=$this->conn->error;
			$error=1;
		}
		
		$jaher=array('error'=>$error,'success'=>$success,'msg'=>$msg);
		
		return $jaher;
	}
	
	public function common_delete($table,$where=false){
		
		$q="delete from $table ";
		if(is_array($where)){
			$q.="where ";
			foreach($where as $f=>$v){
				$q.="$f = '$v' and ";
			}
			$q=rtrim($q,' and ');
		}
		
		/* for error */
		$error=0;
		/* for success */
		$success=0;
		
		if($this->conn->query($q) === TRUE) {
			$msg=$this->conn->affected_rows;
			$success=1;
		}else{
			$msg=$this->conn->error;
			$error=1;
		}
		
		$jaher=array('error'=>$error,'success'=>$success,'msg'=>$msg);
		
		return $jaher;
	}
	
	public function common_query($q){
		/* for error */
		$error=0;
		/* for success */
		$success=0;
		
		$rs=$this->conn->query($q);
		if($rs->num_rows>0){
			$msg=array();
			while($data=$rs->fetch_object()){
				$msg[]=$data;
			}
			$success=1;
		}else{
			$msg=$this->conn->error;
			$error=1;
		}
		
		$jaher=array('error'=>$error,'success'=>$success,'msg'=>$msg);
		
		return $jaher;
	}
	
}