<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ramalan Hewan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Reset dan variabel */
        :root {
            --primary-color: #8B4513;
            --secondary-color: #D2691E;
            --accent-color: #FFD700;
            --warning-color: #8B0000;
            --good-color: #228B22;
            --bad-color: #4B0082;
            --light-color: #F5F5DC;
            --dark-color: #2F2F2F;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--dark-color);
            background-color: var(--light-color);
        }
        
        /* Layout dengan Flexbox */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header dan Navigasi */
        header {
            background-color: var(--primary-color);
            color: white;
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
        }
        
        .nav-links li {
            margin-left: 1.5rem;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .nav-links a:hover {
            color: var(--accent-color);
        }
        
        /* Main Content */
        main {
            padding: 2rem 0;
        }
        
        section {
            margin-bottom: 3rem;
            padding: 2rem;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        h1, h2, h3 {
            margin-bottom: 1rem;
            color: var(--primary-color);
        }
        
        /* Home Section */
        .prediction-form {
            max-width: 500px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        
        input[type="text"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        
        .bell-container {
            text-align: center;
            margin: 2rem 0;
        }
        
        .bell-icon {
            font-size: 3rem;
            color: var(--secondary-color);
            cursor: pointer;
            transition: transform 0.3s, color 0.3s;
        }
        
        .bell-icon:hover {
            transform: scale(1.1);
            color: var(--primary-color);
        }
        
        .ringing {
            animation: ring 0.5s ease-in-out infinite;
        }
        
        @keyframes ring {
            0% { transform: rotate(0deg); }
            25% { transform: rotate(15deg); }
            50% { transform: rotate(0deg); }
            75% { transform: rotate(-15deg); }
            100% { transform: rotate(0deg); }
        }
        
        .prediction-result {
            margin-top: 2rem;
            padding: 1.5rem;
            border-radius: 8px;
            text-align: center;
            display: none;
        }
        
        .warning {
            background-color: rgba(139, 0, 0, 0.1);
            border-left: 5px solid var(--warning-color);
        }
        
        .good {
            background-color: rgba(34, 139, 34, 0.1);
            border-left: 5px solid var(--good-color);
        }
        
        .bad {
            background-color: rgba(75, 0, 130, 0.1);
            border-left: 5px solid var(--bad-color);
        }
        
        /* Animal List Section */
        .animal-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .animal-card {
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .animal-card:hover {
            transform: translateY(-5px);
        }
        
        .animal-card.warning {
            border-top: 5px solid var(--warning-color);
        }
        
        .animal-card.good {
            border-top: 5px solid var(--good-color);
        }
        
        .animal-card.bad {
            border-top: 5px solid var(--bad-color);
        }
        
        .animal-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .animal-card.warning .animal-icon {
            color: var(--warning-color);
        }
        
        .animal-card.good .animal-icon {
            color: var(--good-color);
        }
        
        .animal-card.bad .animal-icon {
            color: var(--bad-color);
        }
        
        /* About Section */
        .about-content {
            max-width: 800px;
            margin: 0 auto;
        }
        
        /* Footer */
        footer {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 1.5rem 0;
            margin-top: 2rem;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                flex-direction: column;
                align-items: center;
            }
            
            .nav-links li {
                margin: 0.5rem 0;
            }
            
            .animal-list {
                grid-template-columns: 1fr;
            }
        .btn-add {
                background: var(--accent-color);
                color: var(--dark-color) !important;
                padding: 8px 14px;
                border-radius: 20px;
                font-weight: bold;
                transition: 0.3s;
            }

            .btn-add:hover {
                background: white;
                color: var(--primary-color) !important;
            }
        }
    </style>
</head>
<body>
    <!-- Header dengan navigasi -->
    <header>
        <div class="container">
            <nav>
            <div class="logo">Ramalan Hewan</div>
            <ul class="nav-links">
                <li><a href="#home">Beranda</a></li>
                <li><a href="#animals">Hewan Peramal</a></li>
                <li><a href="#about">Tentang</a></li>
                <li><a href="admin_panel.php" class="btn-add">Tambah Ramalan</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Konten utama -->
    <main class="container">
        <!-- Bagian Home -->
        <section id="home">
            <!-- Form untuk memasukkan nama -->
            <div class="prediction-form">
                <h2>Dapatkan Ramalan Anda</h2>
                <form id="predictionForm">
                    <div class="form-group">
                        <label for="name">Masukkan Nama Anda:</label>
                        <input type="text" id="name" name="name" placeholder="Nama Anda" required>
                    </div>
                </form>
                
                <!-- Ikon lonceng -->
                <div class="bell-container">
                    <i class="fas fa-bell bell-icon" id="bellIcon"></i>
                    <p>Klik lonceng untuk mendapatkan ramalan</p>
                </div>
                
                <!-- Hasil ramalan -->
                <div id="predictionResult" class="prediction-result">
                    <h3 id="predictionTitle">Ramalan untuk <span id="userName"></span></h3>
                    <p id="predictionText"></p>
                </div>
            </div>
        </section>

        <!-- Bagian Daftar Hewan Peramal -->
        <section id="animals">
            <h2>Hewan Peramal</h2>
            <p><strong>Dapatkan hewan ramalan misterius yang berisi ramalan yang berbeda!</strong></p>
            <p>Berikut adalah contoh tiga hewan yang memberikan ramalan dalam kisah ini</p>

            <div class="animal-list">
                <!-- Daftar hewan peramal -->
                <article class="animal-card warning">
                    <i class="fas fa-paw animal-icon"></i>
                    <h3>Rubah</h3>
                    <p>Rubah memberikan ramalan peringatan dan mengingatkan untuk berhati-hati.</p>
                </article>
                
                <article class="animal-card good">
                    <i class="fas fa-dove animal-icon"></i>
                    <h3>Merpati</h3>
                    <p>Merpati membawa ramalan tentang hal baik yang akan terjadi.</p>
                </article>
                
                <article class="animal-card bad">
                    <i class="fas fa-bug animal-icon"></i>
                    <h3>Lalat</h3>
                    <p>Lalat memberikan ramalan tentang hal buruk yang akan terjadi.</p>
                </article>
            </div>
        </section>

        <!-- Bagian Tentang -->
        <section id="about">
            <h2>Tentang</h2>
            <div class="about-content">
                <ul>
                    <li><strong>Ramalan hewan</strong> akan menafsirkan keberuntungan anda setelah memasukkan nama dan menekan ikon lonceng.
                </ul>
                <Li><strong>Semoga keberuntungan menyertai anda!</strong></ul>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2026 Ramalan Hewan - YoungZeus</p>
        </div>
    </footer>

    <script>
        // Elemen DOM
        const bellIcon = document.getElementById('bellIcon');
        const predictionForm = document.getElementById('predictionForm');
        const predictionResult = document.getElementById('predictionResult');
        const predictionTitle = document.getElementById('predictionTitle');
        const predictionText = document.getElementById('predictionText');
        const userName = document.getElementById('userName');
        const nameInput = document.getElementById('name');

        // Fungsi untuk memutar suara lonceng
        function playBellSound() {
            const audioContext = new (window.AudioContext || window.webkitAudioContext)();
            const oscillator = audioContext.createOscillator();
            const gainNode = audioContext.createGain();
            
            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);
            
            oscillator.type = 'sine';
            oscillator.frequency.value = 800;
            gainNode.gain.value = 0.1;
            
            oscillator.start();
            
            // Mengatur penurunan volume untuk efek fade out
            gainNode.gain.exponentialRampToValueAtTime(0.001, audioContext.currentTime + 1);
            oscillator.stop(audioContext.currentTime + 1);
        }

        // Event listener untuk ikon lonceng
        bellIcon.addEventListener('click', function() {
            // Validasi form
            if (!nameInput.value.trim()) {
                alert('Silakan masukkan nama Anda terlebih dahulu!');
                nameInput.focus();
                return;
            }
            
            // Menampilkan nama pengguna
            userName.textContent = nameInput.value;
            
            // Animasi lonceng
            bellIcon.classList.add('ringing');
            
            // Memutar suara lonceng
            playBellSound();
            
            // Mengambil ramalan acak setelah jeda
            setTimeout(() => {
                bellIcon.classList.remove('ringing');
                
    fetch("get_ramalan.php")
    .then(res => res.json())
    .then(data => {

        if (data.status !== "success") {
            alert(data.message);
            return;
        }

        predictionTitle.textContent = data.judul;
        predictionText.textContent = data.isi;
    });

    bellIcon.addEventListener('click', function()  {
    if (!nameInput.value.trim()) {
        alert('Silakan masukkan nama Anda terlebih dahulu!');
        return;
    }

    userName.textContent = nameInput.value;
    bellIcon.classList.add('ringing');
    playBellSound();

    setTimeout(() => {
        bellIcon.classList.remove('ringing');

        fetch("get_ramalan.php")
    .then(res => res.json())
    .then(data => {
        predictionTitle.textContent = data.judul;
        predictionText.textContent = data.isi;

        predictionResult.className = "prediction-result";

        // warna dari database
        predictionResult.style.borderLeft = "8px solid " + data.warna;
        predictionResult.style.backgroundColor = data.warna + "20";

        predictionResult.style.display = "block";
        predictionResult.scrollIntoView({ behavior: 'smooth' });
    });


    }, 1500);
});                
                // Scroll ke hasil ramalan
                predictionResult.scrollIntoView({ behavior: 'smooth' });
            }, 1500);
        });

        // Smooth scroll untuk navigasi
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
<a href="logout.php" class="logout-btn">Logout</a>

<style>
/* ===== tombol logout ===== */
.logout-btn {
    position: fixed;
    bottom: 30px;     /* pindah ke bawah */
    right: 30px;
    padding: 12px 20px;
    background: linear-gradient(135deg, #ff6b6b, #ff9f43);
    color: white;
    text-decoration: none;
    border-radius: 25px;
    font-weight: bold;
    box-shadow: 0 6px 14px rgba(0,0,0,0.25);
    transition: 0.3s;
    z-index: 999;
}

.logout-btn:hover {
    transform: scale(1.08);
}
.logout-btn:hover {
    background: linear-gradient(135deg, #ff9f43, #ff6b6b);
    transform: scale(1.05);
}

</style>
</body>
</html>