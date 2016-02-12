
<?php
 
//include_once("functions.php");
//include_once("connect.php");
include_once("region.php");

?>

<br/>

<div>
<button type="button" class="btn btn-success btn-sm" id="btnCountry">Country</button>
<button type="button" class="btn btn-success btn-sm" id="btnCity">City</button>
<button type="button" class="btn btn-success btn-sm" id="btnLanguage">Language</button>
</div>

<script type="text/javascript">
			$(document).ready(function() {				

				$('#btnCountry').click(function () {
					location.href = "index.php?id=11"; 
					return false;
				});
				
				$('#btnCity').click(function () {
					location.href = "index.php?id=12"; 
					return false;
				});
				
				$('#btnLanguage').click(function () {
					location.href = "index.php?id=13"; 
					return false;
				});
				
			});				

</script>

<br/>

<?php

 $getid = $_GET['id'];
  
  if ($getid==11)
  {
	$Name_table = 'country' ;	  
	$Name = ' Country ' ;	
  }	  
 else if ($getid==12)
 {
	$Name_table = 'city' ;  
	$Name = ' City ' ;
 }
 else if ($getid==13)
 {
	$Name_table = 'lang';  
	$Name = ' Language ' ;
 } 
 
if (isset($Name_table)) 
 {
	$Reg = new Region ($Name_table); // создание объекта
	$res = $Reg->getAll(); // выбока всех элементов таблицы

?>
    <div id="alert-msg1"></div>

    <table class="table table-hover" id="tab1" title="<?php echo $Name_table; ?>">
			<caption class="title_tab"><h3 id="name_list"><?php echo $Name; ?>list</h3></caption>
			<thead>
			<tr>
				<th></th>
				<th>Name</th>				
				<th></th>
				<th></th>
			</tr>
			</thead>
			<tbody id="tbod" >
			<?php $i=0;   
			while ($row = mysql_fetch_array($res)) {  ?>    
				<tr id="tr_<?php echo $row['id'];?>">
					<td><?php echo ++$i; ?></td>
					<td><?php echo $row[1]; ?></td>					
					<td><button type="button" class="btn btn-warning btn-upd" title="<?php echo $row[1]; ?>" id="upd_<?php echo $row['id'];?>" data-toggle="modal" data-target="#myModal2">Update</button></td>
					<td><button type="button" class="btn btn-danger  btn-del" id="del_<?php echo $row['id'];?>">Delete</button></td>
				</tr>
			<?php }; ?>
			</tbody>
		</table>
          
		
		<br/>
		<br/>
		
		<div>
		<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">Add <?php echo $Name; ?></button>
        </div>		
		
		<br/>
		
		<!-- modal form1 for Add -->
		<div id="myModal" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					
					<form action="pages/actions.php?id=2" method="POST"  > 

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button>
						<h4 class="modal-title">Add <?php echo $Name; ?></h4>
					</div>
					<br/>
					<div class="modal-body" id="myModalBody">

						<div class="form-group">
							<label for="title">Input <?php echo $Name; ?> Name</label>
							<br/>
							<br/>
							<input class="form-control" id="name_input_add" name="name" placeholder="New <?php echo $Name; ?> Name" type="text" value="" />
						</div>						

						<div id="alert-msg2"></div>
					</div>
					<br/>
					<div class="modal-footer">
						<input class="btn btn-default" id="submit_add" name="submit" type="button" value=" Add " />
						<input class="btn btn-default" id="close1"  type="button" data-dismiss="modal" value="Close" />
					</div>
					</form>
				</div>
			</div>
		</div>
		
		<!-- modal form2 for Update -->
		<div id="myModal2" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					
					<form action="pages/actions.php?id=2" method="POST"  > 

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button>
						<h4 class="modal-title" id="modal_t">Update <?php echo $Name; ?></h4>
					</div>
					<br/>
					<div class="modal-body" id="myModalBody1">

						<div class="form-group">
							<label for="title id="upd_name">Input New <?php echo $Name; ?> Name</label>
							<br/>
							<br/>
							<input class="form-control" id="name_input" name="name" placeholder="New <?php echo $Name; ?> Name" type="text" value="" />
						</div>						

						<div id="alert-msg3"></div>
					</div>
					<br/>
					<div class="modal-footer">
						<input class="btn btn-default" id="submit_update" name="submit" type="button" value="Update" />
						<input class="btn btn-default" id="close2"  type="button" data-dismiss="modal" value="Close" />
					</div>
					</form>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
			$(document).ready(function() {
				
			$("body").on("click", "#tbod .btn-del", function(e) {                                          //“даление элемента объекта
                    e.preventDefault();
					var data_id = this.id.substr(4);					
					var name_table = $('#tab1').attr("title");
					//alert (name_table);
					
					$.ajax({
						url: "pages/actions.php",
						type: 'POST',						
						data: {
							   action: 'Delete' , 
							   name_table: name_table , 
							   id: data_id 
							   },
						success: function(msg) {
						
						if (msg.indexOf('Error')!=-1)
						{								
							$('#alert-msg1').html('<div class="alert alert-danger">' + msg + '</div>');							
						}
						else 
						{
							$('#tr_'+data_id).fadeOut("slow");
						}					
						
					}
					});
					return false;
				});		
								
				$("body").on("click", "#tbod .btn-upd", function(e) {                                        //Ћбновление элемента объекта
                    e.preventDefault();
					data_id = this.id.substr(4);									
					name_table = $('#tab1').attr("title");
					name_element = this.title ;  
										
					$('#modal_t').text("Update "+name_element);	
					$('#name_input').attr("placeholder", name_element);					
				});
				
				 $('#submit_update').click(function () {				
										
					$.ajax({
						url: "pages/actions.php",
						type: 'POST',						        
						data: {
							    action: 'Update' , 
								name_table: name_table , 
							    new_name_element: $('#name_input').val() , 
								id: data_id 
							  },
						success: function (msg) {
							if (msg.indexOf('Error')!=-1)
							{								
								$('#alert-msg3').html('<div class="alert alert-danger">' + msg + '</div>');								
							}
							else
							{								
								$('#alert-msg3').html('<div class="alert alert-success text-center"> "'+$('#name_input').val()+'" has been update successfully!</div>');							    
								$("#tbod").append(msg);
								$('#tr_'+data_id).fadeOut("slow");
							}
						}
					}); 
					return false;
				});


                  $('#submit_add').click(function () {					                                         //„обавление элемента объекта
					
					var name_table = $('#tab1').attr("title");
					//alert ($('#name_input_add').val());
					$.ajax({
						url: "pages/actions.php",
						type: 'POST',
						data: {
							    action: 'Add' , 
								name_table: name_table ,
							    name_element: $('#name_input_add').val()							  
							  },
						success: function (msg) {
							if (msg.indexOf('Error')!=-1)
							{								
								$('#alert-msg2').html('<div class="alert alert-danger">' + msg + '</div>');								
							}
							else
							{
								$('#alert-msg2').html('<div class="alert alert-success text-center"> "'+$('#name_input_add').val()+'" has been save successfully!</div>');							    
								$("#tbod").append(msg);
							}
						}
					});
					return false;
				});		

				
			});


		</script>
	
<?php } ?>	









