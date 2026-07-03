<?php
// 1. Jalankan session di bagian paling atas
session_start();

// 2. Fitur LOGOUT: Jika ada request ?action=logout di URL
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    header("Location: login.php"); // Sesuaikan nama file login Anda jika berbeda
    exit();
}

// 3. Proteksi Halaman: Jika user belum login, lempar kembali ke halaman login
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Lab</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex flex-col font-sans antialiased">

    <!-- Latar Belakang Glow (Tema Hijau Sukses) -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-[500px] bg-gradient-to-b from-emerald-500/10 via-teal-500/5 to-transparent blur-3xl pointer-events-none -z-10"></div>

    <!-- Header -->
    <header class="border-b border-slate-800 bg-slate-900/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-emerald-600 p-2.5 rounded-xl shadow-lg shadow-emerald-500/20">
                    <span class="text-white text-xl">🎉</span>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white">Dashboard Area</h1>
                    <p class="text-xs text-slate-400 font-medium mt-0.5">Sesi Lab Terautentikasi</p>
                </div>
            </div>
            <!-- Tombol Logout -->
            <a href="?action=logout" class="bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/20 px-4 py-2 rounded-xl text-sm font-semibold transition">
                ➡️ Logout
            </a>
        </div>
    </header>

    <!-- Konten Utama Dashboard -->
    <main class="max-w-3xl mx-auto px-6 py-12 flex-1 w-full">
        
        <!-- Kartu Selamat Datang -->
        <div class="bg-slate-800/40 backdrop-blur-sm border border-slate-800 rounded-2xl p-8 shadow-xl relative overflow-hidden">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-emerald-500/10 rounded-full blur-2xl"></div>
            
            <h2 class="text-2xl font-extrabold text-white mb-3">Selamat Datang di Sistem Kontrol!</h2>
            <p class="text-slate-300 text-sm leading-relaxed mb-4">
                Halo, akun Anda teridentifikasi sebagai: <span class="bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 font-mono font-bold px-2 py-0.5 rounded text-xs"><?php echo htmlspecialchars($_SESSION['username']); ?></span>. Anda telah berhasil menembus dinding pertahanan Level 1.
            </p>

            <div class="bg-slate-900/60 border border-slate-800/80 p-4 rounded-xl text-xs text-slate-400 space-y-2 leading-relaxed">
                <span class="font-bold text-amber-400 block uppercase tracking-wider text-[10px]">Analisis Lab Skenario Nyata:</span>
                <p>
                    Jika Anda berhasil masuk ke halaman ini menggunakan teknik bypass seperti <code>' OR '1'='1</code> tanpa mengetahui sandinya, hal tersebut terjadi karena aplikasi mengevaluasi query SQL secara mentah. Database menganggap pernyataan tersebut selalu bernilai benar (<span class="text-emerald-400">TRUE</span>), lalu memberikan akses masuk untuk baris pengguna pertama yang terarsip di sistem.
                </p>
            </div>
        </div>

    </main>

    <footer class="border-t border-slate-800/60 text-center text-slate-500 py-4 text-xs bg-slate-950/20">
        Pentest Web Lab &copy; 2026
    </footer>

</body>
</html>