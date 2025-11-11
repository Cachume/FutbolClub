// Gráfico de Géneros
new Chart(document.getElementById("playerChart").getContext("2d"), {
    type: "pie",
    data: {
        labels: chartGenerosData.labels,
        datasets: [{ data: chartGenerosData.data, backgroundColor: ["#FF6384","#36A2EB"], borderColor: "#fff", borderWidth: 2 }]
    },
    options: { responsive: true }
});

// Gráfico de Categorías
const colores = chartCategoriasData.labels.map(() => `hsl(${Math.floor(Math.random()*360)}, 70%, 60%)`);
new Chart(document.getElementById("categoriaChart").getContext("2d"), {
    type: "bar",
    data: {
        labels: chartCategoriasData.labels,
        datasets: [{ data: chartCategoriasData.data, backgroundColor: colores, borderColor: "#fff", borderWidth: 2 }]
    },
    options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
});
