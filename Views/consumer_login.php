<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
  </head>
  <body>
    <h1 align="center"> Welcome to <a href="../home.html" style="text-decoration:none;"> Healthcare Hub</a></h1>
      <h3 align="center">Login as a Consumer</h3>
    <table align="center">

      <div style="text-align: center;">
      <tr>
        <td   id="message">
           

        </td>
      </tr>

        <tr>
          <td>
            <input
            type="email"
            name="email"
             id="email"
            placeholder="Enter your EMAIL"
            />
          </td>
        </tr>
        <tr>
          <td>
            <input
            type="password"
            name="password"
            id="password"
            placeholder="Enter your password"
            />
          </td>
        </tr>
        <tr>
          <tr>
            <td>
              <input type="checkbox" name="remember" id="check">Remember me 
            </td>
            
          </tr>
          <td align="center">
            <input type="submit" name="submit" value="Login" onclick="ajax()" id="" />
            
        </td>
      </tr>
      <tr>
        <td>
           <br> If you are new please <a href="consumer_signup.php">Sign Up</a>
        </td>
      </tr>
    </table>
  </div>
    
  </body>
  <script>
    function ajax()
    {

        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;
        let checked = document.getElementById("check").checked;
        if (email =='' || password =='')
        {
          alert("Please give a registered Email and Correct Password to Login!!");
          return false ; 
        }
       else 
       {  
         let data = {
           'email': email,
           'password': password,
           'checked': checked
          };
          
          //alert (data.email);
          let user = JSON.stringify(data);
         // alert(user);
          let xhttp = new XMLHttpRequest();
          xhttp.open('POST', '../Controllers/consumer_login_check.php', true);
          xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
          //xhttp.setRequestHeader('Content-type', 'application/json');
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              let user = JSON.parse(this.responseText);
              //console.log(user);
              if (user.state == 'success') {
                window.location.href ='consumer_page.php';
              }
              if (user.state == 'failed') {
                let msg = document.getElementById('message');
                msg.innerText= "Incorrect Username or Password !";

                //window.location.href='../home.html';
              }
            }
          };

          xhttp.send('data='+user);
          
      }
    }

  </script>
  <style>
      
      body {
        font-family: Arial, sans-serif;
        background-color: #f1f1f1;
      }
      h1, h3 {
        color: #3b3b3b;
        text-align: center;
        margin-top: 50px;
      }
      a {
        color: blue;
        text-decoration: none;
      }
      table {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 50px;
        margin: 0 auto;
        max-width: 500px;
      }
      input[type="email"], input[type="password"] {
        display: block;
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: none;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        font-size: 16px;
      }
      input[type="checkbox"] {
        margin-right: 10px;
      }
      input[type="submit"] {
        display: block;
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
      }
      input[type="submit"]:hover {
        background-color: #3e8e41;
      }
      #message {
        color: red;
        text-align: center;
      }
    
    </style>
</html>