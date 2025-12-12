    <script src="<?php echo ASSETS_URL; ?>/src/www/js/config.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/src/www/js/main.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/src/www/js/fuentes-numeros.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/src/www/js/modals.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/src/www/js/auth.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/src/www/js/diario.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/src/www/js/perfil.js"></script>
    <?php if (isset($js_extra)): ?>
        <?php foreach ($js_extra as $script): ?>
            <script src="<?php echo ASSETS_URL; ?>/<?php echo ltrim($script, '/'); ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>

