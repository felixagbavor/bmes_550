<?php
# Matthew Falcione

# TODO: find BMES tempdir using php
$dbfile=__DIR__.'/test.sqlite'; # if you are using a large database file (> 10 MB), please keep it elsewhere on your computer.

####################################################
# create database connection
$db = new PDO("sqlite:$dbfile");
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

// /**
//  * Check if a table exists in the current PDO database instance.
//  * @param PDO $pdo PDO instance connected to a database.
//  * @param string $table_name table to search for.
//  * @return bool TRUE if table exists, FALSE if the table does not exist.
//  */

# get temp file path and pass to python

# the table will be hardcoded, the rest will be retrieved from a GET request
# TODO: get inputs (user and file_id) from GET request
$test_upload_datetime = date('Y-m-d H:i:s', time());
$test_file_id = 'test6';
$test_user = 'MattFalcione';
$new_table = 'test4';

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
        echo 'New entry added.'."<br>";
        return False;
    }
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
function lookup_past_results($pdo, $table_name, $user) {
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

// $result = lookup_past_results($pdo=$db, $table_name=$table_to_create, $user='J');
// print_r($result);

# tmp image path to python
# running python code

function call_image_processor($img_path){
    $command = "python3 ../processing/main.py ".$img_path." 2>&1";
    $output = shell_exec($command); //output is going to be file paths of image two processed CT scans

    //call database function to store output image here

    return $output;
}

?>