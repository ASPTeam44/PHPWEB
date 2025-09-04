<?php include 'header.php'; ?>
<?php $sups=$mysqli->query("SELECT id, company_name, logo, address FROM users WHERE role='supplier'"); ?>
<h2>Suppliers</h2>
<div class="row">
<?php while($s=$sups->fetch_assoc()): ?>
  <div class="col-md-3 mb-3 text-center">
    <img src="<?= htmlspecialchars($s['logo']) ?>" alt="<?= htmlspecialchars($s['company_name']) ?>" class="img-fluid mb-2" style="max-height:100px;">
    <h5><?= htmlspecialchars($s['company_name']) ?></h5>
    <p><?= htmlspecialchars($s['address']) ?></p>
    <a href="supplier.php?id=<?= $s['id'] ?>" class="btn btn-outline-primary btn-sm">View</a>
  </div>
<?php endwhile; ?>
</div>
<?php include 'footer.php'; ?>
