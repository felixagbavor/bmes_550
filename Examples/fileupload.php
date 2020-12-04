<?php
# Paul DeSantis
# BMES 550 Fall 2020

print_r($_REQUEST);
print_r($_FILES);

#if user has submitted something
if((isset($_REQUEST['myfile']) || $_REQUEST['submit']==1) && !empty($_REQUEST['myfile'])){	
	# display submission:
		echo "<b>Name: </b>".$_REQUEST['myfile']."<br>";

		echo "<b>Size: </b>".filesize($_REQUEST['myfile']).' bytes'."<br>";

		# print first line of file, ignoring HTML characters
		$line = file($_REQUEST['myfile']);
		echo "<b>First line: </b>";
		echo htmlspecialchars($line[0]);
		echo "<br>";
}	


#if form has not been submitted before
if(!isset($_REQUEST['myfile']) || $_REQUEST['submit']==1 || empty($_REQUEST['myfile'])){
	if((isset($_REQUEST['myfile']) || $_REQUEST['submit']==1) && empty($_REQUEST['myfile'])){
		echo "<p style='color:red'><b>Error: You must upload a file.</b></p>";
	}

# HTML form: 
# endtype
?>
<html>
<body>
<form method="POST">
	<table>
		<tr>		
			<td><input type="file" name="myfile"></td>
			<td><input type="submit" name="submit" value="Submit"></td>
		</tr>
	</table>
</form>
</body>
</html>
<?
}
?>