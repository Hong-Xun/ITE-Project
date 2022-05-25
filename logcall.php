<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Police Emergency Service System</title>
<link rel="stylesheet" href="pessdbstyle.css">
</head>

<body>
<script>
function hongxunpess()
	{
		var x=document.forms["frmLogCall"]
		["callerName"].value;
		if (x==null || x=="")
			{
				alert("Caller Name is required.");
				return false;
			}
	}
</script>
<?php require_once 'nav.php';
	?>
	<?php require_once 'db.php';
	
	$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
	if($conn->connect_error) {
		die("Connection failed: ". $conn->connect_error);
	}
$sql = "SELECT * FROM incidenttype";

$result = $conn-> query($sql);
	if ($result->num_rows > 0) {
		while ($row = $result-> fetch_assoc()) {
			$incidentType[$row['incidentTypeId']] = $row['incidentTypeDesc'];
		}
	}
$conn->close();
	?>
	<strong>LAST UPDATE AT:</strong><br>
	<div id="current_date"></p>
    <script>document.getElementById("current_date").innerHTML = Date();</script><br><br>
	<fieldset>
	<legend>Log Call</legend>
		<form name="frmLogCall" method="post" action="dispatch.php" onSubmit="return hongxunpess();">
		<table width="45%" border="1" align="center" cellpadding="5" cellspacing="2">
		<tr>
		<td width="20%" align="center">Name of Caller:</td>
			<td width="50%"><input type="text" name="callerName" id="callername" pattern="[A -z]+" required ></td>
			</tr>
			<tr>
				<td width="20%" align="center">Contact Number:</td>
				<td width="50%"><input type ="text" name="contactNo" id="contactNo" pattern="[0-9]+" minlength="8" maxlength="8" required ></td>
			</tr>
			<tr>
			<td width="50%" align="center">Location:</td>
				<td width="50%"><input type="text" name="location" id="location" required> </td>
			</tr>
			<tr>
			<td width="50%" align="center">Incident Type:</td>
				<td width="50%"><select name="incidentType" id="incidentType" required >
					<?php foreach($incidentType as $key=> $value) {?>
					<option value="<?php echo $key ?> " ><?php echo $value?> </option> <?php } ?>
					</select>
					</td>
			</tr>
			<tr>
			<td width="50%" align="center">Description:</td>
			<td width="50%"><textarea name="incidentDesc" id="incidentDesc" cols="45" rows="5" maxlength="300" required></textarea></td>
			</tr>
			<tr>
				<table width="40%" border="0" align="center" cellpadding="5" cellspacing="5">
					<td align="center">
					<input type="reset" name="cancelProcess" id="cancelProcess" value="Reset"
					</td>
					<td align="center">
					<input type='submit' name="btnProcessCall" id="btnProcessCall" value="Process Call"
					</td>
				</table>
			</tr>
			</table>
		</form>
	</fieldset>
</body>
</html>