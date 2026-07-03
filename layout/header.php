
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $title ?? 'Pentest Web Lab'; ?></title>

<script src="https://cdn.tailwindcss.com"></script>

<style>
    ::-webkit-scrollbar{
        width:8px;
    }

    ::-webkit-scrollbar-track{
        background:#0f172a;
    }

    ::-webkit-scrollbar-thumb{
        background:#334155;
        border-radius:10px;
    }

    ::-webkit-scrollbar-thumb:hover{
        background:#475569;
    }
</style>

</head>

<body class="bg-slate-950 text-slate-100">

<div class="flex">

    <!-- SIDEBAR -->
    <aside class="fixed left-0 top-0 h-screen w-72 bg-slate-900 border-r border-slate-800 flex flex-col">

        <!-- LOGO -->
        <div class="h-20 px-6 border-b border-slate-800 flex items-center">

            <div class="flex items-center gap-3">

                <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-blue-600 to-cyan-500 flex items-center justify-center text-xl">
                    🔐
                </div>

                <div>

                    <h1 class="font-bold text-lg">
                        Pentest Web Lab
                    </h1>

                    <p class="text-xs text-slate-400">
                        Personal Security Lab
                    </p>

                </div>

            </div>

        </div>

        <!-- MENU -->
        <div class="flex-1 overflow-y-auto p-4">

            <!-- MAIN -->
            <div class="mb-8">

                <p class="text-xs uppercase tracking-widest text-slate-500 px-3 mb-3">
                    Main Menu
                </p>

                <div class="space-y-1">

                    <a href="/lab/index.php"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-600 hover:bg-blue-500 transition">

                        <span>🏠</span>
                        Dashboard

                    </a>

                </div>

            </div>

            <!-- LABS -->
            <div class="mb-8">

                <p class="text-xs uppercase tracking-widest text-slate-500 px-3 mb-3">
                    Labs
                </p>

                <div class="space-y-1">

                    <a href="/lab/labs.php"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">

                        <span>🧪</span>
                        All Labs

                    </a>



                </div>

            </div>

            <!-- TOOLS -->
            <div class="mb-8">

                <p class="text-xs uppercase tracking-widest text-slate-500 px-3 mb-3">
                    Tools
                </p>

                <div class="space-y-1">

                    <a href="/lab/tools.php"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">

                        <span>🛠️</span>
                        All Tools

                    </a>


                </div>

            </div>

            <!-- LEARNING -->
            <div>

                <p class="text-xs uppercase tracking-widest text-slate-500 px-3 mb-3">
                    Learning
                </p>

                <div class="space-y-1">

                    <a href="/notes.php"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">

                        <span>📚</span>
                        Notes

                    </a>

                    <a href="/references.php"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">

                        <span>📖</span>
                        References

                    </a>

                </div>

            </div>

        </div>

        <!-- FOOTER SIDEBAR -->
        <div class="border-t border-slate-800 p-4">

            <div class="bg-slate-800 rounded-xl p-4">

                <p class="text-xs text-slate-500">
                    Environment
                </p>

                <h4 class="font-semibold mt-1">
                    Localhost Lab
                </h4>

                <p class="text-xs text-slate-500 mt-2">
                    Education & Learning
                </p>

            </div>

        </div>

    </aside>

    <!-- CONTENT -->
    <div class="ml-72 flex-1 min-h-screen">

        <!-- TOPBAR -->
        <header class="h-20 border-b border-slate-800 bg-slate-950">

            <div class="h-full px-8 flex justify-between items-center">

                <div>

                    <h2 class="text-2xl font-bold">
                        <?= $title ?? 'Dashboard'; ?>
                    </h2>

                    <p class="text-slate-400 text-sm">
                        Web Security Learning Environment
                    </p>

                </div>

                <div class="flex items-center gap-3">

                    <span class="text-cyan-400 text-sm font-semibold">
                        Localhost
                    </span>

                    <div class="w-2 h-2 rounded-full bg-green-500"></div>

                </div>

            </div>

        </header>

        <!-- PAGE CONTENT -->
        <main class="p-8">
