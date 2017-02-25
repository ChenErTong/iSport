function person_duration(paras){
    paras = paras.split(';');
    var length = paras.length;
    var kinds = new Array(length);
    var sports = new Array(length);
    var datas = eval('([])');
    for(var i = 0; i < length; i++){
        sports[i] = eval('('+ paras[i] +')');
        kinds[i] = sports[i][0].sport;
        var data = new Array(sports[i].length);
        for(var j = 0; j < sports[i].length; j++){
            data[j] = [sports[i][j].started_at, sports[i][j].duration];
        }
        var sport = {
            name: kinds[i],
            type: 'line',
            smooth: false,
            data: data
        }
        datas.push(sport);
    }
    var myChart = echarts.init(document.getElementById('person_duration'));
    var option = {
        legend: {
            data:kinds,
            textStyle: {
                color: '#F5DEB3'
            }
        },
        xAxis: {
            name: 'date',
            type: 'time',
            boundaryGap: false,
        },
        yAxis: {
            name: 'duration/minute',
            type: 'value'
        },
        textStyle: {
            color: '#F5DEB3'
        },
        series: datas,
    };
    myChart.setOption(option);
}

function community_ratio(paras) {
    var paras = eval('(' + paras + ')');
    var datas = eval('([])');
    for(var i = 0; i < paras.length; i++){
        var data = {
            value: paras[i].counts,
            name: paras[i].sport,
        }
        datas.push(data);
    }

    var myChart = echarts.init(document.getElementById('community_ratio'));
    var option = {
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        visualMap: {
            show: false,
            min: 80,
            max: 600,
            inRange: {
                colorLightness: [0, 1]
            }
        },
        series : [
            {
                name:'Sport',
                type:'pie',
                radius : '55%',
                center: ['50%', '50%'],
                data:datas.sort(function (a, b) { return a.value - b.value}),
                roseType: 'angle',
                label: {
                    normal: {
                        textStyle: {
                            color: '#F5DEB3',
                        }
                    }
                },
                labelLine: {
                    normal: {
                        lineStyle: {
                            color: 'rgba(255, 255, 255, 0.3)'
                        },
                        smooth: 0.2,
                        length: 10,
                        length2: 20
                    }
                },
                itemStyle: {
                    normal: {
                        color: '#c23531',
                        shadowBlur: 200,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }
        ]
    };

    myChart.setOption(option);
}