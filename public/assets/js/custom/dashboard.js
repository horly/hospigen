//console.log("Archivés : " + archived + "\nBrouillons : " + draft);

var options = {
    series: [archived, draft],
    labels: [$('#archiveds').val(), $('#drafts').val()],
    colors:['#308e87', '#f39159'],
    chart: {
        type: 'donut',
    },
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 200,
                height: 200
            },
            legend: {
                position: 'bottom'
            }
        }
    }]
};

var chart = new ApexCharts(document.querySelector("#pie-chart"), options);
chart.render();
