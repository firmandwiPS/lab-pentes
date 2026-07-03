<?php
include_once __DIR__ . "/../../db.php";

$message = "";
$query = "";
$article = null;

// Skenario Nyata: Mengambil detail artikel berdasarkan parameter ID di URL (?id=1)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query rentan: Tanpa proteksi sanitasi angka/integer
    $query = "SELECT id, title, content, author FROM articles WHERE id = $id";

    // Eksekusi query dengan mengizinkan multiple query / error reporting aktif
    $result = mysqli_query($conn, $query);

    if ($result) {
        $article = mysqli_fetch_assoc($result);
        if (!$article) {
            $message = "ℹ️ Artikel tidak ditemukan di database.";
        }
    } else {
        // PINTU MASUK ERROR-BASED: Sengaja menampilkan mysqli_error() ke layar!
        // Di dunia nyata, kelalaian developer ini dimanfaatkan untuk teknik Error-Based SQLi
        $message = "❌ Database Error: " . mysqli_error($conn);
    }
} else {
    // Default jika user baru masuk halaman tanpa id, arahkan ke id=1
    header("Location: ?id=1");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab SQL Injection - Level 3 (Error Based)</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen font-sans antialiased">

    <!-- Latar Belakang Glow (Tema Ungu Eksploitasi) -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-[500px] bg-gradient-to-b from-purple-500/10 via-fuchsia-500/5 to-transparent blur-3xl pointer-events-none -z-10"></div>

    <!-- Header / Navigasi -->
    <header class="border-b border-slate-800 bg-slate-900/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-purple-600 p-2.5 rounded-xl shadow-lg shadow-purple-500/20">
                    <span class="text-white text-xl">⚠️</span>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white">SQL Injection: Level 3</h1>
                    <p class="text-xs text-slate-400">Skenario Nyata: Error-Based Injection via Fungsi Database</p>
                </div>
            </div>
            <a href="../../index.php" class="bg-slate-800 hover:bg-slate-700 text-slate-200 px-4 py-2 rounded-xl text-sm font-medium border border-slate-700 transition">
                🏠 Kembali ke Menu
            </a>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="max-w-3xl mx-auto px-6 py-10">
        
        <!-- Misi Pentest -->
        <div class="bg-slate-800/40 backdrop-blur-sm border border-slate-800 rounded-2xl p-6 mb-8">
            <h2 class="text-lg font-bold text-purple-400 mb-2">🎯 Misi Pentest:</h2>
            <p class="text-slate-300 text-sm leading-relaxed">
                Tantangan kali ini, struktur tabel produk sudah ditutup! Tampilan web tidak akan memunculkan data dari kolom <code class="text-amber-400">UNION</code> baru. Tugas Anda adalah memanfaatkan <b>Pesan Error Database</b> untuk memaksa sistem membocorkan data password admin dari tabel <code class="text-cyan-400">users</code>!
            </p>
        </div>

        <!-- Panel Navigasi ID Artikel (Simulasi Artikel Normal) -->
        <div class="flex space-x-3 mb-6">
            <a href="?id=1" class="px-4 py-2 bg-slate-800 border <?php echo $_GET['id'] == '1' ? 'border-purple-500 text-purple-400' : 'border-slate-700 text-slate-300'; ?> rounded-xl text-xs font-semibold transition">📰 Artikel 1</a>
            <a href="?id=2" class="px-4 py-2 bg-slate-800 border <?php echo $_GET['id'] == '2' ? 'border-purple-500 text-purple-400' : 'border-slate-700 text-slate-300'; ?> rounded-xl text-xs font-semibold transition">📰 Artikel 2</a>
            <span class="text-xs text-slate-500 self-center font-mono">Ubah parameter <code class="text-amber-400 font-bold bg-slate-950 px-1.5 py-0.5 rounded">?id=</code> pada URL Bar browser Anda untuk menyerang!</span>
        </div>

        <!-- Box Pesan Error / Informasi Backend (Tempat Payload Beraksi) -->
        <?php if($message): ?>
            <div class="p-4 rounded-xl mb-6 text-sm font-mono border bg-red-500/10 border-red-500/20 text-red-400 overflow-x-auto">
                <span class="font-bold block text-xs uppercase text-red-500 tracking-wider mb-1">Respon Database Error:</span>
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <!-- Tampilan Artikel -->
        <?php if($article): ?>
            <div class="bg-slate-800/20 border border-slate-800/60 rounded-2xl p-8 shadow-xl">
                <span class="text-xs font-semibold text-purple-400 bg-purple-500/10 border border-purple-500/20 px-2.5 py-1 rounded-full uppercase tracking-wider">
                    Author: <?php echo htmlspecialchars($article['author']); ?>
                </span>
                <h2 class="text-2xl font-bold text-white mt-4 mb-4"><?php echo htmlspecialchars($article['title']); ?></h2>
                <p class="text-slate-300 text-sm leading-relaxed whitespace-pre-line"><?php echo htmlspecialchars($article['content']); ?></p>
            </div>
        <?php endif; ?>

        <!-- Debugger Real-time -->
        <div class="mt-8 pt-4 border-t border-slate-800/60">
            <span class="text-xs font-semibold text-slate-500 uppercase block mb-1">Query SQL yang sedang dieksekusi:</span>
            <code class="text-xs text-amber-400 bg-slate-950 px-3 py-1.5 rounded block overflow-x-auto font-mono">
                <?php echo $query; ?>
            </code>
        </div>

    </main>

    <footer class="border-t border-slate-800/60 text-center text-slate-500 py-6 text-xs mt-auto">
        Pentest Web Lab &copy; 2026 &bull; Skenario Error Based Injection
    </footer>

</body>
</html>