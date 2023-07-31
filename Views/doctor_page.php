<?php
session_start();
if(isset($_COOKIE['doctor_logged_flag']))
{
   //including model files 
   require_once "../models/doctor_user_model.php";
   ?>
   <html>
<head>
    <title>
        Doctor Page 
    </title>
</head>
<body>
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
    <table>
        
    </table>
    
<h2 align="center">Welcome Dr. <?php
                        $con = getconnection();
                        $sql = "SELECT username FROM doctor_user WHERE email = '{$_SESSION['doctor_id']}'";
                        $status = mysqli_query($con , $sql);
                        $result = mysqli_fetch_assoc($status);
                        echo $result['username'];
     ?></h2>   
    <table border=1px>
        

<p align="center">
    <a href="doc_profile.php">Customize Your Profile</a> </br>
    <a href="blog_make_form.php">Write a Blog</a><br><br>
    <a href="doctor_messages.php">See Messages</a><br>
    <?php
                    //unread notifucation Number
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
    <a href="doctor_notification.php">Notification <span><?php echo $show_count ; ?></span></a> <br>
    <a href="../Controllers/logout_doctor.php">Logout</a>
    
    


</p>
</body>

<!-- Internal CSS starts HERE -->
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
body {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 16px;
  line-height: 1.5;
  color: #333;
  background-color: #f5f5f5;
}

/* Table Styles */
table {
  margin: 30px auto;
  border-collapse: collapse;
  border: 1px solid #ddd;
  background-color: #fff;
  width: 80%;
}

table th, table td {
  padding: 12px;
  text-align: center;
  border: 1px solid #ddd;
}

table th {
  background-color: #f2f2f2;
  font-weight: bold;
}


/* Heading Styles */
h2 {
  margin: 50px 0 30px;
  text-align: center;
}

/* Link Styles */
a {
  color: #333;
  text-decoration: none;
  font-weight: bold;
  transition: all 0.3s ease;
}

a:hover {
  color: #777;
}


</style> 
<!-- Internal CSS ENDS HERE -->
   </html>      

<?php
}
else 
{
    header("location:../home.html");
}
?>

