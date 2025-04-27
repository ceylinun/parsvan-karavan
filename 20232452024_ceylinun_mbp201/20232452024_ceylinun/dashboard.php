<?php
session_start();

// Oturum kontrolü
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Veritabanı bağlantısı
$conn = new mysqli('localhost', 'ceylin', 'ceylin123', 'kullanici_sistemi');

if ($conn->connect_error) {
    die('Veritabanına bağlanılamadı: ' . $conn->connect_error);
}

// Tüm kullanıcıları çekmek için sorgu
$sql = 'SELECT kullanici_adi FROM kullanicilar';
$result = $conn->query($sql);

// Kullanıcı adı oturumdan alınır
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Paneli</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 600px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        table th {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color:#0056b3;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hoş Geldiniz, <?= htmlspecialchars($username) ?>!</h2>
        <p>Aşağıda tüm kayıtlı kullanıcılar listelenmiştir:</p>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Kullanıcı Adı</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['kullanici_adi']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Henüz kayıtlı kullanıcı yok.</p>
        <?php endif; ?>

        <a href="logout.php">Çıkış Yap</a>
    </div>
</body>
</html>

<?php $conn->close(); ?>
