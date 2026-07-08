<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "pentest_lab");

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Proses jika form dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $pesan = $_POST['pesan'];

    if (!empty($nama) && !empty($pesan)) {
        // Menggunakan escape string agar tanda kutip payload XSS tidak merusak SQL syntax
        $safe_nama = mysqli_real_escape_string($conn, $nama);
        $safe_pesan = mysqli_real_escape_string($conn, $pesan);

        // Simpan ke database
        $query = "INSERT INTO `xss_komentar` (`nama`, `pesan`) VALUES ('$safe_nama', '$safe_pesan')";
        mysqli_query($conn, $query);
        
        // Refresh halaman agar input langsung muncul
        header("Location: guestbook.php");
        exit();
    }
}

$title = 'XSS Challenge 2 - Stored Guestbook';
include '../../../layout/header.php'; 

// Inisialisasi pengecekan database untuk memicu spanduk Flag
$flag_captured = false;
$check_stored = mysqli_query($conn, "SELECT nama, pesan FROM xss_komentar");
if ($check_stored) {
    while ($check_row = mysqli_fetch_assoc($check_stored)) {
        // Jika di dalam database tersimpan script tag atau event handler XSS
        if (
            preg_match('/<script>|alert\(|onerror=|onload=/i', $check_row['nama']) || 
            preg_match('/<script>|alert\(|onerror=|onload=/i', $check_row['pesan'])
        ) {
            $flag_captured = true;
            break;
        }
    }
}
?>

<section class="py-6">
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-2 text-sm">
            <a href="../../xss/xss.php" class="text-slate-400 hover:text-blue-400 transition">XSS Dashboard</a>
            <span class="text-slate-600">/</span>
            <span class="text-emerald-400 font-semibold">Challenge 2</span>
        </div>
        
        <h2 class="text-3xl font-bold text-white flex items-center gap-3">
            💬 Challenge 2: Guestbook Comments (Stored XSS)
        </h2>
        <p class="text-slate-400 mt-2 max-w-3xl">
            Tantangan ini menyimulasikan kolom komentar atau buku tamu. Skrip yang berhasil masuk ke sini akan tereksekusi secara menetap pada setiap pengguna yang mengunjungi halaman ini.
        </p>
    </div>

    <?php if ($flag_captured): ?>
        <div class="bg-emerald-950/30 border border-emerald-800/60 rounded-2xl p-5 border-l-4 border-l-emerald-500 shadow-2xl mb-6 animate-fade-in">
            <div class="flex items-center gap-2 text-emerald-400 font-bold text-sm mb-2">
                <span>🏁</span> STORED XSS COMPROMISED
            </div>
            <p class="text-slate-300 text-xs mb-3 leading-relaxed">
                Luar biasa! Kamu berhasil menyuntikkan muatan kode persisten ke dalam basis data. Karena data dari kolom komentar dirender tanpa validasi kontekstual ataupun encoding output, browser siapa pun yang membuka halaman ini akan mengeksekusi muatan skrip tersebut.
            </p>
            <div class="bg-slate-950 p-4 rounded-xl border border-slate-800 flex items-center justify-between font-mono">
                <span class="text-sm text-emerald-400 font-bold select-all">FLAG{St0r3d_XSS_Guesth00k_Persist_2026}</span>
                <span class="text-[10px] text-slate-500 bg-slate-900 px-2 py-0.5 rounded">Stored captured</span>
            </div>
        </div>
    <?php endif; ?>

    <div class="grid gap-6 md:grid-cols-3">
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 h-fit">
            <h3 class="text-lg font-bold text-white mb-4">Isi Buku Tamu</h3>
            <form action="" method="POST" class="space-y-4">
                <div>
                    <label class="block text-xs text-slate-400 uppercase font-semibold mb-2">Nama</label>
                    <input type="text" name="nama" required placeholder="Nama Anda..." 
                           class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-white focus:outline-none focus:border-emerald-500 text-sm">
                </div>
                <div>
                    <label class="block text-xs text-slate-400 uppercase font-semibold mb-2">Pesan Komentar</label>
                    <textarea name="pesan" rows="4" required placeholder="Tulis komentar atau payload XSS..." 
                              class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-white focus:outline-none focus:border-emerald-500 text-sm"></textarea>
                </div>
                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-semibold py-2.5 rounded-xl transition text-sm">
                    Kirim Komentar 🚀
                </button>
            </form>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 md:col-span-2">
            <h3 class="text-lg font-bold text-white mb-4">Daftar Komentar Pengunjung</h3>
            
            <div class="space-y-4 max-h-[500px] overflow-y-auto pr-2">
                <?php
                // Ambil semua komentar dari database
                $result = mysqli_query($conn, "SELECT * FROM xss_komentar ORDER BY id DESC");
                if (mysqli_num_rows($result) > 0):
                    while ($row = mysqli_fetch_assoc($result)):
                ?>
                    <div class="bg-slate-950 border border-slate-800 rounded-xl p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-bold text-emerald-400"><?php echo $row['nama']; ?></span>
                            <span class="text-xs text-slate-500"><?php echo $row['tanggal']; ?></span>
                        </div>
                        <p class="text-slate-300 text-sm leading-relaxed whitespace-pre-line"><?php echo $row['pesan']; ?></p>
                    </div>
                <?php 
                    endwhile;
                else: 
                ?>
                    <p class="text-slate-500 text-sm text-center py-4">Belum ada komentar.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php 
mysqli_close($conn);
include '../../../layout/footer.php'; 
?>