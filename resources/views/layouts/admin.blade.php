<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Desa Sarirogo' }}</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <main>
        @yield('content')
    </main>

</body>

<script>
    const ctx = document.getElementById('chartFCR').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Aug', 'W2', 'W3', 'Sept', 'W2', 'W3', 'Oct'],
            datasets: [{
                    label: 'Produksi Telur',
                    data: [40, 80, 60, 120, 100, 150, 180],
                    borderWidth: 2,
                    tension: 0.3
                },
                {
                    label: 'Batas Normal',
                    data: [120, 120, 120, 120, 120, 120, 120],
                    borderWidth: 1,
                    borderDash: [5, 5],
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    /* === Grafik Tren Produksi === */
    const ctxProduksi = document.getElementById('chartProduksi');
    if (ctxProduksi) {
        new Chart(ctxProduksi, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [
                    {
                        label: 'Jumlah Butir Telur',
                        data: [1000, 1100, 1150, 1200, 1300, 1400],
                        borderWidth: 2,
                        tension: 0.3,
                        pointRadius: 4
                    },
                    {
                        label: 'Total Berat',
                        data: [800, 900, 950, 980, 1020, 1100],
                        borderWidth: 2,
                        tension: 0.3,
                        borderDash: [4,4],
                        pointRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' }},
                scales: {
                    y: { beginAtZero: false },
                    x: { }
                }
            }
        });
    }

</script>

</html>