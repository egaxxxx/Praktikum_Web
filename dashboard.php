<?php
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => false,
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$action = $_GET['action'] ?? '';
$message = $_GET['message'] ?? '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Informasi RT 05</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #ddd;
        }
        
        .welcome-message {
            font-size: 1.2rem;
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .logout-link {
            background-color: #dc3545;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        
        .logout-link:hover {
            background-color: #c82333;
        }
        
        .dashboard-content {
            background: var(--card-bg);
            padding: 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 2rem;
        }
        
        .notification {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: var(--border-radius);
            font-weight: 600;
        }
        
        .notification.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .notification.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        body.dark-mode .notification.success {
            background-color: #284d28;
            color: #d4edda;
            border-color: #3d7a3d;
        }
        
        body.dark-mode .notification.error {
            background-color: #55282a;
            color: #f8d7da;
            border-color: #7d3f42;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: var(--card-bg);
            padding: 1.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0.5rem 0;
        }
        
        .stat-label {
            font-size: 1rem;
            color: var(--secondary-color);
        }
        
        .recent-activities {
            margin-top: 2rem;
        }
        
        .activity-list {
            list-style: none;
        }
        
        .activity-item {
            padding: 1rem;
            margin-bottom: 0.5rem;
            background: var(--background-color);
            border-radius: var(--border-radius);
            display: flex;
            justify-content: space-between;
        }
        
        body.dark-mode .activity-item {
            background: #333;
        }
        
        .back-link {
            text-align: center;
            margin-top: 1rem;
        }
        
        .back-link a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <a href="dashboard.php" class="logo"><strong>Dashboard Admin RT 05</strong></a>
                <ul>
                    <li><a href="#dashboard-content">Ringkasan</a></li>
                    <li><a href="#pengumuman">Kelola Pengumuman</a></li>
                    <li><a href="#jadwal">Kelola Kegiatan</a></li>
                    <li><a href="#dokumentasi">Kelola Dokumentasi</a></li>
                    <li><a href="#pendaftaran">Lihat Pendaftar</a></li>
                    <li><button id="theme-toggle" class="theme-button">🌙</button></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        <div class="dashboard-header">
            <div class="welcome-message">
                Selamat Datang, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!
            </div>
            <a href="logout.php" class="logout-link">Logout</a>
        </div>
        
        <?php if ($message): ?>
            <div class="notification <?php echo htmlspecialchars($action); ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        
        <div class="dashboard-content" id="dashboard-content">
            <h2>Dashboard Admin</h2>
            <p>Anda telah berhasil login sebagai admin. Di halaman ini Anda dapat mengelola sistem informasi kegiatan lingkungan RT 05.</p>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Total Pengumuman</div>
                    <div class="stat-number">4</div>
                    <div>Pengumuman aktif</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Kegiatan Mendatang</div>
                    <div class="stat-number">3</div>
                    <div>Kegiatan terjadwal</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Peserta Terdaftar</div>
                    <div class="stat-number">24</div>
                    <div>Warga terdaftar</div>
                </div>
            </div>
            
            <div class="recent-activities">
                <h3>Aktivitas Terbaru</h3>
                <ul class="activity-list">
                    <li class="activity-item">
                        <span>Pendaftaran kegiatan vaksinasi</span>
                        <span><time>5 menit yang lalu</time></span>
                    </li>
                    <li class="activity-item">
                        <span>Pengumuman lomba kebersihan</span>
                        <span><time>1 hari yang lalu</time></span>
                    </li>
                    <li class="activity-item">
                        <span>Update jadwal kerja bakti</span>
                        <span><time>2 hari yang lalu</time></span>
                    </li>
                    <li class="activity-item">
                        <span>Pendaftaran arisan bulanan</span>
                        <span><time>3 hari yang lalu</time></span>
                    </li>
                </ul>
            </div>
        </div>
        
        <section id="pengumuman">
            <h2>Kelola Pengumuman</h2>
            <p>Di sini admin bisa menambah, mengedit, atau menghapus pengumuman.</p>
            <div class="card" style="margin-bottom: 1rem;">
                <h3>Tambah Pengumuman Baru</h3>
                <form action="#" method="post">
                    <p><label for="judul_pengumuman">Judul:</label><input type="text" id="judul_pengumuman" name="judul_pengumuman" placeholder="Judul pengumuman"></p>
                    <p><label for="isi_pengumuman">Isi:</label><textarea id="isi_pengumuman" name="isi_pengumuman" rows="4" placeholder="Detail pengumuman"></textarea></p>
                    <button type="submit">Tambah</button>
                </form>
            </div>
            <h3>Daftar Pengumuman Aktif</h3>
            <div class="card-grid">
                <article class="card">
                    <h3>Lomba Kebersihan Antar Blok</h3>
                    <p>Dalam rangka menyambut hari jadi kompleks, akan diadakan lomba kebersihan antar blok. Pemenang akan mendapatkan hadiah menarik!</p>
                    <p><em>Diposting: <time datetime="2025-09-14">14 September 2025</time></em></p>
                    <button class="edit-button">Edit</button> <button class="delete-button">Hapus</button>
                </article>
                <article class="card">
                    <h3>Pengumuman Arisan Bulanan</h3>
                    <p>Arisan warga RT 05 akan diadakan pada hari Minggu, 22 September 2025 pukul 19.00 di rumah Bapak Budi (No. 12).</p>
                    <p><em>Diposting: <time datetime="2025-09-05">5 September 2025</time></em></p>
                    <button class="edit-button">Edit</button> <button class="delete-button">Hapus</button>
                </article>
                </div>
        </section>

        <section id="jadwal">
            <h2>Kelola Jadwal Kegiatan</h2>
            <p>Di sini admin bisa menambah, mengedit, atau menghapus jadwal kegiatan.</p>
            <div class="card-grid">
                <article class="card">
                    <h3>Vaksinasi Hewan Peliharaan</h3>
                    <p>Bekerja sama dengan dinas kesehatan, akan diadakan vaksinasi gratis untuk anjing dan kucing.</p>
                    <ul>
                        <li><strong>Tanggal:</strong> <time datetime="2025-09-25">25 September 2025</time></li>
                        <li><strong>Waktu:</strong> 09:00 WIB - Selesai</li>
                        <li><strong>Lokasi:</strong> Taman Kompleks RT 05</li>
                    </ul>
                    <button class="edit-button">Edit</button> <button class="delete-button">Hapus</button>
                </article>
                </div>
        </section>
        
        <section id="dokumentasi">
            <h2>Kelola Dokumentasi Kegiatan</h2>
            <p>Di sini admin bisa mengunggah atau menghapus foto dokumentasi.</p>
            <div class="card-grid">
                <article class="card">
                    <img src="https://via.placeholder.com/300x200.png?text=Kerja+Bakti" alt="Foto Kerja Bakti" style="width:100%; border-radius: var(--border-radius); margin-bottom: 1rem;">
                    <h3>Kerja Bakti September</h3>
                    <p>Warga bergotong royong membersihkan area taman dan selokan untuk kenyamanan bersama.</p>
                    <p><em><time datetime="2025-09-10">10 September 2025</time></em></p>
                    <button class="edit-button">Edit</button> <button class="delete-button">Hapus</button>
                </article>
                </div>
        </section>

        <section id="pendaftaran">
            <h2>Lihat Data Pendaftar Kegiatan</h2>
            <p>Di sini admin bisa melihat daftar warga yang sudah mendaftar untuk kegiatan.</p>
            <div class="card">
                <h3>Daftar Peserta Kegiatan</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>No. Rumah</th>
                            <th>Kegiatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Budi Santoso</td>
                            <td>A12</td>
                            <td>Kerja Bakti Rutin Bulanan</td>
                            <td><button class="delete-button">Hapus</button></td>
                        </tr>
                        <tr>
                            <td>Siti Aminah</td>
                            <td>B05</td>
                            <td>Vaksinasi Hewan Peliharaan</td>
                            <td><button class="delete-button">Hapus</button></td>
                        </tr>
                        </tbody>
                </table>
            </div>
        </section>
        
        <div class="back-link">
            <a href="index.php">← Kembali ke Beranda Publik</a>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Pengurus RT 05. Semua Hak Cipta Dilindungi.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>