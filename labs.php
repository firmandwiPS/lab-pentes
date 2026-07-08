<?php
$title = 'Pentest Web Lab';
include 'layout/header.php';
?>

<section class="">
    <div class="mb-8">
        <div class="flex items-center gap-2 text-blue-400 text-sm font-semibold uppercase mb-2">
            <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
            Pentest Labs
        </div>

        <h2 class="text-4xl font-bold text-white">
            🧪 Laboratorium Eksploitasi
        </h2>

        <p class="text-slate-400 mt-3 max-w-3xl">
            Pilih kategori kerentanan yang ingin dipelajari dan diuji pada lingkungan laboratorium lokal.
        </p>
    </div>

    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 hover:border-blue-500 transition flex flex-col justify-between">
            <div>
                <div class="text-5xl mb-4">🗄️</div>
                <h3 class="text-xl font-bold mb-3 text-white">SQL Injection</h3>
                <p class="text-slate-400 text-sm mb-6">
                    Pelajari bypass login, union injection, error-based, hingga blind data extraction melalui tantangan terstruktur.
                </p>
            </div>
            <a href="labs/sqli/sqli.php" class="w-full bg-blue-600 hover:bg-blue-500 py-3 rounded-xl font-semibold text-center text-white block transition">
                🚀 Masuk Lab SQLi
            </a>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 hover:border-blue-500 transition flex flex-col justify-between">
            <div>
                <div class="text-5xl mb-4">⚡</div>
                <h3 class="text-xl font-bold mb-3 text-white">XSS Lab</h3>
                <p class="text-slate-400 text-sm mb-6">
                    Uji kemampuan manipulasi skrip melalui tantangan Reflected, Stored, hingga DOM-Based Cross-Site Scripting.
                </p>
            </div>
            <a href="labs/xss/xss.php" class="w-full bg-blue-600 hover:bg-blue-500 py-3 rounded-xl font-semibold text-center text-white block transition">
                 🚀 Masuk Lab XSS 
            </a>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 opacity-75 flex flex-col justify-between">
            <div>
                <div class="text-5xl mb-4">📁</div>
                <h3 class="text-xl font-bold mb-3 text-white">File Upload</h3>
                <p class="text-slate-400 text-sm mb-6">
                    Simulasi bypass upload shell, validasi ekstensi file, dan bypass MIME-type checker.
                </p>
            </div>
            <div class="bg-slate-800 rounded-xl py-3 text-center text-slate-500 font-medium">
                🚧 Coming Soon
            </div>
        </div>

    </div>
</section>

<?php include 'layout/footer.php'; ?>