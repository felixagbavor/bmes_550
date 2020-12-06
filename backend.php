<?php
# Matthew Falcione

# TODO: find BMES tempdir using php
$dbfile=__DIR__.'/test.sqlite'; # if you are using a large database file (> 10 MB), please keep it elsewhere on your computer.

# create processed image directory if missing
if (!file_exists('Processed_Files/')) {
    mkdir('Processed_Files/');
}

####################################################
# create database connection
$db = new PDO("sqlite:$dbfile");
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

# create database table if it does not already exist
function create_db_table_if_not_exist($pdo, $table_to_create){
    $pdo->exec("CREATE TABLE IF NOT EXISTS '$table_to_create' (
        user VARCHAR(30),
        file_id VARCHAR(50),
        upload_datetime TEXT,
        PRIMARY KEY (user, file_id)
    )");
}

//  adds entry to table
function add_entry_to_table($pdo, $table_name, $user, $file_id, $upload_datetime) {
    $pdo->exec("INSERT INTO '$table_name'(user, file_id, upload_datetime) VALUES ('$user', '$file_id', '$upload_datetime')");
}

// checks if value already in table and adds it if not, returns a message if value found in table
function check_duplicate_value_and_add($pdo, $table_name, $user, $file_id, $upload_datetime) {
    $result = $pdo->query("SELECT * FROM '$table_name' WHERE user='$user' AND file_id='$file_id'")->fetch();
    if (boolval($result)){
        echo 'Value already in database.'."<br>";
        return TRUE;
    } else {
        add_entry_to_table($pdo=$pdo, $table_name=$table_name, $user=$user, $file_id=$file_id, $upload_datetime=$upload_datetime);
        return False;
    }
}

# retieve all values that match a user
function retrieve_user_images($pdo, $table_name, $user) {
    
    $result = $pdo->query("SELECT * FROM '$table_name' WHERE user='$user'")->fetchAll();
    return $result;
}

# check if user in database
function check_user_in_db($pdo, $table_name, $user) {
    $result = $pdo->query("SELECT EXISTS(SELECT 1 FROM '$table_name' WHERE user='$user')")->fetchColumn();
    return $result;
}

# retrieve all distinct users
// list_distinct_users
function list_distinct_users($pdo, $table_name) {
    $result = $pdo->query("SELECT DISTINCT user FROM '$table_name'")->fetchAll();
    return $result;
}

# lookup past results
function lookup_past_results($table_name, $user) {
    $result = check_user_in_db($pdo=$pdo, $table_name=$table_name, $user=$user);
    if (boolval($result)){
        $result = retrieve_user_images($pdo=$pdo, $table_name=$table_name, $user=$user);
        return $result;
    } else {
        echo 'Sorry, no users match the input. Below is a list of all unique users in the table.'."<br>";
        $result = list_distinct_users($pdo=$pdo, $table_name=$table_name);
        return $result;
    }
}

#TODO: extract this programmatically
$python = "C:/Users/agbav/AppData/Local/Programs/Python/Python38-32/python.exe";

# TODO: Test anaconda python path
// $PYEXE='python';
// if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'){
// 	if(file_exists($try='C:\ProgramData\Anaconda3\python.exe')) $PYEXE=$try;
// }
// else{
// 	#On MAC, python is probably on the path already. So, nothing to do.
// }

function call_image_processor($img_path,$username){
    $dbfile=__DIR__.'/test.sqlite';
    
    $db = new PDO("sqlite:$dbfile");
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $command = $python." ..\processing\main.py ".$img_path." 2>&1";
    $output = shell_exec($command); //output is going to be file paths of image two processed CT scans

    $arr = explode(":",$output);
    $upload_datetime = date('Y-m-d H:i:s', time());
    $table = 'images';
    $file = "";
    create_db_table_if_not_exist($pdo=$db, $table_to_create=$table);
    for($i=0;$i<2;$i++){
        $file = $arr[$i]; 
        check_duplicate_value_and_add($pdo=$db, $table_name=$table, $user=$username, $file_id=$file, $upload_datetime=$upload_datetime);
    }

    

    
    //call database function to store output image here
    return $output;
}


// function to retrieve name and list of corresponding values in table
// returns a list of DISTINCT names if the name is not found in the table

####################################################
// # create table
// create_db_table_if_not_exist($pdo=$db, $table_to_create=$new_table);

// # add entry to database
// check_duplicate_value_and_add($pdo=$db, $table_name=$new_table, $user=$test_user, $file_id=$test_file_id, $upload_datetime=$test_upload_datetime);

// # add duplicate entry
// check_duplicate_value_and_add($pdo=$db, $table_name=$new_table, $user=$test_user, $file_id=$test_file_id, $upload_datetime=$test_upload_datetime);

// # add new unique entry
// check_duplicate_value_and_add($pdo=$db, $table_name=$new_table, $user='MF', $file_id='sample2.png', $upload_datetime='2013-10-07 08:23:19.120');

# HTML/php front end -> pass image id and user directly to db (since we already know the filename format) in try catch statement
# Before running put if statment to check if value already in the database
# inside of statement would be the processing of files and storing of images

# when retrieving the user, there should be a scrolling drop down menu

// echo "<br>";
// $filename_username = 'sample1_user1';
// echo "Processed_Files/{$filename_username}.png"

// $PYEXE='python';
// if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'){
//     if(file_exists($try='C:\Users\matth\Anaconda3\python.exe')) $PYEXE=$try;
// }
// else{
//     // On MAC, python is probably on the path already. So, nothing to do.
// }
// $cmd="\"$PYEXE\" C:\Users\matth\Dropbox\bmes550.MatthewFalcione.mjf378\web\prostaterisk.py ".escapeshellarg($_REQUEST['history'])." ".escapeshellarg($_REQUEST['europe'])." ".escapeshellarg($_REQUEST['ar_ggc'])." ".escapeshellarg($_REQUEST['haplotype']);
// // echo "Running command: $cmd";

// exec($cmd, $out);
// $out = implode("\n", $out);

// // echo "<pre>"; print_r($out); echo "</pre>";

// echo "Your risk of prostate cancer is: <b>$out<b>";

?>