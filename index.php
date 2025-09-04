<?php include 'header.php'; ?>

<div id="banner" class="carousel slide mb-4" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active"><img src="https://via.placeholder.com/1200x300?text=Banner+1" class="d-block w-100" alt="Banner 1"></div>
    <div class="carousel-item"><img src="https://via.placeholder.com/1200x300?text=Banner+2" class="d-block w-100" alt="Banner 2"></div>
    <div class="carousel-item"><img src="https://via.placeholder.com/1200x300?text=Banner+3" class="d-block w-100" alt="Banner 3"></div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#banner" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#banner" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<h2 class="mb-3">Categories</h2>
<div class="row">
<?php $cats = $mysqli->query("SELECT * FROM categories LIMIT 8"); ?>
<?php while($cat = $cats->fetch_assoc()): ?>
  <div class="col-md-3 mb-3">
    <div class="card h-100">
      <img src="<?= htmlspecialchars($cat['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($cat['name']) ?>">
      <div class="card-body text-center">
        <h5 class="card-title"><?= htmlspecialchars($cat['name']) ?></h5>
      </div>
    </div>
  </div>
<?php endwhile; ?>
</div>

<h2 class="mb-3">Featured Products</h2>
<div class="row">
<?php $prods = $mysqli->query("SELECT p.*, u.company_name FROM products p JOIN users u ON p.supplier_id=u.id WHERE p.approved=1 LIMIT 6"); ?>
<?php while($p = $prods->fetch_assoc()): ?>
  <div class="col-md-3 mb-3">
    <div class="card h-100">
      <img src="<?= htmlspecialchars($p['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($p['name']) ?>">
      <div class="card-body">
        <h5 class="card-title"><?= htmlspecialchars($p['name']) ?></h5>
        <p class="card-text">From <?= htmlspecialchars($p['company_name']) ?></p>
        <a href="product_detail.php?id=<?= $p['id'] ?>" class="btn btn-primary">View</a>
      </div>
    </div>
  </div>
<?php endwhile; ?>
</div>

<h2 class="mb-3">Featured Suppliers</h2>
<div class="row">
<?php $sups = $mysqli->query("SELECT id, company_name, logo FROM users WHERE role='supplier' LIMIT 4"); ?>
<?php while($s = $sups->fetch_assoc()): ?>
  <div class="col-md-3 mb-3 text-center">
    <img src="<?= htmlspecialchars($s['logo']) ?>" alt="<?= htmlspecialchars($s['company_name']) ?>" class="img-fluid mb-2" style="max-height:100px;">
    <h5><?= htmlspecialchars($s['company_name']) ?></h5>
    <a href="supplier.php?id=<?= $s['id'] ?>" class="btn btn-sm btn-outline-primary">View Profile</a>
  </div>
<?php endwhile; ?>
</div>

<?php include 'footer.php'; ?>
