// Menunggu seluruh konten halaman (DOM) dimuat sebelum menjalankan skrip
document.addEventListener('DOMContentLoaded', function() {

    // --- 1. Fitur Dark Mode Toggle ---
    const themeToggle = document.getElementById('theme-toggle');
    const body = document.body;

    // Fungsi untuk menerapkan tema yang dipilih dan mengubah ikon tombol
    function applyTheme(theme) {
        if (theme === 'dark') {
            body.classList.add('dark-mode');
            themeToggle.textContent = '☀️'; // Ikon matahari
        } else {
            body.classList.remove('dark-mode');
            themeToggle.textContent = '🌙'; // Ikon bulan
        }
    }

    // Cek tema yang tersimpan di localStorage saat halaman pertama kali dimuat
    const savedTheme = localStorage.getItem('theme') || 'light';
    applyTheme(savedTheme);

    // Tambahkan event listener untuk tombol
    themeToggle.addEventListener('click', () => {
        const currentTheme = body.classList.contains('dark-mode') ? 'dark' : 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

        applyTheme(newTheme);
        localStorage.setItem('theme', newTheme);
    });


    // --- 2. Fitur Validasi dan Penanganan Formulir Pendaftaran ---
    const formPendaftaran = document.querySelector('#pendaftaran form');

    if (formPendaftaran) {
        formPendaftaran.addEventListener('submit', function(event) {
            event.preventDefault();

            const namaInput = document.getElementById('nama_lengkap');
            const rumahInput = document.getElementById('nomor_rumah');
            const kegiatanDipilih = document.getElementById('kegiatan_dipilih');
            
            const namaError = document.getElementById('nama-error');
            const rumahError = document.getElementById('rumah-error');
            const successMessage = document.getElementById('success-message');

            namaError.textContent = '';
            rumahError.textContent = '';
            successMessage.textContent = '';
            
            let isValid = true;

            if (namaInput.value.trim() === '') {
                namaError.textContent = 'Nama Lengkap tidak boleh kosong.';
                isValid = false;
            }

            if (rumahInput.value.trim() === '') {
                rumahError.textContent = 'Nomor Rumah tidak boleh kosong.';
                isValid = false;
            }

            if (isValid) {
                const namaKegiatan = kegiatanDipilih.options[kegiatanDipilih.selectedIndex].text;
                const pesanKonfirmasi = `Terima kasih, pendaftaran untuk "${namaKegiatan}" berhasil!`;
                
                successMessage.textContent = pesanKonfirmasi;
                formPendaftaran.reset();

                setTimeout(() => {
                    successMessage.textContent = '';
                }, 5000);
            }
        });
    }


    // --- 3. Fitur Interaksi pada Kartu Kegiatan ---
    const semuaKartu = document.querySelectorAll('.card');

    semuaKartu.forEach(function(kartu) {
        kartu.addEventListener('click', function(event) {
            if (event.currentTarget.closest('#pendaftaran')) {
                return;
            }
            const judulKartu = kartu.querySelector('h3');
            if (judulKartu) {
                console.log(`Anda mengklik kartu dengan judul: ${judulKartu.innerText}`);
            }
        });
    });


    // --- 4. Fitur Konfirmasi untuk Tautan Login Admin ---
    const linkLoginAdmin = document.querySelector('a[href="admin_login.html"]');

    if (linkLoginAdmin) {
        linkLoginAdmin.addEventListener('click', function(event) {
            event.preventDefault();

            const konfirmasi = confirm('Anda akan diarahkan ke halaman login admin. Apakah Anda yakin ingin melanjutkan?');

            if (konfirmasi) {
                const urlTujuan = linkLoginAdmin.href;

                fetch(urlTujuan, { method: 'HEAD' })
                    .then(response => {
                        if (response.ok) {
                            window.location.href = urlTujuan;
                        } else {
                            alert('Peringatan: Halaman login admin tidak dapat ditemukan. File "admin_login.html" mungkin belum dibuat atau salah penempatan.');
                        }
                    })
                    .catch(error => {
                        console.error('Error saat memeriksa halaman admin:', error);
                        alert('Terjadi kesalahan saat mencoba mengakses halaman admin. Silakan periksa koneksi Anda.');
                    });
            }
        });
    }

    // --- 5. Fitur Animasi Smooth Scrolling untuk Link Navigasi ---
    const scrollLinks = document.querySelectorAll('a[href^="#"]');

    scrollLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

});