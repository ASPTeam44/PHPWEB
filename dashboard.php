<?php include 'header.php'; ?>
<?php if(!isset($_SESSION['user'])){ header('Location: login.php'); exit; }
$user = $_SESSION['user'];
?>
<h2>Dashboard</h2>
<?php if($user['role']==='supplier'): ?>
  <a href="add_product.php" class="btn btn-success mb-3">Add Product</a>
  <?php $my = $mysqli->query("SELECT * FROM products WHERE supplier_id=".$user['id']); ?>
  <table class="table">
    <tr><th>Name</th><th>Price</th><th>MOQ</th><th>Actions</th></tr>
    <?php while($p=$my->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($p['name']) ?></td>
        <td><?= htmlspecialchars($p['price']) ?></td>
        <td><?= htmlspecialchars($p['moq']) ?></td>
        <td><a href="edit_product.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-primary">Edit</a> <a href="delete_product.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-danger">Delete</a></td>
      </tr>
    <?php endwhile; ?>
  </table>
<?php else: ?>
  <p>Welcome, browse <a href="products.php">products</a> and send enquiries.</p>
<?php endif; ?>
<?php include 'footer.php'; ?>
