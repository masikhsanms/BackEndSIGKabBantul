
    <style type="text/css">
        h4{
            text-align: center;
            padding-top: 30px;
        }
        p{
            text-align: center;
        }

    </style>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">

<?php
    require_once('config/koneksi.php');
    require_once('model/database.php');
    // ob_start();
    session_start();
    $connection = new Database ($host, $user, $pass, $database);

    // If form submitted, insert values into the database.
    if (isset($_POST['username'])){
        
        $username = stripslashes($_REQUEST['username']); // removes backslashes
        $username = mysqli_real_escape_string($connection->con,$username); //escapes special characters in a string
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($connection->con,$password);
        
    //Checking is user existing in the database or not
        $query = "SELECT * FROM tb_admin WHERE username='$username' and password='".md5($password)."'";
        $result = mysqli_query($connection->con,$query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if($rows==1){
            $_SESSION['username'] = $username;
            header("Location: index.php"); // Redirect user to index.php
            }else{
                echo "<div class='container'>
                <h4>Username atau Password Salah Silahkan Coba Lagi.</h4><br/>
                <p>Click here to <a href='form_login.php'>Login</a></p></div>";
                }
    }else{
?>

    <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
<!--                         <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
 -->                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form"  action="" method="POST" onsubmit="return validasi()">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username or email">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                                    </div>
                                    

                                
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                    <input type="submit" class="btn btn-success" name="login" value="Login"></input>
                              
                                    </div>
                                </div>
                            </form>     
                       </div>                     
                    </div>  
        </div>
        
    <script type="text/javascript">
        function validasi(){
            var username = document.getElementByid("username").value;
            var password = document.getElementByid("password").value;
        if (username != "" && password !="") {
            return true;
            }else{
                alert('username dan password Harus di isi');
                return false;
            }
        }
    </script>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <?php } ?>