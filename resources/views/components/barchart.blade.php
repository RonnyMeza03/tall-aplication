@props([
    'barchartData' => [],
])

<div 
    {{ $attributes->merge(['class' => "bg-white rounded-lg px-6 py-6 shadow-xs hover:shadow-lg transition duration-300 ease-in-out space-y-4 dark:bg-gray-800 dark:shadow-none dark:hover:shadow-none"]) }}
    x-data="{
        chartData: @js($barchartData),
        chartOptions: {
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
                    type: 'horizontal',
                    shadeIntensity: 0.25,
                    gradientToColors: undefined,
                    inverseColors: true,
                    opacityFrom: 0.85,
                    opacityTo: 0.85,
                    stops: [50, 0, 100]
                },
            }
        },
        initChart() {
            var chart = new ApexCharts(document.querySelector('#chart'), this.chartOptions);
            chart.render();
        }
    }"
    x-init="initChart()"
>
    <div class="flex items-center justify-between gap-4 w-full">
        <p class="font-medium text-gray-700 line-clamp-2 dark:text-gray-400">Top ofertas con mayor numero de solicitudes esta semana.</p>
        <div class="rounded-full bg-gray-100 p-2">
            <x-icons.chart-column-decreasing />
        </div>
    </div>

    <div id="chart"></div>

    @if(count($barchartData['categories']) > 0 && count($barchartData['series'][0]['data']) > 0)
        <div id="chart"></div>
    @else
        <div class="w-full grid grid-cols-1 place-items-center gap-4 py-12">
            <x-icons.chart-column-decreasing class="w-16 h-16 text-gray-300" />
            <p class="text-gray-500">No hay datos disponibles</p>
        </div>
    @endif
</div>