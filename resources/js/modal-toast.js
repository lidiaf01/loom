// Sistema de Toast y Modal personalizado

class ToastManager {
    constructor() {
        this.toastContainer = null;
        this.init();
    }

    init() {
        // Crear contenedor de toasts si no existe
        if (!this.toastContainer) {
            this.toastContainer = document.createElement('div');
            this.toastContainer.id = 'toast-container';
            this.toastContainer.className = 'fixed bottom-32 left-1/2 -translate-x-1/2 z-[60] flex flex-col gap-2 items-center pointer-events-none';
            document.body.appendChild(this.toastContainer);
        }
    }

    show(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = 'animate-toast-slide-in pointer-events-auto';

        let bgClasses, borderClass;
        if (type === 'success') {
            bgClasses = 'bg-gradient-to-r from-emerald-200 to-green-200';
            borderClass = 'border-emerald-300';
        } else if (type === 'error') {
            bgClasses = 'bg-gradient-to-r from-red-200 to-pink-200';
            borderClass = 'border-red-300';
        } else if (type === 'warning') {
            bgClasses = 'bg-gradient-to-r from-amber-200 to-yellow-200';
            borderClass = 'border-amber-300';
        } else if (type === 'info') {
            bgClasses = 'bg-gradient-to-r from-blue-200 to-cyan-200';
            borderClass = 'border-blue-300';
        }

        toast.innerHTML = `
            <div class="px-6 py-3 ${bgClasses} rounded-full border-2 ${borderClass} shadow-lg text-stone-700 text-sm font-normal font-['Outfit'] whitespace-nowrap max-w-xs text-center">
                ${message}
            </div>
        `;

        this.toastContainer.appendChild(toast);

        // Auto-ocultar después de 4 segundos
        setTimeout(() => {
            toast.classList.remove('animate-toast-slide-in');
            toast.classList.add('animate-toast-slide-out');

            setTimeout(() => {
                toast.remove();
            }, 400);
        }, 4000);
    }

    success(message) {
        this.show(message, 'success');
    }

    error(message) {
        this.show(message, 'error');
    }

    warning(message) {
        this.show(message, 'warning');
    }

    info(message) {
        this.show(message, 'info');
    }
}

class ModalManager {
    constructor() {
        this.modal = null;
        this.modalContent = null;
        this.resolvePromise = null;
        this.isSetup = false;
        
        // Intentar setup inmediatamente o esperar DOMContentLoaded
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setupModal());
        } else {
            setTimeout(() => this.setupModal(), 0);
        }
    }

    setupModal() {
        if (this.isSetup) return;
        
        this.modal = document.getElementById('custom-modal');
        this.modalContent = document.getElementById('modal-content');

        if (!this.modal || !this.modalContent) {
            // Reintentar después de un breve delay
            setTimeout(() => this.setupModal(), 100);
            return;
        }

        this.isSetup = true;

        const cancelBtn = document.getElementById('modal-cancel');
        const confirmBtn = document.getElementById('modal-confirm');

        if (cancelBtn) {
            cancelBtn.addEventListener('click', () => this.close(false));
        }
        
        if (confirmBtn) {
            confirmBtn.addEventListener('click', () => this.close(true));
        }

        // Cerrar al hacer clic fuera del modal
        this.modal.addEventListener('click', (e) => {
            if (e.target === this.modal) {
                this.close(false);
            }
        });

        // Cerrar con tecla Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.modal && !this.modal.classList.contains('hidden')) {
                this.close(false);
            }
        });
    }

    confirm(message, title = 'Confirmar acción', options = {}) {
        return new Promise((resolve) => {
            // Si el modal no está listo, usar confirm nativo
            if (!this.isSetup || !this.modal || !this.modalContent) {
                resolve(window.confirm(message));
                return;
            }

            this.resolvePromise = resolve;

            // Configurar contenido
            const modalTitle = document.getElementById('modal-title');
            const modalMessage = document.getElementById('modal-message');
            const modalIcon = document.getElementById('modal-icon');
            const modalIconSvg = document.getElementById('modal-icon-svg');
            const confirmBtn = document.getElementById('modal-confirm');
            const cancelBtn = document.getElementById('modal-cancel');

            if (modalTitle) modalTitle.textContent = title;
            if (modalMessage) modalMessage.textContent = message;

            // Mostrar botón cancelar si estaba oculto
            if (cancelBtn) cancelBtn.style.display = '';

            // Configurar estilo según el tipo
            const type = options.type || 'danger';
            
            if (modalIcon && confirmBtn && modalIconSvg) {
                if (type === 'danger') {
                    modalIcon.className = 'w-16 h-16 rounded-full mb-4 flex items-center justify-center bg-red-100 border-2 border-red-300';
                        modalIconSvg.setAttribute('class', 'w-8 h-8 text-red-600');
                    confirmBtn.className = 'flex-1 px-4 py-3 bg-gradient-to-br from-red-200 to-pink-300 hover:from-red-300 hover:to-pink-400 rounded-2xl border border-red-300 text-stone-700 text-sm font-semibold font-["Outfit"] transition-all duration-300 hover:scale-105 shadow-md';
                } else if (type === 'warning') {
                    modalIcon.className = 'w-16 h-16 rounded-full mb-4 flex items-center justify-center bg-amber-100 border-2 border-amber-300';
                        modalIconSvg.setAttribute('class', 'w-8 h-8 text-amber-600');
                    confirmBtn.className = 'flex-1 px-4 py-3 bg-gradient-to-br from-yellow-100 to-amber-300 hover:from-yellow-200 hover:to-amber-400 rounded-2xl border border-amber-300 text-stone-700 text-sm font-semibold font-["Outfit"] transition-all duration-300 hover:scale-105 shadow-md';
                } else if (type === 'info') {
                    modalIcon.className = 'w-16 h-16 rounded-full mb-4 flex items-center justify-center bg-blue-100 border-2 border-blue-300';
                        modalIconSvg.setAttribute('class', 'w-8 h-8 text-blue-600');
                    confirmBtn.className = 'flex-1 px-4 py-3 bg-gradient-to-br from-blue-200 to-cyan-300 hover:from-blue-300 hover:to-cyan-400 rounded-2xl border border-blue-300 text-stone-700 text-sm font-semibold font-["Outfit"] transition-all duration-300 hover:scale-105 shadow-md';
                }
            }

            // Configurar textos de botones
            if (confirmBtn) {
                confirmBtn.textContent = options.confirmText || 'Confirmar';
            }

            if (cancelBtn) {
                cancelBtn.textContent = options.cancelText || 'Cancelar';
            }

            // Mostrar modal con animación
            this.modal.classList.remove('hidden');
            this.modal.classList.add('flex');
            
            // Forzar reflow
            void this.modal.offsetHeight;
            
            // Aplicar animación de entrada
            requestAnimationFrame(() => {
                this.modal.classList.remove('opacity-0');
                this.modal.classList.add('opacity-100');
                this.modalContent.classList.remove('scale-95', 'opacity-0');
                this.modalContent.classList.add('scale-100', 'opacity-100');
            });
        });
    }

    close(result) {
        if (!this.modal || !this.modalContent) return;

        // Animar salida
        this.modal.classList.remove('opacity-100');
        this.modal.classList.add('opacity-0');
        this.modalContent.classList.remove('scale-100', 'opacity-100');
        this.modalContent.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            this.modal.classList.remove('flex');
            this.modal.classList.add('hidden');
            
            if (this.resolvePromise) {
                this.resolvePromise(result);
                this.resolvePromise = null;
            }
        }, 300);
    }
}

// Instancias globales
const toast = new ToastManager();
const modal = new ModalManager();

// Exportar para uso global
window.toast = toast;
window.modal = modal;

// Helper para formularios con data-confirm
document.addEventListener('submit', async (e) => {
    const form = e.target;
    const confirmMessage = form.getAttribute('data-confirm');
    
    if (confirmMessage) {
        e.preventDefault();
        e.stopPropagation();
        
        const confirmed = await modal.confirm(confirmMessage, '¿Estás seguro?', { type: 'danger' });
        
        if (confirmed) {
            // Remover el atributo para evitar loop infinito
            form.removeAttribute('data-confirm');
            form.submit();
        }
    }
}, true);

export { toast, modal };
