<style>
.browse-plugin > .container {
    width: 80rem;
    height: 20rem;
}

.browse-plugin canvas {
    margin-bottom: 2rem;
}
</style>
<div class="container">
    <canvas id="weightChart1"></canvas>
    <canvas id="weightChart2"></canvas>
    <canvas id="weightChart3"></canvas>
</div>
<script>
var ctx1 = document.getElementById("weightChart1").getContext('2d');
var ctx2 = document.getElementById("weightChart2").getContext('2d');
var ctx3 = document.getElementById("weightChart3").getContext('2d');

var weightChart1 = new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: [{!! $labels !!}],
        datasets: [{
            label: 'Вес',
            data: [{!! $data1 !!}],
            backgroundColor: [{!! $colors !!}],
            borderColor: [{!! $colors !!}],
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    suggestedMin: 85,
                    suggestedMax: 95
                }
            }]
        }
    }
});

var weightChart2 = new Chart(ctx2, {
    type: 'line',
    data: {
        labels: [{!! $labels !!}],
        datasets: [{
            label: 'Вес',
            data: [{!! $data1 !!}],
            backgroundColor: 'transparent',
            borderColor: 'silver',
            borderWidth: 2
        }, {
            label: 'Вес av',
            data: [{!! $data2 !!}],
            backgroundColor: 'transparent',
            borderColor: 'royalblue',
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    suggestedMin: 85,
                    suggestedMax: 95
                }
            }]
        }
    }
});

var weightChart3 = new Chart(ctx3, {
    type: 'line',
    data: {
        labels: [{!! $labelsWeekly !!}],
        datasets: [{
            label: 'Вес max',
            data: [{!! $dataWeeklyMax !!}],
            backgroundColor: 'transparent',
            borderColor: 'orangered',
            borderWidth: 2
        }, {
            label: 'Вес min',
            data: [{!! $dataWeeklyMin !!}],
            backgroundColor: 'transparent',
            borderColor: 'forestgreen',
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    suggestedMin: 85,
                    suggestedMax: 95
                }
            }]
        }
    }
});
</script>