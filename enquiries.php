<?php include 'header.php'; ?>
<?php if(!isset($_SESSION['user'])){ header('Location: login.php'); exit; }
$user=$_SESSION['user'];
if($user['role']==='supplier'){
  $ens=$mysqli->query("SELECT e.*, u.name as buyer, p.name as product FROM enquiries e JOIN users u ON e.buyer_id=u.id JOIN products p ON e.product_id=p.id WHERE e.supplier_id=".$user['id']);
  echo '<h2>Enquiries</h2><table class="table"><tr><th>Product</th><th>Buyer</th><th>Message</th><th>Date</th><th>Chat</th></tr>';
  while($e=$ens->fetch_assoc()){
    echo '<tr><td>'.htmlspecialchars($e['product']).'</td><td>'.htmlspecialchars($e['buyer']).'</td><td>'.htmlspecialchars($e['message']).'</td><td>'.htmlspecialchars($e['created_at']).'</td><td><a href="message.php?enquiry='.$e['id'].'" class="btn btn-sm btn-primary">Chat</a></td></tr>';
  }
  echo '</table>';
} else {
  $ens=$mysqli->query("SELECT e.*, u.company_name as supplier, p.name as product FROM enquiries e JOIN users u ON e.supplier_id=u.id JOIN products p ON e.product_id=p.id WHERE e.buyer_id=".$user['id']);
  echo '<h2>Your Enquiries</h2><table class="table"><tr><th>Product</th><th>Supplier</th><th>Message</th><th>Date</th><th>Chat</th></tr>';
  while($e=$ens->fetch_assoc()){
    echo '<tr><td>'.htmlspecialchars($e['product']).'</td><td>'.htmlspecialchars($e['supplier']).'</td><td>'.htmlspecialchars($e['message']).'</td><td>'.htmlspecialchars($e['created_at']).'</td><td><a href="message.php?enquiry='.$e['id'].'" class="btn btn-sm btn-primary">Chat</a></td></tr>';
  }
  echo '</table>';
}
include 'footer.php';
?>
