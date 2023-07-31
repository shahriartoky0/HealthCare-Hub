<?php
session_start();
if(isset($_COOKIE['doctor_logged_flag']))
{
    setcookie('doctor_logged_flag',true,time()+400,'/');
    require_once "../models/blog_model.php";
    require_once "../models/notifications_model.php";
    require_once "../models/doctor_user_model.php";
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


<?php
    $blog_id = $_REQUEST['blog_id'];

    $post = ['blog_id'=>$blog_id];
    $show_post = show_doctor_post($post);
    ?>
    <form action="../Controllers/doctor_edit_post_contorller.php">

        <input type="hidden" name="blog_id" value=<?php echo $blog_id ?> id="">
        <h2>Title : </h2>
        <input type="text" name="title" value="<?php echo $show_post['title'] ?>" id="">
        <br>
        <h3>Content : </h3>
        <textarea name="content" rows="10" cols="50" id=""><?php echo $show_post['content'] ?></textarea>
        <br> <br>
        <input type="submit" name="submit" Value="Update" onclick="return confirm('Are you sure you want to make this changes !')" id="">
    </form>
        


    <?php
}
else 
{
    header("location:../home.html");
}
?>
<!-- Internal CSS starts here -->
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

form {
  margin-top: 50px;
}

form h2, form h3 {
  margin-bottom: 10px;
}

form input[type="text"], form textarea {
  display: block;
  margin-bottom: 20px;
  padding: 10px;
  width: 100%;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
}

form input[type="submit"] {
  background-color: #333;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 4px;
  font-size: 18px;
  cursor: pointer;
}

form input[type="submit"]:hover {
  background-color: #666;
}

a {
  display: block;
  margin-top: 20px;
  color: #333;
  text-decoration: none;
}

a:hover {
  color: #666;
}

</style>
<!-- Internal CSS ends here -->

</html>
