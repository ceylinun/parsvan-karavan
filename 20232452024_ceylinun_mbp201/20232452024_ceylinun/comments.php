<?php
// Veritabanı bağlantısı
$host = 'localhost';
$dbname = 'comment';  // Veritabanı adını kontrol edin
$username = 'ceylin';
$password = 'ceylin123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Bağlantı başarılı!";  // Bağlantıyı kontrol etmek için (isteğe bağlı)
} catch (PDOException $e) {
    die("Veritabanı bağlantısı başarısız: " . $e->getMessage());
}

// Formdan gelen verileri al
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'];
    $user_name = htmlspecialchars($_POST['user_name']);
    $comment_text = htmlspecialchars($_POST['comment_text']);

    // Veritabanına kaydet
    $sql = "INSERT INTO comment (post_id, user_name, comment_text) VALUES (:post_id, :user_name, :comment_text)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':post_id' => $post_id,
        ':user_name' => $user_name,
        ':comment_text' => $comment_text,
    ]);
}

// Yorumları veritabanından çek
$sql = "SELECT user_name, comment_text, created_at FROM comment WHERE post_id = :post_id ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([':post_id' => 1]);  // Burada post_id'yi istediğiniz gönderinin ID'sine göre değiştirebilirsiniz.

$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Değişken adını $comments olarak düzelt
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yorumlar</title>
    <link rel="stylesheet" href="yorum.css">  <!-- CSS dosyasına bağlantı -->
</head>
<body>
    <div class="comment-form-container">
        <form action="comments.php" method="POST" class="comment-form">
            <input type="hidden" name="post_id" value="1"> <!-- Gönderi ID -->
            <label for="user_name">Adınız:</label>
            <input type="text" name="user_name" id="user_name" required>
            
            <label for="comment_text">Yorumunuz:</label>
            <textarea name="comment_text" id="comment_text" rows="5" required></textarea>
            
            <button type="submit">Yorum Yap</button>
        </form>
    </div>

    <div class="comments-container">
    <h2>Yorumlar:</h2>
    <?php foreach ($comments as $comment): ?>
        <div class="comment">
            <p><strong><?php echo htmlspecialchars($comment['user_name']); ?></strong> 
                (<?php echo $comment['created_at']; ?>)
            </p>
            <p><?php echo nl2br(htmlspecialchars($comment['comment_text'])); ?></p>
        </div>
        <hr>
    <?php endforeach; ?>
</div>

</body>
</html>
