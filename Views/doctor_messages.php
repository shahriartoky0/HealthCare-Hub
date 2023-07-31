<?php
if(isset($_COOKIE['doctor_logged_flag']))
{
require_once "../models/doctor_user_model.php";
require_once "../models/chat_model.php";
?>
<?php
session_start();
if (!isset($_SESSION['doctor_id'])) {
    header("Location: doctor_login.php");
    exit;
}
?>
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

<h2>SEE THE MESSAGES YOU RECIEVED</h2>
<?php
$user=['email'=> $_SESSION['doctor_id']];
$doctor_id = get_id($user);

//$doctor_id = $_SESSION['doctor_id'];
?>
<?php
$doctor_data = doctor_data_byid($doctor_id);
$doctor = mysqli_fetch_assoc($doctor_data);
?>
<?php
$messages = show_messages_to_doctor($doctor_id);
$current_consumer_id =  null;
while ($message = mysqli_fetch_assoc($messages)) {
    ?>
    <?php
    $con = getconnection();
    $sql = "SELECT * FROM consumer_user WHERE id = '{$message['consumer_id']}'";
    $status1= mysqli_query($con, $sql);
    $consumer = mysqli_fetch_assoc ($status1);
   // $consumer = mysqli_fetch_assoc(consmuer_data($message['consumer_id']));
   if ($message['sent_by']=='doctor')
   {
       echo "<p><strong>" . "YOU" . "</strong>: " . $message['message_text']. "</p>";

   }
   else 
   {
    echo "<p><strong>" . $consumer['username']. "</strong>: " . $message['message_text'] . "</p>";

   }
    /* Here the doctor can reply starts  */
    if ($current_consumer_id !== $message['consumer_id']) {
    ?>
        <hr>
    <form method="POST" action="../Controllers/doctor_messages_controller.php">
        <input type="hidden" name="doctor_id" value="<?php echo $doctor_id; ?>">
        <input type="hidden" name="consumer_id" value="<?php echo $message['consumer_id']; ?>">
        <textarea name="message"></textarea>
        <input type="submit" name="submit" value="Send">
    </form>
    
    <?php }
    $current_consumer_id = $message['consumer_id']; // update the current consumer ID
    ?>
    </div>

    <?php
    /* Here the doctor can reply ends */
}
?>
<?php
echo "<h1>Messages for Dr. " . $doctor['username'] . "</h1>";
echo "<table>";
echo "<tr><td>Doctor ID:</td><td>" . $doctor['id'] . "</td></tr>";
echo "<tr><td>Username:</td><td>" . $doctor['username'] . "</td></tr>";
echo "<tr><td>Expertise:</td><td>" . $doctor['expertise'] . "</td></tr>";
echo "</table>";

echo "<hr>";

while ($message = mysqli_fetch_assoc($messages)) {
  
    //$consumer = mysqli_fetch_assoc(consumer_data_byid($message['consumer_id']));
    echo "<p><strong>" . $consumer['username'] . "</strong>: " . $message['message_text'] . "</p>";
}
}
else 
{
    header("location:../home.html");
}
?>
<!-- Internal CSS Starts Here  -->
<style>
    h2
    {
        text-align: center;
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
body {
    background-color: #f2f2f2;
    font-family: Arial, sans-serif;
    margin: 0;
}
</style>
<!-- Internal CSS Ends Here --> 
</html>
