<?php
// C:\xampp\htdocs\green_volt\test.php
echo "<h3>Diagnóstico de Archivos:</h3>";

$ruta1 = __DIR__ . '/app/Controllers/HomeController.php';
$ruta2 = __DIR__ . '/app/controllers/HomeController.php';

echo "Buscando en Controllers: " . (file_exists($ruta1) ? "✅ ENCONTRADO" : "❌ NO ENCONTRADO") . "<br>";
echo "Buscando en controllers (minúscula): " . (file_exists($ruta2) ? "✅ ENCONTRADO" : "❌ NO ENCONTRADO") . "<br>";

echo "<br> Archivos reales dentro de app/: <br>";
if (is_dir(__DIR__ . '/app')) {
    print_r(scandir(__DIR__ . '/app'));
} else {
    echo "❌ La carpeta 'app' no existe o está mal nombrada.";
}