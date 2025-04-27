<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kullanıcı seçimlerini alalım
    $model = $_POST['model'] ?? '';
    $length = $_POST['length'] ?? '';
    $rooms = $_POST['rooms'] ?? '';
    $veranda = $_POST['veranda'] ?? '';

    // Temel fiyatlar
    $base_price = 300000; // Örnek başlangıç fiyatı

    // Model fiyatlandırması
    switch ($model) {
        case 'Çekme Karavan':
            $base_price += 20000;
            break;
        case 'Motokaravan':
            $base_price += 50000;
            break;
        case 'Tiny House':
            $base_price += 30000;
            break;
        default:
            $base_price += 0;
    }

    // Uzunluk fiyatlandırması
    if ($length == '8') {
        $base_price += 10000;
    } elseif ($length == '9') {
        $base_price += 20000;
    } elseif ($length == '10') {
        $base_price += 30000;
    }

    // Oda sayısı fiyatlandırması
    if ($rooms == '1') {
        $base_price += 7000;
    } elseif ($rooms == '2') {
        $base_price += 14000;
    }

    // Veranda fiyatlandırması (boş bırakılırsa etkilenmez)
    if (!empty($veranda)) {
        $base_price += 5000;
    }

   // Hesaplanan fiyatı göster
   echo "<div class='calculated-price'>Hesaplanan Ortalama Fiyat: <strong>" . number_format($base_price, 2) . " TL</strong></div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Parsvan Karavan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
     <link rel="stylesheet" href="fiyat.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <div id="container">
        <div id="header">
            <div id="header-üst">
                <div id="yazi"> <h5>PARSVAN KARAVAN</h5> </div>
                <div id="logo"><a href="index.html"> <img src="resimler/logom.jpg" class="logo"> </a> </div>
            </div>
            <div id="header-alt">
                <div id="menü">
                    <div class="navbar-main">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                          <a class="navbar-brand" href="index.html">Anasayfa</a>
                          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                              <li class="nav-item active">
                                <a class="nav-link" href="#hakkimizda">Hakkımızda <span class="sr-only">(current)</span></a>
                              </li>
                              <li class="nav-item dropdown">
                                  <a class="nav-link dropdown-toggle" href="#kutucuklar-baslik" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Modeller
                                  </a>
                                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="https://www.sahibinden.com/karavan-cekme-karavan"  target="_blank"  >Çekme Karavan</a>
                                    <a class="dropdown-item" href="https://www.sahibinden.com/ilan/emlak-konut-satilik-hemen-teslim-en-buyuk-tiny-house-mobil-ev-super-fiyat-933642672/detay" target="_blank" >Tiny House</a>
                                    <a class="dropdown-item" href="https://www.sahibinden.com/karavan-motokaravan" target="_blank" >Motokaravan</a>
                                  </div>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="#blog" >Blog</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="#fiyat-al" >Fiyat Al</a>
                                </li>  
                                <li class="nav-item">
                                  <a class="nav-link" href="yorum.php" >Yorum Yap</a>
                                </li> 
                              <li class="nav-item">
                                <a class="nav-link" href="#footer">İletişim</a>
                              </li>    
                              <li class="nav-item">
                                  <a class="nav-link" href="kyaıt.php" >Giriş Yap</a>
                                </li> 
                               
                            </ul>
                          </div>
                        </nav>
                </div>
            </div>
        </div>
       
    </div>

    <div id="main">
    <div id="price">
    <form method="POST" action="">
            <label for="model">Model Seçiminiz:</label>
            <select name="model" id="model" required>
                <option value="">Seçiniz</option>
                <option value="Çekme Karavan">Çekme Karavan</option>
                <option value="Motokaravan">Motokaravan</option>
                <option value="Tiny House">Tiny House</option>
            </select>

            <label for="length">Uzunluk Seçiminiz:</label>
            <select name="length" id="length" required>
                <option value="">Seçiniz</option>
                <option value="8">8 Metre</option>
                <option value="9">9 Metre</option>
                <option value="10">10 Metre</option>
            </select>

            <label for="rooms">Oda Sayısı Seçiminiz:</label>
            <select name="rooms" id="rooms" required>
                <option value="">Seçiniz</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>

            <label for="veranda">Veranda:</label>
            <input type="text" name="veranda" id="veranda" placeholder="Var / Yok">

            <button type="submit">Fiyat Al</button>
        </form>






    </div>
    </div>


     <div id="iletişim">
      <div id="iletişim-sol">
        <div class="sağ"> <h4 class="iletişim-yazi">Bilgiler</h4>
          <ul>
            <li><i class="fa-solid fa-phone-flip">  0 552 519 3775</i></li>
            <li><i class="fa-brands fa-whatsapp">  Whatsapp</i></li>
            <li><i class="fa-regular fa-envelope"> ceeyliin1@gmail.com</i></li>
            <li><i class="fa-brands fa-instagram"> Instagram</i></li>
            <li><i class="fa-solid fa-location-dot"> İzmir / Balcova</i></li>
           
          </ul></div>
      </div>
      <div id="iletişim-sağ">
        <div class="sağ">
          <h4 class="iletişim-yazi">İletişim Formu</h4>
          <form action="mail.php" method="post">
          <label class=" ilk">Adınız Soyadınız:</label><br><input name="fullname" type="text"  class="bir"   ><br><br>
          <label class=" ilk-1">Email Adresiniz:</label><br><input name="email" type="email"  class="iki"  ><br><br>
          <label class="msj" >Mesajınız:</label><br><textarea  name="message" class="mesaj" rows="3"  cols="50"></textarea>

          <button type ="submit"  class="şimdi">GÖNDER
           
          </button>
          </form>
        </div>
      </div>
     </div>
    <div id="footer">
      <div id="footer-üst"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.9789734962587!2d27.423409275876804!3d37.76709121260246!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14beba70b93d8185%3A0xd548ac03aa196ebe!2sNovada%20Outlet%20S%C3%B6ke!5e0!3m2!1str!2str!4v1710289529008!5m2!1str!2str" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
      <div id="footer-alt"><h3>PARSVAN KARAVAN</h3></div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>