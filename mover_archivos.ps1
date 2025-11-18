# Script para mover archivos de Loom a la ubicación correcta
# Ejecutar como administrador si es necesario

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Corrección de Estructura - Proyecto Loom" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

$rutaHtdocs = "C:\xampp\htdocs\loom"
$rutaOrigen = "$rutaHtdocs\src\www"
$rutaDestino = $rutaHtdocs

# Verificar que existe la carpeta htdocs/loom
if (-not (Test-Path $rutaHtdocs)) {
    Write-Host "ERROR: No se encuentra la carpeta $rutaHtdocs" -ForegroundColor Red
    Write-Host "Verifica que XAMPP esté instalado y que hayas copiado el proyecto." -ForegroundColor Yellow
    Read-Host "Presiona Enter para salir"
    exit
}

# Verificar que existen los archivos en src/www/
if (-not (Test-Path $rutaOrigen)) {
    Write-Host "ERROR: No se encuentra la carpeta $rutaOrigen" -ForegroundColor Red
    Write-Host "Los archivos pueden estar en otra ubicación." -ForegroundColor Yellow
    Read-Host "Presiona Enter para salir"
    exit
}

# Verificar que existe index.php en src/www/
if (-not (Test-Path "$rutaOrigen\index.php")) {
    Write-Host "ERROR: No se encuentra index.php en $rutaOrigen" -ForegroundColor Red
    Read-Host "Presiona Enter para salir"
    exit
}

Write-Host "Ubicación actual de los archivos: $rutaOrigen" -ForegroundColor Yellow
Write-Host "Ubicación destino: $rutaDestino" -ForegroundColor Yellow
Write-Host ""

# Listar archivos que se van a mover
Write-Host "Archivos que se moverán:" -ForegroundColor Cyan
Get-ChildItem -Path $rutaOrigen -File | ForEach-Object {
    Write-Host "  - $($_.Name)" -ForegroundColor White
}
Get-ChildItem -Path $rutaOrigen -Directory | ForEach-Object {
    Write-Host "  - $($_.Name)/" -ForegroundColor White
}
Write-Host ""

# Confirmar acción
$confirmar = Read-Host "¿Deseas mover los archivos a la ubicación correcta? (S/N)"
if ($confirmar -ne "S" -and $confirmar -ne "s") {
    Write-Host "Operación cancelada." -ForegroundColor Yellow
    Read-Host "Presiona Enter para salir"
    exit
}

Write-Host ""
Write-Host "Moviendo archivos..." -ForegroundColor Cyan

try {
    # Mover todos los archivos y carpetas
    Get-ChildItem -Path $rutaOrigen | ForEach-Object {
        $nombre = $_.Name
        Write-Host "  Moviendo: $nombre..." -ForegroundColor Gray
        
        # Si el archivo/carpeta ya existe en destino, preguntar
        if (Test-Path "$rutaDestino\$nombre") {
            $sobrescribir = Read-Host "  El archivo/carpeta '$nombre' ya existe. ¿Sobrescribir? (S/N)"
            if ($sobrescribir -eq "S" -or $sobrescribir -eq "s") {
                Move-Item -Path $_.FullName -Destination $rutaDestino -Force
            } else {
                Write-Host "  Saltando: $nombre" -ForegroundColor Yellow
            }
        } else {
            Move-Item -Path $_.FullName -Destination $rutaDestino -Force
        }
    }
    
    Write-Host ""
    Write-Host "¡Archivos movidos correctamente!" -ForegroundColor Green
    Write-Host ""
    
    # Verificar que index.php esté en la raíz
    if (Test-Path "$rutaDestino\index.php") {
        Write-Host "✓ index.php está en la ubicación correcta" -ForegroundColor Green
    } else {
        Write-Host "✗ ERROR: index.php no se encuentra en la raíz" -ForegroundColor Red
    }
    
    # Preguntar si desea eliminar carpetas vacías
    Write-Host ""
    $eliminar = Read-Host "¿Deseas eliminar las carpetas vacías (src/, doc/, docs/)? (S/N)"
    if ($eliminar -eq "S" -or $eliminar -eq "s") {
        if (Test-Path "$rutaHtdocs\src") {
            if ((Get-ChildItem "$rutaHtdocs\src" -Recurse | Measure-Object).Count -eq 0) {
                Remove-Item "$rutaHtdocs\src" -Force -ErrorAction SilentlyContinue
                Write-Host "✓ Carpeta src/ eliminada" -ForegroundColor Green
            }
        }
        if (Test-Path "$rutaHtdocs\doc") {
            Remove-Item "$rutaHtdocs\doc" -Force -ErrorAction SilentlyContinue
            Write-Host "✓ Carpeta doc/ eliminada" -ForegroundColor Green
        }
        if (Test-Path "$rutaHtdocs\docs") {
            Remove-Item "$rutaHtdocs\docs" -Force -ErrorAction SilentlyContinue
            Write-Host "✓ Carpeta docs/ eliminada" -ForegroundColor Green
        }
    }
    
    Write-Host ""
    Write-Host "========================================" -ForegroundColor Cyan
    Write-Host "  ¡Proceso completado!" -ForegroundColor Green
    Write-Host "========================================" -ForegroundColor Cyan
    Write-Host ""
    Write-Host "Ahora puedes acceder a la aplicación en:" -ForegroundColor Yellow
    Write-Host "  http://localhost/loom/" -ForegroundColor White
    Write-Host ""
    Write-Host "Si aún aparece el listado de directorios:" -ForegroundColor Yellow
    Write-Host "  1. Limpia la caché del navegador (Ctrl + Shift + R)" -ForegroundColor White
    Write-Host "  2. Reinicia Apache desde XAMPP Control Panel" -ForegroundColor White
    Write-Host ""
    
} catch {
    Write-Host ""
    Write-Host "ERROR al mover archivos: $($_.Exception.Message)" -ForegroundColor Red
    Write-Host ""
}

Read-Host "Presiona Enter para salir"

