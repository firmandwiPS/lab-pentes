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