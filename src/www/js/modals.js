/**
 * Sistema de modales y alertas personalizados
 * Adaptado al estilo de la página
 */

// Crear contenedor de toasts si no existe
function initToastContainer() {
    if (!document.getElementById('toast-container')) {
        const container = document.createElement('div');
        container.id = 'toast-container';
        container.className = 'toast-container';
        document.body.appendChild(container);
    }
}

// Mostrar toast/notificación
function showToast(message, type = 'info', title = null) {
    initToastContainer();
    
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    toast.className = `toast-custom ${type}`;
    
    // Iconos según el tipo
    const icons = {
        success: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" fill="#5C4B51"/></svg>',
        error: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z" fill="#5C4B51"/></svg>',
        warning: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z" fill="#5C4B51"/></svg>',
        info: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z" fill="#5C4B51"/></svg>'
    };
    
    toast.innerHTML = `
        <div class="toast-custom-icon">${icons[type] || icons.info}</div>
        <div class="toast-custom-content">
            ${title ? `<div class="toast-custom-title">${title}</div>` : ''}
            <div class="toast-custom-message">${message}</div>
        </div>
        <button class="toast-custom-close" onclick="this.parentElement.remove()">×</button>
    `;
    
    container.appendChild(toast);
    
    // Auto-remover después de 5 segundos
    setTimeout(() => {
        if (toast.parentElement) {
            toast.style.animation = 'slideOutRight 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }
    }, 5000);
}

// Mostrar modal de confirmación
function showConfirmModal(options) {
    const {
        title = 'Confirmar',
        message = '¿Estás seguro?',
        confirmText = 'Confirmar',
        cancelText = 'Cancelar',
        confirmClass = 'primary',
        onConfirm = () => {},
        onCancel = () => {}
    } = options;
    
    // Crear backdrop
    const backdrop = document.createElement('div');
    backdrop.className = 'modal-backdrop';
    backdrop.id = 'confirm-modal-backdrop';
    
    // Crear modal
    const modal = document.createElement('div');
    modal.className = 'modal-custom';
    
    modal.innerHTML = `
        <div class="modal-custom-header">
            <h3 class="modal-custom-title">${title}</h3>
            <button class="modal-custom-close" onclick="closeConfirmModal()">×</button>
        </div>
        <div class="modal-custom-body">
            <p>${message}</p>
        </div>
        <div class="modal-custom-footer">
            <button class="modal-btn modal-btn-secondary" onclick="closeConfirmModal()">${cancelText}</button>
            <button class="modal-btn modal-btn-${confirmClass}" id="confirm-btn">${confirmText}</button>
        </div>
    `;
    
    backdrop.appendChild(modal);
    document.body.appendChild(backdrop);
    
    // Prevenir scroll del body
    document.body.style.overflow = 'hidden';
    
    // Event listeners
    const confirmBtn = document.getElementById('confirm-btn');
    confirmBtn.addEventListener('click', () => {
        closeConfirmModal();
        onConfirm();
    });
    
    backdrop.addEventListener('click', (e) => {
        if (e.target === backdrop) {
            closeConfirmModal();
            onCancel();
        }
    });
    
    // Guardar callbacks en el backdrop para acceso global
    backdrop._onConfirm = onConfirm;
    backdrop._onCancel = onCancel;
}

// Cerrar modal de confirmación
function closeConfirmModal() {
    const backdrop = document.getElementById('confirm-modal-backdrop');
    if (backdrop) {
        backdrop.style.animation = 'fadeOut 0.2s ease';
        const modal = backdrop.querySelector('.modal-custom');
        if (modal) {
            modal.style.animation = 'slideDown 0.3s ease';
        }
        setTimeout(() => {
            document.body.style.overflow = '';
            backdrop.remove();
        }, 300);
    }
}

// Mostrar modal de alerta
function showAlertModal(options) {
    const {
        title = 'Aviso',
        message = '',
        buttonText = 'Aceptar',
        onClose = () => {}
    } = options;
    
    // Crear backdrop
    const backdrop = document.createElement('div');
    backdrop.className = 'modal-backdrop';
    backdrop.id = 'alert-modal-backdrop';
    
    // Crear modal
    const modal = document.createElement('div');
    modal.className = 'modal-custom';
    
    modal.innerHTML = `
        <div class="modal-custom-header">
            <h3 class="modal-custom-title">${title}</h3>
            <button class="modal-custom-close" onclick="closeAlertModal()">×</button>
        </div>
        <div class="modal-custom-body">
            <p>${message}</p>
        </div>
        <div class="modal-custom-footer">
            <button class="modal-btn modal-btn-primary" id="alert-ok-btn">${buttonText}</button>
        </div>
    `;
    
    backdrop.appendChild(modal);
    document.body.appendChild(backdrop);
    
    // Prevenir scroll del body
    document.body.style.overflow = 'hidden';
    
    // Event listeners
    const okBtn = document.getElementById('alert-ok-btn');
    okBtn.addEventListener('click', () => {
        closeAlertModal();
        onClose();
    });
    
    backdrop.addEventListener('click', (e) => {
        if (e.target === backdrop) {
            closeAlertModal();
            onClose();
        }
    });
}

// Cerrar modal de alerta
function closeAlertModal() {
    const backdrop = document.getElementById('alert-modal-backdrop');
    if (backdrop) {
        backdrop.style.animation = 'fadeOut 0.2s ease';
        const modal = backdrop.querySelector('.modal-custom');
        if (modal) {
            modal.style.animation = 'slideDown 0.3s ease';
        }
        setTimeout(() => {
            document.body.style.overflow = '';
            backdrop.remove();
        }, 300);
    }
}

// Agregar animaciones CSS dinámicamente
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
    
    @keyframes slideDown {
        from {
            transform: translateY(0);
            opacity: 1;
        }
        to {
            transform: translateY(20px);
            opacity: 0;
        }
    }
    
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Inicializar cuando el DOM esté listo
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initToastContainer);
} else {
    initToastContainer();
}

