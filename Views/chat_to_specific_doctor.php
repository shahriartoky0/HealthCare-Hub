<?php
session_start();

// Check if consumer is logged in
if (!isset($_SESSION['consumer_id'])) {
    header("Location: consumer_login.php");
    exit;
}

require_once "../models/doctor_user_model.php";
require_once "../models/chat_model.php";
require_once '../models/notifications_model.php';

// Check if doctor_id is set
if (!isset($_GET['doctor_id'])) {
    header("Location: consumer_page.php");
    exit;
}

$doctor_id = $_GET['doctor_id'];

// Get consumer_id
$cons_id = $_SESSION['consumer_id'];
$con = getconnection();
$sql = "SELECT id FROM consumer_user WHERE email = '{$cons_id}'";
$status= mysqli_query($con, $sql);
$result = mysqli_fetch_assoc($status);
$consumer_id =  $result['id'];

// Check if form is submitted
if (isset($_POST['submit'])) {
    $message_text = $_POST['message_text'];
    $message = ['consumer_id' => $consumer_id, 'doctor_id' => $doctor_id, 'msg' => $message_text , 'sent_by'=> 'consumer'];
    $add_message = add_consumer_message($message);
    if ($add_message) {
        //send notification to doctor
        $notice= ['type'=>'doctor', 'id'=>$doctor_id , 
        'notice'=>"A patient has sent you a message ."];
        add_notification($notice);
        header("Location: chat_to_specific_doctor.php?doctor_id={$doctor_id}");
        exit();
    } else {
        echo "ERROR";
    }
}

// Get doctor data
$doctor_all_data = doctor_data_byid($doctor_id);
$doctor_data = mysqli_fetch_assoc($doctor_all_data);
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

<h1>Chatting with <?php echo $doctor_data['username']; ?></h1>

<!-- Show previous messages -->
<?php
$status = show_conversation_consumer($consumer_id, $doctor_id);
while ($previous_conversation = mysqli_fetch_assoc($status)) {
    if ($previous_conversation['sent_by'] == 'consumer') {
        // Consumer message
        echo "<p><strong>You</strong>: " . $previous_conversation['message_text'] . "</p>";
    } else {
        // Doctor message
        echo "<p><strong>" . $doctor_data['username'] . "</strong>: " . $previous_conversation['message_text'] . "</p>";
    }
}
?>

<!-- Form to send new message -->
<form method="post" action="">
    <input type="hidden" name="doctor_id" value="<?php echo $doctor_id; ?>">
    <textarea name="message_text" rows="4" cols="50"></textarea>
    <br>
    <input type="submit" name="submit" value="Send">
</form>
<!-- <a href="consumer_show_doctors.php">ALL Doctors</a> -->

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


    
</style>
</html>
