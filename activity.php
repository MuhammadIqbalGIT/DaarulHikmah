<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Kegiatan</title>
    <style>
        /* Reset default browser styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #8DB255;
            margin: 0;
            padding-bottom: 50px;
            /* Tinggi footer */
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .activity {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 20px 0;
        }

        .activity-item {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Bayangan pada kartu */
            margin: 10px;
            width: 90%;
            /* Lebar kartu 90% dari lebar layar */
            max-width: 300px;
            /* Lebar maksimum kartu */
            overflow: hidden;
        }

        .activity-item img {
            border-radius: 10px 10px 0 0;
            /* Membuat sudut atas gambar melengkung */
            width: 100%;
            height: auto;
            object-fit: cover;
            /* Memastikan gambar terisi dengan baik */
        }

        .activity-item .content {
            padding: 20px;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        /* Slider Styles */
        .card {
            background-color: #8DB255;
            /* Warna latar belakang hijau */
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            width: 90%;
            /* Lebar kartu 90% dari lebar layar */
            max-width: 600px;
            /* Lebar maksimum kartu */
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Bayangan pada kartu */
            position: relative;
        }

        .slider {
            overflow: hidden;
            width: 100%;
            position: relative;
            margin-top: 20px;
        }

        .slider-container {
            display: flex;
            transition: transform 0.5s ease;
        }

        .slide {
            min-width: 100%;
        }

        img.slide-img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        /* Panah Navigasi */
        .prev,
        .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            font-size: 18px;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .prev {
            left: 20px;
        }

        .next {
            right: 20px;
        }

        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }
    </style>
</head>

<body>
    <header>
        <h1>Halaman Kegiatan</h1>
    </header>

    <!-- Kartu (Card) Slider -->
    <div class="card">
        <!-- Slider -->
        <div class="slider">
            <div class="slider-container">
                <div class="slide">
                    <img class="slide-img" src="image/kegiatan_bukber.jpg" alt="Kegiatan 1">
                    <div class="content">
                        <h2>Kegiatan 1</h2>
                        <p>Deskripsi kegiatan 1.</p>
                    </div>
                </div>
                <div class="slide">
                    <img class="slide-img" src="image/kbm_english_pesantren.jpg" alt="Kegiatan 2">
                    <div class="content">
                        <h2>Kegiatan 2</h2>
                        <p>Deskripsi kegiatan 2.</p>
                    </div>
                </div>
                <div class="slide">
                    <img class="slide-img" src="image/program_ziswaf.jpg" alt="Kegiatan 3">
                    <div class="content">
                        <h2>Kegiatan 3</h2>
                        <p>Deskripsi kegiatan 3.</p>
                    </div>
                </div>
            </div>
            <div class="prev" onclick="prevSlide()">&#10094;</div>
            <div class="next" onclick="nextSlide()">&#10095;</div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Pesantren Al-Hikmah. All rights reserved.</p>
    </footer>

    <script>
        let sliderContainer = document.querySelector('.slider-container');
        let slides = document.querySelectorAll('.slide');
        let index = 0;

        function slide() {
            index++;
            if (index === slides.length) index = 0;
            let offset = -index * 100;
            sliderContainer.style.transform = `translateX(${offset}%)`;
        }

        function prevSlide() {
            index--;
            if (index < 0) index = slides.length - 1;
            let offset = -index * 100;
            sliderContainer.style.transform = `translateX(${offset}%)`;
        }

        function nextSlide() {
            index++;
            if (index === slides.length) index = 0;
            let offset = -index * 100;
            sliderContainer.style.transform = `translateX(${offset}%)`;
        }

        setInterval(slide, 3000); // Change slide every 3 seconds
    </script>
</body>

</html>