<?php

$fileuser="pages/user.txt";
function ShowHeader($name, $bgcolor, $title)
{
echo "<html><head><title>".$title."</title><link rel='stylesheet' type='text/css' href='styles/style.css'></head>";
echo "<body bgcolor=".$bgcolor.">";
echo "<div class='header'>";
echo '<h1>'.$name.'</h1>';
echo "</div>";
}
function Register($name, $pass, $email)
{
  global $fileuser;
  if ( CheckForRepeat($fileuser , $name, $pass ) == 0 )
  {
  
  $file = fopen($fileuser, "a"); // "a" - append
  $line = $name.":".$pass.":".$email."\r\n";
  fputs($file, $line); //запись
  fclose($file);
  }
  
}


function configDB()
{
 $arr_conf = array (
 "host" => "localhost" ,
 "dbuser" => "root" ,
 "dbpass" => "" ,
 "dbname" => "countrycitylang"  
 );
 
 return $arr_conf ;
}


$host = "localhost" ;
$dbuser = "root" ;
$dbpass = "" ;
$dbname = "countrycitylang" ;

function connect()
{
 global $host ;
 global $dbuser ;
 global $dbpass ;
 global $dbname ;

   $link = mysql_connect($host, $dbuser, $dbpass);
   $err = mysql_errno(); // если ошибок нет то возвращает false
   if ( $err) 
   {
      echo "Error".$err."<br/>";
	  return false;
   }
   mysql_select_db($dbname); // вход в  свою личную базу данных
   //mysql_query("set names 'cp1251'"); // запрос о кодировке   
   return $link; // вернули указатель на созданное подключение к ®Ч
}
 

?> 





