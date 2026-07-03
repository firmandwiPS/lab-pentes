<?php
// 1. Jalankan session di bagian paling atas
session_start();

// 2. Fitur LOGOUT
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

// 3. Proteksi Halaman Level 4 secara ketat
if (!isset($_SESSION['is_logged_in_lvl4']) || $_SESSION['is_logged_in_lvl4'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Area - Level 4</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex flex-col font-sans antialiased">

    <!-- Glow Background (Tema Emas Sukses) -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-[500px] bg-gradient-to-b from-amber-500/10 via-yellow-500/5 to-transparent blur-3xl pointer-events-none -z-10"></div>

    <!-- Header -->
    <header class="border-b border-slate-800 bg-slate-900/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-amber-500 p-2.5 rounded-xl shadow-lg shadow-amber-500/20">
                    <span class="text-white text-xl">👑</span>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white">Elite Dashboard</h1>
                    <p class="text-xs text-slate-400 font-medium mt-0.5">Sesi Terenkripsi Penuh</p>
                </div>
            </div>
            <a href="?action=logout" class="bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/20 px-4 py-2 rounded-xl text-sm font-semibold transition">
                ➡️ Keluar Sesi
            </a>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="max-w-3xl mx-auto px-6 py-12 flex-1 w-full">
        
        <div class="bg-slate-800/40 backdrop-blur-sm border border-slate-800 rounded-2xl p-8 shadow-2xl relative overflow-hidden">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-amber-500/10 rounded-full blur-2xl"></div>
            
            <div class="flex items-center space-x-2 text-amber-400 text-xs font-bold uppercase tracking-wider mb-2">
                <span>⚡ Misi Selesai</span>
            </div>
            <h2 class="text-2xl font-extrabold text-white mb-3">Selamat, Anda Peneliti Keamanan Tingkat Tinggi!</h2>
            <p class="text-slate-300 text-sm leading-relaxed mb-6">
                Anda berhasil masuk menggunakan akun resmi: <span class="bg-amber-500/10 text-amber-400 border border-amber-500/20 font-mono font-bold px-2.5 py-0.5 rounded text-xs"><?php echo htmlspecialchars($_SESSION['username_lvl4']); ?></span>. Menembus level ini membuktikan pemahaman mendalam Anda mengenai ekstraksi data berbasis struktur inferensi biner.
            </p>

            <div class="bg-slate-900/80 border border-slate-800 p-4 rounded-xl space-y-3">
                <span class="font-bold text-slate-400 block uppercase tracking-wider text-[10px]">Tinjauan Teknikal (Boolean-Based):</span>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Karena tidak ada data tabel maupun teks error yang bocor ke luar dari server, satu-satunya cara mengetahui password di level ini adalah dengan menyuntikkan fungsi komparasi biner seperti <code class="text-amber-400">SUBSTRING((SELECT password FROM users WHERE username='admin'),1,1)='a'</code>. Jika respon status login berubah menjadi <span class="text-emerald-400">TRUE (Sistem Aktif)</span>, maka huruf pertama adalah 'a'. Skrip otomatis (Python/SQLMap) mengulang logika tebakan logika biner ini ribuan kali dalam hitungan detik untuk menyusun potongan informasi menjadi data utuh.
                </p>
            </div>
        </div>

    </main>

    <footer class="border-t border-slate-800/60 text-center text-slate-500 py-4 text-xs bg-slate-950/20">
        Pentest Web Lab &copy; 2026 &bull; Secure Storage Access
    </footer>

</body>
</html>