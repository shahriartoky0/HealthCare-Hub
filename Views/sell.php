<?php 
if(isset($_COOKIE['provider_logged_flag']))
{
    session_start();
    require_once "../models/provider_user_model.php";

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
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
<form action="../Controllers/sell_check.php" method="post" enctype="multipart/form-data" onsubmit="return validate_form()">
    <h2 align="center">Enter the details of the medical equipment you want to sell:</h2>
    <table align="center">
        <tr>
            <td>
                <label for="item_name">Item Name:</label>
            </td>
            <td>
                <input type="text" name="item_name" id="name"><br>
            </td>
        </tr>
        <tr>
            <td>
                <label for="description">Description:</label>
            </td>
            <td>
                <textarea name="description" id="description"></textarea><br>
            </td>
        </tr>
        <tr>
            <td>
                <label for="price">Price:</label>
            </td>
            <td>
                <input type="number" name="price" id="price" ><br>
            </td>
        </tr>
        <tr>
            <td>
                <label for="quantity">Quantity:</label>
            </td>
            <td>
                <input type="number" name="quantity" id="quantity" ><br>
            </td>
        </tr>
        <tr>
            <td>
                <label for="image">Upload an Image:</label>
            </td>
            <td>
                <input type="file" name="picture" id="">
            </td>
        </tr>
        <tr>
            <td colspan=2 align="center">
                <?php
                
                if(isset($_SESSION['profile_customization_msg']))
                {
                    echo $_SESSION['profile_customization_msg'];
                    unset($_SESSION['profile_customization_msg']);
                }
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2" align='center'>
                <br><input type="submit" name="submit" value="Sell">
            </td>
        </tr>
    </table>
</form>

<script>
    function validate_form()
    {
        
        let name = document.getElementById ('name').value;
        let description = document.getElementById ('description').value;
        let price = document.getElementById ('price').value;
        let quantity = document.getElementById ('quantity').value;
        if (name =='' || description =='' || price =='' || quantity == '')
        {
            alert("Fill up the asked Information to submit a form to sell!");
            return false ; 
        }
        return true ;
    } 
</script>
    </body>
    <?php 
}
else 
{
    header("location:../home.html");
}

?>
<!-- Internal CSS starts here  -->
<style>
   /* Global styles */
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

/* Form styles */
form {
  max-width: 800px;
  margin: 2rem auto;
  padding: 1rem;
  border: 1px solid #ccc;
}

form h2 {
  text-align: center;
  margin-bottom: 2rem;
}

form label {
  display: block;
  margin-bottom: 0.5rem;
}

form input ,
form textarea {
  width: 100%;
  padding: 0.5rem;
  margin-bottom: 1rem;
  border: 1px solid #ccc;
}

form input[type="file"] {
  margin-top: 1rem;
}

form input[type="submit"] {
  background-color: #333;
  color: #fff;
  border: none;
  font-size: 20px;
  cursor: pointer;
}

form a {
  display: block;
  margin-top: 1rem;
  text-align: center;
}


</style>
<!-- Internal CSS ends here  -->
</html>
