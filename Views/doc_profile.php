<?php
if(isset($_COOKIE['doctor_logged_flag']))
{
session_start();
require_once "../models/doctor_user_model.php";

?>

<!DOCTYPE html>
<html>
<head>
	<!-- NAVBAR INCLUDES HERE  -->
<?php
            $email = $_SESSION['doctor_id'];
            $image = doctor_image($email);
            ?>
<nav>
          <ul>

			  <img class="logo" src="../pictures/uploads-d/<?php echo $image ?>" height=80px width=80px alt="Logo">
		  </ul>  
                <ul>
                    
                    <li><a href="doctor_page.php">Home</a></li>
                    <li><a href="doc_profile.php">Customize Your Profile</a></li>
                    <li><a href="blog_make_form.php">Write a Blog</a></li>
                    <li><a href="doctor_messages.php">See Messages</a></li>
                    <?php
                    //unread notification Number
                    require_once "../models/notifications_model.php";
                    $user = ['email'=>$_SESSION['doctor_id']];
                    $doctor_id= get_id($user);
                    $client =['type'=>'doctor', 'user_id'=>$doctor_id];
                    $client_all_notices = unread_notification($client);
                    $unread_count=0;
                    while ($client_notice = mysqli_fetch_assoc($client_all_notices))
                    {
                        if ($client_notice['read_status']==0)
                         $unread_count++;
                    }
                    if ($unread_count > 0 )
                    {
                        $show_count = "($unread_count)";
                    }
                    else 
                    {
                        $show_count='';

                    }
                    ?>
                    <li><a href="doctor_notification.php">Notifications <span><?php echo $show_count ; ?></span></a></li>
                </ul>
                <br>
                <ul>
                    <li><a href="../Controllers/logout_doctor.php">Logout</a></li>
                </ul>
            </nav>
<!-- NAVBAR ENDS HERE  -->
	<title>Doctor Profile</title>
</head>
<body >
	<h1 align="center">Doctor Profile Customization</h1>
	
	<form action="../Controllers/doc_profile_update.php" method="post" enctype="multipart/form-data" onsubmit= "return validateContactNumber()">

	<table align="center" >
		<tr>
			<td colspan="2" align="center">
				<?php
					if(isset($_SESSION['empty_msg'])){
						echo $_SESSION['empty_msg'];
						unset($_SESSION['empty_msg']);
					}
				?>
			</td>
			
					
				
		</tr>
	<tr>
			<td>
				<label for="name">Name:</label>

			</td>
			<td>
				<input type="text" id="name" name="name"><br>

			</td>
		</tr>
		<tr>
			<td>
				<label for="expertise">Expertise:</label>

			</td>
			<td>
			<select name="field" id="expertise">
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
			<tr>
				<td>
				<label for="education">Education:</label>
				</td>
				<td>
					<textarea name="education" id="education" cols="30" rows="2"></textarea>
				</td>
			</tr>
			<td>
				<label for="Contact">Contact:</label>

			</td>
			<td>
				<input type="text" name="contact" id="number"><br>
			</td>
			</tr>
			<tr>
				<td>
					<label for="picture">Profile Picture:</label>

				</td>
				<td>
					<input type="file" name="picture"><br>

				</td>
			</tr>
			<tr>

			</tr>
			<tr>
				<td colspan="2" align="center">

					<input type="submit" name='submit' value="Save">
				</td>
			</tr>

	</table>




	</form>
	<p align="center" >
	<?php if(isset($_SESSION['profile_customization_msg'])){
		echo $_SESSION['profile_customization_msg'];
		unset($_SESSION['profile_customization_msg']);
	}
	?>
	</p>
</body>
<script>


  function validateContactNumber() {
        const contactNumber = document.getElementById("number").value;
		const expertise = document.getElementById("expertise").value;
		const education = document.getElementById("education").value;
		const name = document.getElementById("name").value;
		if (contactNumber == '' || expertise == '' || education == '' || name == '')
		{
			alert("Please fill in the fields !");
			return false ;
		}
    
        if (contactNumber.length !== 14 || contactNumber.substring(0, 4) !== "+880") {
            alert("Please enter a valid BD contact number. It should be 14 digits where the first 4 digits should be +880.");
            return false;
        }
    
        return true;
    }
	</script>




<?php
} else 
{
    header("location:../home.html");
}
?>
	<!-- Internal CSS starts Here  -->
<style>

body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f5f5f5;
}
/* Navbar Styles */
nav {
  background-color: #fff;
  padding: 10px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

nav ul {
  list-style: none;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
}

nav ul li {
  margin: 0 10px;
}

nav ul li a {
  text-decoration: none;
  color: #333;
  font-weight: bold;
  transition: all 0.3s ease;
  padding: 10px;
  border-radius: 5px;
}

nav ul li a:hover {
  background-color: #ddd;
}

nav img.logo {
  height: 80px;
  width: 80px;
  object-fit: cover;
  border-radius: 50%;
  margin-right: 20px;
}
/* Nav bar ends here  */

/* Form styling */
form {
  margin: 2rem auto;
  max-width: 50rem;
}

label {
  display: block;
  margin-bottom: 0.5rem;
}

input[type="text"],
textarea,
select {
  width: 100%;
  padding: 0.5rem;
  margin-bottom: 1rem;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 1rem;
}

input[type="file"] {
  margin-top: 1rem;
}

input[type="submit"] {
  background-color: #333;
  color: #fff;
  padding: 0.5rem;
  border: none;
  border-radius: 4px;
  font-size: 1rem;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #555;
}

/* Footer styling */
footer {
  background-color: #333;
  color: #fff;
  text-align: center;
  padding: 1rem;
}


	</style>
	<!-- Internal CSS ends Here  -->
</html>
