<?php
session_start();

// Veritabanı bağlantısı
$conn = new mysqli('localhost', 'ceylin', 'ceylin123', 'kullanici_sistemi');

if ($conn->connect_error) {
    die('Veritabanına bağlanılamadı: ' . $conn->connect_error);
}

// Mesaj değişkeni
$message = '';

// Giriş İşlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kullanıcıyı veritabanında arama
    $stmt = $conn->prepare('SELECT id, sifre FROM kullanicilar WHERE kullanici_adi = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            // Oturum başlatma ve yönlendirme
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            exit();
        } else {
            $message = 'Hatalı şifre!';
        }
    } else {
        $message = 'Kullanıcı bulunamadı!';
    }
    $stmt->close();
}

// Kayıt İşlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare('INSERT INTO kullanicilar (kullanici_adi, sifre) VALUES (?, ?)');
    $stmt->bind_param('ss', $username, $password);

    if ($stmt->execute()) {
        $message = 'Kayıt başarılı! Giriş yapabilirsiniz.';
    } else {
        $message = 'Kayıt başarısız! Kullanıcı adı zaten mevcut.';
    }   
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş ve Kayıt</title>
    <style>
        /* CSS kodu buraya aynı şekilde eklenebilir */
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
            width: 400px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: white;
            color: black;
        }

        .message {
            text-align: center;
            margin-top: 10px;
            color: #ff0000;
        }

        .switch-form {
            text-align: center;
            margin-top: 10px;
        }

        .switch-form a {
            color: #4CAF50;
            text-decoration: none;
            cursor: pointer;
        }

        .switch-form a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Giriş Yap ve Kayıt Ol</h2>
        <form method="POST">
            <div class="form-group">
                <label for="username">Kullanıcı Adı:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Şifre:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="login">Giriş Yap</button>
            </div>
            <div class="form-group">
                <button type="submit" name="register">Kayıt Ol</button>
            </div>
        </form>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    </div>
</body>
</html>