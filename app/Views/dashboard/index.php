<main class="dashboard-page">
    <div class="container">
        <header class="dashboard-header">
            <div>
                <h1>Dashboard</h1>
                <p>Resumen general de Green Volt.</p>
            </div>
            <a href="#reporte-empresa" class="btn-report">
                <i class="fa-solid fa-file-lines me-2"></i>Reporte
            </a>
        </header>

        <section class="dashboard-grid">
            <article class="dashboard-card">
                <span class="label">Vehículos</span>
                <p class="value"><?= htmlspecialchars((string)($metricas['total_vehiculos'] ?? 0)) ?></p>
            </article>

            <article class="dashboard-card">
                <span class="label">Citas pendientes</span>
                <p class="value"><?= htmlspecialchars((string)($metricas['citas_pendientes'] ?? 0)) ?></p>
            </article>

            <article class="dashboard-card">
                <span class="label">Servicios</span>
                <p class="value"><?= htmlspecialchars((string)($metricas['total_servicios'] ?? 0)) ?></p>
            </article>

            <article class="dashboard-card">
                <span class="label">Usuarios</span>
                <p class="value"><?= htmlspecialchars((string)($metricas['total_usuarios'] ?? 0)) ?></p>
            </article>
        </section>

        <section id="reporte-empresa" class="report-panel">
            <div class="report-header">
                <div>
                    <span class="report-kicker">Reporte de empresa</span>
                    <h2>Green Volt</h2>
                </div>
                <button id="generateReportBtn" class="btn-report secondary" type="button">
                    <i class="fa-solid fa-download me-2"></i>Generar reporte
                </button>
            </div>

            <div class="report-summary">
                <div class="report-box">
                    <span>Inventario total</span>
                    <strong><?= htmlspecialchars((string)($metricas['stock_total'] ?? 0)) ?> unidades</strong>
                </div>
                <div class="report-box">
                    <span>Solicitudes</span>
                    <strong><?= htmlspecialchars((string)($metricas['solicitudes_compra'] ?? 0)) ?> compras</strong>
                </div>
                <div class="report-box">
                    <span>Valor del inventario</span>
                    <strong>$<?= htmlspecialchars(number_format((float)($metricas['valor_inventario'] ?? 0), 2, ',', '.')) ?></strong>
                </div>
                <div class="report-box">
                    <span>Autonomía promedio</span>
                    <strong><?= htmlspecialchars(number_format((float)($metricas['autonomia_promedio'] ?? 0), 0, ',', '.')) ?> km</strong>
                </div>
            </div>

            <div class="report-content">
                <div class="report-column">
                    <h3>Resumen ejecutivo</h3>
                    <p>
                        Green Volt mantiene una operación enfocada en movilidad eléctrica con un inventario activo de
                        <?= htmlspecialchars((string)($metricas['total_vehiculos'] ?? 0)) ?> vehículos y una base de
                        <?= htmlspecialchars((string)($metricas['total_usuarios'] ?? 0)) ?> usuarios registrados.
                        La cartera de productos presenta una autonomía media de
                        <?= htmlspecialchars(number_format((float)($metricas['autonomia_promedio'] ?? 0), 0, ',', '.')) ?> km,
                        lo que refuerza la propuesta de valor de sostenibilidad, eficiencia y acceso a soluciones eléctricas.
                    </p>
                </div>

                <div class="report-column">
                    <h3>Recomendaciones</h3>
                    <ul class="report-list">
                        <li>Potenciar campañas para aumentar solicitudes de compra.</li>
                        <li>Enfocar promociones en modelos con mayor autonomía y volumen de stock.</li>
                        <li>Priorizar atención en servicios pendientes para mejorar la experiencia del cliente.</li>
                        <li>Ampliar la visibilidad del catálogo para convertir más visitas en ventas.</li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const reportButton = document.getElementById('generateReportBtn');

        if (!reportButton) {
            return;
        }

        reportButton.addEventListener('click', function () {
            const totalVehiculos = document.querySelectorAll('.dashboard-card .value')[0]?.textContent?.trim() || '0';
            const citasPendientes = document.querySelectorAll('.dashboard-card .value')[1]?.textContent?.trim() || '0';
            const totalServicios = document.querySelectorAll('.dashboard-card .value')[2]?.textContent?.trim() || '0';
            const totalUsuarios = document.querySelectorAll('.dashboard-card .value')[3]?.textContent?.trim() || '0';

            const reportContent = `
                <html>
                    <head>
                        <meta charset="UTF-8" />
                        <title>Reporte Green Volt</title>
                        <style>
                            body { font-family: Arial, sans-serif; padding: 30px; color: #0f172a; }
                            h1 { color: #0f172a; }
                            .box { border: 1px solid #dbeafe; border-radius: 12px; padding: 18px; margin: 12px 0; }
                            .grid { display: grid; grid-template-columns: repeat(2, minmax(200px, 1fr)); gap: 12px; }
                            strong { color: #1d4ed8; }
                        </style>
                    </head>
                    <body>
                        <h1>Reporte de Green Volt</h1>
                        <p>Generado el: ${new Date().toLocaleString('es-MX')}</p>

                        <div class="grid">
                            <div class="box"><strong>Vehículos:</strong> ${totalVehiculos}</div>
                            <div class="box"><strong>Citas pendientes:</strong> ${citasPendientes}</div>
                            <div class="box"><strong>Servicios:</strong> ${totalServicios}</div>
                            <div class="box"><strong>Usuarios:</strong> ${totalUsuarios}</div>
                        </div>

                        <div class="box">
                            <h2>Resumen ejecutivo</h2>
                            <p>Green Volt opera con un modelo de movilidad sostenible centrado en vehículos eléctricos, enfocado en la comparación, venta y soporte del ecosistema eléctrico.</p>
                            <p>La empresa mantiene una base de clientes activa, un catálogo en crecimiento y un fuerte enfoque en servicio y atención postventa.</p>
                        </div>

                        <div class="box">
                            <h2>Recomendaciones</h2>
                            <ul>
                                <li>Impulsar la conversión de visitas a solicitudes de compra.</li>
                                <li>Priorizar atención a citas pendientes.</li>
                                <li>Ampliar la visibilidad del catálogo y servicio al cliente.</li>
                            </ul>
                        </div>
                    </body>
                </html>
            `;

            const blob = new Blob([reportContent], { type: 'text/html;charset=utf-8' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'reporte-green-volt.html';
            document.body.appendChild(a);
            a.click();
            a.remove();
            URL.revokeObjectURL(url);
        });
    });
</script>
