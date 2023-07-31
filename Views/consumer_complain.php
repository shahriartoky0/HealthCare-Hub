<?php
session_start();
if(isset($_COOKIE['consumer_logged_flag'])){
    setcookie('consumer_logged_flag',true,time()+400,'/');
    require_once "../models/consumer_user_model.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
      	<!-- NAVBAR INCLUDES HERE  -->
<nav>
<?php
            $email = $_SESSION['consumer_id'];
            $image = consumer_image($email);
            ?>
            <img class="logo" src="../pictures/uploads-c/<?php echo $image ?>" height=80px width=80px alt="Logo">
                <ul>
                    
                    <li><a href="consumer_page.php">Home</a></li>
                    <li><a href="con_profile.php">Customize Your Profile</a></li>
                    <li><a href="buy.php">BUY MEDICAL ACCESSORIES</a></li>
                    <li><a href="blog_show.php">Show Articles</a></li>
                    <li><a href="consumer_orders.php">My Orders</a></li>
                    <li><a href="consumer_complain.php">File a Complain</a></li>
                    <li><a href="consumer_show_doctors.php">Chat with a Doctor</a></li>
                    <?php
                    //unread notification Number
                    require_once "../models/notifications_model.php";
                    $user = ['email'=>$_SESSION['consumer_id']];
                    $consumer_id= get_id($user);
                    $client =['type'=>'consumer', 'user_id'=>$consumer_id];
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
<h1>CONSUMER COMPLAIN PAGE </h1>
<form action="../Controllers/complain_controller.php" method = "POST" enctype="multipart/form-data"  onsubmit= "return form_validate()">

    <h3>You want to complain about :</h3>
    <select name="category" id="">
        <option value="">Select One</option>
        <option value="doctor">Doctor</option>
        <option value="provider">Seller</option>
    </select><br><br>
    <label for="description">Description : </label><br>
    <textarea name="description" id="description" cols="30" rows="10"></textarea><br><br>
    Attach an Image or Screenshot as proof if available:<br><br> 
        <input type="file" name="complain_image" id=""><br><br>
        <input type="submit" name="submit" value="Done" id="">
</form>

    
<?php

?>
</body>
<script>
    function form_validate()
    {
        let description = document.getElementById("description").value;
        if(description == '')
        {
            alert("Please give a description to file a complain !!");
            return false ; 
        }
        return true ; 
        
    }
</script>
<?php }
else 
{
    header("location:../home.html");
}
?>
<!-- INTERNAL CSS INCLUDES HERE -->
<style>
    
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

/* Style for the heading */
h1 {
  margin-top: 30px;
  text-align: center;
}

/* Style for the form */
form {
  margin: 30px auto;
  max-width: 600px;
}

label {
  display: block;
  margin-bottom: 10px;
}

input[type="file"] {
  margin-top: 10px;
}

textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  resize: vertical;
  min-height: 200px;
}

input[type="submit"] {
  margin-top: 10px;
  background-color: #4285f4;
  color: white;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  font-weight: bold;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #3367d6;
}

    </style>
    <!-- INTERNAL CSS ENDS HERE -->
</html>