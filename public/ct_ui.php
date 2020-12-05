<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        html,body {
            background-color: white;
            height:100%;
            
            margin: 0;
            padding: 0;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;

        }
        body {
            display:flex;
        }
    </style>
<script>
    function validateForm() {
        var x = document.forms["new_user_form"]["new_user"].value;
        if (x == "") {
            alert("Name must be filled out");
            return false;
        }
    }
</script>

<?php
		include "../backend.php";
        $dbfile='../test.sqlite'; 
        ####################################################
        # create database connection
        $db = new PDO("sqlite:$dbfile");
		$table = "images";
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$users = list_distinct_users($pdo=$db,$table_name=$table);
?>
</head>
<body>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label>Select User: </label>
		<select name="user_name" id="users">
			<?php
				foreach($users as $u):
					echo "<html>
					<option value=$u[0]>$u[0]</option>
					</html>
					";
				endforeach;
				echo "</select>";
			?>
		


		  <!-- Trigger the modal with a button -->
		  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Add User</button><br></br>

        <label>retrieve previous results?</label>
        <input type="checkbox" id="retrieve" name="previous_results"><br><br>
        <input type='file' id="image" name="myfile" required/>
		
        <input type="submit" value="submit" name="submit">
    </form>

    
    
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <form name="new_user_form" action="" onsubmit="return validateForm()">
            <div class="modal-dialog">
            <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add New User</h4>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="new_user" id="new_user" min=4>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-default" value="Add User">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>      
                </div>          
            </div>
        </form>  
    </div>
    
        
<script>
    var chbox = document.getElementById("retrieve");
    chbox.addEventListener("click",function(event){

        if(chbox.checked){
            document.getElementById("image").required = false;
        } else{
            document.getElementById("image").required = true;
        }
       
    })

</script>
</body>
</html>