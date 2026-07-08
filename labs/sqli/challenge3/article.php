<?php
$conn = mysqli_connect("localhost", "root", "", "pentest_lab");

if (!$conn) {
    die("Koneksi database gagal.");
}

$article = null;
$id = $_GET['id'] ?? '';
$flag_captured = "";

if ($id !== '') {

    // KODE RENTAN: Input langsung digabung ke string query
    $sql = "SELECT id, title, author, content, created_at 
            FROM articles 
            WHERE id = '$id'";

    $result = mysqli_query($conn, $sql);
    
    if (!$result) {
        $error_message = mysqli_error($conn);

        // LOGIKA DETEKSI FLAG: Jika payload berhasil memaksa MySQL mengeluarkan isi flag ke dalam pesan error
        if (strpos($error_message, 'FLAG{') !== false) {
            // Tangkap teks flag dari dalam pesan error
            preg_match('/FLAG\{([^}]+)\}/', $error_message, $matches);
            $flag_captured = isset($matches[0]) ? $matches[0] : $error_message;
        } else {
            // Tampilan error SQL standar jika payload salah/rusak syntax biasa
            die("<div class='max-w-5xl mx-auto p-8'>
                    <a href='?id=' class='text-xs text-blue-400 hover:underline'>← Reset Input</a>
                    <div class='bg-red-500/10 border border-red-500/20 p-4 rounded-xl text-red-400 font-mono text-xs mt-4 leading-relaxed'>
                        ⚠️ SQL Execution Error: <br>" . htmlspecialchars($error_message) . "
                    </div>
                 </div>");
        }
    } else {
        $article = mysqli_fetch_assoc($result);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Article Viewer - Error Based SQLi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 text-slate-100 min-h-screen">

<div class="max-w-5xl mx-auto p-8">

    <a href="../sqli.php"
       class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-700 px-4 py-2 rounded-xl border border-slate-700 mb-6 text-sm transition">
        ← Kembali ke Dashboard
    </a>

    <h1 class="text-3xl font-bold mb-2">
        📰 CMS Article Viewer (Error-Based)
    </h1>

    <p class="text-slate-400 mb-8 text-sm">
        Simulasi eksploitasi kebocoran data memanfaatkan fungsi error handling database yang tidak aman.
    </p>

    <form method="GET" class="mb-8">
        <label class="block mb-2 font-medium text-sm text-slate-300">Artikel ID</label>
        <div class="flex gap-3">
            <input type="text" name="id" placeholder="Masukkan ID artikel atau payload..." 
                   value="<?= htmlspecialchars($id, ENT_QUOTES) ?>"
                   class="flex-1 bg-slate-900 border border-slate-800 rounded-xl p-3 text-sm focus:outline-none focus:border-blue-500">
            <button class="bg-blue-600 hover:bg-blue-500 px-6 rounded-xl font-semibold text-sm transition">
                Buka
            </button>
        </div>
    </form>

    <?php if ($flag_captured): ?>
        <div class="bg-emerald-950/30 border border-emerald-800/60 rounded-2xl p-5 border-l-4 border-l-emerald-500 shadow-2xl">
            <div class="flex items-center gap-2 text-emerald-400 font-bold text-sm mb-2">
                <span>🏁</span> ERROR-BASED INJECTION SUCCESS
            </div>
            <p class="text-slate-300 text-xs mb-3 leading-relaxed">
                Hebat! Kamu berhasil mengeksploitasi fungsi <code class="text-emerald-400 bg-slate-950 px-1 py-0.5 rounded font-mono">updatexml()</code> untuk memaksa database memuntahkan data sensitif melalui pesan kesalahan *XPath syntax error*.
            </p>
            <div class="bg-slate-950 p-4 rounded-xl border border-slate-800 flex items-center justify-between font-mono">
                <span class="text-sm text-emerald-400 font-bold select-all"><?= htmlspecialchars($flag_captured) ?></span>
                <span class="text-[10px] text-slate-500 bg-slate-900 px-2 py-0.5 rounded">Captured via Error</span>
            </div>
        </div>

    <?php elseif ($article): ?>
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
            <h2 class="text-2xl font-bold mb-2 text-white"><?= htmlspecialchars($article['title']) ?></h2>
            <p class="text-slate-500 text-xs mb-6">Oleh <?= htmlspecialchars($article['author']) ?> | <?= htmlspecialchars($article['created_at']) ?></p>
            <div class="leading-relaxed text-slate-300 text-sm whitespace-pre-line"><?= htmlspecialchars($article['content']) ?></div>
        </div>

    <?php elseif ($id !== ''): ?>
        <div class="bg-slate-900/50 border border-slate-800 rounded-xl p-4 text-sm text-slate-400 italic">
            Artikel tidak ditemukan di database.
        </div>

    <?php else: ?>
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6 text-sm text-slate-400">
            💡 Masukkan ID <code class="text-blue-400">1</code> untuk melihat artikel contoh, atau mulai suntikkan payload Error-Based SQLi kamu pada input di atas.
        </div>
    <?php endif; ?>

</div>

</body>
</html>