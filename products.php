<?php include 'header.php'; ?>
<?php
$where = "WHERE approved=1";
if(!empty($_GET['category'])){
  $where .= " AND category_id=".intval($_GET['category']);
}
if(!empty($_GET['min'])){
  $where .= " AND price>=".floatval($_GET['min']);
}
if(!empty($_GET['max'])){
  $where .= " AND price<=".floatval($_GET['max']);
}
$cats = $mysqli->query("SELECT * FROM categories");
$prods = $mysqli->query("SELECT p.*, u.company_name FROM products p JOIN users u ON p.supplier_id=u.id $where");
?>
<h2>Products</h2>
<form class="row g-3 mb-3">
  <div class="col-md-3"><select name="category" class="form-select"><option value="">All Categories</option><?php while($c=$cats->fetch_assoc()): ?><option value="<?= $c['id'] ?>" <?= (($_GET['category'] ?? '')==$c['id'])?'selected':'' ?>><?= htmlspecialchars($c['name']) ?></option><?php endwhile; ?></select></div>
  <div class="col-md-2"><input type="number" step="0.01" name="min" class="form-control" placeholder="Min Price" value="<?= htmlspecialchars($_GET['min'] ?? '') ?>"></div>
  <div class="col-md-2"><input type="number" step="0.01" name="max" class="form-control" placeholder="Max Price" value="<?= htmlspecialchars($_GET['max'] ?? '') ?>"></div>
  <div class="col-md-2"><button class="btn btn-primary" type="submit">Filter</button></div>
</form>
<div class="row">
<?php while($p=$prods->fetch_assoc()): ?>
  <div class="col-md-3 mb-3">
    <div class="card h-100">
      <img src="<?= htmlspecialchars($p['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($p['name']) ?>">
      <div class="card-body">
        <h5 class="card-title"><?= htmlspecialchars($p['name']) ?></h5>
        <p class="card-text">Price: <?= htmlspecialchars($p['price']) ?></p>
        <a href="product_detail.php?id=<?= $p['id'] ?>" class="btn btn-primary">View</a>
      </div>
    </div>
  </div>
<?php endwhile; ?>
</div>
<?php include 'footer.php'; ?>
