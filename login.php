<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "reporting_system");  
if(isset($_POST["login"])){  
    if(!empty($_POST["user_name"]) && !empty($_POST["user_password"])){
          $name = $_POST["user_name"];
          $password = $_POST["user_password"];
          $query = "SELECT * fROM user_master WHERE name = '" . $name . "' AND password = '" . md5($password) . "'";  
          $result = mysqli_query($conn,$query);  
          $user = mysqli_fetch_array($result);  
          if (mysqli_num_rows($result) == 1) {
            if(!empty($_POST["remember"])){  
                  setcookie ("user_name",$name,time()+ (10 * 365 * 24 * 60 * 60));  
                  setcookie ("user_password",$password,time()+ (10 * 365 * 24 * 60 * 60));
                       
            }else{
                if (isset($_COOKIE["user_name"])) {
                  setcookie("user_name", "");
                }
                if (isset($_COOKIE["user_password"])) {
                    setcookie("user_password", "");
                }
            }
            $_SESSION["name"] = $name;
            $_SESSION["password"] = $password;
            header("location:index.php"); 
          }else{  
              $message = "Invalid Login";  
         } 
    }else{
        $message = "Both are Required Fields";
    }
 }
?>
<!DOCTYPE html>
<html>
    <head>
          <title> Login </title>
          <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="header"> <h2> Login </h2> </div>
            <form method="post" action="">
                <div class="text-danger"><?php if(isset($message)) { echo $message; } ?></div>  
            	  <table>

                	    <tr class="input-group">
                  		    <td><label for="login"> User Name </label></td>
                  		    <td><input type="text" name="user_name" value="<?php if(isset($_COOKIE["user_name"])) { echo $_COOKIE["user_name"]; } ?>" required="required"></td>
                	    </tr>
                	    <tr class="input-group">
                  		    <td><label for="password"> Password </label></td>
                  		    <td><input type="password" name="user_password" value="<?php if(isset($_COOKIE["user_password"])) { echo $_COOKIE["user_password"]; } ?>" required="required"></td>
                	    </tr>
                      <tr class="input">
                          <td style="text-align: center;"><input type="checkbox" name="remember" class="remember" <?php if(isset($_COOKIE["user_name"])&&($_COOKIE["user_password"])) { ?> checked <?php } ?>></td>
                          <td><label for="remember-me">remember me</label></td>
                      </tr>
                      <tr class="input">
                          <td></td>
                          <td><label>forget password?</label></td>
                      </tr>
                	    <tr class="input-group">
                		      <td colspan="2" style="text-align: center;"><button type="submit" class="btn" name="login"> Login </button></td>
                	    </tr>
                </table>
            </form>
        </div>
    </body>
</html>