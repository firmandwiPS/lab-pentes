<?php
$conn = mysqli_connect("localhost", "root", "", "pentest_lab");

if (!$conn) {
    die("Koneksi database gagal.");
}

$keyword = trim($_GET['q'] ?? '');
$flag_captured = "";

$sql = "
SELECT
    id,
    customer_code,
    full_name,
    email,
    phone,
    city
FROM customers
";

if ($keyword !== "") {
    // Sengaja dibuat rentan menggunakan operator LIKE dan petik tunggal
    $sql .= " WHERE full_name LIKE '%$keyword%' OR email LIKE '%$keyword%' OR city LIKE '%$keyword%' ";
}

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("<div class='max-w-6xl mx-auto p-8'>
            <a href='?q=' class='text-xs text-blue-400 hover:underline'>← Reset Pencarian</a>
            <div class='bg-red-500/10 border border-red-500/20 p-4 rounded-xl text-red-400 font-mono text-xs mt-4'>
                ⚠️ SQL Error: " . htmlspecialchars(mysqli_error($conn)) . "
            </div>
         </div>");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Management System - SQLi LIKE Lab</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 text-slate-100 min-h-screen">

<div class="max-w-6xl mx-auto p-8">

    <a href="../sqli.php"
       class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-700 px-4 py-2 rounded-xl border border-slate-700 mb-6 text-sm transition">
        ← Kembali ke Dashboard
    </a>

    <h1 class="text-3xl font-bold mb-2">
        👥 Customer Management System (LIKE Injection)
    </h1>

    <p class="text-slate-400 mb-8 text-sm">
        Gunakan teknik penutupan syntax operator <code class="text-amber-400 font-mono">LIKE</code> untuk melakukan data exfiltration lewat metode UNION.
    </p>

    <form method="GET" class="mb-6">
        <input type="text" name="q" value="<?= htmlspecialchars($keyword) ?>"
               placeholder="Cari nama, email, atau kota (Contoh payload: a%') ..."
               class="w-full bg-slate-900 border border-slate-800 rounded-xl p-3 text-sm focus:outline-none focus:border-blue-500">
    </form>

    <?php 
    // Kita kumpulkan datanya terlebih dahulu untuk mengecek apakah ada flag yang bocor
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        if (strpos($row['customer_code'], 'FLAG{') !== false || strpos($row['full_name'], 'FLAG{') !== false) {
            $flag_captured = $row['customer_code'] . $row['full_name']; // Ambil flagnya
        }
        $rows[] = $row;
    }
    ?>

    <?php if ($flag_captured): ?>
        <div class="bg-emerald-950/30 border border-emerald-800/60 rounded-2xl p-5 border-l-4 border-l-emerald-500 shadow-2xl mb-6">
            <div class="flex items-center gap-2 text-emerald-400 font-bold text-sm mb-2">
                <span>🏁</span> LIKE CLAUSE EXFILTRATION SUCCESS
            </div>
            <p class="text-slate-300 text-xs mb-3 leading-relaxed">
                Luar biasa! Kamu berhasil memecah pembungkus parameter query dengan menutup wildcard persen dan petik tunggal (<code class="text-emerald-400 bg-slate-950 px-1 py-0.5 rounded font-mono">%'</code>), menyelaraskan jumlah total kolom, dan mengekstrak isi tabel rahasia.
            </p>
            <div class="bg-slate-950 p-4 rounded-xl border border-slate-800 flex items-center justify-between font-mono">
                <span class="text-sm text-emerald-400 font-bold select-all"><?= htmlspecialchars($flag_captured) ?></span>
                <span class="text-[10px] text-slate-500 bg-slate-900 px-2 py-0.5 rounded">Search Flag Captured</span>
            </div>
        </div>
    <?php endif; ?>

    <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
        <table class="w-full text-sm">
            <thead class="bg-slate-800/50 text-slate-300 font-semibold border-b border-slate-800">
                <tr>
                    <th class="text-left p-4">Kode</th>
                    <th class="text-left p-4">Nama</th>
                    <th class="text-left p-4">Email</th>
                    <th class="text-left p-4">Telepon</th>
                    <th class="text-left p-4">Kota</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/60">
                <?php if (count($rows) > 0): ?>
                    <?php foreach ($rows as $row): ?>
                        <tr class="hover:bg-slate-850/40 transition">
                            <td class="p-4 font-mono text-blue-400"><?= htmlspecialchars($row['customer_code']) ?></td>
                            <td class="p-4 text-white font-medium"><?= htmlspecialchars($row['full_name']) ?></td>
                            <td class="p-4 text-slate-300"><?= htmlspecialchars($row['email']) ?></td>
                            <td class="p-4 text-slate-400"><?= htmlspecialchars($row['phone']) ?></td>
                            <td class="p-4 text-slate-400"><?= htmlspecialchars($row['city']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="p-8 text-center text-slate-500 italic">Tidak ada data pelanggan yang cocok dengan kata kunci.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>