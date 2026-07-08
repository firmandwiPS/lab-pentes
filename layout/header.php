<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Pentest Web Lab'; ?></title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #0f172a;
        }
        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }
    </style>
</head>

<body class="bg-slate-950 text-slate-100 min-h-screen">

    <div id="preloader" class="fixed inset-0 bg-slate-950 z-50 flex flex-col items-center justify-center transition-all duration-500 ease-in-out opacity-100 visible">
        <div class="relative flex flex-col items-center">
            
            <div class="w-16 h-16 border-4 border-slate-800 border-t-emerald-500 rounded-full animate-spin mb-4"></div>
            
            <div class="text-center animate-pulse">
                <span class="text-xl font-black tracking-wider text-white uppercase block">
                    💻 PENTEST<span class="text-emerald-500">_LAB</span>
                </span>
                <span class="text-[10px] text-slate-500 font-mono tracking-widest mt-1 block">
                    INITIALIZING SECURE ENVIRONMENT...
                </span>
            </div>
            
        </div>
    </div>
    <div class="flex min-h-screen">

        <aside class="fixed left-0 top-0 h-screen w-72 bg-slate-900 border-r border-slate-800 flex flex-col z-20">

            <div class="h-20 px-6 border-b border-slate-800 flex items-center">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-blue-600 to-cyan-500 flex items-center justify-center text-xl">
                        🔐
                    </div>
                    <div>
                        <h1 class="font-bold text-lg text-white">Pentest Web Lab</h1>
                        <p class="text-xs text-slate-400">Personal Security Lab</p>
                    </div>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-4">

                <div class="mb-6">
                    <p class="text-xs uppercase tracking-widest text-slate-500 px-3 mb-3">Main Menu</p>
                    <div class="space-y-1">
                        <a href="/lab/index.php" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-600 hover:bg-blue-500 transition font-medium">
                            <span>🏠</span> Dashboard
                        </a>
                    </div>
                </div>

                <div class="mb-6">
                    <p class="text-xs uppercase tracking-widest text-slate-500 px-3 mb-3">Labs</p>
                    <div class="space-y-1">
                        
                        <button id="labsDropdownBtn" class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-slate-800 transition font-medium text-slate-300 hover:text-white">
                            <div class="flex items-center gap-3">
                                <span>🧪</span> 
                                <span>All Labs</span>
                            </div>
                            <svg id="dropdownArrow" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div id="labsDropdownMenu" class="hidden pl-9 space-y-1 mt-1 transition-all duration-300">
                            <a href="/lab/labs/sqli/sqli.php" class="block px-4 py-2 text-sm rounded-lg text-slate-400 hover:bg-slate-800 hover:text-blue-400 transition">
                                🗄️ SQL Injection
                            </a>
                            <a href="/lab/labs/xss/xss.php" class="block px-4 py-2 text-sm rounded-lg text-slate-400 hover:bg-slate-800 hover:text-amber-400 transition">
                                ⚡ XSS Vulnerability
                            </a>
                            <div class="block px-4 py-2 text-sm rounded-lg text-slate-600 cursor-not-allowed">
                                📁 File Upload (Soon)
                            </div>
                        </div>

                    </div>
                </div>

                <div class="mb-6">
                    <p class="text-xs uppercase tracking-widest text-slate-500 px-3 mb-3">Tools</p>
                    <div class="space-y-1">
                        <a href="/lab/tools.php" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition font-medium text-slate-300 hover:text-white">
                            <span>🛠️</span> All Tools
                        </a>
                    </div>
                </div>

                <div>
                    <p class="text-xs uppercase tracking-widest text-slate-500 px-3 mb-3">Learning</p>
                    <div class="space-y-1">
                        <a href="/lab/notes.php" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition font-medium text-slate-300 hover:text-white">
                            <span>📚</span> Notes
                        </a>
                        <a href="/lab/references.php" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition font-medium text-slate-300 hover:text-white">
                            <span>📖</span> References
                        </a>
                    </div>
                </div>

            </div>

            <div class="border-t border-slate-800 p-4 mt-auto">
                <div class="bg-slate-800 rounded-xl p-4">
                    <p class="text-xs text-slate-500">Environment</p>
                    <h4 class="font-semibold mt-1 text-white">Localhost Lab</h4>
                    <p class="text-xs text-slate-500 mt-2">Education & Learning</p>
                </div>
            </div>

        </aside>

        <div class="ml-72 flex-1 min-h-screen flex flex-col">

            <header class="h-20 border-b border-slate-800 bg-slate-950 shrink-0 z-10">
                <div class="h-full px-8 flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-white">
                            <?= $title ?? 'Dashboard'; ?>
                        </h2>
                        <p class="text-slate-400 text-sm">Web Security Learning Environment</p>
                    </div>

                    <div class="flex items-center gap-3 relative">
                        <span class="text-cyan-400 text-sm font-semibold">Localhost</span>
                        <div class="w-2 h-2 rounded-full bg-green-500 animate-ping absolute right-0 -mr-1"></div>
                        <div class="w-2 h-2 rounded-full bg-green-500 relative"></div>
                    </div>
                </div>
            </header>

            <main class="p-8 flex-1">

    <script>
        // 1. Logika Menghilangkan Layar Preloader
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            setTimeout(() => {
                preloader.classList.add('opacity-0', 'invisible');
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 500);
            }, 300);
        });

        // 2. Logika Navigasi Dropdown Labs
        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.getElementById('labsDropdownBtn');
            const menu = document.getElementById('labsDropdownMenu');
            const arrow = document.getElementById('dropdownArrow');

            btn.addEventListener('click', function () {
                menu.classList.toggle('hidden');
                arrow.classList.toggle('rotate-180');
            });
        });
    </script>