
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pentest Web Lab</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex flex-col font-sans">

    <!-- Glow Background -->
    <div class="fixed inset-0 pointer-events-none -z-10">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-[500px] bg-gradient-to-b from-cyan-500/10 via-blue-500/5 to-transparent blur-3xl"></div>
    </div>

    <!-- Header -->
    <header class="sticky top-0 z-50 border-b border-slate-800 bg-slate-950/80 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <div class="flex items-center gap-3">
                <div class="bg-gradient-to-tr from-blue-600 to-cyan-500 p-3 rounded-xl">
                    🔐
                </div>

                <div>
                    <h1 class="text-xl font-bold">Pentest Web Lab</h1>
                    <p class="text-xs text-slate-400">
                        Environment Pembelajaran Keamanan Web
                    </p>
                </div>
            </div>

            <span class="text-xs text-cyan-400 font-semibold">
                Localhost Environment
            </span>

        </div>
    </header>

    <!-- Main -->
    <main class="max-w-7xl mx-auto px-6 py-10 flex-1 w-full">

        <!-- ========================= -->
        <!-- TOOLS SECTION -->
        <!-- ========================= -->

        <section class="mb-16">

    <div class="mb-8">
        <div class="flex items-center gap-2 text-cyan-400 text-sm font-semibold uppercase mb-2">
            <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
            Security Tools
        </div>

        <h2 class="text-4xl font-bold text-white">
            🛠️ Tools Pembelajaran
        </h2>
    </div>

<div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

    <a href="tools/Blind-SQLi-Extractor/"
       class="bg-slate-900 border border-slate-800 rounded-xl p-4 hover:border-cyan-500 transition">

        <div class="flex items-center gap-3">
            <span class="text-3xl">🔐</span>

            <div>
                <h3 class="font-semibold text-white">
                   Blind SQLi Extractor
                </h3>

                <p class="text-xs text-slate-500">
                    Tool
                </p>
            </div>
        </div>

    </a>

</div>

</section>

        <!-- ========================= -->
        <!-- LAB SECTION -->
        <!-- ========================= -->

        <section>

            <div class="mb-8">
                <div class="flex items-center gap-2 text-blue-400 text-sm font-semibold uppercase mb-2">
                    <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                    Pentest Labs
                </div>

                <h2 class="text-4xl font-bold text-white">
                    🧪 Laboratorium Eksploitasi
                </h2>

                <p class="text-slate-400 mt-3 max-w-3xl">
                    Pilih kategori kerentanan yang ingin dipelajari dan diuji
                    pada lingkungan laboratorium lokal.
                </p>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">

                <!-- SQLI -->
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 hover:border-blue-500 transition">

                    <div class="text-5xl mb-4">🗄️</div>

                    <h3 class="text-xl font-bold mb-3">
                        SQL Injection
                    </h3>

                    <p class="text-slate-400 text-sm mb-6">
                        Pelajari bypass login, union injection,
                        error-based dan data extraction.
                    </p>

                    <select id="sqlLevel"
                        class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 mb-4">

                        <option value="">
                            -- Pilih Level --
                        </option>

                        <option value="sqli/level1/login.php">
                            Level 1 - Basic Auth Bypass
                        </option>

                        <option value="sqli/level2/produk.php">
                            Level 2 - Union Based
                        </option>

                        <option value="sqli/level3/artikel.php">
                            Level 3 - Error Based
                        </option>

                        <option value="sqli/level4/login.php">
                            Level 4 - Advanced Login
                        </option>

                    </select>

                    <button onclick="goToLevel()"
                        class="w-full bg-blue-600 hover:bg-blue-500 py-3 rounded-xl font-semibold">
                        🚀 Masuk Lab
                    </button>

                </div>

                <!-- XSS -->
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 opacity-75">

                    <div class="text-5xl mb-4">⚡</div>

                    <h3 class="text-xl font-bold mb-3">
                        XSS Lab
                    </h3>

                    <p class="text-slate-400 text-sm mb-6">
                        Reflected, Stored dan DOM Based XSS.
                    </p>

                    <div class="bg-slate-800 rounded-xl py-3 text-center text-slate-500">
                        🚧 Dalam Pengembangan
                    </div>

                </div>

                <!-- Upload -->
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 opacity-75">

                    <div class="text-5xl mb-4">📁</div>

                    <h3 class="text-xl font-bold mb-3">
                        File Upload
                    </h3>

                    <p class="text-slate-400 text-sm mb-6">
                        Simulasi bypass upload dan validasi file.
                    </p>

                    <div class="bg-slate-800 rounded-xl py-3 text-center text-slate-500">
                        🚧 Coming Soon
                    </div>

                </div>

            </div>

        </section>

    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-800 py-6 text-center text-slate-500 text-sm">
        Pentest Web Lab © 2026 • Dibuat untuk Keperluan Edukasi & Keamanan Informasi
    </footer>

    <script>
        function goToLevel() {
            let level = document.getElementById("sqlLevel").value;

            if(level){
                window.location.href = level;
            } else {
                alert("Silakan pilih level terlebih dahulu.");
            }
        }
    </script>

</body>
</html>
