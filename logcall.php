<!DOCTYPE HTML>
<html>
<head>
<title>Log Call</title>
<Script>

function validateForm() {
  var callerName = document.forms["frmLogCall"]["callerName"].value;
  var ContactNo =document.forms["frmLogCall"]["ContactNo"].value;
  var Location =document.forms["frmLogCall"]["Location"].value;
  var incidentDesc =document.forms["frmLogCall"]["incidentDesc"].value;
 
  if (callerName == "") {
    alert("Name must be filled out");
    return false;
  }
  
  else if (!isNaN){
	  alert("Name must be in Alplabet!");
	  return false;
  }
  
  if (ContactNo == "") {
    alert("Number must be filled out");
    return false; 
  }
	
  else if (!isNaN){
	  alert("");
	  return false;
  }
	  
  if (Location == "") {
    alert("Location must be filled out");
    return false; 
  }	
  
  if (incidentDesc == "") {
    alert("Description must be filled out");
    return false; 
  }
  
}

</Script>

<?php
	include 'navigation.php';
	
	if(isset($_POST['submit']))
	{
		$con = mysql_connect("localhost","pess_tianxi","password");
		if(!$con)
		{
			die('Cannot connect to database: '. mysql_error());
		}
 
		mysql_select_db("32_tianxi_pessdb",$con);

		$sql= "INSERT INTO incident (callerName, phoneNumber ,incidentTypeId,incidentLocation, incidentDesc ,incidentStatusId) VALUES('$_POST[callerName]','$_POST[ContactNo]','$_POST[incidenttype]','$_POST[Location]','$_POST[incidentDesc]', '1')";
		
		
		if(!mysql_query($sql,$con))
		{
				die('Error:' .mysql_error());
		}
		
		mysql_close($con);
	}
?>
</head>

<body>

	<?php
	
		$con = mysql_connect("localhost","pess_tianxi","password");
		if(!$con)
		{
			die("Cannot connect to database: ". mysql_error());
		}
 
		mysql_select_db("32_tianxi_pessdb",$con);

		$result = mysql_query("SELECT * FROM incidenttype");
	
		$incidenttype;

		while($row = mysql_fetch_array($result))
			$incidenttype[$row['incidentTypeId']] = $row['incidentTypeDesc'];
	
		mysql_close($con);
	?>
	
<fieldset>
<legend>Log Call</legend>
<form name="frmLogCall"  onsubmit="return validateForm()" method="POST" action="dispatch.php">	

<table>
	<tr>
		<td>Caller Name:</td>
		<td><p><input type="text" name="callerName"/></p></td>
	</tr>
	<tr>
		<td>Contact No:</td>
		<td><p><input type="text" name="ContactNo"/></p></td>
	</tr>
	<tr>
		<td>Location:</td>
		<td><p><input type="text" name="Location"/></p></td>
	</tr>
	<tr>
		<td align="right" class="td_label">Incident type:</td>
		<td class="td_Data">
			<p>
			<select name="incidenttype" id="incidenttype">
				<?php foreach($incidenttype as $key => $value){ ?>
					<option value="<?php echo $key?>"><?php echo $value ?></option>
				<?php } ?>
			</select>
			</p>
		</td>
	</tr>
	<tr>
		<td>Description :</td>
		<td><p><textarea name="incidentDesc" rows="5" cols="50"></textarea><p></td>
	</tr>
	<tr>
	<td><input type="Reset" value="Reset"></td>
	</tr>
	<tr>
	<td><br><input type="submit" value="Process Call" name="submit"></td>
	</tr>
</table>
</form>
</fieldset>
</body>
</html>