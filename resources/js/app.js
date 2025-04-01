import './bootstrap';
import ApexCharts from 'apexcharts';

window.ApexCharts = ApexCharts;

const dropdownBtn = document.getElementById('btnDropdown');
const dropdownMenu = document.getElementById('menuDrop');

console.log(dropdownBtn);
console.log(dropdownMenu);

dropdownBtn.addEventListener('click', () => {
    dropdownMenu.classList.toggle('hidden');
});