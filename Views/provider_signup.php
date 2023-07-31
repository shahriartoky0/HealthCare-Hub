<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Consumer Sign Up</title>
  </head>
  <body>
    <h1 align="center">Sign Up as a Provider</h1>
    <h3><a href="../home.html">Healthcare Hub</a></h3>
    <form action="../Controllers/pro_signup_check.php" method="post" onsubmit="return validateContactNumber()">
      <table align="center">
        <tr>
          <td>Your Name :</td>
          <td>
            <input type="text" name="username" id="" />
          </td>
        </tr>
        <tr>
          <td>Your Email Address :</td>
          <td><input type="email" name="email" id="email" /></td>
        </tr>

        <tr>
          <td>Your Password :</td>
          <td>
            <input type="password" name="password" id="password" onkeyup="checkPassword()" />
          </td>
        </tr>
        <tr>
          <td colspan='2' id="password-strength" align='center'>
          
            
          </td>
        </tr>
        <tr>
          <td>Retype Password :</td>
          <td>
            <input type="password" name="r_password" id="" />
          </td>
        </tr>
        <tr>
    <td colspan='2' align="center">
        <?php if (isset($_SESSION['password_match_msg']))
          {
                echo $_SESSION['password_match_msg'];
                unset($_SESSION['password_match_msg']);
          }
         
        ?>
    </td> 


        </tr>
       <tr>
          <td>Your Phone Number :</td>
          <td>
            <input type="text" name="contact" id="contact_number"  placeholder=" BKASH MERCHANT NUMBER" />
          </td>
        </tr>
        <tr>
          <td colspan=2 align="center">
            <?php
            if (isset($_SESSION['blank_msg']))
            {
                  echo $_SESSION['blank_msg'];
                  unset($_SESSION['blank_msg']);
            }
            ?>
          </td>
        </tr>


        <!-- 
        Here the terms has to be implemented -->
        <tr>
        <td>
        <input type="checkbox" name="terms" id="terms"><a href="terms.txt">Terms and Conditions</a>
        </td>
        </tr
       <!--  end here  -->
        <tr>
          <td colspan="2" align="center">
            <br><input type="submit" name="submit" value="Submit" id="" />
          </td>
        </tr>
      </table>
    </form>
    <p align='center'>
    <?php if(isset($_SESSION['pass_check_msg'])){
              echo $_SESSION['pass_check_msg'];
              unset($_SESSION['pass_check_msg']);
            }
              ?>
    </p>

    <script>

  function validateContactNumber() {
        const contactNumber = document.getElementById("contact_number").value;
    
        if (contactNumber.length !== 14 || contactNumber.substring(0, 4) !== "+880") {
            alert("Please enter a valid contact number. It should be 14 digits where the first 4 digits should be +880.");
            return false;
        }
        if (email =='')
        {
          alert('Please Give a verified Email !');
          return false; 
        }
        let terms = document.getElementById('terms');
        if (terms.checked== false)
		{
			alert('Agree with the agreements')
			return false ;
		}
    
        return true;
    }
    // password strength meter 
   
 function checkPassword() {
  var password = document.getElementById("password").value;
  var strength = checkPasswordStrength(password);
  
  var strengthText;
  switch(strength) {
    case 0:
      strengthText = "";
      break;
    case 1:
      strengthText = "Weak";
      break;
    case 2:
      strengthText = "Moderate";
      break;
    case 3:
      strengthText = "Strong";
      break;
    case 4:
      strengthText = "Very strong";
      break;
    default:
      strengthText = "";
  }
  
  document.getElementById("password-strength").innerHTML = strengthText;
}
function checkPasswordStrength(password) {
  let strength = 0;

if (password.length >= 8) {
  strength++;
}

if (password.toLowerCase() != password) {
  strength++;
}

if (password.toUpperCase() != password) {
  strength++;
}

if (!isNaN(password)) {
  strength++;
}

if (password.includes('!') || password.includes('@') || password.includes('#') || password.includes('$') || password.includes('%') || password.includes('^') || password.includes('&') || password.includes('*')) {
  strength++;
}

  return strength;
}

</script>
  </body>
  </script>
  </body>
  <!--------------------------- APPLYING CSS TO THE FILE -------------------------- -->
  <style>
    /* body style */
body {
  font-family: Arial, sans-serif;
  background-color: #f2f2f2;
}

/* header style */
h1 {
  text-align: center;
  color: #4a4a4a;
  font-size: 36px;
  margin-top: 30px;
}

h3 {
  text-align: center;
  margin-bottom: 30px;
}

a {
  color: #4a4a4a;
  text-decoration: none;
}

a:hover {
  color: #4a4a4a;
  text-decoration: underline;
}

/* form style */
form {
  max-width: 500px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}

table {
  margin: 0 auto;
}

input[type="text"],
input[type="email"],
input[type="password"] {
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
  font-size: 16px;
  width: 100%;
  margin-bottom: 10px;
}

input[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 18px;
}

input[type="submit"]:hover {
  background-color: #3e8e41;
}

/* password strength indicator */
#password-strength {
  font-size: 14px;
  margin-top: 10px;
  text-align: center;
}

#password-strength::before {
  content: "Password Strength: ";
}

#password-strength::after {
  content: attr(data-strength);
  color: var(--password-color);
}

/* message style */
p {
  text-align: center;
  color: red;
  margin-top: 10px;
  font-size: 16px;
}

    </style>
</html>
