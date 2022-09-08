<?php
require_once('connect.php');

class Utilities{
			

	public function prove($d = NULL, $n = null)
	{
		if(isset($n) && $n > 0 && isset($d) )
		{
			if($n == 1)
			{
				//text
				return array(1, $d);

			}
			elseif($n == 2)
			{
				//number
				return array(1, $d);

			}
			elseif($n == 3)
			{
				//phone
				return array(1, $d);

			}
			elseif($n == 4)
			{
				//password
				return array(1, $d);

			}
			elseif($n == 5)
			{
				//email
				return array(1, $d);

			}
			elseif($n == 6)
			{
				//date
				return array(1, $d);

			}
			else
			{
				return array(0, $d);
			}

		}
		else
		{
			return array(0, $d);
		}
		
	}
	public function generatePassword()
	{
		//generate password
		$b ='';
		$alp = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',1,2,3,4,5,6,7,8,9,0);
		shuffle($alp);
		shuffle($alp);
		shuffle($alp);
		shuffle($alp);
		$output = array_slice($alp, 5, 5);
		$passwd = '';
			foreach($output as $j){
				$passwd .= $j;
			}

			$arr[] = $passwd;
			$arr[] = md5($passwd);
			return $arr;
	}


	
}




?>