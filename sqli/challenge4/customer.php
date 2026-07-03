<?php

$conn = mysqli_connect("localhost", "root", "", "pentest_lab");

if (!$conn) {
    die("Koneksi database gagal.");
}

$keyword = trim($_GET['q'] ?? '');

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

// GANTI KODE BARIS 21 - 36 DENGAN KODE RENTAN INI:

if ($keyword !== "") {
    // Sengaja dibuat rentan: input langsung digabung menggunakan petik tunggal
    $sql .= " WHERE full_name LIKE '%$keyword%' OR email LIKE '%$keyword%' OR city LIKE '%$keyword%' ";
}

// Langsung eksekusi tanpa binding param
$result = mysqli_query($conn, $sql);

// Opsional: Buka error database agar bisa belajar Error-Based juga jika query salah
if (!$result) {
    die("<div class='bg-red-500/10 border border-red-500/20 p-4 rounded-xl text-red-400 font-mono text-xs mb-4'>
            ⚠️ SQL Error: " . mysqli_error($conn) . "
         </div>");
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Customer Management System</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 text-slate-100 min-h-screen">

<div class="max-w-6xl mx-auto p-8">

    <a href="../../index.php"
       class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-700 px-4 py-2 rounded-xl border border-slate-700 mb-6">
        ← Kembali ke Dashboard
    </a>

    <h1 class="text-3xl font-bold mb-2">
        👥 Customer Management System
    </h1>

    <p class="text-slate-400 mb-8">
        Dashboard pelanggan perusahaan.
    </p>

    <form method="GET" class="mb-6">
        <input
            type="text"
            name="q"
            value="<?= htmlspecialchars($keyword) ?>"
            placeholder="Cari nama, email, atau kota..."
            class="w-full bg-slate-900 border border-slate-800 rounded-xl p-3">
    </form>

    <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-800">
                <tr>
                    <th class="text-left p-4">Kode</th>
                    <th class="text-left p-4">Nama</th>
                    <th class="text-left p-4">Email</th>
                    <th class="text-left p-4">Telepon</th>
                    <th class="text-left p-4">Kota</th>
                </tr>
            </thead>

            <tbody>

            <?php while($row = mysqli_fetch_assoc($result)): ?>

                <tr class="border-t border-slate-800">
                    <td class="p-4"><?= htmlspecialchars($row['customer_code']) ?></td>
                    <td class="p-4"><?= htmlspecialchars($row['full_name']) ?></td>
                    <td class="p-4"><?= htmlspecialchars($row['email']) ?></td>
                    <td class="p-4"><?= htmlspecialchars($row['phone']) ?></td>
                    <td class="p-4"><?= htmlspecialchars($row['city']) ?></td>
                </tr>

            <?php endwhile; ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>