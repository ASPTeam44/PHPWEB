<?php include 'header.php'; ?>
<?php
if($_SERVER['REQUEST_METHOD']==='POST'){
    $email = $_POST['email'];
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    if($user && password_verify($_POST['password'],$user['password'])){
        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
        exit;
    } else {
        echo '<div class="alert alert-danger">Invalid credentials</div>';
    }
}
?>
<h2>Login</h2>
<form method="post">
  <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
  <div class="mb-3"><label class="form-label">Password</label><input type="password" name="password" class="form-control" required></div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>
<?php include 'footer.php'; ?>
