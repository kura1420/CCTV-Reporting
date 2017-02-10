$(function () {
    // Create the chart
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Ringkasan Status Issue'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Total percent market share'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.1f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },

        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'Menunggu',
                y: 56.33
            }, {
                name: 'Sudah Diterima',
                y: 24.03
            }, {
                name: 'Diproses',
                y: 10.38
            }, {
                name: 'Selesai',
                y: 4.77
            }, {
                name: 'Ditolak',
                y: 0.91
            }]
        }]
    });
});
