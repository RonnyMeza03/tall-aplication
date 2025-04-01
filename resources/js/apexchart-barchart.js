export default function initChart() {
    return {
        chart: null,
        init(chartData) {
            
            if (!chartData) { return; }

            const options = {
                series: [{
                    name: 'Solicitudes',
                    data: chartData.series.data
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
                    categories: chartData.categories,
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

            if (this.chart) {
                this.chart.destroy();
            }

            this.chart = new ApexCharts(this.$el, options);
            this.chart.render();
        }
    }
}