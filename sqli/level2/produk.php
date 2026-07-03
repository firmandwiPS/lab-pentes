<?php
include_once __DIR__ . "/../../db.php";

$message = "";
$query = "";
$data = [];

// Studi Kasus Nyata: Fitur Pencarian Produk / Katalog Toko Online
if(isset($_GET['search']))
{
    $search = $_GET['search'];

    // Query yang rentan: Variabel langsung dimasukkan tanpa sanitasi/prepared statements
    $query = "SELECT id, name, price, description FROM products WHERE name LIKE '%$search%'";

    $result = mysqli_query($conn, $query);

    if($result)
    {
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            $message = "✨ Ditemukan " . count($data) . " produk yang cocok.";
        } else {
            $message = "ℹ️ Produk tidak ditemukan.";
        }
    }
    else
    {
        // Menampilkan pesan error database agar mempermudah penyerang melakukan debug UNION (Khas sistem rentan)
        $message = "❌ Database Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab SQL Injection - Level 2 (Union Based)</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen font-sans antialiased">

    <!-- Header / Navigasi -->
    <header class="border-b border-slate-800 bg-slate-900/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-blue-600 p-2.5 rounded-xl shadow-lg">
                    <span class="text-white text-xl">🗄️</span>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white">SQL Injection: Level 2</h1>
                    <p class="text-xs text-slate-400">Skenario Nyata: Union-Based Injection pada Fitur Pencarian</p>
                </div>
            </div>
            <a href="../../index.php" class="bg-slate-800 hover:bg-slate-700 text-slate-200 px-4 py-2 rounded-xl text-sm font-medium border border-slate-700 transition">
                🏠 Kembali ke Menu
            </a>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="max-w-4xl mx-auto px-6 py-10">
        
        <!-- Kartu Deskripsi Misi -->
        <div class="bg-slate-800/40 border border-slate-800 rounded-2xl p-6 mb-8">
            <h2 class="text-lg font-bold text-blue-400 mb-2">🎯 Misi Pentest:</h2>
            <p class="text-slate-300 text-sm leading-relaxed">
                Aplikasi di bawah ini adalah fitur pencarian barang toko online. Tugas Anda bukanlah membypass login, melainkan menggunakan teknik <span class="text-amber-400 font-mono">UNION SELECT</span> untuk mengeksfiltrasi (mencuri) data dari tabel lain, yaitu tabel <span class="text-cyan-400 font-mono">users</span>!
            </p>
        </div>

        <!-- Form Pencarian Realistis -->
        <div class="bg-slate-800/20 border border-slate-800/60 rounded-2xl p-6 mb-8 shadow-xl">
            <form method="GET" class="space-y-4">
                <div>
                    <label for="search" class="text-xs font-semibold text-slate-400 tracking-wide block uppercase mb-2">Cari Produk Kami:</label>
                    <div class="flex space-x-2">
                        <input type="text" name="search" id="search" 
                               value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                               placeholder="Contoh: Sepatu, Baju, Laptop..." 
                               class="flex-1 bg-slate-900 text-slate-200 px-4 py-2.5 border border-slate-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-500 text-white font-semibold text-sm px-6 py-2.5 rounded-xl transition shadow-md">
                            🔍 Cari
                        </button>
                    </div>
                </div>
            </form>

            <!-- Query Debugger (Sangat bagus untuk edukasi lab agar user paham apa yang terjadi) -->
            <div class="mt-4 pt-4 border-t border-slate-800/60">
                <span class="text-xs font-semibold text-slate-500 uppercase block mb-1">Query SQL Backend yang Terjadi:</span>
                <code class="text-xs text-amber-400 bg-slate-950 px-3 py-1.5 rounded block overflow-x-auto">
                    <?php echo $query ? $query : "Menunggu input..."; ?>
                </code>
            </div>
        </div>

        <!-- Notifikasi Status -->
        <?php if($message): ?>
            <div class="p-4 rounded-xl mb-6 text-sm font-medium border <?php echo strpos($message, '❌') !== false ? 'bg-red-500/10 border-red-500/20 text-red-400' : 'bg-slate-800/50 border-slate-700 text-slate-300'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <!-- Hasil Tampilan Tabel Data -->
        <?php if(!empty($data)): ?>
            <div class="bg-slate-800/30 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
                <div class="px-6 py-4 bg-slate-800/50 border-b border-slate-800">
                    <h3 class="font-bold text-white text-sm">📊 Hasil Pencarian Produk</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-300">
                        <thead class="text-xs text-slate-400 uppercase bg-slate-900/50 border-b border-slate-800">
                            <tr>
                                <th class="px-6 py-3">ID Barang</th>
                                <th class="px-6 py-3">Nama Produk</th>
                                <th class="px-6 py-3">Harga</th>
                                <th class="px-6 py-3">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800">
                            <?php foreach($data as $row): ?>
                                <tr class="hover:bg-slate-800/20 transition">
                                    <td class="px-6 py-4 font-mono text-blue-400"><?php echo $row['id']; ?></td>
                                    <!-- Catatan: Di dunia nyata data ini di-escape, namun pada lab data kolom lain sengaja ditampilkan mentah jika terkena UNION -->
                                    <td class="px-6 py-4 font-medium text-white"><?php echo $row['name']; ?></td>
                                    <td class="px-6 py-4 text-emerald-400"><?php echo is_numeric($row['price']) ? "Rp " . number_format($row['price'], 0, ',', '.') : $row['price']; ?></td>
                                    <td class="px-6 py-4 text-slate-400 max-w-xs truncate"><?php echo $row['description']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>

    </main>

    <footer class="border-t border-slate-800/60 text-center text-slate-500 py-6 text-xs mt-auto">
        Pentest Web Lab &copy; 2026 &bull; Skenario Union Based Injection
    </footer>

</body>
</html>