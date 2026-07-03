<?php

$conn = mysqli_connect("localhost", "root", "", "pentest_lab");

$keyword = $_GET['id'] ?? '';

$result = null;

if($keyword != ''){

    // Sengaja rentan untuk pembelajaran
    $sql = "SELECT id,name,price
            FROM products
            WHERE id='$keyword'";

    $result = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Product Catalog</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 text-white min-h-screen">

<div class="max-w-4xl mx-auto p-8">

    <h1 class="text-3xl font-bold mb-2">
        🛒 Product Catalog
    </h1>

    <p class="text-slate-400 mb-6">
        Search products by ID
    </p>

    <form method="GET" class="mb-6">

        <input
            type="text"
            name="id"
            placeholder="Product ID"
            class="bg-slate-800 p-3 rounded-lg w-64">

        <button
            class="bg-blue-600 px-5 py-3 rounded-lg">
            Search
        </button>

        

    </form>

            <a href="../../index.php"
   class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-700 px-4 py-2 rounded-xl border border-slate-700 mb-6">
    ← Kembali ke Dashboard
</a>
    <?php if($result): ?>

        <div class="space-y-4">

            <?php while($row = mysqli_fetch_assoc($result)): ?>

                <div class="bg-slate-900 border border-slate-800 p-4 rounded-xl">

                    <h3 class="font-bold text-lg">
                        <?= htmlspecialchars($row['name']) ?>
                    </h3>

                    <p class="text-slate-400">
                        Product ID: <?= htmlspecialchars($row['id']) ?>
                    </p>

                    <p class="text-green-400">
                        Rp <?= htmlspecialchars($row['price']) ?>
                    </p>

                </div>

            <?php endwhile; ?>

        </div>

    <?php endif; ?>

</div>

</body>
</html>