<?php include 'header.php'; ?>
<?php if(!isset($_SESSION['user']) || $_SESSION['user']['role']!=='supplier'){ header('Location: login.php'); exit; }
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name=$_POST['name'];
    $image=$_POST['image'];
    $price=$_POST['price'];
    $moq=$_POST['moq'];
    $desc=$_POST['description'];
    $cat=$_POST['category_id'];
    $stmt=$mysqli->prepare("INSERT INTO products(supplier_id,category_id,name,image,price,moq,description,approved) VALUES (?,?,?,?,?,?,?,0)");
    $stmt->bind_param('iissdis',$_SESSION['user']['id'],$cat,$name,$image,$price,$moq,$desc);
    $stmt->execute();
    echo '<div class="alert alert-success">Product added and awaiting approval.</div>';
}
$cats=$mysqli->query("SELECT * FROM categories");
?>
<h2>Add Product</h2>
<form method="post">
  <div class="mb-3"><label class="form-label">Name</label><input type="text" name="name" class="form-control" required></div>
  <div class="mb-3"><label class="form-label">Image URL</label><input type="text" name="image" class="form-control" required></div>
  <div class="mb-3"><label class="form-label">Price</label><input type="number" step="0.01" name="price" class="form-control" required></div>
  <div class="mb-3"><label class="form-label">MOQ</label><input type="number" name="moq" class="form-control" required></div>
  <div class="mb-3"><label class="form-label">Category</label><select name="category_id" class="form-select">
      <?php while($c=$cats->fetch_assoc()): ?>
      <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
      <?php endwhile; ?>
    </select></div>
  <div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control" required></textarea></div>
  <button type="submit" class="btn btn-primary">Save</button>
</form>
<?php include 'footer.php'; ?>
