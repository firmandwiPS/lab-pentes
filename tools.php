  <?php

$title = 'Pentest Web Lab';
include 'layout/header.php';
?>




  
  
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



<?php include 'layout/footer.php' ?>