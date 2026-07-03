<?php

$conn = mysqli_connect("localhost", "root", "", "pentest_lab");

if (!$conn) {
    die("Koneksi database gagal.");
}

// 1. Mengambil parameter sorting dari URL, contoh: financial.php?sort=revenue
// Jika tidak ada parameter di URL, default-nya akan diurutkan berdasarkan 'id'
$sort = $_GET['sort'] ?? 'id'; 

// 2. KODE SENGAJA DIRUSAK (RENTAN): 
// Variabel $sort langsung digabungkan ke dalam string query tanpa filter atau whitelist.
$query = "
SELECT
    report_month,
    revenue,
    expenses,
    profit
FROM financial_reports
ORDER BY $sort DESC
";

$result = mysqli_query($conn, $query);

$totalRevenue = 0;
$totalExpenses = 0;
$totalProfit = 0;

$data = [];

// 3. JIKA QUERY ERROR: Tampilkan pesan error database ke layar untuk bahan belajar Error-Based SQLi
if (!$result) {
    $sql_error = mysqli_error($conn);
} else {
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
        $totalRevenue += $row['revenue'];
        $totalExpenses += $row['expenses'];
        $totalProfit += $row['profit'];
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Financial Reporting Dashboard - Lab</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 text-slate-100 min-h-screen">

<div class="max-w-7xl mx-auto p-8">

    <a href="../../index.php"
       class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-700 px-4 py-2 rounded-xl border border-slate-700 mb-6">
        ← Kembali ke Dashboard
    </a>

    <h1 class="text-3xl font-bold mb-2">
        🏦 Financial Reporting Dashboard
    </h1>

    <p class="text-slate-400 mb-8">
        Internal Finance Monitoring System <span class="text-red-500 font-bold">(Lab Vulnerable Edition)</span>
    </p>

    <!-- KOTAK ERROR DATABASE (Tempat hasil payload dieksekusi) -->
    <?php if (isset($sql_error)): ?>
        <div class="bg-red-500/10 border border-red-500/30 p-4 rounded-xl text-red-400 font-mono text-sm mb-6">
            <p class="font-bold text-red-500 mb-1">⚠️ SQL Syntax Error Detected:</p>
            <code><?= htmlspecialchars($sql_error) ?></code>
        </div>
    <?php endif; ?>

    <!-- WIDGET MENU SORTING (Untuk simulasi normal) -->
    <div class="flex gap-3 mb-6">
        <span class="text-slate-400 self-center">Urutkan Berdasarkan:</span>
        <a href="?sort=report_month" class="bg-slate-900 border border-slate-800 hover:bg-slate-800 px-4 py-2 rounded-xl text-sm">Bulan</a>
        <a href="?sort=revenue" class="bg-slate-900 border border-slate-800 hover:bg-slate-800 px-4 py-2 rounded-xl text-sm">Revenue</a>
        <a href="?sort=expenses" class="bg-slate-900 border border-slate-800 hover:bg-slate-800 px-4 py-2 rounded-xl text-sm">Expenses</a>
        <a href="?sort=profit" class="bg-slate-900 border border-slate-800 hover:bg-slate-800 px-4 py-2 rounded-xl text-sm">Profit</a>
    </div>

    <!-- STATISTIK TOTAL -->
    <div class="grid md:grid-cols-3 gap-6 mb-8">
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
            <p class="text-slate-400 text-sm">Total Revenue</p>
            <h2 class="text-3xl font-bold text-green-400 mt-2">
                Rp <?= number_format($totalRevenue,0,',','.') ?>
            </h2>
        </div>
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
            <p class="text-slate-400 text-sm">Total Expenses</p>
            <h2 class="text-3xl font-bold text-red-400 mt-2">
                Rp <?= number_format($totalExpenses,0,',','.') ?>
            </h2>
        </div>
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
            <p class="text-slate-400 text-sm">Total Profit</p>
            <h2 class="text-3xl font-bold text-cyan-400 mt-2">
                Rp <?= number_format($totalProfit,0,',','.') ?>
            </h2>
        </div>
    </div>

    <!-- TABEL DATA -->
    <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-800">
                <tr>
                    <th class="text-left p-4">Month</th>
                    <th class="text-left p-4">Revenue</th>
                    <th class="text-left p-4">Expenses</th>
                    <th class="text-left p-4">Profit</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($data)): ?>
                <?php foreach($data as $row): ?>
                    <tr class="border-t border-slate-800">
                        <td class="p-4"><?= htmlspecialchars($row['report_month']) ?></td>
                        <td class="p-4 text-green-400">Rp <?= number_format($row['revenue'],0,',','.') ?></td>
                        <td class="p-4 text-red-400">Rp <?= number_format($row['expenses'],0,',','.') ?></td>
                        <td class="p-4 text-cyan-400">Rp <?= number_format($row['profit'],0,',','.') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="p-4 text-center text-slate-500">Tidak ada data atau query sedang error.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>