<?php
session_start();
if(isset($_COOKIE['consumer_logged_flag'])){
    setcookie('consumer_logged_flag',true,time()+400,'/');
    require_once "../models/blog_model.php";
    require_once "../models/doctor_user_model.php";
    $status = showdata();
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
                    $show_count = '';
                    require_once "../models/notifications_model.php";
                    ?>
                    <li><a href="consumer_notification.php">Notifications <span><?php echo $show_count ; ?></span></a></li>
                </ul>
                <br>
                <ul>
                    <li><a href="../Controllers/logout_consumer.php">Logout</a></li>
                </ul>
            </nav>
<!-- NAVBAR ENDS HERE  -->
    <h1 align='center'> BLOGS WRITTEN BY DOCTORS </h1>
    <?php
    while ($data = mysqli_fetch_assoc($status))
    
    {
        ?>
        <div style="border: solid 2px maroon;">
            
            <h2> <?php echo $data['title']; ?> </h2>
            <?php 
        //doctor information here 
        $doctor_all_data = doctor_data_byid($data['doctor_id']);
        $doctor_data = mysqli_fetch_assoc($doctor_all_data);
        ?>
        
        <h4>Writer: <?php echo $doctor_data['username'];  ?></h4>
        <h5><?php 
        $image =$doctor_data['picture'];
        echo $doctor_data['education']; ?></h5>
        <img src="../pictures/uploads-d/<?php echo $image; ?>" style="width:50px ; height: 50px" alt="">
        
        <small>Category :<?php echo $data['category'];  ?> </small>
        <p>
            <?php echo $data['content']; ?>
        </p>
    
        </div>
        <?php
    }
    
}
else 
{
    header("location:../home.html");
}
?>
<!-- INTERNAL CSS INCLUDES HERE  -->
<style>
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

h1 {
  font-size: 36px;
  text-align: center;
  margin-bottom: 20px;
}

div {
  border: solid 2px maroon;
  padding: 20px;
  margin-bottom: 20px;
}

h2 {
  font-size: 28px;
  margin-bottom: 10px;
}

h4 {
  font-size: 20px;
  margin-top: 0;
}

h5 {
  font-size: 18px;
  margin-top: 0;
}

p {
  font-size: 16px;
  line-height: 1.5;
  margin-top: 10px;
}

</style>