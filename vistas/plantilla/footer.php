    <script src="/loom/scripts/main.js"></script>
    <?php if (isset($js_extra)): ?>
        <?php foreach ($js_extra as $script): ?>
            <script src="<?php echo url($script); ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>

