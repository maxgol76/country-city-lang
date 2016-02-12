
<?php
 
include_once("functions.php");

$db = connect();

$res = mysql_query('SELECT * FROM country' , $db);

$err = mysql_errno();
 if ( $err )
	{
	 echo "Error: ".$err ;
	} 
?> 

<select id="select_country" name="country" class="form-control" onchange="javascript:getCities();">
  <option value="">Select Country</option>
  <?php  
  while ($row = mysql_fetch_array($res))  {  
  ?>      
  <option value="<?php echo $row['id'];?>"><?php echo $row['name_country'];?></option> 
  <?php }; ?>
</select>  


<select id="select_city" name="city" class="form-control" onchange="javascript:getLaguage();" >
  <option value="">City</option>  
</select>

<h3 class="label-def">Language: <span class="label label-default" id="label_lang">Indefined</span></h3>

<br/><br/>

<script type="text/javascript">

 function getCities(){
        var id_country = $('select[name="country"]').val();
        //alert(id_country);
		
		if(!id_country){                
				$('select[name="city"]').html('<option value="">City</option>');				
                $('#label_lang').html('Indefined');
        }else{
                $.ajax({
                        url: "pages/actions.php",
						type: 'POST',
                        data: { action: 'getCities', id_country: id_country },
                        //cache: false,
                        success: function(data){
							$('select[name="city"]').html(data); 
							}
                });
           };
        };
		
  function getLaguage(){
        var id_city = $('select[name="city"]').val();
        //alert(id_city);
		
		if(!id_city){                								
                $('#label_lang').html('Indefined');
        }else{
                $.ajax({
                        url: "pages/actions.php",
						type: 'POST',
                        data: { action: 'getLaguage', id_city: id_city },
                        //cache: false,
                        success: function(data){
							$('#label_lang').html(data); 
							}
                }); 
           };
        };		

</script>


<?php
/*
if(!isset($_REQUEST['send'])) // если кнопка send еще не нажималась
{
?>
<br/>
<div>Выбрать файл для отправки на сервер:</div>
<br/>
<form action="index.php?id=2" method="POST" enctype="multipart/form-data"  > 
<input type="file" name="fname" size="20" />

<input type="submit" name="send" value="  Send  " /><br/>
</form>
<?php
}
else
{
   // долител ли файл до сервера
   if ( is_uploaded_file($_FILES['fname']['tmp_name']))
   {
    move_uploaded_file($_FILES['fname']['tmp_name'], "./images/".$_FILES['fname']['name'] ); // если долител то переместить его в папку /images
   }

}
*/
?>




