<?php 
include 'navigation.php';
if(!isset($_POST["btnSearch"])){

?>


<!-- create a form to search for patrol car based on id -->

<form name="form1" method ="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">

<table width ="80%" border="0" align="center" cellpadding="4" cellspacing="4">

<tr>

	<td width="25%" class="td_lable">Patrol Car ID: </td>

	<td width="25%" class="td_Data"><input type="text" name="patrolCarId" id="patrolCarId"></td>

	<!-- must validate for no empty entry at the Client side-->

	<td class="td_Data"><input type="submit" name="btnSearch" id="btnSearch" value="Search"></td>

</tr>
</table>
</form>


<?php 
} else {
	//echo $_POST["patrolCarId"];
	//retrieve patrol car status and patrolcarstatus
	//connect to a database
	$con = mysql_connect("localhost","pess_tianxi","password");
		if(!$con)
		{
			die('Cannot connect to database: '. mysql_error());
		}
	//select a table in the database
	mysql_select_db("32_tianxi_pessdb",$con);
	//retrieve patrol car status
	$sql = "SELECT * FROM patrolcar WHERE patrolcarId='".$_POST['patrolCarId']."'";
	$result = mysql_query($sql,$con);
	
	$patrolCarId;
	
	$patrolCarStatusId;
	
	while($row = mysql_fetch_array($result))
	{
		//patrolcarId,patrolcarStatusId
		
		$patrolCarId = $row['patrolcarId'];
		$patrolCarStatusId = $row['patrolcarStatusId'];
	}
	
	
	//retrieve patrolcarstatus master table 
	$sql ="SELECT * FROM patrolcar_status";
	
	$result = mysql_query($sql,$con);
	
	$patrolCarStatusMaster;
	
	while($row = mysql_fetch_array($result))
	{
		//statusId, statusDesc
		//create an associative array of patrol car status master type
		
		$patrolCarStatusMaster[$row['statusId']] =$row['StatusDesc'];
	
	}
	
	mysql_close($con);

	
?>


	<form name ="form2"  method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">

	<table width="80%" border="0" align="center" cellpadding="4" cellspacing="4">

	<tr>
		<td width="25%" class="td_lable">Patrol Car ID:</td>
		<td width="25%" class="td_Data"><?php echo $_POST["patrolCarId"]?></td>
	</tr>

	<tr>
		<td width="25%" class="td_lable">ID:</td>
		<td width="25%" class="td_Data"><?php echo$_POST["patrolCarId"]?>
		<input type="hidden" name="patrolCarId" id="patrolCarId" value="<?php echo $_POST["patrolCarId"]?>">
		</td>
	</tr>

	<tr>
		<td class="td_lable">Status:</td>
		<td class="td_Data"><select name="patrolCarStatus" id="$patrolCarStatus">


	<?php foreach($patrolCarStatusMaster as $key => $value){ ?>
			
			<option value="<?php echo $key ?>"
			<?php if($key==$row['patrolCarStatusId']) {?> selected="selected"
			<?php } ?>>
			<?php echo $value ?>
			</option>
	<?php } ?>
	
	</select></td>
	</tr>

	</table>
	<br/>
	<table width="80%" border="0" align="center" cellpadding="4" cellspacing="4">
		<tr>
			<td width="46%" class="td_Data"><input type="reset" name="btnCancel" id="btnCancel" value="Reset"></td>
		
			<td width="54%" class="td_Data">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="btnUpdate" id="btnUpdate" value="Update"></td>
		</tr>
	</table>
	</form>
<?php } ?>

<?php 

if(isset($_POST["btnUpdate"])){
	//retrive patrol car status and patrolcarstatus, need to connect to server/ database
	$con = mysql_connect("localhost","pess_tianxi","password");
	
	if(!$con){
		die('Cannot connect to database:'.mysql_error());
	}
	mysql_select_db("32_tianxi_pessdb",$con);
	
	
	$sql="UPDATE patrolcar SET patrolcarStatusId='".$_POST["patrolCarStatus"]."' WHERE patrolcarId='".$_POST['patrolCarId']."'";
	
	if(!mysql_query($sql,$con)){
		die('Error4:'.mysql_error());
	}


	if($_POST["patrolCarStatus"]=='4'){
		$sql = "UPDATE dispatch SET timeArrived=NOW() WHERE timeArrived is NULL AND patrolcarId='".$_POST["patrolCarId"]."'";

		if(!mysql_query($sql,$con)){
			die('ERROR4:'.mysql_error());
		}
	}

else if($_POST["patrolCarStatus"]=='3'){
	// else if patrol car status is free then capture the time of completion
	$sql= "SELECT incidentId FROM dispatch WHERE timeCompleted IS NULL AND patrolcarId='".$_POST["patrolCarId"]."'";
	
	$result= mysql_query($sql,$con);
	
	$incidentId;
	
	while($row = mysql_fetch_array($result)){
		$incidentId = $row['incidentId'];
	}
	//echo $incidentId
	
	$sql="UPDATE dispatch SET timeCompleted=NOW() WHERE timeCompleted is NULL AND patrolcarId='".$_POST["patrolCarId"]."'";
	
	if(!mysql_query($sql,$con))
	{
		die('Error4:'.mysql_eror());
	}

$sql="UPDATE incident SET incidentStatusId='3' WHERE incidentId='$incidentId' 
AND incidentId NOT IN (SELECT incidentId FROM dispatch WHERE timeCompleted IS NULL)";

if(!mysql_query($sql,$con)){
	die('Error5:'.mysql_error());
}
}
mysql_close($con);

?>

<script type="text/javascript">windown.location="./logcall.php";</script>
<?php }	?>