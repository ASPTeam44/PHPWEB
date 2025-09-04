<?php include 'header.php'; ?>
<?php
$id=intval($_GET['id'] ?? 0);
$p=$mysqli->query("SELECT p.*, u.company_name, u.id as supplier_id, u.contact FROM products p JOIN users u ON p.supplier_id=u.id WHERE p.id=$id AND p.approved=1")->fetch_assoc();
if(!$p){ die('Product not found'); }
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_SESSION['user']) && $_SESSION['user']['role']==='buyer'){
    $msg=$_POST['message'];
    $stmt=$mysqli->prepare("INSERT INTO enquiries(product_id,buyer_id,supplier_id,message,created_at) VALUES (?,?,?,?,NOW())");
    $stmt->bind_param('iiis',$id,$_SESSION['user']['id'],$p['supplier_id'],$msg);
    $stmt->execute();
    echo '<div class="alert alert-success">Enquiry sent.</div>';
}
?>
<div class="row">
  <div class="col-md-6"><img src="<?= htmlspecialchars($p['image']) ?>" class="img-fluid" alt="<?= htmlspecialchars($p['name']) ?>"></div>
  <div class="col-md-6">
    <h2><?= htmlspecialchars($p['name']) ?></h2>
    <p>Price: <?= htmlspecialchars($p['price']) ?></p>
    <p>MOQ: <?= htmlspecialchars($p['moq']) ?></p>
    <p><?= nl2br(htmlspecialchars($p['description'])) ?></p>
    <p>Supplier: <?= htmlspecialchars($p['company_name']) ?> (<?= htmlspecialchars($p['contact']) ?>)</p>
    <?php if(isset($_SESSION['user']) && $_SESSION['user']['role']==='buyer'): ?>
      <form method="post">
        <div class="mb-3"><textarea name="message" class="form-control" placeholder="Your enquiry" required></textarea></div>
        <button type="submit" class="btn btn-primary">Send Enquiry</button>
      </form>
    <?php else: ?>
      <a href="login.php" class="btn btn-primary">Login to contact supplier</a>
    <?php endif; ?>
  </div>
</div>
<?php include 'footer.php'; ?>
