<?php
require_once('class.dbcontrol.php');

class DB extends DbControl{
	var $host = "localhost";
	var $db = "liberato_liberators";
	var $user = "liberato_admin";
	var $pass = '$erverS669';

	#var $host = "localhost";
	#var $db = "liberator";
	#var $user = "root";
	#var $pass = "";
	public function chrr($a, $b){
		if($b == 0){
			return ucwords(strtolower($a));
			}

		}
	public function getYears($d){
	 if(($d != "0000-00-00") && ($d != NULL)) {
        $date1 = date_create($d);
		$date2 = date_create(date('Y-m-d'));
        $diff = date_diff($date1,$date2);
        return $diff->format("%y yrs, %m m ");
	 }
	 else{
		 return "--.--";
		 }
 	}
 	public function url_origin( $s, $use_forwarded_host = false )
	{
	    $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
	    $sp       = strtolower( $s['SERVER_PROTOCOL'] );
	    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
	    $port     = $s['SERVER_PORT'];
	    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
	    $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
	    $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
	    return $protocol . '://' . $host;
	}

	public function full_url( $s, $use_forwarded_host = false )
	{
	    return $this->url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
	}

	
	public function maincheck($a, $b){
			if(isset($a) && strlen($a)>0){
				return $a;
				}
			else{
				header('location:'.$b.'');
				}
		}
	public function ect($a, $b){
		return $a;
		}
	public function dct($a, $b){
		return $a;
		}
	 public  function safe_b64encode($string) {
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }

    public function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    public  function encode($value, $e){ 
        if(!$value){return false;}
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $e, $text, MCRYPT_MODE_ECB, $iv);
        return trim($this->safe_b64encode($crypttext)); 
    }

    public function decode($value, $e){
        if(!$value){return false;}
        $crypttext = $this->safe_b64decode($value); 
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $e, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }
	public function construct(){
		
		try
		{
			$dbh = new PDO("mysql:host=". $this->host ."; dbname=". $this->db , $this->user,$this->pass);
			$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}
		catch (PDOException $e)
		{
			print ("Could not connect to server.\n");
			print ("getMessage(): " . $e->getMessage () . "\n");
		}
		
		return $dbh;
	}
	protected function array_to_pdo_params($array) {
 	 $temp = array();
  		foreach (array_keys($array) as $name) {
   			 $temp[] = "`$name` = ?";
 		 }
  		return implode(', ', $temp);
	}
	protected function array_to_pdo_key($array) {
 	 $temp = array();
  		foreach (array_keys($array) as $name) {
   			 $temp[] = "`$name` ";
 		 }
  		return "( ".implode(', ', $temp)." )";
	}
	public function object_to_array($data) 
		{
		if ((! is_array($data)) and (! is_object($data))) return 'xxx'; //$data;
		
		$result = array();
		
		$data = (array) $data;
		foreach ($data as $key => $value) {
			if (is_object($value)) $value = (array) $value;
			if (is_array($value)) 
			$result[$key] = $value;
			else
				$result[$key] = $value;
		}
		
		return $result;
		}
	public function array_or_array($d,$e){
	if(is_array($e)){
		$i =$e;
	}else{
	$i = explode(',',$e);
	}
	$item = '(';
	foreach($i as $ii){
		$item .= $d."='".$ii."' OR "; 
		}
	return substr($item,0,-3).')';
	}	
	protected function array_to_pdo_place($array) {
 	 $temp = array();
  		foreach (array_keys($array) as $name) {
   			 $temp[] = " ? ";
 		 }
  		return "( ".implode(', ', $temp)." )";
	}
	protected function array_to_pdo_value($array) {
 	 $temp = array();
  		foreach (array_keys($array) as $name) {
   			 $temp[] = " :$name ";
 		 }
  		return "( ".implode(', ', $temp)."  )";
	}
	public function studentSession($e){
		$se = $this->select('session');
			$details = array();
			foreach($se as $ses){
				$sc = 'student_class'.$ses->id;
				$ss = 'student_subject'.$ses->id;
				//get class
				$sc1 = $this->selectOne($sc, NULL, array('studentID'=>$e));
				$ss1 = $this->select($ss, NULL, array('studentID'=>$e));
					if(isset($sc1) && !isset($ss1)){
						$details[$ses->id] = array($ses->name, $sc1, NULL);
					}
				    elseif(!isset($sc1) && isset($ss1) && is_array($ss1)){
						$details[$ses->id] = array($ses->name,NULL, $ss1);
						}
					elseif(isset($sc1) && isset($ss1) && is_array($ss1)){
						$details[$ses->id] = array($ses->name,$sc1, $ss1);
						}
				}
			return $details;
		}
	public function studentSemester($e){
					//	get semesters
					$semesters = $this->select('semester', NULL, NULL, array('id desc'));
					$details2 = array();
					foreach($semesters as $semester){
						$get_session = $this->selectOne('session', NULL, array('id'=>$semester->session));
						$s = array();
						$s[] = 'student_class'.$semester->id;
						$s[] = 'student_subject'.$semester->id;
						$s[] = 'student_behavior'.$semester->id;
						$s[] = 'student_health'.$semester->id;
						$s[] = 'student_fee'.$semester->id;
						$s[] = 'student_money'.$semester->id;
						$s[] = 'student_result'.$semester->id;
						//foreach semester get cas
						$deta = array();
						$dbh = $this->construct();
						foreach($s as $sr){
							 $sr1 = $this->ifTableExist($e, $sr, $dbh);
							 $deta[] = $sr1;
						}
						$cas = $this->select('ca', null, array('semesterID'=>$semester->id));
						$all_scores = array();
						$all_subjects = array();
						if(in_array('student_result'.$semester->id, $deta)){
						foreach($cas as $ca){
						$get_all_subjects = $this->select('student_result'.$semester->id, NULL, array('caID'=>$ca->id, 'studentID'=>$e));
								$subject_score = array();
								foreach($get_all_subjects as $j){
									$subject_score[$j->subjectID] = $j->score; 
									$all_subjects[] = $j->subjectID;
									}
								if(count($subject_score) > 0){$all_scores[$ca->id] = $subject_score;}
							}
						}
						$name_file = array($semester->name, $get_session->name, $get_session->id);
						$details2[$semester->id] = array($name_file, $cas, $all_scores, array_unique($all_subjects), $deta);
						$deta = array();
						}
					
							
				
			return $details2;
		}	
	public function ifTableExist($a, $b, $c){
		try {
		 $result = $c->query("SELECT $a FROM $b LIMIT 1");
		} 
		catch (Exception $e) {
			return FALSE;
		}
    	return $b;
	}
	public function select($table = NULL, $columns  = NULL, $where  = NULL,  $orderby  = NULL, $groupby  = NULL)
	{
		$add = parent::whereClause($where);
		$add .= parent::orderByClause($orderby);
		if(isset($columns))
			{
				$col = parent::columnChoice($columns);
			}
		else
			{
			$col = '*';	
			}
		try
		{
		$sql = 'SELECT '. $col .' FROM `'. $table .'` '.$add;
				
				$rows = array();
				$dbh = $this->construct();	
				$sth = $dbh->query($sql);
				
			while ($row = $sth->fetch(PDO::FETCH_OBJ)){
				array_push($rows, $row);
			}
			return $rows;
		}
		catch (PDOException $e)
		{
		$msg = $db.":";
		$msg .=  ("getMessage(): " . $e->getMessage() . "\n");
		return $msg;
		}
		
	}

	
	
	public function selectIN($table = NULL, $columns  = NULL, $where  = NULL,  $orderby  = NULL, $groupby  = NULL)
	{
		$add = parent::whereClause($where);
		$add .= parent::orderByClause($orderby);
		if(isset($columns))
			{
				$col = parent::columnChoice($columns);
			}
		else
			{
			$col = '*';	
			}
		try
		{
		$sql = 'SELECT '. $col .' FROM `'. $table .'` '.$add;
				
				$rows = array();
				$dbh = $this->construct();	
				$sth = $dbh->query($sql);
				
			while ($row = $sth->fetch(PDO::FETCH_OBJ)){
				array_push($rows, $row);
			}
			return $rows;
		}
		catch (PDOException $e)
		{
		$msg = $db.":";
		$msg .=  ("getMessage(): " . $e->getMessage() . "\n");
		return $msg;
		}
		
	}
	
	public function selectMax($table = NULL, $columns  = NULL, $where  = NULL,  $orderby  = NULL, $groupby  = NULL)
	{
		$add = parent::whereClause($where);
		$add .= parent::orderByClause($orderby);
		if(isset($columns))
			{
				$col = parent::columnChoice($columns);
			}
		else
			{
			$col = '*';	
			}
		try
		{
		$sql = 'SELECT MAX('.$columns.') as '.$columns.' FROM `'. $table .'` '.$add;
				
				$rows = array();
				$dbh = $this->construct();	
				$sth = $dbh->query($sql);
				
			while ($row = $sth->fetch(PDO::FETCH_OBJ)){
				array_push($rows, $row);
			}
			return $rows;
		}
		catch (PDOException $e)
		{
		$msg = $db.":";
		$msg .=  ("getMessage(): " . $e->getMessage() . "\n");
		return $msg;
		}
		
	}
	
	public function selectjoin($firsttable = NULL, $secondtable = NULL, $ontable, $jointype, $columns  = NULL, $where  = NULL,  $orderby  = NULL, $groupby  = NULL)
	{
		$add = parent::whereClause($where);
		$add .= parent::orderByClause($orderby);
		if(isset($columns))
			{
				$col = parent::columnChoice($columns);
			}
		else
			{
			$col = '*';	
			}
		try
		{
		 $sql = 'SELECT '. $col .' FROM `'. $firsttable .'` '.$jointype.' `'.$secondtable.'` ON '.$ontable.' '.$add;
				
				$rows = array();
				$dbh = $this->construct();	
				$sth = $dbh->query($sql);
				
			while ($row = $sth->fetch(PDO::FETCH_OBJ)){
				array_push($rows, $row);
			}
			return $rows;
		}
		catch (PDOException $e)
		{
		$msg = $db.":";
		$msg .=  ("getMessage(): " . $e->getMessage() . "\n");
		return $msg;
		}
		
	}
	
	
	
	public function selectOne($table = NULL, $columns  = NULL, $where  = NULL,  $orderby  = NULL, $groupby  = NULL)
	{
		$add = parent::whereClause($where);
		$add .= parent::orderByClause($orderby);
		if(isset($columns))
			{
				$col = parent::columnChoice($columns);
			}
		else
			{
			$col = '*';	
			}
		try
		{
	 $sql = 'SELECT '. $col .' FROM `'. $table .'` '.$add;
			
				$dbh = $this->construct();	
				$sth = $dbh->query($sql);
				
			while ($row = $sth->fetch(PDO::FETCH_OBJ))
			return $row;
		}
		catch (PDOException $e)
		{
		$msg = $db.":";
		$msg .=  ("getMessage(): " . $e->getMessage() . "\n");
		return $msg;
		}
		
	}

	public function LogWinners($id, $raffle, $gift,  $numb)
	{
		$tbl = 'raffle_log'.$id;
		
		try
		{
	    $sql = 'UPDATE  
	    			`'.$tbl.'` AS tbl1 
	    			 INNER JOIN
	    			(SELECT  
	    			*  
	    			FROM 
	    				`'.$tbl.'` 
	    			WHERE `giftID`= '.$gift.' AND `raffleID` = '.$raffle.' AND `winID` IS NULL ORDER BY RAND() LIMIT '.$numb.') 
					AS `tbl2`  
					ON  tbl1.id =  tbl2.id
				SET `tbl1`.`winID` = 1';
			
				$dbh = $this->construct();
				$sth = $dbh->prepare($sql);
				$sth->execute ();
				
			
			return $sth;
		}
		catch (PDOException $e)
		{
		##$msg = $sth.":";
		$msg =  ("getMessage(): " . $e->getMessage() . "\n");
		return $msg;
		}
		
	}
	public function selectTimeOne($table = NULL, $columns  = NULL, $where  = NULL,  $orderby  = NULL, $groupby  = NULL)
	{
		$add = parent::whereClause($where);
		$add .= parent::orderByClause($orderby);
		if(isset($columns))
			{
				$col = parent::columnChoice($columns);
			}
		else
			{
			$col = '*';	
			}
		try
		{
	 $sql = 'SELECT * FROM 	`raffles` WHERE active = 0 AND `raffle_end` > NOW() ORDER BY `raffle_end` LIMIT 1';
			
				$dbh = $this->construct();	
				$sth = $dbh->query($sql);
				
			while ($row = $sth->fetch(PDO::FETCH_OBJ))
			return $row;
		}
		catch (PDOException $e)
		{
		$msg = $db.":";
		$msg .=  ("getMessage(): " . $e->getMessage() . "\n");
		return $msg;
		}
		
	}


	public function selectClients($states = NULL, $lga  = NULL, $num=null)
	{
		$wh1 ='';
		if(isset($states))
		{
			$lgas = $this->select('local_governments', array('id'), array('state_id' => $states));
			foreach($lgas as $lgx)
			{
				$lgx_arr[] = $lgx->id;
			}
			$wh = $this->array_or_array('lga', $lgx_arr);
			$wh1 = ' WHERE '.$wh;
		}elseif(isset($lga))
		{
			$wh1 = ' WHERE lga = '.$lga;
		}

		if(isset($num)  && $num == 1)
		{
			$wh2 = ' active = 1 ';
		}elseif(isset($num)  && $num == 0)
		{
			$wh2 = ' active = 0 ';
		}

		if(strlen($wh1) > 0)
		{
			$wh1 = $wh1.' AND '.$wh2;
		}else
		{
			$wh1 = ' WHERE '.$wh2;
		}


		$db = 'clients';
		
		try
		{
	 $sql = '
		SELECT
			*,
			(SELECT name FROM local_governments WHERE id = `lga` LIMIT 1) as lganame
		FROM 
			`'.$db.'` '.$wh1.'  
		';
				
				$rows = array();
				$dbh = $this->construct();	
				$sth = $dbh->query($sql);
				
			while ($row = $sth->fetch(PDO::FETCH_OBJ)){
				array_push($rows, $row);
			}
			return $rows;
		}
		catch (PDOException $e)
		{
		$msg = $db.":";
		$msg .=  ("getMessage(): " . $e->getMessage() . "\n");
		return $msg;
		}
		
	}

	public function selectLogs($id, $raffle, $num = NULL, $gift = NULL, $center = NULL)
	{
		$db = 'raffle_log'.$id;
		$wh = '';
		if(isset($num))
		{
			if($num == 1 )
			{
				$wh .= ' winID = 1';
			}else
			{
				$wh .= ' winID IS NULL';
			}
			
		}
		if(isset($gift) && $gift > 0)
		{
			if( strlen($wh) > 0)
			{
				$wh .= ' AND ';
			}
			
				$wh .= ' giftID = '.$gift;
		}

		if(isset($raffle) && $raffle > 0)
		{
			if( strlen($wh) > 0)
			{
				$wh .= ' AND ';
			}
			
				$wh .= ' raffleID = '.$raffle;
		}
		if(isset($center) && $center > 0)
		{
			if( strlen($wh) > 0)
			{
				$wh .= ' AND ';
			}
			
				$wh .= ' centerID = '.$center;
		}

		if(strlen($wh) > 0)
		{
			$wh =' WHERE '. $wh; 
		}
		
		try
		{
	 $sql = '
		SELECT
			id,
			clientID,
			giftID,
			centerID,
			winID,
			winSms,
			logSms,
			date_created as dt,
			(SELECT CONCAT(surname," ",othername) as name FROM clients WHERE id = `clientID`) as name, 
			(SELECT phone FROM clients WHERE id = `clientID`) as phone, 
			(SELECT name FROM gifts WHERE id = `giftID`) as giftname, 
			(SELECT price FROM gifts WHERE id = `giftID`) as price,
			(SELECT name FROM centers WHERE id = `centerID`) as centername,  
			(SELECT abbrv FROM local_governments WHERE id = (SELECT lga  FROM clients WHERE id = `clientID` LIMIT 1) LIMIT 1) as lganame 
		FROM 
			`'.$db.'`  
		'.$wh.' ORDER BY centerID, giftID';
				
				$rows = array();
				$dbh = $this->construct();	
				$sth = $dbh->query($sql);
				
			while ($row = $sth->fetch(PDO::FETCH_OBJ)){
				array_push($rows, $row);
			}
			return $rows;
		}
		catch (PDOException $e)
		{
		$msg = $db.":";
		$msg .=  ("getMessage(): " . $e->getMessage() . "\n");
		return $msg;
		}
		
	}


	public function recordCount($table)
	{
		try
		{
			$sql = 'SELECT COUNT(*) as total FROM `'. $table .'` ';

				$dbh = $this->construct();
				$sth = $dbh->query($sql);

			while ($row = $sth->fetch(PDO::FETCH_OBJ))
			return $row->total;
		}
		catch (PDOException $e)
		{
			$msg = $db.":";
			$msg .=  ("getMessage(): " . $e->getMessage() . "\n");
			return $msg;
		}

	}

	public function generateMemberId($u, $db){

		$id = $this->recordCount($db);
		$membershipId = "";

		if(isset($id))
		{
			$lga = $this->selectOne('local_governments', NULL, array('id' => $u['lga']));
			$id = ($id + 1)."";
			if($id < 10){
				$id = '000'.$id;
			}
			elseif($id < 100){
				$id = '00'.$id;
			}
			elseif($id < 1000){
				$id = '0'.$id;
			}
			$lga_name = strtoupper(substr($lga->name, 0, 3));
			$abbrv = $lga->abbrv==null?$lga_name:$lga->abbrv;
			$membershipId = $abbrv.$id;
		}
		return $membershipId;
	}

	public function selectLogsSummary($id, $raffle, $num = NULL, $gift = NULL)
	{
		$db = 'raffle_log'.$id;
		$wh = '';
		if(isset($num))
		{
			if($num == 1 )
			{
				$wh .= ' winID = 1';
			}else
			{
				$wh .= ' winID IS NULL';
			}
			
		}
		if(isset($gift) && $gift > 0)
		{
			if( strlen($wh) > 0)
			{
				$wh .= ' AND ';
			}
			
				$wh .= ' giftID = '.$gift;
		}

		if(isset($raffle) && $raffle > 0)
		{
			if( strlen($wh) > 0)
			{
				$wh .= ' AND ';
			}
			
				$wh .= ' raffleID = '.$raffle;
		}

		if(strlen($wh) > 0)
		{
			$wh =' WHERE '. $wh; 
		}
		
		try
		{
	$sql = '
		SELECT
			DISTINCT giftID AS gift,
			centerID AS center,
			COUNT(clientID) as client,
			(SELECT name FROM gifts WHERE id = `giftID`) as giftname, 
			(SELECT price FROM gifts WHERE id = `giftID`) as giftcost,
			(SELECT name FROM centers WHERE id = `centerID`) as centername 
		FROM 
			`'.$db.'`  
		'.$wh.' GROUP BY centerID, giftID';
				
				$rows = array();
				$dbh = $this->construct();	
				$sth = $dbh->query($sql);
				
			while ($row = $sth->fetch(PDO::FETCH_OBJ)){
				array_push($rows, $row);
			}
			return $rows;
		}
		catch (PDOException $e)
		{
		$msg = $db.":";
		$msg .=  ("getMessage(): " . $e->getMessage() . "\n");
		return $msg;
		}
		
	}

	public function selectBlogs($id , $num)
	{
		$db = 'blogs';

		$sel = $this->select('blogs', null, array('active'=>0));
		$selnum = count($sel);
		$selnum = ceil($selnum);
		$fr = $id * $num;
		$lr = $fr + $num;
		if($lr > $sel)
		{
			$lr = $sel;
		}
		
		try
		{
	 $sql = '
		SELECT
			* 
		FROM 
			`'.$db.'`
		ORDER BY id DESC
		LIMIT  '.$fr.' , '.$num.' 

		
		';
				
				$rows = array();
				$dbh = $this->construct();	
				$sth = $dbh->query($sql);
				
			while ($row = $sth->fetch(PDO::FETCH_OBJ)){
				array_push($rows, $row);
			}
			return $rows;
		}
		catch (PDOException $e)
		{
		$msg = $db.":";
		$msg .=  ("getMessage(): " . $e->getMessage() . "\n");
		return $msg;
		}
		
	}

	public function selectLogsWins($id, $where = NULL)
	{
		$db = 'raffle_log'.$id;
		$dbw = 'raffle_winner'.$id;
		
		try
		{
	 $sql = '
		SELECT
			`'.$db.'`.`id`,
			`'.$db.'`.`clientID`,
			`'.$db.'`.`giftID`,
			`'.$db.'`.`centerID`,
			`'.$db.'`.`raffleID`,
			(SELECT CONCAT(surname," ",othername) as name FROM clients WHERE id = `'.$db.'`.`clientID`) as name, 
			(SELECT phone FROM clients WHERE id = `clientID`) as phone, 
			(SELECT name FROM gifts WHERE id = `giftID`) as giftname, 
			(SELECT name FROM centers WHERE id = `centerID`) as centername 
		FROM 
			`'.$db.'` 
		RIGHT JOIN 
			`'.$dbw.'`
		ON 
			`'.$db.'`.`id` =  `'.$dbw.'`.`logID`
		'.$where;
				
				$rows = array();
				$dbh = $this->construct();	
				$sth = $dbh->query($sql);
				
			while ($row = $sth->fetch(PDO::FETCH_OBJ)){
				array_push($rows, $row);
			}
			return $rows;
		}
		catch (PDOException $e)
		{
		$msg = $db.":";
		$msg .=  ("getMessage(): " . $e->getMessage() . "\n");
		return $msg;
		}
		
	}


	public function selectCenters()
	{
		$db = 'raffle_log'.$id;
		
		try
		{
	 $sql = '
	 	SELECT 
	 			`centers`.`id` as id,
	 			`centers`.`name` as name,
	 			`Q`.`sid` as sid,
	 			`Q`.`sname` as sname,
	 			`Q`.`sil` as sil,
	 			`Q`.`lname` as lname

	 	FROM
	 			`centers`
	 	LEFT JOIN 

			(SELECT 
					`states`.`id` as sid, 
					`states`.`name` as sname, 
					`local_governments`.`id` as sil, 
					`local_governments`.`name` as lname
			FROM 
					`states` 
			LEFT JOIN 
					`local_governments`  
			ON 
					`states`.`id` = `local_governments`.`state_id`
			) as Q
		ON 
				`centers`.`lga` = `Q`.sil
		'
		;
				
				$rows = array();
				$dbh = $this->construct();	
				$sth = $dbh->query($sql);
				
			while ($row = $sth->fetch(PDO::FETCH_OBJ)){
				array_push($rows, $row);
			}
			return $rows;
		}
		catch (PDOException $e)
		{
		$msg = $db.":";
		$msg .=  ("getMessage(): " . $e->getMessage() . "\n");
		return $msg;
		}
		
	}
	
	public function selectRaw($table = NULL, $columns  = NULL, $where  = NULL,  $orderby  = NULL, $groupby  = NULL)
	{
		$add = $where;
		$add .= parent::orderByClause($orderby);
		if(isset($columns))
			{
				$col = parent::columnChoice($columns);
			}
		else
			{
			$col = '*';	
			}
		try
		{
   $sql = 'SELECT '. $col .' FROM `'. $table .'` '.$add;
			
				$dbh = $this->construct();	
				$sth = $dbh->query($sql);
				
			while ($row = $sth->fetch(PDO::FETCH_OBJ))
			return $row;
		}
		catch (PDOException $e)
		{
		$msg = $db.":";
		$msg .=  ("getMessage(): " . $e->getMessage() . "\n");
		return $msg;
		}
		
	}
	public function selectRawAll($table = NULL, $columns  = NULL, $where  = NULL,  $orderby  = NULL, $groupby  = NULL)
	{
		$add = $where;
		$add .= parent::orderByClause($orderby);
		if(isset($columns))
			{
				$col = parent::columnChoice($columns);
			}
		else
			{
			$col = '*';	
			}
		try
		{
   $sql = 'SELECT '. $col .' FROM `'. $table .'` '.$add;
				$rows = array();
				$dbh = $this->construct();	
				$sth = $dbh->query($sql);
				
			while ($row = $sth->fetch(PDO::FETCH_OBJ)){
				array_push($rows, $row);
			}
			return $rows;
		}
		catch (PDOException $e)
		{
		$msg = $db.":";
		$msg .=  ("getMessage(): " . $e->getMessage() . "\n");
		return $msg;
		}
		
	}
	
	
	public function selectRawMain($columns = NULL, $state  = NULL, $lga = NULL,  $bank  = NULL)
	{
		$add = $where;
		$add .= parent::orderByClause($orderby);
		if(isset($columns))
			{
				$col = parent::columnChoice($columns);
			}
		else
			{
				$col = '*';	
			}
		$m = '';
		if(isset($state) && strlen($state) > 0)
		{
			if(strlen($m) > 0 )
			{
				$m .= ' AND '.$state;
			}
			else{
				$m .= ' '.$state;
			}
			
		}
		if(isset($lga) && strlen($lga) > 0)
		{
			if(strlen($m) > 0 )
			{
				$m .= ' AND '.$lga;
			}
			else
			{
				$m .= $lga;
			}
		}

		if(isset($bank) && strlen($bank) > 0)
		{
			if(strlen($m) > 0 )
			{
				$m .= ' AND '.$bank;
			}
			else
			{
				$m .= $bank;
			}
		}
		try
		{
   $sql = 'SELECT
    	 	'. $col .' 	 
    		FROM 
    			(
    			SELECT 
    				`centers`.`id` as `id`,
    				`centers`.`name` as `name`,
    				`centers`.`address` as `address`,
    				`centers`.`lga` as `lga`,
    				(SELECT `name` FROM `local_governments` WHERE `id` = `centers`.`lga` LIMIT 1) as `lganame`,
    				(SELECT `state_id` FROM `local_governments` WHERE `id` = `centers`.`lga` LIMIT 1) as `state`,
    				(SELECT `name` FROM `states` WHERE 
    						id = (SELECT `state_id` FROM `local_governments` WHERE id = `centers`.`lga` LIMIT 1) 
    					LIMIT 1) as `statename`,
    				`centers`.`bank` as `bank`,
    				(SELECT `name` FROM `banks` WHERE `id` = `centers`.`bank` LIMIT 1) as `bankname`,
    				`centers`.`account` as `account`
    				FROM centers
    			) as P
    			WHERE '.$m.'
    			';
    			
    		
				$rows = array();
				$dbh = $this->construct();	
				$sth = $dbh->query($sql);
				
			while ($row = $sth->fetch(PDO::FETCH_OBJ)){
				array_push($rows, $row);
			}
			return $rows;
		}
		catch (PDOException $e)
		{
		$msg = $db.":";
		$msg .=  ("getMessage(): " . $e->getMessage() . "\n");
		return $msg;
		}
		
	}
	
	
	
	public function select_json($table = NULL, $columns  = NULL, $where  = NULL,  $orderby  = NULL, $groupby  = NULL)
	{
		$add = parent::whereClause($where);
		$add .= parent::orderByClause($orderby);
		if(isset($columns))
			{
				$col = parent::columnChoice($columns);
			}
		else
			{
			$col = '*';	
			}
		try
		{
		$sql = 'SELECT '. $col .' FROM `'. $table .'` '.$add;
				
				//$rows = array();
				$dbh = $this->construct();	
				$sth = $dbh->query($sql);
				
			while ($row = $sth->fetch(PDO::FETCH_OBJ))
			//{
				//array_push($rows, $row);
			//}
			return $rows;
		}
		catch (PDOException $e)
		{
		$msg = $db.":";
		$msg .=  ("getMessage(): " . $e->getMessage() . "\n");
		return $msg;
		}
		
	}
	
	public function selectn($table = NULL, $columns  = NULL, $where  = NULL,  $orderby  = NULL, $groupby  = NULL)
	{
		$add = parent::whereClause($where);
		$add .= parent::orderByClause($orderby);
		if(isset($columns))
			{
				$col = parent::columnChoice($columns);
			}
		else
			{
			$col = '*';	
			}
		try
		{
		$sql = 'SELECT '. $col .' FROM `'. $table .'` '.$add;
				$rows = array();
				$dbh = $this->construct();	
				$sth = $dbh->query($sql);
				
			while ($row = $sth->fetch(PDO::FETCH_NUM)){
				array_push($rows, $row);
			}
			return $rows;
		}
		catch (PDOException $e)
		{
		$msg = $db.":";
		$msg .=  ("getMessage(): " . $e->getMessage() . "\n");
		return $msg;
		}
		
	}
		
	public function insert($table, $column)
	{
		$num = NULL;
		try
			{
				$key = $this->array_to_pdo_key($column);
				$place = $this->array_to_pdo_place($column);
				$val = $this->array_to_pdo_value($column);
				$queryData = array_values($column);
			    $detail = "INSERT INTO `". $table ."`  ". $key ."	VALUES   ". $place ."";
				$dbh = $this->construct();
				if (!($sth = $dbh->prepare($detail)))
					{
					print ("errorInfo: ". print_r($dbh->errorInfo()) . "\n");
					}
				elseif (!$sth->execute($queryData))
						{
						print ("errorInfo: " . print_r($dbh->errorInfo())  . "\n");
						}
					else{
						$num = $dbh->lastInsertId();
						}
					
					
			}
		catch (PDOException $e)
			{
				$num = ("The statement failed.\n");
				$num .= ("getCode: ". $e->getCode () . "\n");
				$num .= ("getMessage: ". $e->getMessage () . "\n");
			}
			return($num);
		}
		
	public function update($table, $column, $where)
	{
		$num = NULL;
		$add = parent::whereClause($where);
		try
			{
				
				$data = $this->array_to_pdo_params($column);
				$query = " UPDATE `". $table ."` SET ". $data ." ".$add;
				
				// Convert the data array to indexed and append the WHERE parameter(s) to it
				$queryData = array_values($column);
				$db =  $this->construct();
				$stmt = $db->prepare($query); // Obviously add the appropriate error handling
				$stmt->execute($queryData);
				if($stmt){$num = 1;}
					
			}
		catch (PDOException $e)
			{
				
				print ("The statement failed.\n");
				print ("getCode: ". $e->getCode () . "\n");
				print ("getMessage: ". $e->getMessage () . "\n");
			}
			return $num;
		}
		
	public function delete($table, $where)
	{
		$add = parent::whereClause($where);
		try
			{
				$dbh = $this->construct();
				$detail = "DELETE FROM `". $table ."`  ". $add ."";
				$dbh = $this->construct();
				$sth = $dbh->prepare($detail);
				$sth->execute ();
				return 1;
			}
		catch (PDOException $e)
			{
				print ("The statement failed.\n");
				print ("getCode: ". $e->getCode () . "\n");
				print ("getMessage: ". $e->getMessage () . "\n");
			}
		}
		
	public function convert_array($array)
	{
		$text = '[';
		foreach($array as $k => $v){
			$text .= '{';
			$text .= 'value:';
			$text .= '"'.$v[0].'"';
			$text .= ',';
			$text .= 'label:';
			$text .= '"'.$v[1].'"';
			$text .= '},';
			
			}
		$text = substr($text, 0, -1);
		$text .= ']';
		
		return $text;
	}
	
	public function getData($username, $password){
	$d = $this->selectOne('users', NULL, array('username'=>$username));
//print_r($d);
	if ($d->active == 0){
		
		//echo md5($password);
	if (md5($password) == $d->password){

				session_start();
				$_SESSION['a'] = array();
				$_SESSION['a']['username'] = $d->username;
				$_SESSION['a']['password'] = $d->password;
				$_SESSION['a']['id'] = $d->id;
				$_SESSION['a']['level'] = $d->level;
				$_SESSION['a']['rank'] = ucfirst(strtolower($d->rank));
				$_SESSION['a']["fullname"] = ucfirst(strtolower($d->fullname));  
				
				//qualification	:if no qualification set to null				
				if(isset($_SESSION['a'])){
					header ("Location: users.php");
				}
				else
				{
					header ("Location: ../login/index.html");
				}
	}
	else{
			header ("Location: ../login/index.html");
		}
	
	}else{
		$message = "Invalid Data"; header ("Location: ../login/index.html");
	} 
		
		}


	public function getS($username, $password){
	$d = $this->selectOne('students', NULL, array('username'=>$username));
	if (count($d) == 1){
		//print_r($d);
		$ph[] = $d->g1_phone1;
		$ph[] = $d->g1_phone2;
		$ph[] = $d->g2_phone1;
		$ph[] = $d->g2_phone2;
	if (strlen($password) >10 && in_array($password,$ph)){
				session_start();
				$_SESSION['a'] =array();
				
				$_SESSION['a']['id'] = $d->id;
$_SESSION['a']["fullname"] = ucfirst(strtolower($d->surname)).", ".ucfirst(strtolower($d->middlename))." ".ucfirst(strtolower($d->firstname));  
				$numb = $d->id * 12121212121212;
				//qualification	:if no qualification set to null				
				if(isset($_SESSION['a'])){
				header ("Location: ../students/report_student.php?id =".$numb);
					}
				else{
		header ("Location: ../index.php");
		
					}
	}
	else{
		header ("Location: ../index.php");
		}
	
	}else{ $message = "Invalid Data"; header ("Location: ../index.php?msg=".$message);} 
		
		}

	

	public function createLog($id)
	{
		$raf = 'raffle_log'.$id;
		$sql = 'CREATE TABLE IF NOT EXISTS `'.$raf.'` (
			  `id` int(20) PRIMARY KEY AUTO_INCREMENT,
			  `raffleID` int(10) NOT NULL,
			  `clientID` int(11) NOT NULL,
			  `centerID` int(10) NOT NULL,
			  `giftID` int(10) NOT NULL,
			  `winID` int(10)  NULL,
			  `playSms` int(5)  NULL,
			  `winSms` int(5)  NULL,
			  `logSms` int(5)  NULL,
			  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
			) ;';

		$dbh = $this->construct();	
		$sth = $dbh->query($sql);
	}

	public function createWin($id)
	{
		$raf = 'raffle_winner'.$id;
		$sql = 'CREATE TABLE IF NOT EXISTS `'.$raf.'` (
  				`id` int(200) PRIMARY KEY ,
 				 `logID` int(200) UNIQUE,
 				 `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
				) ;';

		$dbh = $this->construct();	
		$sth = $dbh->query($sql);
	}

	public function getStudentData($username, $password){
	$d = $this->selectOne('exam_students', NULL, array('matric'=>$username));
	if (count($d) == 1){
		
	if ($d->password = $password){
		//confirm students login
	$ip = $_SERVER['REMOTE_ADDR'];
	$host = $_SERVER['REMOTE_HOST']; 
	$lg = $this->selectOne('exam_login', NULL, array('studentID'=>$d->id)); 
	if(isset($lg))
	{
		//using the same system
		if($lg->hostIP ==  $ip && $lg->host == $host){

		return $msg = '<i class="label label-danger">You already have an active session or You did not properly Logout of the previous session. Kindly see the administrator</i>';
			header ("Location: ../../exam_login/index.php?msg=".$msg);	
		}
		else{
	return $msg = '<i class="label label-danger">You already have an active session or You did not properly Logout of the previous session. Kindly see the administrator</i>';
			header ("Location: ../../exam_login/index.php?msg=".$msg);
		}
		
	}
	else
	{
		$log_details = array('studentID' => $d->id, 'hostIP' => $ip, 'host' =>$host);
		$intg = $this->insert('exam_login', $log_details);
		
		if(ctype_digit($intg) && $intg > 0){

			$regis = true;
		}
		else{
	return $msg = '<i class="label label-danger">Login Registration Error. Kindly see the administrator</i>';
			header ("Location: ../../exam_login/index.php?msg=".$msg);
		}
		
	}
	
	
	if(isset($regis)){
				session_start();
				$_SESSION['a'] = array();
				$_SESSION['a']['id'] = $d->id;
$_SESSION['a']["fullname"] = ucfirst(strtolower($d->surname)).", ".ucfirst(strtolower($d->middlename))." ".ucfirst(strtolower($d->firstname));  
				$dn = $this->selectOne('datas', NULL, array('id'=>$d->department));
				$_SESSION['a']['dept'] = $dn->name;
				$pn = $this->selectOne('datas', NULL, array('id'=>$d->programme));
				
				$_SESSION['a']['prog'] = $pn->abbrv;	
				$_SESSION['a']['matric'] = $username;
				$_SESSION['a']['passport'] = $d->passport;
				$_SESSION['a']['ip'] = $ip;
				$_SESSION['a']['host'] = $host;			
				//qualification	:if no qualification set to null				
				
	}
	}
	else{
		return $message = "Invalid Data"; 
		header ("Location: index.html?msg=".$message);
		}
	
	}
	else{ 
	return $message = "Invalid Data"; header("Location: index.html?msg=".$message);} 
		
		}


	public function loadFile($type, $id, $place, $folder, $max , $replace = NULL, $extend = NULL ){
	$max_size = $max * 1024;
	$picture = array('png','gif','jpg','JPG', 'PNG', 'GIF', 'mp4', 'wma', '3gpp', 'flv');
	$document = array('pdf','doc','docx', 'png','gif','jpg');
	($type > 0)?$types = $picture: NULL;

	$f_name = $_FILES[$place]["name"];
	$f_size = $_FILES[$place]["size"];
	$f_exts = explode(".", $f_name);	
	$f_ext = end($f_exts);
	//Check extention
	if(file_exists($_FILES[$place]['tmp_name']) && is_file($_FILES[$place]['tmp_name'])){ 
		if(in_array($f_ext, $types) || $types[0] == 'ty'){
			//check size
			if($f_size < $max_size){
				//check if file exist
				$new_name = $id.$extend.".".$f_ext;
				$new_path = $folder.'/'.$new_name;
				if(file_exists($new_path))
				{
					if($replace == 1){
						$new_paths = $new_path;
						unset($new_path);
						$isMove = move_uploaded_file($_FILES[$place]['tmp_name'], $new_paths);
						}
					else{
						$isMove = true;
						}
					
				}
				else
				{
					$isMove = move_uploaded_file ($_FILES[$place]['tmp_name'], $new_path);
				}
				
			}
			else{
				$error ="Maximum Upload file size exceeded !!!";
				}
			
		}else{
			$error = 'Wrong Format!!!';
		}
		if(isset($isMove)){ return array(0, $folder.'/'.$new_name);}else{return array(1, $error);}
	}
	else{return array(1, 'No. File Uploaded');}
		}

		public function enrcode($a)
		{
			$st = str_split($a);
			$stnum = count($st);

			$f = array(1 =>'A', 2 =>'Z', 3 =>'D', 4 =>'X', 5 =>'F', 6 =>'T', 7 =>'G', 8 =>'R', 9 =>'I', 0 =>'P' );
			$f1 = array(1 =>'B', 2 =>'Y', 3 =>'C', 4 =>'W', 5 =>'E', 6 =>'U', 7 =>'H', 8 =>'S', 9 =>'J', 0 =>'Q' );
			$rest1 = $f[$st[$stnum - 1]];
			$rest2 = $f1[$st[$stnum - 2]];
			$st[$stnum - 1] = $rest1;
			$st[$stnum - 2] = $rest2;

			return implode("", $st);
		}
		public function dercode($a)
		{

		}

	
}




?>