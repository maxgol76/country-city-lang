<?php
 
include_once("functions.php");
include_once("connect.php");

class Region {                      // класс для объектов 'Country', 'City' и 'Lang'

private	$table ;
private $id ;
private $name ;
private $new_name ;
private $DB ;

public function __construct ($table , $id = 0 , $name = '')
{
	$this->table = $table ;
	$this->id = $id ;
	$this->name = $name;  
	
    $db = configDB() ;
    $this->DB = new DBm( $db['host'] , $db['dbuser'] , $db['dbpass'] , $db['dbname'] ); // создаем соединение	
}

public function getAll()
{   
   $res = $this->DB->selectAll($this->table ) ;
   return $res ;
} 	

public function getOne()
{   
   $res = $this->DB->select_one($this->table , $this->name ) ;
   return $res ;
}

public function Update_one()
{                         
   $res = $this->DB->update_one( $this->table , $this->id , $this->name ) ;
   return $res ;
} 	

public function Add_one()
{                           
   $res = $this->DB->insert_one( $this->table , $this->name ) ;
   return $res ;
} 	

public function Del_one()
{   
   $err = $this->DB->delete_one($this->table , $this->id ) ;
   return $err ;
} 	

	
}	




?>




