<?php
// Koneksi langsung ke database pentest_lab
$conn = mysqli_connect("localhost", "root", "", "pentest_lab");

// Cek koneksi jika bermasalah
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

$title = 'XSS Challenge 1 - Search Echo';
// Path naik 3 tingkat karena file ini berada di dalam xxs/challenge1/search.php
include '../../../layout/header.php'; 

// Inisialisasi status flag
$flag_captured = false;
if (isset($_GET['keyword'])) {
    $raw_keyword = $_GET['keyword'];
    // Deteksi jika pengguna berhasil memasukkan payload XSS berbasis tag script atau event handler
    if (preg_match('/<script>|alert\(|onerror=|onload=/i', $raw_keyword)) {
        $flag_captured = true;
    }
}
?>

<section class="py-6">
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-2 text-sm">
            <a href="../../xss/xss.php" class="text-slate-400 hover:text-blue-400 transition">XSS Dashboard</a>
            <span class="text-slate-600">/</span>
            <span class="text-emerald-400 font-semibold">Challenge 1</span>
        </div>
        
        <h2 class="text-3xl font-bold text-white flex items-center gap-3">
            🔍 Challenge 1: Search Engine Echo
        </h2>
        <p class="text-slate-400 mt-2 max-w-3xl">
            Selamat datang di mesin pencari laboratorium. Temukan celah keamanan Reflected XSS di sini dengan merefleksikan skrip JavaScript langsung ke browser!
        </p>
    </div>

    <?php if ($flag_captured): ?>
        <div class="bg-emerald-950/30 border border-emerald-800/60 rounded-2xl p-5 border-l-4 border-l-emerald-500 shadow-2xl mb-6 animate-fade-in">
            <div class="flex items-center gap-2 text-emerald-400 font-bold text-sm mb-2">
                <span>🏁</span> REFLECTED XSS SUCCESS
            </div>
            <p class="text-slate-300 text-xs mb-3 leading-relaxed">
                Luar biasa! Browser berhasil dipaksa untuk merender input string sebagai kode eksekusi JavaScript aktif karena tidak adanya fungsi <code class="text-emerald-400 bg-slate-950 px-1 py-0.5 rounded font-mono">htmlspecialchars()</code> pada refleksi layar.
            </p>
            <div class="bg-slate-950 p-4 rounded-xl border border-slate-800 flex items-center justify-between font-mono">
                <span class="text-sm text-emerald-400 font-bold select-all">FLAG{XSS_R3fl3ct3d_3ch0_Byp4ss_2026}</span>
                <span class="text-[10px] text-slate-500 bg-slate-900 px-2 py-0.5 rounded">Captured</span>
            </div>
        </div>
    <?php endif; ?>

    <div class="grid gap-6 md:grid-cols-3">
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 md:col-span-2">
            <h3 class="text-lg font-bold text-white mb-4">Mesin Pencari Artikel</h3>
            
            <form action="" method="GET" class="flex gap-2">
                <input type="text" name="keyword" placeholder="Ketik kata kunci (misal: Hacking, XSS)..." 
                       value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword'], ENT_QUOTES) : ''; ?>"
                       class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-white focus:outline-none focus:border-emerald-500 text-sm">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white font-semibold px-6 py-3 rounded-xl transition text-sm flex items-center gap-2 whitespace-nowrap">
                    Cari 🔍
                </button>
            </form>

            <?php 
            if (isset($_GET['keyword']) && $_GET['keyword'] !== ''): 
                $keyword = $_GET['keyword'];
                
                // Query database (Gunakan pelarian string bawaan untuk mencegah SQLi sekunder)
                $safe_keyword = mysqli_real_escape_string($conn, $keyword);
                $query = "SELECT * FROM xss_artikel WHERE judul LIKE '%$safe_keyword%' OR konten LIKE '%$safe_keyword%'";
                $result = mysqli_query($conn, $query);
            ?>
                <div class="mt-8 border-t border-slate-800 pt-6">
                    <p class="text-slate-400 text-sm mb-4">
                        Hasil pencarian untuk kata kunci: 
                        <span class="text-emerald-400 font-semibold">
                            <?php echo $keyword; ?>
                        </span>
                    </p>

                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <div class="space-y-4">
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                                <div class="bg-slate-950 border border-slate-800 rounded-xl p-5">
                                    <h4 class="text-white font-bold text-base mb-1"><?php echo htmlspecialchars($row['judul']); ?></h4>
                                    <span class="text-xs text-slate-500 block mb-2">Diposting pada: <?php echo $row['tanggal']; ?></span>
                                    <p class="text-slate-400 text-sm leading-relaxed"><?php echo htmlspecialchars($row['konten']); ?></p>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <div class="bg-slate-950 border border-slate-800 rounded-xl p-8 text-center">
                            <div class="text-4xl mb-2">📭</div>
                            <h4 class="text-white font-semibold text-sm">Artikel tidak ditemukan</h4>
                            <p class="text-slate-500 text-xs mt-1">Coba gunakan kata kunci atau tag pencarian yang lain.</p>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 h-fit">
            <h3 class="text-lg font-bold text-amber-400 mb-3">💡 Petunjuk Target</h3>
            <p class="text-slate-400 text-xs leading-relaxed mb-4">
                Aplikasi ini mengambil nilai dari parameter URL <code class="text-emerald-400 font-mono">?keyword=</code> lalu menampilkannya kembali ke layar. Karena teks dicetak mentah-mentah, Anda bisa memasukkan kode HTML atau JavaScript.
            </p>
            
            <div class="bg-slate-950 p-3 rounded-xl border border-slate-800">
                <span class="text-xs text-slate-500 block mb-1">Contoh Eksploitasi:</span>
                <code class="text-xs text-rose-400 font-mono break-all block">
                    &lt;script&gt;alert('XSS')&lt;/script&gt;
                </code>
            </div>
        </div>
    </div>
</section>

<?php 
// Tutup koneksi database setelah selesai digunakan
mysqli_close($conn);

// Path naik 3 tingkat menuju folder utama layout
include '../../../layout/footer.php'; 
?>