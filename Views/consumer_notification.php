<?php
if(isset($_COOKIE['consumer_logged_flag']))
{
    session_start();
    require_once "../models/consumer_user_model.php";
    require_once "../models/notifications_model.php";
    ?> 
    <!-- NAVBAR INCLUDES HERE  -->
    <?php
            $email = $_SESSION['consumer_id'];
            $image = consumer_image($email);
            ?>
            <img class="logo" src="../pictures/uploads-c/<?php echo $image ?>" height=80px width=80px alt="Logo">
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
    <u><h1>Your Notifications</h1></u>
    <?php
    $user =['email'=> $_SESSION['consumer_id']];
    $consumer_id = get_id($user);
    $notice = ['type'=> 'consumer', 'user_id'=> $consumer_id];
    $all_notification = show_notification($notice);
    while($notification = mysqli_fetch_assoc($all_notification))
    {?>

    <div>
        <?php
        ?>
<h2><?php echo $notification['notice'] ?></h2> <?php echo '('.$notification['timestamp'].')'; ?></h2>
</div>
<?php
    }

    //update the seen status
    $status = ['user'=>'consumer', 'user_id'=> $consumer_id]; 
    update_consumer_read_status($status);
    

}
else 
{
    header("location:../home.html");
}

?>
<!-- Internal CSS starts  HERE  -->
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

h1 {
  margin-top: 50px;
  font-size: 24px;
  font-weight: bold;
}

h2 {
  font-size: 18px;
  font-weight: normal;
  margin-top: 20px;
}

div {
  border: 1px solid #ccc;
  padding: 10px;
  margin-bottom: 20px;
  background-color: #fff;
}

    </style>
    <!-- Internal CSS ends HERE  -->