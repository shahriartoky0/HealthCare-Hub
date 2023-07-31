<?php 
 if (isset($_COOKIE['consumer_logged_flag'])) {

    require_once "../models/doctor_user_model.php";
    session_start();
    ?>
        	<!-- NAVBAR INCLUDES HERE  -->
<nav>
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
                    $show_count='';

                    ?>
                    <li><a href="consumer_notification.php">Notifications <span><?php echo $show_count ; ?></span></a></li>
                </ul>
                <br>
                <ul>
                    <li><a href="../Controllers/logout_consumer.php">Logout</a></li>
                </ul>
            </nav>
<!-- NAVBAR ENDS HERE  -->
    <h1>Here are the List of Our doctors </h1>
    <?php

    $doctor_all_data_obj = show_all_doctors();
    ?>
    <div id = "listing">
    <?php
    while ($doctor_data = mysqli_fetch_assoc($doctor_all_data_obj))
    {
        ?>
        <div>

            <h2><?php echo $doctor_data['username']; ?></h2>
            <img src="../pictures/uploads-d/<?php echo $doctor_data['picture'];?>" style="width: 80px ; height: 80px;" alt=""> <br>
            <strong><?php echo $doctor_data['expertise']; ?></strong>, <small><?php echo $doctor_data['education']; ?></small> <br><br>
            <form action="chat_to_specific_doctor.php">
                <input type="hidden" name="doctor_id" value="<?php echo $doctor_data['id']; ?>" id="">
                <input type="submit" name="submit" value="Chat" id="">
            </form>
            <!-- <a href="consumer_messege_to_doctor.php">Messege Him </a>
             -->
        </div>

        <?php
    }
    ?>
    </div>

    <?php
}
else 
{
    header("location:../home.html");
}
?>
<!-- INTERNAL CSS INCLUDES HERE  -->
<style>
/* NAVBAR */
nav {
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


/* Main Content */
h1 {
  font-size: 36px;
  font-weight: 700;
  margin-top: 50px;
  margin-bottom: 30px;
  text-align: center;
}

div {
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  padding: 30px;
  margin-bottom: 30px;
  text-align: center;
}

div h2 {
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 10px;
}

div img {
  border-radius: 50%;
  margin-bottom: 20px;
}

div strong {
  font-size: 18px;
  font-weight: 500;
}

div small {
  font-size: 14px;
}

div form {
  margin-top: 30px;
}

div input[type="submit"] {
  background-color: #008CBA;
  color: #fff;
  font-size: 16px;
  font-weight: 500;
  padding: 10px 20px;
  border-radius: 4px;
  border: none;
  cursor: pointer;
}

div input[type="submit"]:hover {
  background-color: #006c87;
}
#listing{
    display: flex;
}


</style>