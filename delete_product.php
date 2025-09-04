<?php include 'config.php'; ?>
<?php if(!isset($_SESSION['user']) || $_SESSION['user']['role']!=='supplier'){ header('Location: login.php'); exit; }
$id=intval($_GET['id'] ?? 0);
$mysqli->query("DELETE FROM products WHERE id=$id AND supplier_id=".$_SESSION['user']['id']);
header('Location: dashboard.php');
exit;
?>
