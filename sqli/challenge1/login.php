<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "pentest_lab");

$message = "";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sengaja rentan untuk pembelajaran
    $sql = "SELECT * FROM users
            WHERE username='$username'
            AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $message = "Login berhasil!";
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

<body class="bg-slate-950 text-white min-h-screen flex items-center justify-center">

<div class="w-full max-w-md bg-slate-900 border border-slate-800 rounded-2xl p-6">

    <h1 class="text-2xl font-bold mb-2">
        🏢 Employee Portal
    </h1>

    <p class="text-slate-400 mb-6">
        Internal Employee Authentication System
    </p>

    <?php if($message): ?>
        <div class="mb-4 p-3 bg-slate-800 rounded-lg">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <input
            type="text"
            name="username"
            placeholder="Username"
            class="w-full p-3 rounded-lg bg-slate-800 mb-3">

        <input
            type="password"
            name="password"
            placeholder="Password"
            class="w-full p-3 rounded-lg bg-slate-800 mb-4">

        <button
            type="submit"
            name="login"
            class="w-full bg-blue-600 py-3 mb-2 rounded-lg">
            Login
        </button>

        <a href="../../index.php"
   class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-700 px-4 py-2 rounded-xl border border-slate-700 mb-6">
    ← Kembali ke Dashboard
</a>
    </form>

</div>

</body>
</html>