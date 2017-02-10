$(function () {
    // Create the chart
    $('#chart1').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Laporan Outlet Diterima dan Ditolak'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Jumlah Banyaknya Laporan'
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
                name: 'Issue Selesai',
                y: selesai
            }, {
                name: 'Issue Ditolak',
                y: tolak
            }, {
                name: 'Tidak Ada Laporan',
                y: tidaklaporan
            }]
        }]
    });

    $('#chart2').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Jumlah Laporan Per-Outlet'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Jumlah Laporan'
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
            data: peroutlet
        }]
    });

    $('#chart3').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Jumlah Admin Menerima Laporan'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Jumlah Banyaknya Laporan'
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
                name: 'Issue',
                y: issueterima,
                drilldown: 'Issue'
            }]
        }],
        drilldown: {
            series: [{
                name: 'Issue',
                id: 'Issue',
                data: drillissueterima
            }]
        }
    });

    $('#chart4').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Jumlah Admin Menerima Menolak'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Jumlah Banyaknya Laporan'
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
                name: 'Issue',
                y: issuetolak,
                drilldown: 'Issue'
            }]
        }],
        drilldown: {
            series: [{
                name: 'Issue',
                id: 'Issue',
                data: drillissuetolak
            }]
        }
    });
});
