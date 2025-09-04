<?php include 'header.php'; ?>
<?php
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];
    $company = $_POST['company_name'] ?? '';
    $gst = $_POST['gst'] ?? '';
    $address = $_POST['address'] ?? '';
    $contact = $_POST['contact'] ?? '';
    $stmt = $mysqli->prepare("INSERT INTO users(name,email,password,role,company_name,gst_number,address,contact) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param('ssssssss',$name,$email,$pass,$role,$company,$gst,$address,$contact);
    $stmt->execute();
    echo '<div class="alert alert-success">Registration successful. <a href="login.php">Login</a></div>';
}
?>
<h2>Register</h2>
<form method="post">
  <div class="mb-3"><label class="form-label">Name</label><input type="text" name="name" class="form-control" required></div>
  <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
  <div class="mb-3"><label class="form-label">Password</label><input type="password" name="password" class="form-control" required></div>
  <div class="mb-3"><label class="form-label">Role</label>
    <select name="role" class="form-select">
      <option value="buyer">Buyer</option>
      <option value="supplier">Supplier</option>
    </select>
  </div>
  <div class="mb-3"><label class="form-label">Company Name</label><input type="text" name="company_name" class="form-control"></div>
  <div class="mb-3"><label class="form-label">GST Number</label><input type="text" name="gst" class="form-control"></div>
  <div class="mb-3"><label class="form-label">Address</label><input type="text" name="address" class="form-control"></div>
  <div class="mb-3"><label class="form-label">Contact</label><input type="text" name="contact" class="form-control"></div>
  <button type="submit" class="btn btn-primary">Register</button>
</form>
<?php include 'footer.php'; ?>
