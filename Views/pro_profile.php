<?php
if(isset($_COOKIE['provider_logged_flag']))
{
session_start();

require_once "../models/provider_user_model.php";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Doctor Profile</title>
</head>
<body >
<!-- NAVBAR INCLUDES HERE  -->
<?php
            $email = $_SESSION['provider_id'];
            $image = provider_image($email);
            ?>
<nav>
	<ul>
		<img class="logo" src="../pictures/uploads-p/<?php echo $image ?>" height=80px width=80px alt="Logo">

	</ul>
                <ul>
                    
                    <li><a href="provider_page.php">Home</a></li>
                    <li><a href="pro_profile.php">Customize Your Profile</a></li>
                    <li><a href="sell.php">Sell Medical Equipment</a></li>
					<li><a href="show_provider_selling_products.php">My Products</a></li>
                    <li><a href="provider_own_sell.php">My Sold Products</a></li>
                    <?php
                    //unread notification Number
                    require_once "../models/notifications_model.php";
                    $user = ['email'=>$_SESSION['provider_id']];
                    $provider_id= get_id($user);
                    $client =['type'=>'provider', 'user_id'=>$provider_id];
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
                    <li><a href="provider_notification.php">Notifications <span><?php echo $show_count ; ?></span></a></li>
					<li><a href="../Controllers/logout_provider.php">Logout</a></li>
                </ul>
                <br>
               
            </nav>
<!-- NAVBAR ENDS HERE  -->
	<h1 align="center">Profile Customization</h1>

	<p id="para"></p>
	<form action="../Controllers/pro_profile_update.php" method="post" enctype="multipart/form-data" onsubmit= "return validateContactNumber()">

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
				<input type="text" name="name" id="name_input" onkeyup="f2()" ><br>

			</td>
		</tr>

		<tr>
			<td>
				<label for="Contact">Contact:</label>

			</td>
			<td>
				<input type="text" name="contact" id="contact_input" onkeyup="f1()" placeholder="BKASH MERCHANT NUMBER"> <br>
			</td>
			</tr>
			<tr>
				<td>
					<label for="picture">Profile Picture:</label>

				</td>
				<td>
					<input type="file" name="picture"><br>

				</td>
				<td>
					
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
		function f1 ()
		{
			
			let contact = document.getElementById("contact_input").value;
			let obj = document.getElementById("para");
			obj.innerHTML='';
			obj.innerHTML =`<h1 align="center">Your contact will be :` + contact +`</h1>`	;
			
		}
		function f2 ()
		{
			let name = document.getElementById("name_input").value;
			let obj = document.getElementById("para");
			obj.innerHTML =`<h1 align="center">Your name will be :` + name +`</h1>`	;
			console.log (name);
			console.log (obj);
		}
			
	function validateContactNumber() {
		const contactNumber = document.getElementById("contact_input").value;
		
        if (contactNumber.length !== 14 || contactNumber.substring(0, 4) !== "+880") {
			alert("Please enter a valid BD contact number. It should be 14 digits where the first 4 digits should be +880.");
            return false;
        }
		
        return true;
    }
	</script>

	<?php 
}
else 
{
    header("location:../home.html");
}
	?>
	<!-- Internal CSS starts here --> 
	<style>
		/* Navbar */
		body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}
		nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #f2f2f2;
  height: 80px;
  padding: 0 30px;
}

nav ul {
  display: flex;
  align-items: center;
  list-style: none;
}

nav li {
  margin-right: 30px;
}

nav li:last-child {
  margin-right: 0;
}

nav a {
  text-decoration: none;
  color: #333;
  font-weight: bold;
  font-size: 18px;
}

nav img.logo {
  margin-right: 20px;
  border-radius: 50%;
}

nav a:hover {
  color: #008080;
}

nav span {
  background-color: #008080;
  color: #fff;
  border-radius: 50%;
  padding: 5px 10px;
  margin-left: 5px;
  font-size: 12px;
}

/* Main Content */
h1 {
  text-align: center;
  font-size: 36px;
  margin-top: 50px;
}

form {
  margin-top: 50px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

form table {
  border-collapse: collapse;
}

form td {
  padding: 10px;
}

form label {
  font-size: 18px;
  font-weight: bold;
  margin-right: 10px;
}

form input[type="text"] {
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
  font-size: 16px;
  width: 300px;
  margin-bottom: 20px;
}

form input[type="file"] {
  margin-bottom: 20px;
}

form input[type="submit"] {
  background-color: #008080;
  color: #fff;
  border-radius: 5px;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
}

form input[type="submit"]:hover {
  background-color: #006666;
}

	</style>
	<!-- Internal CSS ends here --> 
</html>
