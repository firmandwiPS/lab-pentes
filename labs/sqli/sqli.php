<?php
$title = 'SQL Injection Lab';
include '../../layout/header.php';
?>

<section class="">
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-2 text-sm">
            <a href="../../labs.php" class="text-slate-400 hover:text-blue-400 transition">Labs</a>
            <span class="text-slate-600">/</span>
            <span class="text-blue-400 font-semibold">SQL Injection</span>
        </div>
        
        <h2 class="text-4xl font-bold text-white flex items-center gap-3">
            🗄️ SQL Injection Challenges
        </h2>
        <p class="text-slate-400 mt-3 max-w-3xl">
            Selesaikan misi eksploitasi database di bawah ini. Mulailah dari tingkat dasar hingga teknik blind extraction yang lebih rumit.
        </p>
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 hover:border-emerald-500/50 transition flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <!-- <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Easy</span> -->
                    <span class="text-xs text-slate-500">ID: SQLi-01</span>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">🏢 Employee Portal Login</h3>
                <p class="text-slate-400 text-xs line-clamp-3 mb-4">
                    Tujuan: Bypass halaman login admin tanpa mengetahui password asli pengguna menggunakan teknik manipulasi logika logika query SQL.
                </p>
                <div class="text-xs text-blue-400 font-mono bg-slate-950 p-2 rounded mb-4 border border-slate-800">
                    Target: Authentication Bypass
                </div>
            </div>
            <a href="challenge1/login.php" class="w-full bg-slate-800 hover:bg-emerald-600 hover:text-white py-2.5 rounded-xl text-center text-slate-300 font-semibold text-sm transition block">
                Start Challenge 🎯
            </a>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 hover:border-emerald-500/50 transition flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <!-- <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Easy</span> -->
                    <span class="text-xs text-slate-500">ID: SQLi-02</span>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">🛒 E-Commerce Product Search</h3>
                <p class="text-slate-400 text-xs line-clamp-3 mb-4">
                    Tujuan: Ekstraksi data sensitif dari tabel lain dengan menggabungkan query pencarian produk menggunakan operator UNION.
                </p>
                <div class="text-xs text-blue-400 font-mono bg-slate-950 p-2 rounded mb-4 border border-slate-800">
                    Target: UNION-Based Injection
                </div>
            </div>
            <a href="challenge2/products.php" class="w-full bg-slate-800 hover:bg-emerald-600 hover:text-white py-2.5 rounded-xl text-center text-slate-300 font-semibold text-sm transition block">
                Start Challenge 🎯
            </a>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 hover:border-amber-500/50 transition flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <!-- <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-500/10 text-amber-400 border border-amber-500/20">Medium</span> -->
                    <span class="text-xs text-slate-500">ID: SQLi-03</span>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">📰 CMS Article Viewer</h3>
                <p class="text-slate-400 text-xs line-clamp-3 mb-4">
                    Tujuan: Memanfaatkan pesan error database (MySQL/PostgreSQL) yang bocor ke browser untuk membaca struktur skema dan data internal.
                </p>
                <div class="text-xs text-blue-400 font-mono bg-slate-950 p-2 rounded mb-4 border border-slate-800">
                    Target: Error-Based Injection
                </div>
            </div>
            <a href="challenge3/article.php" class="w-full bg-slate-800 hover:bg-amber-600 hover:text-white py-2.5 rounded-xl text-center text-slate-300 font-semibold text-sm transition block">
                Start Challenge 🎯
            </a>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 hover:border-rose-500/50 transition flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <!-- <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-rose-500/10 text-rose-400 border border-rose-500/20">Hard</span> -->
                    <span class="text-xs text-slate-500">ID: SQLi-04</span>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">👥 Customer Management</h3>
                <p class="text-slate-400 text-xs line-clamp-3 mb-4">
                    Tujuan: Mengambil data karakter demi karakter dengan menganalisis respons Benar (True) atau Salah (False) dari halaman web.
                </p>
                <div class="text-xs text-blue-400 font-mono bg-slate-950 p-2 rounded mb-4 border border-slate-800">
                    Target: Boolean-Based Blind
                </div>
            </div>
            <a href="challenge4/customer.php" class="w-full bg-slate-800 hover:bg-rose-600 hover:text-white py-2.5 rounded-xl text-center text-slate-300 font-semibold text-sm transition block">
                Start Challenge 🎯
            </a>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 hover:border-rose-500/50 transition flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <!-- <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-rose-500/10 text-rose-400 border border-rose-500/20">Hard</span> -->
                    <span class="text-xs text-slate-500">ID: SQLi-05</span>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">🏦 Financial Reporting</h3>
                <p class="text-slate-400 text-xs line-clamp-3 mb-4">
                    Tujuan: Melakukan eksploitasi blind SQLi menggunakan fungsi waktu seperti `SLEEP()` karena aplikasi tidak memberikan respon output atau error yang berbeda.
                </p>
                <div class="text-xs text-blue-400 font-mono bg-slate-950 p-2 rounded mb-4 border border-slate-800">
                    Target: Time-Based Blind
                </div>
            </div>
            <a href="challenge5/report.php" class="w-full bg-slate-800 hover:bg-rose-600 hover:text-white py-2.5 rounded-xl text-center text-slate-300 font-semibold text-sm transition block">
                Start Challenge 🎯
            </a>
        </div>

    </div>
</section>

<?php include '../../layout/footer.php'; ?>