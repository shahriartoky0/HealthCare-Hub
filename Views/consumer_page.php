<?php
session_start();
if(isset($_COOKIE['consumer_logged_flag'])){
    require_once "../models/consumer_user_model.php";
   //$user = $_SESSION['username'];
   ?>
   <html>
<head>
    <title>
        Consumer Page 
    </title>
</head>
<header>
        <div class="container">
            <?php
            $email = $_SESSION['consumer_id'];
            $image = consumer_image($email);
            ?>
            <img class="logo" src="../pictures/uploads-c/<?php echo $image ?>" height=80px width=80px alt="Logo">
            <nav>
                <ul>
                     <li><a href="consumer_page.php">Home</a></li>
                    <li><a href="con_profile.php">Customize Your Profile</a></li>
                    <li><a href="buy.php">Buy Medical Equipment</a></li>
                    <li><a href="blog_show.php">Show Articles</a></li>
                    <li><a href="consumer_orders.php">My Orders</a></li>
                    <li><a href="consumer_complain.php">File a Complain</a></li>
                    <li><a href="consumer_show_doctors.php">Chat with a Doctor</a></li>
                    <?php
                    //unread notifucation Number
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
        </div>
    </header>
<body>
<table>
        
    </table>
<h2 align="center">Welcome <?php 

        $con = getconnection();
        $sql = "SELECT username FROM consumer_user WHERE email = '{$_SESSION['consumer_id']}'";
        $status = mysqli_query($con , $sql);
        $result = mysqli_fetch_assoc($status);
        echo $result['username'];
     ?></h2>    
<p align="center">
    <table border=1 >
        <tr>
            <td>

                <a href="con_profile.php">Customize Your Profile</a> </br>
            </td>
                            </tr>
                            <tr>
            <td>
                <a href="buy.php">Buy Medical Equipment </a>
            </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="blog_show.php">Show Articles</a>
                                </td>
                            </tr>
                            <tr>
                                <td> 
                                    <a href="consumer_orders.php">My Orders </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="consumer_complain.php">File a Complain</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="consumer_show_doctors.php">Chat with a Doctor</a>
                                </td>
                            </tr>
                            <tr>
            <td>
                <a href="../Controllers/logout_consumer.php">Logout</a>

            </td>
        </tr>
    </table>
</p>
</body>

<?php
}
else 
{
    header("location:../home.html");
}
?>
<!--------------------------------------- INTERNAL CSS IS GOING TO APPLY HERE.----------------------- -->
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

		h2 {
			font-size: 32px;
			font-weight: bold;
			margin-top: 50px;
			margin-bottom: 20px;
			text-align: center;
			color: #333;
		}

		table {
			border-collapse: collapse;
			margin: 0 auto;
			width: 100%;
			max-width: 1200px;
			background-color: #fff;
			box-shadow: 0px 5px 10px rgba(0,0,0,0.1);
		}
 </style>



</html>

