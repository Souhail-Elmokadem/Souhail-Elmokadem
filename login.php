<?php
session_start();
    if(isset($_SESSION['user'])){
        header('Location:dashbord/index.php');
    }else{

    
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Login 07</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
							<div class="text w-100">
								<h2>Welcome to login</h2>
								<p>Don't have an account?</p>
								<a href="#" class="btn btn-white btn-outline-white">Sign Up</a>
							</div>
			      </div>
						<div class="login-wrap p-4 p-lg-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign In</h3>
			      		</div>
							
			      	</div>
							<form action="#" class="signin-form">
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Username</label>
			      			<input type="text" class="form-control" placeholder="Username" required>
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" class="form-control" placeholder="Password" required>
		            </div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
			            	<label class="checkbox-wrap checkbox-primary mb-0">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
										</label>
									</div>
									<div class="w-50 text-md-right">
										<a href="#">Forgot Password</a>
									</div>
		            </div>
		          </form>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>




    <?php
    $con = new PDO("mysql:host=localhost;dbname=latecoere;port=3306;charset=utf8",'root','');
    if(isset($_POST["send"]))
        {
            try{
                if (filter_var($_POST["username"], FILTER_VALIDATE_EMAIL)) {
            $username =strip_tags($_POST["username"]);
            $password =strip_tags($_POST["password"]);
            $sql = "SELECT * FROM `users` WHERE `Email`='$username' and `password`='$password'";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $lin = $stmt->rowCount();
            $arr = $stmt->fetch();
            if($lin>0){
                $_SESSION['id']=$arr[0];
                $_SESSION['nom'] = $arr[1];
                $_SESSION['role'] = $arr[5];
                $_SESSION['nicknom']=$arr[2];
                $_SESSION['job']=$arr[6];
                $_SESSION['img']=$arr[7];
                $_SESSION['user'] = $username;
                $_SESSION['pass'] = $password;
            if(isset($_POST["checkcookie"]))
            {
                setcookie('user',$username,time()+365*24*3600);
                setcookie('pass',$password,time()+365*24*3600);
            }
                echo "connecting...";
                 
                header('refresh:1;url=dashbord/index.php');
                }else{
                    echo "user ou pass incorrect";
                }
            }else{
                echo "email format incorrect";   
            }
        }catch(PDOException $E)
        {
            die("data incorrect");
        }
            
            
        }
    
    ?>

 







<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>
<?php } ?>