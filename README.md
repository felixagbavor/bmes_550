# Project

This table will hold the file paths to each of the uploaded and processed files. The files will be grouped by a username field that can be used to retrieve a set of file paths. The username and file name (will need to append the data directory path) will be passed by the user and into a php script that will call the the update/select statments. There will be no way of dropping the files after uploading, but there will be a date and time field that will allow for sorting.

### Limitations

Inputs are not sanitized (could be used for SQL injection)
No security for user authentication (HIPPA violation)
Files cannot be deleted/rewritten by the user

### Fields

user VARCHAR(30) - if the user cannot be found, return a list of all unique users (not suitable for large number of users)
file_id VARCHAR(30) - might need to replace some of the symbols to work with file systems
upload_datetime DATETIME - stored as text or integer so will need to use the date and time functions to convert and display them
Primary Key - (user, file_id)

### Other Information

A parameterized query is a query in which placeholders are used for parameters and the parameter values are supplied at execution time.
Why use Parameterized Query
The most important reason to use parameterized queries is to avoid SQL injection attacks.
Secondly parameterized query takes care of scenario where sql query might fail for e.g. inserting of O'Baily in a field.
Parameterized query handels such query without forcing you to replace single quotes with double single quotes.
pendingDeletions = new SQLiteCommand(@"DELETE FROM [centres] WHERE [name] = $name", conn);

### Sample Code

`foreach (string name in selected) { pendingDeletions.Parameters.AddWithValue("$name", centre.Name); pendingDeletions.ExecuteNonQuery(); }`

`sql = "select exists(SELECT * from USERS where PASSWORD = ? AND USERNAME = ?)" args = (var1,var2) cursor = database_connection.execute(sql, args)`# bmes_550

### Runing the Code


