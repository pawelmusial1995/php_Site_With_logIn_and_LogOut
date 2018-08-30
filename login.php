<?php 
/* 
    1.Build login HTML form
    2. Check if form has been submitted
    3.Validate form data
    4.Add form data to variables
    5.Connect to database
    6.Query the database for username submit in the form
    6.1 If no entries: Show error message 
    7.Store Basig user data form database  in variables
    8. verify stored hased password with the one submited in the form
    8.1 If invalid : showe error message
    9. Start a session & create session variables
    10.Redirect to a profile "profile page"
    10.1 Provide link to Logout page
    10.2 Add cookie clear to logout page
    10.3 Provide link to log back include
    11. Close the MySQl connection
*/
    if(isset($_POST['login']) ) {
       //build a function to validate data 
       function validateData ($formData) {
           $formData = (stripslashes(htmlspecialchars( $formData) ) );
           return $formData;
       } 
        // create variables 
        //wrap the data with our function
        $formUser = validateFormData($_POST['username'] );
        $formPass = validateFormData($_POST['password'] );
        // connect to database
       
        include('connection.php');
        
        //create SQL query(zapytanie)
        
        $query = "SELECT username, email , password FROM users WHERE username='$formUser'   ";
        
        //store the result
        $result = mysqli_query($conn, $query);
        
        
        //verify if result is returned 
        
        if( mysqli_num_rows($result) > 0 ) {
            
            //store basic user data in some variables
            
            while($row = mysql_fetch_assoc($result) ) {
                $user       = $row['username'];
                $email      = $row['email'];
                $hashedPass = $row['password'];   
            }
            
            //verify hashed password with the typed password
            
            if( password_verify($formPass, $hasedPass) ) {
                
                //correct login details!
                
            }
        }
    }


?>


<html>

    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>Login</title>
    
    </head>
    
    <body>
    
        <div class="container">
        <h1>Login</h1>
       <p class="Lead"> use this form to log to your account</p>
        <form class="form-inline" action="<?php echo htmlspecialchars(SERVER['PHP_SELF'] ); ?>" method="post">
            <div class="form-group">
            <label for="login-username" class="sr-only"> Username </label>
            <input type="text" class="form-control" id="login-username" placeholder="Username" name="username"> <br>
                </div>
            <div class="form-group">
            <label for="login-password" class="sr-only"> Password </label>
            <input type="password" class="form-control" id="login-password" placeholder="Password" name="password"> <br>
            <button type="submit" class="btn btn-default" name="login">Log In</button>
            </div>
            
            </form>
        </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>



</html>