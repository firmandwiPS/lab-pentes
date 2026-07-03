<?php
// 1. Mulai session di bagian paling atas script
session_start();

include_once __DIR__ . "/../../db.php";

$message = "";
$query = "";

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Catatan: Ini adalah query yang rentan SQL Injection (sesuai tujuan Lab)
    $query = "SELECT * FROM users
              WHERE username='$username'
              AND password='$password'";

    $result = mysqli_query($conn, $query);

    if($result && mysqli_num_rows($result) > 0)
    {
        // 2. Ambil data user yang berhasil login
        $user_data = mysqli_fetch_assoc($result);
        
        // 3. Simpan status login dan username ke dalam session
        $_SESSION['is_logged_in'] = true;
        $_SESSION['username'] = $user_data['username']; 
        
        // 4. Alihkan halaman ke dashboard.php
        header("Location: dashboard.php");
        exit(); 
    }
    else
    {
        $message = "❌ Login Gagal! Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab SQL Injection - Level 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex flex-col font-sans antialiased">

    <!-- Latar Belakang Glow -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-[500px] bg-gradient-to-b from-blue-500/10 via-cyan-500/5 to-transparent blur-3xl pointer-events-none -z-10"></div>

    <!-- Header -->
    <header class="border-b border-slate-800 bg-slate-900/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-blue-600 p-2.5 rounded-xl shadow-lg shadow-blue-500/20">
                    <span class="text-white text-xl">🔓</span>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white">SQL Injection: Level 1</h1>
                    <p class="text-xs text-slate-400 font-medium mt-0.5">Authentication Bypass Lab</p>
                </div>
            </div>
            <a href="../../index.php" class="bg-slate-800 hover:bg-slate-700 text-slate-200 px-4 py-2 rounded-xl text-sm font-medium border border-slate-700 transition">
                🏠 Menu Utama
            </a>
        </div>
    </header>

    <!-- Konten Form Login -->
    <main class="flex-1 flex items-center justify-center p-6 w-full">
        <div class="w-full max-w-md bg-slate-800/40 backdrop-blur-sm border border-slate-800 rounded-2xl p-8 shadow-2xl relative overflow-hidden">
            
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-extrabold text-white">Sign In</h2>
                <p class="text-sm text-slate-400 mt-1">Gunakan celah SQLi untuk masuk tanpa password</p>
            </div>

            <!-- Pesan Error -->
            <?php if($message !== ""): ?>
                <div class="mb-4 p-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-xs font-medium">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-5">
                <div>
                    <label class="text-xs font-semibold text-slate-400 tracking-wide block uppercase mb-2">Username:</label>
                    <input type="text" name="username" placeholder="Masukkan username atau payload" 
                           class="w-full bg-slate-900 text-slate-200 px-4 py-2.5 border border-slate-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm transition">
                </div>

                <div>
                    <label class="text-xs font-semibold text-slate-400 tracking-wide block uppercase mb-2">Password:</label>
                    <input type="password" name="password" placeholder="Masukkan password" 
                           class="w-full bg-slate-900 text-slate-200 px-4 py-2.5 border border-slate-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm transition">
                </div>

                <button type="submit" name="login" 
                        class="w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white font-semibold text-sm px-4 py-2.5 rounded-xl transition shadow-md shadow-blue-600/10 hover:shadow-blue-500/20">
                    Bypass & Login 🚀
                </button>
            </form>

            <!-- Debugger Query backend -->
            <?php if($query): ?>
                <div class="mt-6 pt-4 border-t border-slate-800/60">
                    <span class="text-[10px] font-semibold text-slate-500 uppercase block mb-1">Query Terproses:</span>
                    <code class="text-[11px] text-amber-400 bg-slate-950 px-2.5 py-1.5 rounded block overflow-x-auto font-mono"><?php echo $query; ?></code>
                </div>
            <?php endif; ?>

        </div>
    </main>

    <footer class="border-t border-slate-800/60 text-center text-slate-500 py-4 text-xs bg-slate-950/20">
        Pentest Web Lab &copy; 2026
    </footer>

</body>
</html>