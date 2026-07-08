<?php
$conn = mysqli_connect("localhost", "root", "", "pentest_lab");

if (!$conn) {
    die("Koneksi database gagal.");
}

$sort = $_GET['sort'] ?? 'id'; 
$flag_captured = "";
$sql_error = null;

// KODE RENTAN: Langsung digabung ke query ORDER BY
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

if (!$result) {
    $error_message = mysqli_error($conn);
    
    // LOGIKA DETEKSI FLAG DI DALAM ERROR HANDLING
    if (strpos($error_message, 'FLAG{') !== false) {
        preg_match('/FLAG\{([^}]+)\}/', $error_message, $matches);
        $flag_captured = isset($matches[0]) ? $matches[0] : $error_message;
    } else {
        $sql_error = $error_message;
    }
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
    <title>Financial Reporting Dashboard - SQLi Lab</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 text-slate-100 min-h-screen">

<div class="max-w-7xl mx-auto p-8">

    <a href="../sqli.php"
       class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-700 px-4 py-2 rounded-xl border border-slate-700 mb-6 text-sm transition">
        ← Kembali ke Dashboard
    </a>

    <h1 class="text-3xl font-bold mb-2">
        🏦 Financial Reporting Dashboard (ORDER BY Injection)
    </h1>

    <p class="text-slate-400 mb-8 text-sm">
        Parameter pengurutan data sangat sering diabaikan pengembang. Temukan cara menyuntikkan fungsi <code class="text-red-400 font-mono">updatexml()</code> ke klausul pengurutan data.
    </p>

    <?php if ($flag_captured): ?>
        <div class="bg-emerald-950/30 border border-emerald-800/60 rounded-2xl p-5 border-l-4 border-l-emerald-500 shadow-2xl mb-6">
            <div class="flex items-center gap-2 text-emerald-400 font-bold text-sm mb-2">
                <span>🏁</span> ORDER BY EXFILTRATION SUCCESS
            </div>
            <p class="text-slate-300 text-xs mb-3 leading-relaxed">
                Luar biasa! Kamu berhasil memanfaatkan celah injeksi pada struktur kontrol <code class="text-emerald-400 bg-slate-950 px-1 py-0.5 rounded font-mono">ORDER BY</code> dan memaksa database memicu kesalahan XPath runtime yang membocorkan token bendera.
            </p>
            <div class="bg-slate-950 p-4 rounded-xl border border-slate-800 flex items-center justify-between font-mono">
                <span class="text-sm text-emerald-400 font-bold select-all"><?= htmlspecialchars($flag_captured) ?></span>
                <span class="text-[10px] text-slate-500 bg-slate-900 px-2 py-0.5 rounded">Captured via Sort Error</span>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($sql_error): ?>
        <div class="bg-red-500/10 border border-red-500/30 p-4 rounded-xl text-red-400 font-mono text-sm mb-6">
            <p class="font-bold text-red-500 mb-1">⚠️ SQL Syntax Error Detected:</p>
            <code><?= htmlspecialchars($sql_error) ?></code>
        </div>
    <?php endif; ?>

    <div class="flex gap-3 mb-6">
        <span class="text-slate-400 self-center text-sm">Urutkan Berdasarkan:</span>
        <a href="?sort=report_month" class="bg-slate-900 border border-slate-800 hover:bg-slate-800 px-4 py-2 rounded-xl text-sm transition">Bulan</a>
        <a href="?sort=revenue" class="bg-slate-900 border border-slate-800 hover:bg-slate-800 px-4 py-2 rounded-xl text-sm transition">Revenue</a>
        <a href="?sort=expenses" class="bg-slate-900 border border-slate-800 hover:bg-slate-800 px-4 py-2 rounded-xl text-sm transition">Expenses</a>
        <a href="?sort=profit" class="bg-slate-900 border border-slate-800 hover:bg-slate-800 px-4 py-2 rounded-xl text-sm transition">Profit</a>
    </div>

    <div class="grid md:grid-cols-3 gap-6 mb-8">
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
            <p class="text-slate-400 text-sm">Total Revenue</p>
            <h2 class="text-3xl font-bold text-green-400 mt-2">Rp <?= number_format($totalRevenue,0,',','.') ?></h2>
        </div>
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
            <p class="text-slate-400 text-sm">Total Expenses</p>
            <h2 class="text-3xl font-bold text-red-400 mt-2">Rp <?= number_format($totalExpenses,0,',','.') ?></h2>
        </div>
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
            <p class="text-slate-400 text-sm">Total Profit</p>
            <h2 class="text-3xl font-bold text-cyan-400 mt-2">Rp <?= number_format($totalProfit,0,',','.') ?></h2>
        </div>
    </div>

    <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
        <table class="w-full text-sm">
            <thead class="bg-slate-800/60 text-slate-200">
                <tr>
                    <th class="text-left p-4">Month</th>
                    <th class="text-left p-4">Revenue</th>
                    <th class="text-left p-4">Expenses</th>
                    <th class="text-left p-4">Profit</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/40">
            <?php if (!empty($data)): ?>
                <?php foreach($data as $row): ?>
                    <tr class="hover:bg-slate-850/30 transition">
                        <td class="p-4 font-medium"><?= htmlspecialchars($row['report_month']) ?></td>
                        <td class="p-4 text-green-400">Rp <?= number_format($row['revenue'],0,',','.') ?></td>
                        <td class="p-4 text-red-400">Rp <?= number_format($row['expenses'],0,',','.') ?></td>
                        <td class="p-4 text-cyan-400">Rp <?= number_format($row['profit'],0,',','.') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="p-8 text-center text-slate-500 italic">Tidak ada data atau struktur query mengalami gangguan.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>