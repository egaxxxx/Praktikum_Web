document.addEventListener('DOMContentLoaded', function() {

    const themeToggle = document.getElementById('theme-toggle');
    const body = document.body;

    function applyTheme(theme) {
        if (theme === 'dark') {
            body.classList.add('dark-mode');
            themeToggle.textContent = '☀️';
        } else {
            body.classList.remove('dark-mode');
            themeToggle.textContent = '🌙';
        }
    }

    const savedTheme = localStorage.getItem('theme') || 'light';
    applyTheme(savedTheme);

    themeToggle.addEventListener('click', () => {
        const currentTheme = body.classList.contains('dark-mode') ? 'dark' : 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

        applyTheme(newTheme);
        localStorage.setItem('theme', newTheme);
    });


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


        const linkLoginAdmin = document.querySelector('a[href="login.php"]');
    
        if (linkLoginAdmin) {
            linkLoginAdmin.addEventListener('click', function(event) {
                event.preventDefault();
    
                const konfirmasi = confirm('Anda akan diarahkan ke halaman login admin. Apakah Anda yakin ingin melanjutkan?');
    
                if (konfirmasi) {
                    window.location.href = 'login.php';
                }
            });
        }

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