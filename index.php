<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Film</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1 class="title">Web Pencarian Film</h1>
        </header>
        <main>
            <form method="post" action="index.php">
                <input type="text" name="judul" placeholder="Masukkan judul" required>
                <button type="submit" name="cari">Cari</button>
            </form>
            <?php
            if(isset($_POST['cari'])){
                $judul = $_POST['judul'];
                echo "<h2 class='subtitle'>Pencarian dari $judul</h2>";
                $url = 'http://www.omdbapi.com/?apikey=202bed7d&s="'.$judul.'"';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $output = curl_exec($ch);
                curl_close($ch);
                $data = json_decode($output, TRUE);
                foreach ($data['Search'] as $movie) {
                    echo "<div class='movie'>
                            <img src='".$movie['Poster']."' alt='".$movie["Title"]."'>
                            <div class='details'>
                                <h3>".$movie["Title"]."</h3>
                                <p>Tahun: ".$movie["Year"]."</p>
                            </div>
                        </div>";
                }
            }
            ?>
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>
