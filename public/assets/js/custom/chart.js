(function ($) {
  "use strict";

    const siteDataApex = window.jsonDataApex || [];
    const categories = siteDataApex.map(site => site.name);
    const documentCounts = siteDataApex.map(site => site.document_count);

    //console.log(siteDataApex);


  // column chart
  var optionscolumnchart = {
    series: [
      {
        name: "Documents",
        data: documentCounts,
      },
    ],
    chart: {
      type: "bar",
      height: 380,
      toolbar: {
        show: false,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "30%",
        endingShape: "rounded",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 1,
      colors: ["transparent"],
      curve: "smooth",
      lineCap: "butt",
    },
    xaxis: {
      categories: categories,
      floating: false,
      axisTicks: {
        show: false,
      },
      axisBorder: {
        color: "#C4C4C4",
      },
    },
    yaxis: {
      title: {
        text: $('#site-chart-title').text(),
        style: {
          fontSize: "14px",
          fontFamily: "Roboto, sans-serif",
          fontWeight: 500,
        },
      },
    },
    colors: [AdmiroAdminConfig.primary, "#3eb95f", AdmiroAdminConfig.secondary],
    fill: {
      type: "gradient",
      gradient: {
        shade: "light",
        type: "vertical",
        shadeIntensity: 0.1,
        inverseColors: false,
        opacityFrom: 1,
        opacityTo: 0.9,
        stops: [0, 100],
      },
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return val;
        },
      },
    },
    responsive: [
      {
        breakpoint: 576,
        options: {
          chart: {
            height: 200,
          }
        }
      }
    ]
  };
  var chartcolumnchart = new ApexCharts(
    document.querySelector("#chart-widget4"),
    optionscolumnchart
  );
  chartcolumnchart.render();


})(jQuery);
