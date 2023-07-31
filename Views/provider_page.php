<?php
session_start();
if(isset($_COOKIE['provider_logged_flag'])){
    //including model files 
   require_once "../models/provider_user_model.php";
    
   ?>
   <html>
<head>
    <title>
        Provider Page 
    </title>
</head>
<body>
<!-- NAVBAR INCLUDES HERE  -->
<?php
            $email = $_SESSION['provider_id'];
            $image = provider_image($email);
            ?>
<nav>
	<ul>
		<img class="logo" src="../pictures/uploads-p/<?php echo $image ?>" height=80px width=80px alt="Logo">

	</ul>
                <ul>
                    
                    <li><a href="provider_page.php">Home</a></li>
                    <li><a href="pro_profile.php">Customize Your Profile</a></li>
                    <li><a href="sell.php">Sell Medical Equipment</a></li>
					<li><a href="show_provider_selling_products.php">My Products</a></li>
                    <li><a href="provider_own_sell.php">My Sold Products</a></li>
                    <?php
                    //unread notification Number
                    require_once "../models/notifications_model.php";
                    $user = ['email'=>$_SESSION['provider_id']];
                    $provider_id= get_id($user);
                    $client =['type'=>'provider', 'user_id'=>$provider_id];
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
                    <li><a href="provider_notification.php">Notifications <span><?php echo $show_count ; ?></span></a></li>
					<li><a href="../Controllers/logout_provider.php">Logout</a></li>
                </ul>
                <br>
               
            </nav>
<!-- NAVBAR ENDS HERE  -->
<table>
<tr>
    <td>

        <?php
         $provider=['email'=> $_SESSION['provider_id']];
         $result =  get_provider_alldata($provider);
    
      ?> 
        
    </td>
    <td>
    </td>
</tr>
        
    </table>
<h2 align="center">Welcome <?php 
                
                echo $result['username'];
     ?></h2>   
<p align="center">
<a href="pro_profile.php">Customize Your Profile</a> </br>
<a href="sell.php">Sell MEDICAL EQIPMENT</a><br>
<a href="provider_own_sell.php">My Sold Products</a><br>
<?php
                    //unread notifucation Number
                    require_once "../models/notifications_model.php";
                    $user = ['email'=>$_SESSION['provider_id']];
                    $provider_id= get_id($user);
                    $client =['type'=>'provider', 'user_id'=>$provider_id];
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
<a href="provider_notification.php">Notification<span><?php echo $show_count ; ?></span></a> <br>
<a href="show_provider_selling_products.php">My Products</a><br>
<a href="../Controllers/logout_provider.php">Logout</a>
</p>
</body>
<!-- Internal CSS starts HERE -->
<style>
   
   /* Internal CSS starts HERE */
   body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}
nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #f2f2f2;
  height: 80px;
  padding: 0 30px;
}

nav ul {
  display: flex;
  align-items: center;
  list-style: none;
}

nav li {
  margin-right: 30px;
}

nav li:last-child {
  margin-right: 0;
}

nav a {
  text-decoration: none;
  color: #333;
  font-weight: bold;
  font-size: 18px;
}

nav img.logo {
  margin-right: 20px;
  border-radius: 50%;
}

nav a:hover {
  color: #008080;
}

nav span {
  background-color: #008080;
  color: #fff;
  border-radius: 50%;
  padding: 5px 10px;
  margin-left: 5px;
  font-size: 12px;
}
/* navbar ends here  */

table {
  margin: 20px auto;
  border-collapse: collapse;
}

td {
  padding: 10px;
  vertical-align: top;
}

h2 {
  margin-top: 40px;
}

p {
  text-align: center;
  font-size: 18px;
  margin-top: 20px;
}

a {
  color: #333;
  text-decoration: none;
  font-weight: bold;
}


/* Internal CSS ENDS HERE */

		
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

