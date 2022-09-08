<?php
require_once('connect.php');

class Raffle extends DB{

	public function selectRaffle($week  = NULL)
	{
		
		try
		{
		$sql = 'SELECT
					`mandates`.`id` as id,
					`mandates`.`fullname` as name,
					`mandates`.`passport` as passport,
					`raffles`.`id` as rid,
					`raffles`.`raffle_start` as raffle_start,
					`raffles`.`raffle_end` as raffle_end,
					`raffles`.`gifts` as gifts
				 FROM 
				 	`mandates` 
				 LEFT JOIN
				 	`raffles`
				 ON
				 	`mandates`.`id` = `raffles`.`mandateID`
				 	ORDER BY `raffles`.`raffle_end` desc
				 #WHERE
				 	#`raffles`.`raffle_end` > CURDATE()
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
	
	
}




?>