import './bootstrap';
import ApexCharts from 'apexcharts';
import initChart from './apexchart-barchart';

window.ApexCharts = ApexCharts;
window.initChart = initChart;


const dropdownBtn = document.getElementById('btnDropdown');
const dropdownMenu = document.getElementById('menuDrop');

console.log(dropdownBtn);
console.log(dropdownMenu);

dropdownBtn.addEventListener('click', () => {
    dropdownMenu.classList.toggle('hidden');
});