<?php
session_start();

// Proteksi halaman: Jika belum login, tendang kembali ke login.php
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Logika Logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header("Location: login.php");
    exit();
}

$title = "Employee Corporate Dashboard";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-white min-h-screen flex items-center justify-center p-4">

<div class="w-full max-w-lg bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-2xl">
    
    <div class="flex justify-between items-center border-b border-slate-800 pb-4 mb-6">
        <div>
            <span class="text-xs font-mono text-emerald-400 uppercase tracking-widest block font-semibold">Access Granted</span>
            <h1 class="text-xl font-bold">Selamat Datang, <?= htmlspecialchars($_SESSION['username']) ?>! 👋</h1>
        </div>
        <a href="?action=logout" class="bg-slate-800 hover:bg-rose-900/50 hover:text-rose-400 border border-slate-700 px-3 py-1.5 rounded-xl text-xs transition">
            Logout 🚪
        </a>
    </div>

    <div class="bg-emerald-950/30 border border-emerald-800/60 rounded-2xl p-5 border-l-4 border-l-emerald-500 mb-4">
        <div class="flex items-center gap-2 text-emerald-400 font-bold text-sm mb-2">
            <span>🏁</span> MISSION ACCOMPLISHED
        </div>
        <p class="text-slate-300 text-xs mb-3 leading-relaxed">
            Kamu berhasil mengeksploitasi parameter autentikasi bypass login SQL Injection. Berikut adalah kode bukti penyelesaian laboratorium:
        </p>
        <div class="bg-slate-950 p-3 rounded-xl border border-slate-800 flex items-center justify-between font-mono">
            <span class="text-sm text-emerald-400 font-bold select-all">FLAG{SQL_1nj3ct10n_Byp4ss_Succ3ss_2026}</span>
            <span class="text-[10px] text-slate-500 bg-slate-900 px-2 py-0.5 rounded">Copy</span>
        </div>
    </div>

    <p class="text-slate-500 text-[11px] text-center">
        Gunakan kode flag ini untuk diinput ke dalam sistem pencatatan skor lab milikmu.
    </p>

</div>

</body>
</html>