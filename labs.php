<?php

$title = 'Pentest Web Lab';
include 'layout/header.php';
?>




 



        <!-- ========================= -->
        <!-- TOOLS SECTION -->
        <!-- ========================= -->


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
        🚩 Pilih Challenge SQL Injection
    </option>

    <option value="sqli/challenge1/login.php">
        🏢 Employee Portal Login (Authentication Bypass)
    </option>

    <option value="sqli/challenge2/products.php">
        🛒 E-Commerce Product Search (UNION-Based SQLi)
    </option>

    <option value="sqli/challenge3/article.php">
        📰 CMS Article Viewer (Error-Based SQLi)
    </option>

    <option value="sqli/challenge4/customer.php">
        👥 Customer Management System (Boolean Blind SQLi)
    </option>

    <option value="sqli/challenge5/report.php">
        🏦 Financial Reporting Dashboard (Time-Based Blind SQLi)
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



<?php include 'layout/footer.php' ?>