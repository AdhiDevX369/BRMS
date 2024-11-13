
<?php
    session_start();
    include('vendor/inc/config.php');
    if(isset($_POST['Usr-login']))
    {
      $u_email=$_POST['u_email'];
      $u_pwd=($_POST['u_pwd']);
      $stmt=$mysqli->prepare("SELECT u_email, u_pwd, u_id FROM tms_user WHERE u_email=? and u_pwd=? ");
      $stmt->bind_param('ss',$u_email,$u_pwd);
      $stmt->execute();
      $stmt -> bind_result($u_email,$u_pwd,$u_id);
      $rs=$stmt->fetch();
      $_SESSION['u_id']=$u_id;
      $_SESSION['login']=$uemail;
      $uip=$_SERVER['REMOTE_ADDR'];
      $ldate=date('d/m/Y h:i:s', time());
      if($rs)
      {
        $uid=$_SESSION['u_id'];
        $uemail=$_SESSION['login'];
        $ip=$_SERVER['REMOTE_ADDR'];
        $geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip;
        $addrDetailsArr = unserialize(file_get_contents($geopluginURL));
        $city = $addrDetailsArr['geoplugin_city'];
        $country = $addrDetailsArr['geoplugin_countryName'];
        $log="insert into userLog(u_id, u_email, u_ip, u_city, u_country) values('$uid','$uemail','$ip','$city','$country')";
        $mysqli->query($log);
        if($log)
        {
         header("location:user-dashboard.php");
         }
        }
      else
      {
      #echo "<script>alert('Access Denied Please Check Your Credentials');</script>";
      $error = "Access Denied Please Check Your Credentials";
      }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Vehicle Booking System - Client Login</title>

  
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  
  <link href="vendor/css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Client Login Panel</div>
      <div class="card-body">
        
          <?php if(isset($error)) {?>
          
              <script>
                    setTimeout(function () 
                    { 
                      swal("Failed!","<?php echo $error;?>!","error");
                    },
                      100);
              </script>
                  
          <?php } ?>
        <form method ="POST">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" name="u_email" id="inputEmail" class="form-control"  required="required" autofocus="autofocus">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="u_pwd" id="inputPassword" class="form-control"  required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <input type="submit" name="Usr-login" class="btn btn-success btn-block" value="Login">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="usr-register.php">Register an Account</a>
          <a class="d-block small" href="usr-forgot-password.php">Forgot Password?</a>
          <a class="d-block small" href="../index.php">Home</a>
        </div>
      </div>
    </div>
  </div>

  
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
 
 <script src="vendor/js/swal.js"></script>

</body>

</html>
