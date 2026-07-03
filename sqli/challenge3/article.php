<?php

$conn = mysqli_connect("localhost", "root", "", "pentest_lab");

if (!$conn) {
    die("Koneksi database gagal.");
}

$article = null;

$id = $_GET['id'] ?? '';

if ($id !== '') {

    // KODE SENGAJA DIRUSAK (RENTAN): Input langsung digabung ke string query
    $sql = "SELECT id, title, author, content, created_at 
            FROM articles 
            WHERE id = '$id'";

    // Sengaja tidak pakai tanda @ agar pesan error MySQL bocor ke layar browser
    $result = mysqli_query($conn, $sql);
    
    if (!$result) {
        // Baris ini yang memicu teknik Error-Based Discovery!
        die("<div class='bg-red-500/10 border border-red-500/20 p-4 rounded-xl text-red-400 font-mono text-xs mb-4'>
                ⚠️ SQL Execution Error: " . mysqli_error($conn) . "
             </div>");
    }

    $article = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CMS Article Viewer</title>

<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 text-slate-100 min-h-screen">

<div class="max-w-5xl mx-auto p-8">

    <a href="../../index.php"
       class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-700 px-4 py-2 rounded-xl border border-slate-700 mb-6">
        ← Kembali ke Dashboard
    </a>

    <h1 class="text-3xl font-bold mb-2">
        📰 CMS Article Viewer
    </h1>

    <p class="text-slate-400 mb-8">
        Simulasi portal artikel perusahaan.
    </p>

    <form method="GET" class="mb-8">

        <label class="block mb-2 font-medium">
            Artikel ID
        </label>

        <div class="flex gap-3">

            <input
                type="number"
                name="id"
                min="1"
                placeholder="Masukkan ID artikel"
                class="flex-1 bg-slate-900 border border-slate-800 rounded-xl p-3">

            <button
                class="bg-blue-600 hover:bg-blue-500 px-6 rounded-xl">
                Buka
            </button>

        </div>

    </form>

    <?php if ($article): ?>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">

            <h2 class="text-2xl font-bold mb-2">
                <?= htmlspecialchars($article['title']) ?>
            </h2>

            <p class="text-slate-400 mb-6">
                Oleh <?= htmlspecialchars($article['author']) ?>
            </p>

            <div class="leading-relaxed text-slate-200">
                <?= nl2br(htmlspecialchars($article['content'])) ?>
            </div>

        </div>

    <?php elseif ($id !== ''): ?>

        <div class="bg-red-900/20 border border-red-700 rounded-xl p-4">
            Artikel tidak ditemukan.
        </div>

    <?php else: ?>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            Pilih salah satu artikel dengan memasukkan ID 1, 2, atau 3.
        </div>

    <?php endif; ?>

</div>

</body>
</html>