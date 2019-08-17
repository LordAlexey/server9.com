var i = 1;

$('#add-session').click(function () {
   $('.sessions').append('<tr class="session">\n' +
       '                                <td><input type="text" name="sessions['+i+'][title]"></td>\n' +
       '                                <td><input type="text" name="sessions['+i+'][time]"></td>\n' +
       '                                <td><input type="text" name="sessions['+i+'][room]"></td>\n' +
       '                                <td><input type="text" name="sessions['+i+'][speaker]"></td>\n' +
       '                            </tr>');
   i++;
});




$.ajax({
    method:'get',
    url:'http://server9.com/BY_JS-PHP_A/api/v1/diagrams/1',
    success:function (res) {
        makeCahrts(res);
    }
});


function makeCahrts(responseData) {

   console.log(responseData);

    var circle = $('#circle');
    new Chart(circle,{
        type:'pie',
        data: {
            labels:[
                '0','1','2'
            ],
            datasets:[{
                data: [responseData.pie[0], responseData.pie[1], responseData.pie[2]],
                backgroundColor:['greenyellow','gray','brown']
            }]
        }
    });

    var bars = $('#bars');

    var data = [];
    var labels = [];
    var dataLine = [];

    for(var i=0;i<responseData.bars.length;i++) {
        data.push(responseData.bars[i].count);
        if(i==0) {
            dataLine.push(responseData.bars[i].count);
        }else {
           var old = dataLine[i-1];
            dataLine.push(old+responseData.bars[i].count);
        }

        labels.push(responseData.bars[i].date);
    }

    new Chart(bars,{
        type:'bar',
        "data": {
            "labels": labels,
            "datasets": [{
                "label": "delta of registrations per day",
                "data": data,
                "fill": false,
                "backgroundColor": 'lightgray',
                "borderColor": 'black',
                "borderWidth": 1
            }]
        },
        "options": {
            "scales": {
                "yAxes": [{
                    "ticks": {
                        "beginAtZero": true
                    }
                }]
            }
        }
    });


    var line = $('#line');
    new Chart(line,{
        "type": "line",
        "data": {
            "labels": labels,
            "datasets": [{
                "label": "My First Dataset",
                "data": dataLine,
                "fill": false,
                "borderColor": "rgb(75, 192, 192)",
                "lineTension": 0.1
            }]
        },
        "options": {
            "scales": {
                "yAxes": [{
                    "ticks": {
                        "beginAtZero": true
                    }
                }]
            }
        }
    });


    var mixed = $('#mixed');
    var mixedChart = new Chart(mixed, {
        type: 'bar',
        data: {
            datasets: [{
                label: 'Bar Dataset',
                data: [10, 20, 30, 40]
            }, {
                label: 'Line Dataset',
                data: [50, 50, 50, 50],

                // Changes this dataset to become a line
                type: 'line'
            }],
            labels: ['January', 'February', 'March', 'April']
        },
    });

    var scatter = $('#scatter');
    var scatterChart = new Chart(scatter, {
        type: 'scatter',
        data: {
            datasets: [{
                label: 'Scatter Dataset',
                data: [{
                    x: -10,
                    y: 0
                }, {
                    x: 0,
                    y: 10
                }, {
                    x: 10,
                    y: 5
                }]
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    type: 'linear',
                    position: 'bottom'
                }]
            }
        }
    });
}

