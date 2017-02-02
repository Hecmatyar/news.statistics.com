function Re(graph, circle, stat) {     
    Highcharts.chart('graph', {
        chart: {
            type: 'spline'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: 'Сравнение выбранных ресурсов за указанный промежуток'
        },
        xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: { 
                month: '%e. %b',
                year: '%b'
            },
            title: {
                text: 'Даты публикации новостей'
            }
        },
        yAxis: {
            title: {
                text: ''
            },
            min: 0
        },
        tooltip: {
            headerFormat: '<b>{series.name}</b><br>',
            pointFormat: '{point.x:%e. %b}: {point.y:.2f} m'
        },

        plotOptions: {
            spline: {
                marker: {
                    enabled: true
                }
            }
        },
        series: graph       
    });


    Highcharts.chart('circle-graph', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: ''
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: circle
        }]
    });

    Highcharts.chart('stat', {
        chart: {
            type: 'bar'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: ['Отсутсвует', 'Низкий', 'Повышенный', 'Высокий', 'Супер']
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        legend: {
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal'
            }
        },
        series: stat
    });
}




    