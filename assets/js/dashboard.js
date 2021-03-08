(function($) {
  'use strict';
  $(function() {
    if ($('#product-area-chart').length) {
      var lineChartCanvas = $("#product-area-chart").get(0).getContext("2d");
      var data = {
        labels: ["2013", "2014", "2014", "2015", "2016", "2017", "2018"],
        datasets: [
          {
            label: 'Support',
            data: [150, 200, 150, 200, 350, 320, 400],
            backgroundColor: 'rgba(190, 165 ,236, 1)',
            borderColor: [
              'rgba(102, 0 ,159, 1)'
            ],
            borderWidth: 1,
            fill: true
          },
          {
            label: 'Product',
            data: [300, 400, 300, 440, 700, 550, 730],
            backgroundColor: 'rgba(217, 225 ,253, 1)',
            borderColor: [
              'rgba(48, 70, 235, 1)'
            ],
            borderWidth: 1,
            fill: true
          }
        ]
      };
      var options = {
        scales: {
          yAxes: [{
            display: false
          }],
          xAxes: [{
            display: false
          }]
        },
        legend: {
          display: false
        },
        elements: {
          point: {
            radius: 3
          }
        },
        stepsize: 1
      };
      var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: data,
        options: options
      });
    }
    if ($('#morris-line-example').length) {
      Morris.Line({
        element: 'morris-line-example',
        lineColors: ['rgba(217, 225 ,253, 1)', 'rgba(190, 165 ,236, 1)'],
        data: [{
            y: '2006',
            a: 50,
            b: 0
          },
          {
            y: '2007',
            a: 75,
            b: 78
          },
          {
            y: '2008',
            a: 30,
            b: 12
          },
          {
            y: '2009',
            a: 35,
            b: 50
          },
          {
            y: '2010',
            a: 70,
            b: 100
          },
          {
            y: '2011',
            a: 78,
            b: 65
          }
        ],
        grid: false,
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        hideHover: "always"
      });
    }
    if ($("#current-chart").length) {
      var CurrentChartCanvas = $("#current-chart").get(0).getContext("2d");
      var CurrentChart = new Chart(CurrentChartCanvas, {
        type: 'bar',
        data: {
          labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
          datasets: [{
              label: 'Profit',
              data: [330, 380, 230, 400, 309, 530, 340, 200],
              backgroundColor: 'rgba(55, 177 ,255, 1)'
            },
            {
              label: 'Target',
              data: [600, 600, 600, 600, 600, 600, 600],
              backgroundColor: 'rgba(147, 208 ,251, 0.3)'
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 20,
              bottom: 0
            }
          },
          scales: {
            yAxes: [{
              display: false,
              gridLines: {
                display: false
              }
            }],
            xAxes: [{
              stacked: true,
              ticks: {
                beginAtZero: true,
                fontColor: "#354168"
              },
              gridLines: {
                color: "rgba(0, 0, 0, 0)",
                display: false
              },
              barPercentage: 0.4
            }]
          },
          legend: {
            display: false
          },
          elements: {
            point: {
              radius: 0
            }
          }
        }
      });
    }
    if ($('#dashoard-area-chart').length) {
      var lineChartCanvas = $("#dashoard-area-chart").get(0).getContext("2d");
      var data = {
        labels: ["2013", "2014", "2014", "2015", "2016", "2017", "2018"],
        datasets: [
          {
            label: 'Target',
            data: [0, 5, 1, 6, 1, 5, 0],
            backgroundColor: 'rgba(133, 123 ,255, 0.3)',
            borderColor: [
              'rgba(133, 123 ,255, 1)'
            ],
            borderWidth: 1,
            fill: true
          },
          {
            label: 'Profit',
            data: [0, 2, 5, 1, 5, 2, 0],
            backgroundColor: 'rgba(255, 116 ,116, 0.3)',
            borderColor: [
              'rgba(255, 116 ,116, 0.3)'
            ],
            borderWidth: 1,
            fill: true
          }
        ]
      };
      var options = {
        scales: {
          yAxes: [{
            display: false
          }],
          xAxes: [{
            display: false
          }]
        },
        legend: {
          display: false
        },
        elements: {
          point: {
            radius: 3
          }
        },
        stepsize: 100
      };
      var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: data,
        options: options
      });
    }
  });
})(jQuery);