<?php
$conn = mysqli_connect("localhost", "root", "", "pentest_lab");

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$keyword = $_GET['id'] ?? '';
$result = null;

if ($keyword != '') {
    // Sengaja rentan untuk pembelajaran UNION Injection
    $sql = "SELECT id, name, price FROM products WHERE id='$keyword'";
    $result = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Product Catalog - SQLi Lab</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 text-white min-h-screen">

<div class="max-w-4xl mx-auto p-8">

    <div class="mb-6">
        <h1 class="text-3xl font-bold mb-2 flex items-center gap-2">
            🛒 Product Catalog
        </h1>
        <p class="text-slate-400 text-sm">
            Cari informasi produk berdasarkan ID unik produk. Temukan celah UNION Injection untuk mengeksfiltrasi data rahasia!
        </p>
    </div>

    <form method="GET" class="flex gap-3 mb-6">
        <input type="text" name="id" placeholder="Product ID (Contoh: 1)" 
               value="<?= htmlspecialchars($keyword, ENT_QUOTES) ?>"
               class="bg-slate-900 border border-slate-800 p-3 rounded-xl w-64 text-white focus:outline-none focus:border-blue-500 text-sm">
        <button type="submit" class="bg-blue-600 hover:bg-blue-500 px-6 py-3 rounded-xl font-semibold text-sm transition">
            Search 🔍
        </button>
    </form>

    <div class="mb-8">
        <a href="../sqli.php" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-slate-400 hover:text-white px-4 py-2 rounded-xl border border-slate-800 text-xs transition">
            ← Kembali ke Dashboard
        </a>
    </div>

    <?php if ($result): ?>
        <div class="space-y-4">
            <?php 
            if (mysqli_num_rows($result) > 0):
                while ($row = mysqli_fetch_assoc($result)): 
                    
                    // Logika Deteksi: Jika penyerang berhasil menarik teks FLAG{...} dari database
                    if (strpos($row['name'], 'FLAG{') !== false || strpos($row['price'], 'FLAG{') !== false): 
            ?>
                        <div class="bg-emerald-950/30 border border-emerald-800/60 rounded-2xl p-5 border-l-4 border-l-emerald-500 shadow-2xl animate-fade-in">
                            <div class="flex items-center gap-2 text-emerald-400 font-bold text-sm mb-2">
                                <span>🏁</span> EXFILTRATION SUCCESS
                            </div>
                            <p class="text-slate-300 text-xs mb-3 leading-relaxed">
                                Luar biasa! Kamu berhasil menggabungkan struktur kolom query asli dengan perintah UNION untuk membaca isi tabel rahasia <code class="text-emerald-400 bg-slate-950 px-1 py-0.5 rounded font-mono">sqli_flags</code>.
                            </p>
                            <div class="bg-slate-950 p-4 rounded-xl border border-slate-800 flex items-center justify-between font-mono">
                                <span class="text-sm text-emerald-400 font-bold select-all">
                                    <?= htmlspecialchars($row['name'] . $row['price']) ?>
                                </span>
                                <span class="text-[10px] text-slate-500 bg-slate-900 px-2 py-0.5 rounded">Flag Captured</span>
                            </div>
                        </div>

            <?php   else: ?>
                        <div class="bg-slate-900 border border-slate-800 p-5 rounded-2xl flex justify-between items-center">
                            <div>
                                <h3 class="font-bold text-lg text-white"><?= htmlspecialchars($row['name']) ?></h3>
                                <p class="text-slate-500 text-xs mt-1">Product ID: <?= htmlspecialchars($row['id']) ?></p>
                            </div>
                            <div class="text-right">
                                <p class="text-xl font-bold text-green-400">Rp <?= htmlspecialchars($row['price']) ?></p>
                            </div>
                        </div>
            <?php 
                    endif;
                endwhile; 
            else:
            ?>
                <p class="text-slate-500 text-sm italic">Produk tidak ditemukan atau syntax database mengalami anomali.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</div>

</body>
</html>