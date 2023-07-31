<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Consumer Sign Up</title>
  </head>
  <body>
    <form action="../Controllers/doc_signup_check.php" method="post" onsubmit="return validateContactNumber()">
      <fieldset>
        <legend align="center">
          <h1>Sign Up as a Doctor</h1>
          
        </legend>
        <table align="center">
            <h3><a href="../home.html">Healthcare Hub</a></h3>
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
            <td>
                Education : 
            </td>
            <td>
               <textarea name="education" id="" cols="30" rows="03"></textarea> 
            </td>
        </tr>
        <tr>
          <td>Your Expertise :</td>
            <td>

                <select name="field" id="">
                    <option value="">Choose an option</option>
                    <option value="Gynaecologist">Gynaecologist</option>
                    <option value="Endocrinologist">Endocrinologist</option>
                    <option value="Cardiologist">Cardiologist</option>
                    <option value="Dentist">Dentist</option>
                    <option value="Neurologist">Neurologist</option>
                    <option value="Oncologist">Oncologist</option>
                    <option value="Radiologist">Radiologist</option>
                </select>
            </td>
        </tr>

        <tr>
          <td>Your Password :</td>
          <td>
            <input type="password" name="password" id="password" onkeyup="checkPassword()" />
          </td>
        </tr>
        <tr>
          <td colspan='2' id="password_strength" align="center">
            
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
            <input type="text" name="contact" id="contact_number" />
          </td>
        </tr>
        
        <tr>
    <td colspan='2' align="center">
          <?php if (isset($_SESSION['blank_msg']))
            {
                  echo $_SESSION['blank_msg'];
                  unset($_SESSION['blank_msg']);
                  
            }
              
            
          ?>
    </td>


        </tr>
        <tr>
          <td>
          <input type="checkbox" name="terms" id="terms"><a href="terms.txt">Terms and Conditions</a>
          </td>
        </tr>
        <tr>
          <td colspan="2" align="center">
            <br><input type="submit" name="submit" value="Submit" id="" />
          </td>
        </tr>
                
      </fieldset>
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
        const email = document.getElementById('email').value;
    
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
  let password = document.getElementById("password").value;
  let strength = checkPasswordStrength(password);
  
  let strengthText;
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
  
  document.getElementById("password_strength").innerHTML = strengthText;
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
#password_strength {
  font-size: 14px;
  margin-top: 10px;
  text-align: center;
}

#password_strength::before {
  content: "Password Strength: ";
}

#password_strength::after {
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
