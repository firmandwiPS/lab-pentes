<?php
// 1. Mulai session di bagian paling atas script
session_start();

include_once __DIR__ . "/../../db.php";

$message = "⚪ STATUS: Menunggu enkripsi data...";
$status_class = "bg-slate-900/50 border-slate-800 text-slate-400";
$query = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query Rentan: Diproses di server tanpa sanitasi
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    
    // Supresi error database agar penyerang tidak mendapat petunjuk error (Blind)
    $result = @mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // Skenario Tersulit: Cek apakah input password user sama persis dengan di database 
            // Ini mencegah bypass menggunakan trik komentar seperti: admin' -- -
            $user_data = mysqli_fetch_assoc($result);
            
            if ($user_data['password'] === $password) {
                // Login sukses hanya jika password tebakan sama dengan password DB asli
                $_SESSION['is_logged_in_lvl4'] = true;
                $_SESSION['username_lvl4'] = $user_data['username'];
                header("Location: dashboard.php");
                exit();
            } else {
                // Jika payload SQLi bernilai TRUE (misal memasukkan payload di kolom username) 
                // tapi password tidak cocok, aplikasi memberikan respon TRUE secara tersirat
                $message = "🟢 TRUE: Node sistem terverifikasi dan aktif.";
                $status_class = "bg-emerald-500/10 border-emerald-500/20 text-emerald-400";
            }
        } else {
            // Jika query bernilai salah atau user memang tidak ada
            $message = "🔴 FALSE: Akses ditolak. Kredensial tidak cocok.";
            $status_class = "bg-red-500/10 border-red-500/20 text-red-400";
        }
    } else {
        // Jika sintaks query rusak akibat payload yang salah, tetap tampilkan respon FALSE
        $message = "🔴 FALSE: Akses ditolak. Kredensial tidak cocok.";
        $status_class = "bg-red-500/10 border-red-500/20 text-red-400";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab SQL Injection - Level 4 (Strict Blind)</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex flex-col font-sans antialiased">

    <!-- Glow Background (Tema Deep Orange/Amber) -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-[500px] bg-gradient-to-b from-amber-600/10 via-orange-600/5 to-transparent blur-3xl pointer-events-none -z-10"></div>

    <!-- Header -->
    <header class="border-b border-slate-800 bg-slate-900/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-amber-600 p-2.5 rounded-xl shadow-lg shadow-amber-500/20">
                    <span class="text-white text-xl">🔒</span>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white">SQL Injection: Level 4</h1>
                    <p class="text-xs text-slate-400 font-medium mt-0.5">Strict Mode: Boolean-Based Blind Injection</p>
                </div>
            </div>
            <a href="../../index.php" class="bg-slate-800 hover:bg-slate-700 text-slate-200 px-4 py-2 rounded-xl text-sm font-medium border border-slate-700 transition">
                🏠 Menu Utama
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col items-center justify-center p-6 w-full max-w-4xl mx-auto">
        
        <!-- Instruksi Kesulitan -->
        <div class="w-full bg-slate-800/40 backdrop-blur-sm border border-slate-800 rounded-2xl p-5 mb-6">
            <h2 class="text-xs font-bold text-amber-400 uppercase tracking-wider mb-1.5">🛡️ Firewall Keamanan Ditingkatkan</h2>
            <p class="text-slate-400 text-xs leading-relaxed">
                Bypass login instan telah dimatikan secara struktural di backend. Anda tidak bisa masuk ke dashboard sebelum mengetahui <b>Password Asli</b> target. Manfaatkan perubahan respon <span class="text-emerald-400">TRUE</span> atau <span class="text-red-400">FALSE</span> untuk menebak isi password admin huruf demi huruf!
            </p>
        </div>

        <!-- Login Form Card -->
        <div class="w-full max-w-md bg-slate-800/40 backdrop-blur-sm border border-slate-800 rounded-2xl p-8 shadow-2xl relative">
            
            <div class="mb-6 text-center">
                <h2 class="text-xl font-bold text-white">Secure Binary Portal</h2>
                <p class="text-xs text-slate-400 mt-1">Gunakan teknik otomasi skrip atau SQLMap untuk ekstraksi data</p>
            </div>

            <!-- Respon Status Boolean -->
            <div class="mb-5 p-3 rounded-xl border text-xs font-mono font-medium transition-all duration-300 <?php echo $status_class; ?>">
                <?php echo $message; ?>
            </div>

            <form method="POST" class="space-y-4">
                <div>
                    <label class="text-[10px] font-bold text-slate-400 tracking-wider block uppercase mb-2">Username Input:</label>
                    <input type="text" name="username" placeholder="Masukkan ID pengguna" required
                           class="w-full bg-slate-900 text-slate-200 px-4 py-2.5 border border-slate-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 text-sm font-mono transition">
                </div>

                <div>
                    <label class="text-[10px] font-bold text-slate-400 tracking-wider block uppercase mb-2">Password Input:</label>
                    <input type="password" name="password" placeholder="Masukkan kata sandi rahasia" 
                           class="w-full bg-slate-900 text-slate-200 px-4 py-2.5 border border-slate-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 text-sm font-mono transition">
                </div>

                <button type="submit" name="login" 
                        class="w-full bg-gradient-to-r from-amber-600 to-amber-500 hover:from-amber-500 hover:to-amber-400 text-white font-semibold text-sm px-4 py-2.5 rounded-xl transition shadow-lg shadow-amber-600/10">
                    Kirim Data Real-time ⚡
                </button>
            </form>

            <!-- Debugger Monitor SQL -->
            <?php if($query): ?>
                <div class="mt-6 pt-4 border-t border-slate-800/60">
                    <span class="text-[9px] font-bold text-slate-500 uppercase block mb-1">Query Raw Server:</span>
                    <code class="text-[11px] text-amber-400 bg-slate-950 px-2.5 py-2 rounded block overflow-x-auto font-mono"><?php echo $query; ?></code>
                </div>
            <?php endif; ?>

        </div>
    </main>

    <footer class="border-t border-slate-800/60 text-center text-slate-500 py-4 text-xs bg-slate-950/20">
        Pentest Web Lab &copy; 2026 &bull; Strict Blind Authentication
    </footer>

</body>
</html>