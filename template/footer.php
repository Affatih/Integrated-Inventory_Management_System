</div> <footer class="text-center mt-5 py-4 border-top bg-white text-secondary">
    <div class="container">
        <p class="mb-1">&copy; 2024 - <?= date('Y'); ?> <strong>Sistem Informasi Warung Madura</strong></p>
        <p class="small mb-0"><span class="badge bg-success">Buka 24 Jam</span> - Melayani dengan Jujur dan Ramah</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Contoh: Otomatis hilangkan alert setelah 3 detik
    setTimeout(function() {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 3000);
</script>

</body>
</html>