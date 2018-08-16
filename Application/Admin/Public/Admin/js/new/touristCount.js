$(function(){

//客流分析－客流统计


    //景区客流统计（按天）

    var carMonitorChart = echarts.init(document.getElementById('carMonitor') , 'walden');

    option = {
        tooltip : {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                label: {
                    backgroundColor: '#6a7985'
                }
            }
        },
        legend: {
            data:['车辆数量']
        },
    /*    toolbox: {
            feature: {
                saveAsImage: {}
            }
        },*/
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis : [
            {
                type : 'category',
                boundaryGap : false,
                data : ['9.14','9.15','9.16','9.17','9.18','9.19','9.20']
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name:'景区内车辆数',
                type:'line',
                stack: '总量',
                areaStyle: {
                    normal: {
                        color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                            offset: 0,
                            color: '#3fb1e3'
                        }, {
                            offset: 0.3,
                            color: '#3fb1e3'
                        }, {
                            offset: 1,
                            color: '#fff'
                        }])
                    }
                },
                markPoint: {
                    data: [
                        {type: 'max', name: '最大值'},
                        {type: 'min', name: '最小值'}
                    ]
                },
                data:[230, 456, 578, 389, 689, 830, 901, 509, 409, 398, 290]
            }
        ]
    };

    carMonitorChart.setOption(option);



//景点客流密度排行

    var touristDensityChart = echarts.init(document.getElementById('touristDensity') , 'walden');

    option = {

        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        legend: {
            x: 'right',
            y: 'top',
            data: ['客流量']
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: {
            type: 'value',
            boundaryGap: [0, 0.01]
        },
        yAxis: {
            type: 'category',
            splitLine: {           // 分隔线
                show: false
            },
            data: ['景点的名称比较长','景点2','景点3排行','景点4','景点5','景点6','景点7','景点8']
        },
        series: [
            {
                name: '客流量',
                type: 'bar',
                barWidth: '30%',
                data: [407, 541, 607, 641, 794, 800, 843, 935]
            }
        ]
    };
    touristDensityChart.setOption(option);




    //景区实时客流（按小时）

    var realTimePFlowChart = echarts.init(document.getElementById('realTimePFlow') , 'walden');

    option = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        legend: {
            x: 'right',
            y: 'top',
            data: ['入园', '出园', '在园']
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        yAxis: {
            type: 'value',
            boundaryGap: [0, 0.01]
        },
        xAxis: {
            type: 'category',
            splitLine: {           // 分隔线
                show: false
            },
            data: ['7:00','8:00','9:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00']
        },
        series: [
            {
                name: '入园',
                type: 'bar',
                barWidth: '12%',
                data: [823, 489, 1034, 970, 744, 230, 730, 744, 230, 730]
            },
            {
                name: '出园',
                type: 'bar',
                barWidth: '12%',
                data: [203, 489, 934, 970, 744, 230, 430, 744, 230, 430]
            },

            {
                name: '在园',
                type: 'bar',
                barWidth: '12%',
                data: [325, 438, 1000, 1094, 141, 807, 530, 141, 807, 530]
            }
        ]
    };

    realTimePFlowChart.setOption(option);






});