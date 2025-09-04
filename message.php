<?php include 'header.php'; ?>
<?php if(!isset($_SESSION['user'])){ header('Location: login.php'); exit; }
$id=intval($_GET['enquiry'] ?? 0);
$enq=$mysqli->query("SELECT * FROM enquiries WHERE id=$id")->fetch_assoc();
if(!$enq || ($enq['buyer_id']!=$_SESSION['user']['id'] && $enq['supplier_id']!=$_SESSION['user']['id'])){ die('Access denied'); }
if($_SERVER['REQUEST_METHOD']==='POST'){
    $msg=$_POST['message'];
    $stmt=$mysqli->prepare("INSERT INTO messages(enquiry_id,sender_id,message,created_at) VALUES (?,?,?,NOW())");
    $stmt->bind_param('iis',$id,$_SESSION['user']['id'],$msg);
    $stmt->execute();
}
$msgs=$mysqli->query("SELECT m.*, u.name FROM messages m JOIN users u ON m.sender_id=u.id WHERE enquiry_id=$id ORDER BY m.created_at");
?>
<h2>Conversation</h2>
<div class="border p-3 mb-3" style="height:300px; overflow-y:scroll;">
<?php while($m=$msgs->fetch_assoc()): ?>
  <p><strong><?= htmlspecialchars($m['name']) ?>:</strong> <?= htmlspecialchars($m['message']) ?> <em><?= htmlspecialchars($m['created_at']) ?></em></p>
<?php endwhile; ?>
</div>
<form method="post">
  <div class="input-group">
    <input type="text" name="message" class="form-control" placeholder="Type message" required>
    <button class="btn btn-primary" type="submit">Send</button>
  </div>
</form>
<?php include 'footer.php'; ?>
