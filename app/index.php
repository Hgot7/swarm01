
<!DOCTYPE html>
<html>
<head>
    <title>Store Login</title>
    <style>
        /* Set the background color to gray */
        h1{
            text-align: center;
        }
        body {
            background-color: gray;
        }
        .topic {
          
            text-align: center;
        }

        /* Center the elements on the page */
        .center {
            display: flex;
            justify-content: center;
            align-items: center;
        }
      

        /* Set the text color to white */
        .white-text {
            color: black;
        }
    </style>
</head>
<body>
    
    <div class="topic">
    <h1 class="white-text">spcn10 Login</h1>
</div>
    <div class="center">
        
        <form>
            
            <label for="username" class="white-text">Username:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password" class="white-text">Password:</label><br>
            <input type="password" id="password" name="password"><br><br>
            <input type="button" value="Login" onclick="login()" class="white-text">
        </form> 
    </div>
    <div class="center">
       <h1><?php
            date_default_timezone_set("Asia/Bangkok");
            echo'Today ';
            echo date('d/m/y');
            echo '<br/>';
            echo'Time ';
            echo date('H:i:s'); 
            echo '<br/>';
            echo'SPCN10 THANKYOU';
           

        ?></h1>
        
   </div>
    

    <script>
        function login() {
            // Get the username and password from the form
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;

            // Validate the username and password
            if (username == 'admin' && password == 'password') {
                // If the username and password are correct, redirect the user to the store homepage
                window.location.href = 'store-homepage.html';
            } else {
                // If the username and password are incorrect, display an error message
                alert('Invalid username or password');
            }
        }
    </script>
    
</body>
</html>
