export default function initChart() {
    return {
        chart: null,
        getTheme() {
            if (document.documentElement.classList.contains('dark')) {
              return 'dark';
            }
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        },
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
                        rotate: -45,
                        style: {
                            colors: this.getTheme() === "dark" ? "#FFFFFF" : "#000000",
                        },
                    },
                    categories: chartData.categories,
                },
                yaxis: {
                    title: {
                        text: 'Solicitudes',
                        style: {
                            color: this.getTheme() === "dark" ? "#FFFFFF" : "#000000",
                            fontWeight: 'medium',
                            fontSize: '14px',
                            fontFamily: 'Inter',
                        },
                    },
                    labels: {
                        style: {
                            colors: this.getTheme() === "dark" ? "#FFFFFF" : "#000000",
                        },
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