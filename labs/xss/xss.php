<?php
$title = 'XSS Vulnerability Lab';
// Keluar 2 tingkat (dari xxs ke lab) untuk mengambil folder layout
include '../../layout/header.php';
?>

<section class="">
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-2 text-sm">
            <a href="../../labs.php" class="text-slate-400 hover:text-blue-400 transition">Labs</a>
            <span class="text-slate-600">/</span>
            <span class="text-blue-400 font-semibold">Cross-Site Scripting (XSS)</span>
        </div>
        
        <h2 class="text-4xl font-bold text-white flex items-center gap-3">
            ⚡ Cross-Site Scripting Challenges
        </h2>
        <p class="text-slate-400 mt-3 max-w-3xl">
            Pelajari bagaimana input yang tidak divalidasi dapat mengeksekusi kode JavaScript berbahaya di sisi klien. Mulailah dari reflected dasar hingga manipulasi DOM.
        </p>
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 hover:border-emerald-500/50 transition flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <span class="text-xs text-slate-500">ID: XSS-01</span>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">🔍 Search Engine Echo</h3>
                <p class="text-slate-400 text-xs line-clamp-3 mb-4">
                    Tujuan: Suntikkan payload skrip berbahaya melalui parameter pencarian yang langsung dipantulkan kembali ke layar tanpa sanitasi.
                </p>
                <div class="text-xs text-blue-400 font-mono bg-slate-950 p-2 rounded mb-4 border border-slate-800">
                    Target: Reflected XSS (Basic)
                </div>
            </div>
            <a href="challenge1/search.php" class="w-full bg-slate-800 hover:bg-emerald-600 hover:text-white py-2.5 rounded-xl text-center text-slate-300 font-semibold text-sm transition block">
                Start Challenge 🎯
            </a>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 hover:border-emerald-500/50 transition flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <span class="text-xs text-slate-500">ID: XSS-02</span>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">💬 Guestbook Comments</h3>
                <p class="text-slate-400 text-xs line-clamp-3 mb-4">
                    Tujuan: Simpan payload JavaScript permanen ke dalam database melalui kolom komentar sehingga tereksekusi otomatis pada browser pengunjung lain.
                </p>
                <div class="text-xs text-blue-400 font-mono bg-slate-950 p-2 rounded mb-4 border border-slate-800">
                    Target: Stored XSS (Persistent)
                </div>
            </div>
            <a href="challenge2/guestbook.php" class="w-full bg-slate-800 hover:bg-emerald-600 hover:text-white py-2.5 rounded-xl text-center text-slate-300 font-semibold text-sm transition block">
                Start Challenge 🎯
            </a>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 hover:border-amber-500/50 transition flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <span class="text-xs text-slate-500">ID: XSS-03</span>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">🌐 Client-Side Dashboard</h3>
                <p class="text-slate-400 text-xs line-clamp-3 mb-4">
                    Tujuan: Manipulasi objek DOM aplikasi web menggunakan URL fragmen (`#`) atau parameter klien untuk memicu eksekusi kode tanpa melibatkan server.
                </p>
                <div class="text-xs text-blue-400 font-mono bg-slate-950 p-2 rounded mb-4 border border-slate-800">
                    Target: DOM-Based XSS
                </div>
            </div>
            <a href="challenge3/dashboard.php" class="w-full bg-slate-800 hover:bg-amber-600 hover:text-white py-2.5 rounded-xl text-center text-slate-300 font-semibold text-sm transition block">
                Start Challenge 🎯
            </a>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 hover:border-rose-500/50 transition flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <span class="text-xs text-slate-500">ID: XSS-04</span>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">🛡️ WAF & Keyword Filter</h3>
                <p class="text-slate-400 text-xs line-clamp-3 mb-4">
                    Tujuan: Lewati proteksi filter regex sederhana yang menghapus tag &lt;script&gt;. Gunakan alternatif tag HTML atau event handler lain untuk memicu *pop-up*.
                </p>
                <div class="text-xs text-blue-400 font-mono bg-slate-950 p-2 rounded mb-4 border border-slate-800">
                    Target: Mitigation & Filter Bypass
                </div>
            </div>
            <a href="challenge4/filter.php" class="w-full bg-slate-800 hover:bg-rose-600 hover:text-white py-2.5 rounded-xl text-center text-slate-300 font-semibold text-sm transition block">
                Start Challenge 🎯
            </a>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 hover:border-rose-500/50 transition flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <span class="text-xs text-slate-500">ID: XSS-05</span>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">🍪 Session Thief Portal</h3>
                <p class="text-slate-400 text-xs line-clamp-3 mb-4">
                    Tujuan: Eksploitasi XSS tingkat lanjut untuk mencuri data session token (`document.cookie`) milik pengguna lain dan mengirimkannya ke server eksternal.
                </p>
                <div class="text-xs text-blue-400 font-mono bg-slate-950 p-2 rounded mb-4 border border-slate-800">
                    Target: Cookie Stealing & Session Hijacking
                </div>
            </div>
            <a href="challenge5/portal.php" class="w-full bg-slate-800 hover:bg-rose-600 hover:text-white py-2.5 rounded-xl text-center text-slate-300 font-semibold text-sm transition block">
                Start Challenge 🎯
            </a>
        </div>

    </div>
</section>

<?php 
include '../../layout/footer.php'; 
?>