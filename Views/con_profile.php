<?php
if(isset($_COOKIE['consumer_logged_flag']))
{
	session_start();
	require_once "../models/consumer_user_model.php";
	
	?>

<!DOCTYPE html>
<html>
	<head>
		<title>Consumer Profile</title>
	</head>
	<body >
	<!-- NAVBAR INCLUDES HERE  -->
<nav>
                <ul>
                    
                    <li><a href="consumer_page.php">Home</a></li>
                    <li><a href="con_profile.php">Customize Your Profile</a></li>
                    <li><a href="buy.php">Buy Medical Equipment </a></li>
                    <li><a href="blog_show.php">Show Articles</a></li>
                    <li><a href="consumer_orders.php">My Orders</a></li>
                    <li><a href="consumer_complain.php">File a Complain</a></li>
                    <li><a href="consumer_show_doctors.php">Chat with a Doctor</a></li>
                    <?php
                    //unread notification Number
                    require_once "../models/notifications_model.php";
                    $user = ['email'=>$_SESSION['consumer_id']];
                    $_profileconsumer_id= get_id($user);
                    $client =['type'=>'consumer', 'user_id'=>$_profileconsumer_id];
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
                    <li><a href="consumer_notification.php">Notifications <span><?php echo $show_count ; ?></span></a></li>
                </ul>
                <br>
                <ul>
                    <li><a href="../Controllers/logout_consumer.php">Logout</a></li>
                </ul>
            </nav>
<!-- NAVBAR ENDS HERE  -->
	<h1 align="center">Profile Customization</h1>
	<form action="../Controllers/con_profile_update.php" method="post" enctype="multipart/form-data" onsubmit= "return validateContactNumber()">

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
				<input type="text" name="name"><br>

			</td>
		</tr>
		<tr>
			<td>
				<label for="Contact">Contact:</label>

			</td>
			<td>
				<input type="text" name="contact" id="number" ><br>
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
}
else 
{
	header("location:consumer_login.php");
}
	?>
	</p>
</body>
<script>

  function validateContactNumber() {
        const contactNumber = document.getElementById("number").value;
    
        if (contactNumber.length !== 14 || contactNumber.substring(0, 4) !== "+880") {
            alert("Please enter a valid BD contact number. It should be 14 digits where the first 4 digits should be +880.");
            return false;
        }
    
        return true;
    }
	</script>
	<style>
		/* body */
body {
  font-family: Arial, sans-serif;
  background-color: #f5f5f5;
  margin: 0;
  padding: 0;
}
header {
			background-color: #fff;
			box-shadow: 0px 5px 10px rgba(0,0,0,0.1);
			position: sticky;
			top: 0;
			z-index: 999;
		}

		.container {
			max-width: 1200px;
			margin: 0 auto;
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding: 10px 20px;
		}

		.logo {
			height: 50px;
			width: 50px;
			object-fit: cover;
			border-radius: 50%;
			margin-right: 10px;
		}

		nav ul {
			list-style: none;
			margin: 0;
			padding: 0;
			display: flex;
		}

		nav ul li {
			margin-left: 10px;
		}

		nav ul li a {
			color: #333;
			text-decoration: none;
			font-size: 16px;
			font-weight: bold;
			padding: 10px 15px;
			transition: all 0.3s ease;
			position: relative;
			display: flex;
			align-items: center;
		}

			nav ul li a:hover {
				background-color: #ddd;
			}

			nav ul li a:after {
				content: '';
				display: inline-block;
				height: 4px;
				width: 100%;
				background-color: #6c5ce7;
				position: absolute;
				bottom: -4px;
				left: 0;
				transform: scaleX(0);
				transform-origin: bottom right;
				transition: transform 0.3s ease;
			}

			nav ul li a:hover:after {
				transform: scaleX(1);
				transform-origin: bottom left;
			}

		nav ul li a span {
			background-color: #6c5ce7;
			color: #fff;
			border-radius: 50%;
			height: 18px;
			width: 18px;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 12px;
			position: absolute;
			top: -6px;
			right: -6px;
		}

/* form */
form {
  max-width: 600px;
  margin: 20px auto;
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.2);
}

h1, h2 {
  text-align: center;
}

h2 a {
  text-decoration: none;
  color: #000;
  font-size: 20px;
  margin-right: 20px;
}

h2 a:hover {
  color: #666;
}

label {
  display: block;
  margin-bottom: 10px;
  color: #666;
}

input[type="text"], input[type="file"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

input[type="submit"] {
  background-color: #ff0000;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #cc0000;
}

	</style>
</html>
