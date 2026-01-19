{{-- Los toasts ahora se manejan desde JavaScript --}}
{{-- Este componente solo maneja mensajes de sesión de Laravel --}}

@if($message = session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.toast) {
            window.toast.success('{{ $message }}');
        }
    });
</script>
@endif

@if($message = session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.toast) {
            window.toast.error('{{ $message }}');
        }
    });
</script>
@endif
