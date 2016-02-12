<?php
include_once("region.php");
include_once("functions.php");


if ( $_POST['action'] == 'Delete' )             // Delete
 { 
  $Reg = new Region ( $_POST['name_table'] , $_POST['id']);	
  $err = $Reg->Del_one();
 
  if ( $err )
	{
	 echo "Error: ".$err ;
	} 
  else
   {
	 echo "Yes" ;
   }
 }                  
else if ( $_POST['action'] == 'Update' )       // Update       
 {
  $name = filter_var(trim($_POST['new_name_element']),FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);  
  
  if (!preg_match("#^[aA-zZ\s\-_]+$#",$name))
  {
    echo "Error: invalid name" ;
	exit();
  }
  
  
  $Reg = new Region ( $_POST['name_table'] , $_POST['id'] , $name  );	
  $err = $Reg->Update_one(); 	
  
  if ( $err )
	{
	 echo "Error: ".$err ;
	} 
  else
   { 	 
	 $res = $Reg->getOne(); 
	 
	 		while ($row = mysql_fetch_array($res)) {
				$i = "+" ;
		        echo	"<tr id='tr_".$row['id']."'>
				         <td>".$i."</td>
						 <td>".$row[1]."</td>             
				         <td><button type='button' class='btn btn-warning btn-upd' title='".$row[1]."' id='upd_".$row['id']."' data-toggle='modal' data-target='#myModal2'>Update</button></td>
						 <td><button type='button' class='btn btn-danger  btn-del' id='del_".$row['id']."'>Delete</button></td>
						 </tr>" ; 	 
				}
      
    } 
 }
else if ( $_POST['action'] == 'Add' )            // Add
 {
  $name = filter_var(trim($_POST['name_element']),FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);  
  
  if (!preg_match("#^[aA-zZ\s\-_]+$#",$name))
  {
    echo "Error: invalid name" ;
	exit();
  }  
  
  $Reg = new Region ( $_POST['name_table'] , 0 , $name);	
  $err = $Reg->Add_one();   
   
  if ( $err )
	{
	 echo "Error: ".$err ;
	} 
  else
   {
	 $res = $Reg->getOne(); 
	 
	 		while ($row = mysql_fetch_array($res)) {
				$i = "+" ;
		        echo	"<tr id='tr_".$row['id']."'>
				         <td>".$i."</td>
						 <td>".$row[1]."</td>             
				         <td><button type='button' class='btn btn-warning btn-upd' title='".$row[1]."' id='upd_".$row['id']."' data-toggle='modal' data-target='#myModal2'>Update</button></td>
						 <td><button type='button' class='btn btn-danger  btn-del' id='del_".$row['id']."'>Delete</button></td>
						 </tr>" ; 	 
				}
   
    }
 }
else if ( $_POST['action'] == 'getCities')
 {
  $db = connect(); 
  $sel = "SELECT c.* FROM city c INNER JOIN population p ON (c.id = p.id_city) WHERE p.id_country = '".$_POST['id_country']."' ORDER BY c.name_city" ;   // `name_country` = '".$_POST['id_country']."'" ;	 
  $res = mysql_query( $sel , $db ); 

  $err = mysql_errno();
   if ( $err )
	{
	 echo "Error: ".$err ;
	}	
   else
   {
	   echo '<option value="">Select City</option>' ;
	   while ($row = mysql_fetch_array($res))  
	   {
	   	  echo '<option value="'.$row['id'].'">'.$row['name_city'].'</option>';
	   };	   
   }     
 }
else if ( $_POST['action'] == 'getLaguage')
 {
	 $db = connect(); 
	 $sel = "SELECT l.name_lang FROM lang l INNER JOIN population p ON (l.id = p.id_lang) WHERE p.id_city = '".$_POST['id_city']."' LIMIT 1" ;   // `name_country` = '".$_POST['id_country']."'" ;	 
     $res = mysql_query( $sel , $db ); 
     $row = mysql_fetch_array($res);
	 
    $err = mysql_errno();
    if ( $err )
	 {
	   echo "Error: ".$err ;
	 }	
     else
     {	 
	   echo $row['name_lang'] ;
	 }  
 }

?>




