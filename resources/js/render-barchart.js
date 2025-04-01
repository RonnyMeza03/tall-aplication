

export function renderChart(categories, series) {
    const options = {
        series: [{
            name: 'Solicitudes',
            data: [44, 55, 41, 67, 22, 43, 21, 33, 45, 31]
        }],
        chart: {
            height: 350,
            type: 'bar',
        },
        plotOptions: {
            bar: {
                borderRadius: 10,
                columnWidth: '50%',
            }
        },
        dataLabels: {
            enabled: true
        },
        stroke: {
            width: 0
        },
        xaxis: {
            labels: {
                rotate: -45
            },
            categories: ['Apples', 'Oranges', 'Strawberries', 'Pineapples', 'Mangoes', 'Bananas',
                'Blackberries', 'Pears', 'Watermelons', 'Cherries'
            ],
        },
        yaxis: {
            title: {
                text: 'Solicitudes',
            },
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: "horizontal",
                shadeIntensity: 0.25,
                gradientToColors: undefined,
                inverseColors: true,
                opacityFrom: 0.85,
                opacityTo: 0.85,
                stops: [50, 0, 100]
            },
        }
    };
    
    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
}

// document.addEventListener('livewire:navigated', function () {
//     v
// });