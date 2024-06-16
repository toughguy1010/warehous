<script>
    const importData = @json($importRevenue);
    const exportData = @json($exportRevenue);

    const importLabels = importData.map(item => item.date);
    const importAmounts = importData.map(item => item.total);

    const exportLabels = exportData.map(item => item.date);
    const exportAmounts = exportData.map(item => item.total);

    // Import Chart
    const importCtx = document.getElementById('importChart').getContext('2d');
    const importChart = new Chart(importCtx, {
        type: 'bar',
        data: {
            labels: importLabels,
            datasets: [{
                label: 'Đơn nhập',
                data: importAmounts,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Export Chart
    const exportCtx = document.getElementById('exportChart').getContext('2d');
    const exportChart = new Chart(exportCtx, {
        type: 'bar',
        data: {
            labels: exportLabels,
            datasets: [{
                label: 'Đơn xuất',
                data: exportAmounts,
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>