<?php
$title = 'Dashboard - Pentest Web Lab';
include 'layout/header.php';

// Simulasi Data Statistik (Nanti bisa dihubungkan ke Database jika sudah dinamis)
$total_labs = 100;
$solved_labs = 7; // Contoh: jika user sudah menyelesaikan 2 lab
$progress_percentage = round(($solved_labs / $total_labs) * 100);
?>

<div class="space-y-8 animate-fade-in">

    <div class="relative bg-slate-900 border border-slate-800 rounded-3xl p-6 md:p-8 overflow-hidden shadow-2xl">
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-emerald-500/5 rounded-full blur-2xl pointer-events-none"></div>

        <div class="relative z-10 max-w-3xl">
            <span class="bg-blue-500/10 text-blue-400 text-xs font-mono font-bold px-3 py-1 rounded-full border border-blue-500/20 uppercase tracking-wider">
                ⚡ Welcome Back, Operator
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-white mt-4 tracking-tight">
                Pertajam Skill Analisis & <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">Web Pentesting</span> Kamu.
            </h1>
            <p class="text-slate-400 text-sm md:text-base mt-2 leading-relaxed">
                Laboratorium lokal terisolasi ini dirancang khusus untuk mensimulasikan kerentanan dunia nyata. Pahami bagaimana celah keamanan bekerja, lakukan eksploitasi, dan pelajari cara mitigasinya.
            </p>
            <div class="flex flex-wrap gap-3 mt-6">
                <a href="/lab/labs/sqli/sqli.php" class="bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 text-white font-semibold text-sm px-5 py-2.5 rounded-xl transition shadow-lg shadow-blue-600/20 flex items-center gap-2">
                    Mulai Coding Lab 🧪
                </a>
                <a href="#quick-status" class="bg-slate-800 hover:bg-slate-700 text-slate-300 border border-slate-700 font-semibold text-sm px-5 py-2.5 rounded-xl transition flex items-center gap-2">
                    Lihat Progres 📊
                </a>
            </div>
        </div>
    </div>

    <div id="quick-status" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 flex items-center gap-4 shadow-md">
            <div class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-xl text-blue-400">
                🧪
            </div>
            <div>
                <p class="text-xs text-slate-500 uppercase font-mono tracking-wider">Total Tantangan</p>
                <h3 class="text-2xl font-bold text-white mt-0.5"><?= $total_labs ?> <span class="text-xs text-slate-500 font-normal">Lab</span></h3>
            </div>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 flex items-center gap-4 shadow-md">
            <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-xl text-emerald-400">
                🏁
            </div>
            <div>
                <p class="text-xs text-slate-500 uppercase font-mono tracking-wider">Berhasil Di-hack</p>
                <h3 class="text-2xl font-bold text-emerald-400 mt-0.5"><?= $solved_labs ?> / <?= $total_labs ?></h3>
            </div>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-md sm:col-span-2">
            <div class="flex justify-between items-center mb-2">
                <p class="text-xs text-slate-500 uppercase font-mono tracking-wider">Completion Rate</p>
                <span class="text-xs font-bold text-cyan-400 font-mono"><?= $progress_percentage ?>%</span>
            </div>
            <div class="w-full bg-slate-800 h-3 rounded-full overflow-hidden p-0.5 border border-slate-700">
                <div class="bg-gradient-to-r from-blue-500 to-emerald-500 h-full rounded-full transition-all duration-1000" style="width: <?= $progress_percentage ?>%"></div>
            </div>
            <p class="text-[10px] text-slate-500 mt-2 italic">*Kumpulkan token FLAG di setiap lab untuk menaikkan rate.</p>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-4">
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                📂 Kategori Pembelajaran Tersedia
            </h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                
                <div class="bg-slate-900 border border-slate-800 hover:border-blue-500/50 rounded-2xl p-5 transition group flex flex-col justify-between h-48">
                    <div>
                        <div class="flex justify-between items-start">
                            <span class="text-2xl">🗄️</span>
                            <span class="bg-red-500/10 text-red-400 font-mono text-[10px] font-bold px-2 py-0.5 rounded border border-red-500/20">Critical</span>
                        </div>
                        <h3 class="text-base font-bold text-white mt-3 group-hover:text-blue-400 transition">SQL Injection (SQLi)</h3>
                        <p class="text-xs text-slate-400 mt-1 line-clamp-2">Pelajari manipulasi parameter database melalui metode UNION, Error-Based, dan klausa pengurutan.</p>
                    </div>
                    <a href="/lab/labs/sqli/sqli.php" class="text-xs text-blue-400 font-semibold group-hover:underline flex items-center gap-1 mt-4">
                        Buka Tantangan SQLi &rarr;
                    </a>
                </div>

                <div class="bg-slate-900 border border-slate-800 hover:border-amber-500/50 rounded-2xl p-5 transition group flex flex-col justify-between h-48">
                    <div>
                        <div class="flex justify-between items-start">
                            <span class="text-2xl">⚡</span>
                            <span class="bg-amber-500/10 text-amber-400 font-mono text-[10px] font-bold px-2 py-0.5 rounded border border-amber-500/20">High Risk</span>
                        </div>
                        <h3 class="text-base font-bold text-white mt-3 group-hover:text-amber-400 transition">Cross-Site Scripting (XSS)</h3>
                        <p class="text-xs text-slate-400 mt-1 line-clamp-2">Injeksi skrip JavaScript berbahaya ke sisi client melalui celah Reflected Echo dan Stored Guestbook.</p>
                    </div>
                    <a href="/lab/labs/xss/xss.php" class="text-xs text-amber-400 font-semibold group-hover:underline flex items-center gap-1 mt-4">
                        Buka Tantangan XSS &rarr;
                    </a>
                </div>

                <div class="bg-slate-900/50 border border-slate-800/40 rounded-2xl p-5 flex flex-col justify-between h-48 opacity-60">
                    <div>
                        <div class="flex justify-between items-start">
                            <span class="text-2xl">📁</span>
                            <span class="bg-slate-800 text-slate-500 font-mono text-[10px] px-2 py-0.5 rounded">Locked</span>
                        </div>
                        <h3 class="text-base font-bold text-slate-500 mt-3">File Upload Vulnerability</h3>
                        <p class="text-xs text-slate-600 mt-1">Eksploitasi upload file gambar palsu untuk memasukkan PHP Web Shell Backdoor ke dalam server target.</p>
                    </div>
                    <span class="text-xs text-slate-600 font-mono italic mt-4">Coming Soon Extension...</span>
                </div>

                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 flex flex-col justify-between h-48 border-dashed">
                    <div>
                        <span class="text-2xl">🛠️</span>
                        <h3 class="text-base font-bold text-white mt-3">Helper Security Tools</h3>
                        <p class="text-xs text-slate-400 mt-1">Gunakan perkakas enkoder/dekoder URL, Base64 encoder, dan generator payload pembantu yang sudah disediakan.</p>
                    </div>
                    <a href="/lab/tools.php" class="text-xs text-slate-300 font-semibold hover:text-white flex items-center gap-1 mt-4">
                        Buka Menu Tools &rarr;
                    </a>
                </div>

            </div>
        </div>

        <div class="space-y-4">
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                🖥️ Live Terminal Activity
            </h2>
            
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-4 font-mono text-xs shadow-md space-y-3 h-[410px] overflow-y-auto">
                <div class="text-slate-500 border-b border-slate-800 pb-2 flex justify-between items-center text-[10px]">
                    <span>SYS_LOGS_STREAM</span>
                    <span class="text-green-500 animate-pulse">● ONLINE</span>
                </div>
                
                <div class="p-2.5 rounded bg-slate-950 border border-slate-800/40">
                    <span class="text-blue-400">[INFO]</span> <span class="text-slate-400">Database connected safely to</span> <code class="text-slate-300">pentest_lab</code>.
                </div>

                <div class="p-2.5 rounded bg-slate-950 border border-slate-800/40">
                    <span class="text-amber-400">[WARN]</span> <span class="text-slate-400">Unfiltered GET parameter detected at</span> <code class="text-amber-300">/labs/sqli/search.php?q=</code>.
                </div>

                <div class="p-2.5 rounded bg-slate-950 border border-slate-800/40">
                    <span class="text-red-400">[ALERT]</span> <span class="text-slate-300">SQL Error-based exploit executed successfully via </span> <code class="text-rose-400 font-bold">updatexml()</code>.
                </div>

                <div class="p-2.5 rounded bg-slate-950 border border-slate-800/40">
                    <span class="text-emerald-400">[SUCCESS]</span> <span class="text-slate-400">Flag captured for</span> <code class="text-emerald-400">Challenge 1 (Search Echo)</code>.
                </div>

                <div class="text-[10px] text-slate-600 text-center pt-2 italic">
                    Press Ctrl+C to terminate system monitor.
                </div>
            </div>
        </div>

    </div>

</div>

<?php include 'layout/footer.php'; ?>