<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "pentest_lab");

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$message = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sengaja rentan SQL Injection untuk pembelajaran
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        
        // Simpan data login ke session
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $user_data['username'] ?? 'Admin';
        
        // Redirect ke halaman dashboard flag
        header("Location: dashboard.php");
        exit();
    } else {
        $message = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Employee Portal Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 text-white min-h-screen flex items-center justify-center p-4">

<div class="w-full max-w-md bg-slate-900 border border-slate-800 rounded-2xl p-6">

    <h1 class="text-2xl font-bold mb-2 flex items-center gap-2">
        🏢 Employee Portal
    </h1>

    <p class="text-slate-400 mb-6 text-sm">
        Internal Employee Authentication System
    </p>

    <?php if($message): ?>
        <div class="mb-4 p-3 bg-rose-950/50 border border-rose-800 text-rose-300 text-sm rounded-xl">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
        <div>
            <input type="text" name="username" required placeholder="Username"
                   class="w-full p-3 rounded-xl bg-slate-800 border border-slate-700 text-white focus:outline-none focus:border-blue-500 text-sm">
        </div>

        <div>
            <input type="password" name="password" required placeholder="Password"
                   class="w-full p-3 rounded-xl bg-slate-800 border border-slate-700 text-white focus:outline-none focus:border-blue-500 text-sm">
        </div>

        <button type="submit" name="login" class="w-full bg-blue-600 hover:bg-blue-500 py-3 rounded-xl font-semibold transition text-sm">
            Sign In 🚀
        </button>

        <div class="pt-2">
            <a href="../sqli.php" class="w-full inline-flex justify-center items-center gap-2 bg-slate-800 hover:bg-slate-700 px-4 py-2.5 rounded-xl border border-slate-700 text-xs text-slate-400 transition">
                ← Kembali ke Dashboard
            </a>
        </div>
    </form>

</div>

</body>
</html>