<?php
session_start();
if(isset($_COOKIE['doctor_logged_flag']))
{
    setcookie('doctor_logged_flag',true,time()+400,'/');
    require_once "../models/doctor_user_model.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a Blog</title>
</head>
<body >

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
<fieldset style="width: 600px; margin:auto" > 
    <legend align="center">

        <h2>Contribute to the world by your knowledge </h2>
    </legend>

    <table align="center">
        <form action="../Controllers/blog_make.php" onsubmit= "return formValidate()" >
            
            
            <tr>
                <td>
                    Title:
                </td>
                <td>
                    <input type="text" name="title" id="title">
                </td>
            </tr>
            <tr>
                
             <td>
                 <input type="hidden" name="author" value= " <?php
                 require_once "../models/doctor_user_model.php";
                            $con = getconnection();
                            $sql = "SELECT * FROM doctor_user WHERE email = '{$_SESSION['doctor_id']}'";
                            $status = mysqli_query($con , $sql);
                            $result = mysqli_fetch_assoc($status);
                            echo $result['id'];
           ?>
           ">
                </td>
            </tr>
            <tr>
                <td>
                    Category:
                </td>
                <td>
                    <!-- <input type="text" name="category" id=""> -->
                    <select name="category" id="">
                        <option value="">Select a Category</option>
                        <option value="Nutrition">Nutrition</option>
                        <option value="Mental Health">Mental Health</option>
                        <option value="Diabetes">Diabetes</option>
                        <option value="Pregnancy">Pregnancy</option>
                        <option value="Prostate">Prostate</option>
                        <option value="Cancer">Cancer</option>
                        <option value="Heart">Heart</option>
                        <option value="Digestion">Digestion</option>
                        <option value="Addiction">Addiction</option>
                        <option value="Dermatology">Dermatology</option>
                        <option value="Reproduction">Reproduction</option>
                        <option value="Sleep">Sleep</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Content:
                </td>
                <td>
                    <textarea type="text" name="content" id="content"> </textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="submit" value="POST" id="">
                </td>
            </tr>
            <tr>
                <td colspan='2' align='center'>
                    <?php
                    if (isset($_SESSION['msg']))
                    {
                        echo $_SESSION['msg'];
                        unset ($_SESSION['msg']);
                    }
                    
                    ?>

                </td>
            </tr>
        </table>
    </form>
    </fieldset> 
   <div align="center">
    <h2>
        Posts by Dr  <?php

                        $con = getconnection();
                        $sql = "SELECT * FROM doctor_user WHERE email = '{$_SESSION['doctor_id']}'";
                        $status = mysqli_query($con , $sql);
                        $result = mysqli_fetch_assoc($status);
                        $doctor_name=  $result['username'];
                        echo $doctor_name;
                        ?>
    </h2>
    <?php
    require_once "../models/blog_model.php";
    $current_doc_id = $result['id'];
    $show = doctor_own_posts($current_doc_id);
    while ($result = mysqli_fetch_assoc ($show))
    {
        
        ?>
            <!-------------------------------Posts By the logged in doctors shows here---------------------- --> 
        <div style= "border-style :solid;">
    <h3>
        
       <?php
        echo $result['title'];
        ?>
    </h3>
    
    <h4>
        Author : <?php
       echo $doctor_name;
       ?> 
    </h4>
    <small> Category:  <?php
        echo $result['category'];
        ?>
     </small>
    <p>
        <?php
        echo $result['content'];
        
        ?>
        <!-------------------------------edit the blog-------------->
            <form action="doctor_edit_post.php">
                <input type="hidden" name="blog_id" value="<?php echo $result['blog_id']?>" id="">
                <input type="submit" name="submit" value="Edit" class="button_size">
                
            </form>
        
        <form action="../Controllers/delete_content.php" method="POST">
            <input type="hidden" name="blog_id" value= <?php echo $result['blog_id']; ?>>
            <input type="submit" name="submit" value = "Delete" onclick="return confirm('Are you sure you want to delete this post?')"  class="button_size" >
        </form>
        <?php
        echo "<hr>";
        echo "</div>";
        echo "</br>";
    }
    ?>

<!-------------------------------Posts By the logged in doctors wnds here---------------------- --> 
    </p>
    
</div>

</body>
<script>
    function formValidate()
{
    console.log('form validation function called');
    let content = document.getElementById ('content').value;
    let title = document.getElementById('title').value;
    if (content =='' || title == '')
    {
        alert("Neither the CONTENT nor the TITLE can be empty to make a post !!! ");
        return false ; 
    }
    return true ; 
}


</script>
<?php
}
else 
{
    header("location:../home.html");
}
?>
<!-- Interal CSS starts here  -->
<style>
    body {
  background-color: #f2f2f2;
  font-family: Arial, sans-serif;
  margin: 0;
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

fieldset {
  background-color: #fff;
  border: 1px solid #ccc;
  margin-top: 50px;
  padding: 20px;
}

legend {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 20px;
  text-align: center;
}

table {
  border-collapse: collapse;
  margin: auto;
}

td {
  padding: 10px;
}

input[type="text"],
input[type="submit"],
select,
textarea {
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
  padding: 10px;
  
}

input[type="submit"] {
    
  background-color: #4CAF50;
  border: none;
  color: #fff;
  cursor: pointer;
  margin-top: 10px;
}

input[type="submit"]:hover {
  background-color: #3e8e41;
}

h2 {
  margin: 50px auto 20px;
  text-align: center;
}

.notification {
  background-color: #f2f2f2;
  border: 1px solid #ddd;
  border-left: 5px solid #4CAF50;
  color: #333;
  margin-bottom: 10px;
  padding: 10px;
}

.notification span {
  float: right;
  font-size: 14px;
  font-weight: bold;
}

.notification:hover {
  background-color: #ddd;
}


</style>
<!-- Interal CSS ends  here  -->
</html>
