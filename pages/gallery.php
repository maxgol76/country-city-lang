<form action="index.php?id=3" method="POST" >
<br/>
<div>Выбрать тип рисунков:</div>
<br/>
<select name = "choice">

<?php

$path = "images";
if ( $dir = opendir($path)) // открывает директорию
{
  $ar = array();
  while( ($file = readdir($dir)) !== false) //тождественное неравенство на "false" 
  {
    $fullname = $path."/".$file ;
	$ext = strrpos($fullname, ".");
	$ext = substr($fullname, $ext);
	if ($ext == ".jpg" || $ext == ".bmp" || $ext == ".png" || $ext == ".psd" || $ext == ".gif")
	{
	  $flag = 0 ;
	  for($i=0; $i<count($ar) ; $i++)
       {
         if($ext == $ar[$i])
		 {
		   $flag = 100;
		   break;
		 }
	   }	  
	   if($flag==0)
	   {
	     $ar[]=$ext;
	     echo "<option valu='".$ext."'>"."*".$ext."</option> ";
	   }
	   
	}
  }
  closedir($dir);
  
}


?>
</select>

<input type="submit" name="show" value="  Ok  " />
</form>

<?php
if(isset($_REQUEST['show']))
{
  $ext = $_REQUEST['choice'];
  $ar = glob($path."/*".$ext);
  echo "<div class = 'gallery'>";
  foreach( $ar as $a)
  {
    echo "<a href='".$a."' target='_blank'>	<img src='".$a."' height='100px' /> </a>";  
  }	
  echo "</div>";
}

?>







