<?php include '../config.php'; ?>
<?php
if(!isset($_SESSION['user']) || $_SESSION['user']['role']!=='admin'){
    header('Location: admin_login.php');
    exit;
}
if(isset($_GET['approve'])){
    $id=intval($_GET['approve']);
    $mysqli->query("UPDATE products SET approved=1 WHERE id=$id");
}
if(isset($_GET['reject'])){
    $id=intval($_GET['reject']);
    $mysqli->query("DELETE FROM products WHERE id=$id");
}
if(isset($_POST['category'])){
    $name=$_POST['category'];
    $stmt=$mysqli->prepare("INSERT INTO categories(name) VALUES (?)");
    $stmt->bind_param('s',$name);
    $stmt->execute();
}
$pending=$mysqli->query("SELECT p.*, u.company_name FROM products p JOIN users u ON p.supplier_id=u.id WHERE p.approved=0");
$users=$mysqli->query("SELECT id,name,email,role FROM users WHERE role!='admin'");
$cats=$mysqli->query("SELECT * FROM categories");
$all=$mysqli->query("SELECT e.*, p.name as product, b.name as buyer, s.company_name as supplier FROM enquiries e JOIN products p ON e.product_id=p.id JOIN users b ON e.buyer_id=b.id JOIN users s ON e.supplier_id=s.id ORDER BY e.created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">
<h2>Admin Dashboard</h2>
<a href="../logout.php" class="btn btn-danger mb-3">Logout</a>
<h3>Pending Products</h3>
<table class="table"><tr><th>Name</th><th>Supplier</th><th>Actions</th></tr>
<?php while($p=$pending->fetch_assoc()): ?>
<tr><td><?= htmlspecialchars($p['name']) ?></td><td><?= htmlspecialchars($p['company_name']) ?></td><td><a href="?approve=<?= $p['id'] ?>" class="btn btn-sm btn-success">Approve</a> <a href="?reject=<?= $p['id'] ?>" class="btn btn-sm btn-danger">Reject</a></td></tr>
<?php endwhile; ?>
</table>
<h3>Add Category</h3>
<form method="post" class="mb-4">
  <div class="input-group"><input type="text" name="category" class="form-control" required><button class="btn btn-primary" type="submit">Add</button></div>
</form>
<h3>Categories</h3>
<ul>
<?php while($c=$cats->fetch_assoc()): ?><li><?= htmlspecialchars($c['name']) ?></li><?php endwhile; ?>
</ul>
<h3>Users</h3>
<table class="table"><tr><th>Name</th><th>Email</th><th>Role</th></tr>
<?php while($u=$users->fetch_assoc()): ?><tr><td><?= htmlspecialchars($u['name']) ?></td><td><?= htmlspecialchars($u['email']) ?></td><td><?= htmlspecialchars($u['role']) ?></td></tr><?php endwhile; ?>
</table>
<h3>Enquiries</h3>
<table class="table"><tr><th>Product</th><th>Buyer</th><th>Supplier</th><th>Message</th><th>Date</th></tr>
<?php while($e=$all->fetch_assoc()): ?><tr><td><?= htmlspecialchars($e['product']) ?></td><td><?= htmlspecialchars($e['buyer']) ?></td><td><?= htmlspecialchars($e['supplier']) ?></td><td><?= htmlspecialchars($e['message']) ?></td><td><?= htmlspecialchars($e['created_at']) ?></td></tr><?php endwhile; ?>
</table>
</body>
</html>
