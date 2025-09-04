<?php include 'header.php'; ?>
<?php
$id=intval($_GET['id'] ?? 0);
$s=$mysqli->query("SELECT * FROM users WHERE id=$id AND role='supplier'")->fetch_assoc();
if(!$s){ die('Supplier not found'); }
$prods=$mysqli->query("SELECT * FROM products WHERE supplier_id=$id AND approved=1");
?>
<h2><?= htmlspecialchars($s['company_name']) ?></h2>
<p>GST: <?= htmlspecialchars($s['gst_number']) ?></p>
<p>Address: <?= htmlspecialchars($s['address']) ?></p>
<p>Contact: <?= htmlspecialchars($s['contact']) ?></p>
<h3 class="mt-4">Products</h3>
<div class="row">
<?php while($p=$prods->fetch_assoc()): ?>
  <div class="col-md-3 mb-3">
    <div class="card h-100">
      <img src="<?= htmlspecialchars($p['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($p['name']) ?>">
      <div class="card-body">
        <h5 class="card-title"><?= htmlspecialchars($p['name']) ?></h5>
        <a href="product_detail.php?id=<?= $p['id'] ?>" class="btn btn-primary btn-sm">View</a>
      </div>
    </div>
  </div>
<?php endwhile; ?>
</div>
<?php include 'footer.php'; ?>
