<?php

$connect = mysqli_connect("localhost", "root", "", "authentication");
$output = '';
if(isset($_POST["export_excel"]))
{
  $sql = "SELECT * FROM users ORDER BY id";
  $result = mysqli_query($connect, $sql);
  if(mysqli_num_rows($result)> 0)
  {
    $output .= '
        <table class="table" bordered="1">
          <tr>
      <th>id</th>
      <th>program</th>
      <th>levelofprog</th>
      <th>natureofprog</th>
			<th>name</th>
			<th>surname</th>
			<th>state_of_origin</th>
			<th>l.g.a</th>
      <th>nationality</th>
	  <th>date_of_birth</th>
      <th>username</th>
      <th>email</th>
      <th>phone</th>
      </tr>
      ';
    while($row = mysqli_fetch_array($result))
    {
      $output .= '
        <tr>
          <td>'.$row["id"].'</td>
          <td>'.$row["program"].'</td>
          <td>'.$row["levelofprog"].'</td>
          <td>'.$row["natureofprog"].'</td>
		  <td>'.$row["fname"].'</td>
		  <td>'.$row["surname"].'</td>
		  <td>'.$row["state"].'</td>
		  <td>'.$row["lga"].'</td>
      	  <td>'.$row["nationality"].'</td>
	      <td>'.$row["date_of_birth"].'</td>
          <td>'.$row["username"].'</td>
          <td>'.$row["email"].'</td>
          <td>'.$row["phone"].'</td>
      ';
    }
    $output .= '</table>';
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=download.xls");
    echo $output;
  }
}





 ?>
