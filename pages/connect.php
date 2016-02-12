
<?php

class DBm { 

private	$host ;
private $dbuser ;
private $dbpass ;
private $dbname ;
private $link ;

public function __construct ($host, $dbuser, $dbpass, $dbname)
{
	$this->host = $host ;
	$this->dbuser = $dbuser ;
	$this->dbpass = $dbpass ;
	$this->dbname = $dbname ;
	$this->connect();		
}

private function connect()
{   
   $this->link = mysql_connect($this->host, $this->dbuser, $this->dbpass);
   $err = mysql_errno(); 
   if ( $err) 
   {
      echo "Error: ".$err."<br/>";
	  exit();
   }
   	
   if (!mysql_select_db($this->dbname , $this->link)) {
			throw new \Exception('Error: Could not connect to database ' . $dbname);
	   }
	mysql_query("SET NAMES 'utf8'", $this->link);   
		mysql_query("SET CHARACTER SET utf8",  $this->link);
		mysql_query("SET CHARACTER_SET_CONNECTION=utf8",  $this->link);
		mysql_query("SET SQL_MODE = ''",  $this->link);
} 

public function selectAll( $table )
{
	$sel = "SELECT * FROM `".$table."`" ;
	$res = mysql_query( $sel , $this->link );
	return $res ;
}

 
public function select_one( $table , $new_name )
{
	$sel = "SELECT * FROM $table WHERE name_$table = '$new_name'" ;	 
	$res = mysql_query( $sel , $this->link );
	return $res ;
}

public function delete_one( $table , $id )
{
	mysql_query("DELETE FROM $table WHERE `id` = $id", $this->link) ;
	$err = mysql_errno();
	return $err ;
} 
                          
public function update_one ( $table , $id , $new_name )
{
	 $upd = "UPDATE $table SET name_$table = '$new_name' WHERE `id` = $id" ;  
     mysql_query($upd, $this->link) ;
	 $err = mysql_errno();
	 return $err ;
} 
	
	
public function insert_one ( $table , $new_name )
{
	 $ins = "INSERT INTO $table (`name_$table`) VALUES('$new_name')" ; 
     mysql_query($ins, $this->link) ;
	 $err = mysql_errno();
	 return $err ;
} 
	
	
}



?>




