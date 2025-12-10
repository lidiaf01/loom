// Autenticación simplificada

document.addEventListener('DOMContentLoaded', function() {
    // Formulario de login
    const formLogin = document.getElementById('formLogin');
    if (formLogin) {
        formLogin.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const btn = document.getElementById('btnLogin');
            btn.disabled = true;
            btn.textContent = 'Procesando...';
            
            const formData = new FormData(formLogin);
            
            fetch(formLogin.action, {
                method: 'POST',
                body: formData
            })
            .then(r => r.json())
            .then(data => {
                if (data.exito) {
                    window.location.href = data.redirect;
                } else {
                    alert(data.mensaje || 'Error');
                    btn.disabled = false;
                    btn.textContent = 'Iniciar sesión';
                }
            })
            .catch(e => {
                alert('Error de conexión');
                btn.disabled = false;
                btn.textContent = 'Iniciar sesión';
            });
        });
    }
    
    // Formulario de registro
    const formRegistro = document.getElementById('formRegistro');
    if (formRegistro) {
        formRegistro.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const clave = document.getElementById('clave').value;
            const confirmar = document.getElementById('confirmar_clave').value;
            
            if (clave !== confirmar) {
                alert('Las claves no coinciden');
                return;
            }
            
            const btn = document.getElementById('btnRegistrar');
            btn.disabled = true;
            btn.textContent = 'Procesando...';
            
            const formData = new FormData(formRegistro);
            
            fetch(formRegistro.action, {
                method: 'POST',
                body: formData
            })
            .then(r => r.json())
            .then(data => {
                if (data.exito) {
                    window.location.href = data.redirect;
                } else {
                    alert(data.mensaje || 'Error');
                    btn.disabled = false;
                    btn.textContent = 'Registrarse';
                }
            })
            .catch(e => {
                alert('Error de conexión');
                btn.disabled = false;
                btn.textContent = 'Registrarse';
            });
        });
    }
    
    // Botón logout
    const btnLogout = document.getElementById('btnLogout');
    if (btnLogout) {
        btnLogout.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('¿Cerrar sesión?')) {
                fetch('/loom/src/www/controladores/auth_router.php?action=logout', {
                    method: 'POST'
                })
                .then(r => r.json())
                .then(data => {
                    if (data.exito) {
                        window.location.href = '/loom/?page=login';
                    }
                });
            }
        });
    }
});

