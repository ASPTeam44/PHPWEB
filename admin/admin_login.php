<?php include '../config.php'; ?>
<?php
if($_SERVER['REQUEST_METHOD']==='POST'){
    $email=$_POST['email'];
    $stmt=$mysqli->prepare("SELECT * FROM users WHERE email=? AND role='admin'");
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $res=$stmt->get_result();
    $user=$res->fetch_assoc();
    if($user && password_verify($_POST['password'],$user['password'])){
        $_SESSION['user']=$user;
        header('Location: admin_dashboard.php');
        exit;
    } else {
        $error='Invalid credentials';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">
<h2>Admin Login</h2>
<?php if(isset($error)) echo '<div class="alert alert-danger">'.$error.'</div>'; ?>
<form method="post">
  <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
  <div class="mb-3"><label class="form-label">Password</label><input type="password" name="password" class="form-control" required></div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>
</body>
</html>
