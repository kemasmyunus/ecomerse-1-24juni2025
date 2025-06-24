</main> <!-- Tutup main -->
</div> <!-- Tutup d-flex -->
<footer class="footer mt-auto py-3 bg-dark text-white text-center">
    &copy; <?= date('Y') ?> Simple Login App. All rights reserved.
</footer>

<script>
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
    });
</script>


</body>
</html>
