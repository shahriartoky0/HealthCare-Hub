<?php
if(isset($_COOKIE['doctor_logged_flag']))
{
    session_start();
    require_once "../models/doctor_user_model.php";
    require_once "../models/notifications_model.php";
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
    <u><h1>Your Notifications</h1></u>
    <?php
    $user =['email'=> $_SESSION['doctor_id']];
    $doctor_id = get_id($user);
    $notice = ['type'=> 'doctor', 'user_id'=> $doctor_id];
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
    $status = ['user'=>'doctor', 'user_id'=> $doctor_id]; 
    update_doctor_read_status($status);
    

}
else 
{
    header("location:../home.html");
}

?>
<!-- INTERNAL CSS STRATS HERE  -->
<style>
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
/* Style for the main content */
h1 {
  margin-top: 100px;
  text-align: center;
  font-size: 36px;
}

h2 {
  font-size: 24px;
  margin-top: 30px;
}

div {
  margin-top: 10px;
  padding-left : 5px;
  border-style: groove;
  border-color: coral;
  border-width: 2px;
}
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f5f5f5;
}

</style>
<!-- INTERNAL CSS ENDS HERE  -->
</html>