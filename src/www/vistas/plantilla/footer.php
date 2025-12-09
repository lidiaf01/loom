    <footer class="footer-principal">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Loom - Plataforma social educativa</p>
            <p>Desarrollado por Lidia Artero Fernández - Sprint 1</p>
        </div>
    </footer>
    
    <script src="/loom/src/www/js/main.js"></script>
    <?php if (isset($js_extra)): ?>
        <?php foreach ($js_extra as $script): ?>
            <script src="<?php echo ASSETS_URL; ?>/<?php echo ltrim($script, '/'); ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>

