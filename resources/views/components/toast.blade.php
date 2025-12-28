@if($message = session('success'))
<div id="toast" class="fixed bottom-32 left-1/2 -translate-x-1/2 z-40 animate-toast-slide-in">
    <div class="px-6 py-3 bg-gradient-to-r from-emerald-200 to-green-200 rounded-full border-2 border-emerald-300 shadow-lg text-stone-700 text-sm font-normal font-['Outfit'] whitespace-nowrap max-w-xs text-center">
        {{ $message }}
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toast = document.getElementById('toast');
        if (toast) {
            setTimeout(function() {
                toast.classList.remove('animate-toast-slide-in');
                toast.classList.add('animate-toast-slide-out');
                
                setTimeout(function() {
                    toast.remove();
                }, 400);
            }, 4000);
        }
    });
</script>
@endif

@if($message = session('error'))
<div id="toast" class="fixed bottom-32 left-1/2 -translate-x-1/2 z-40 animate-toast-slide-in">
    <div class="px-6 py-3 bg-gradient-to-r from-red-200 to-pink-200 rounded-full border-2 border-red-300 shadow-lg text-stone-700 text-sm font-normal font-['Outfit'] whitespace-nowrap max-w-xs text-center">
        {{ $message }}
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toast = document.getElementById('toast');
        if (toast) {
            setTimeout(function() {
                toast.classList.remove('animate-toast-slide-in');
                toast.classList.add('animate-toast-slide-out');
                
                setTimeout(function() {
                    toast.remove();
                }, 400);
            }, 4000);
        }
    });
</script>
@endif
