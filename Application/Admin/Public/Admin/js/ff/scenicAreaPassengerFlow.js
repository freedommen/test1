
$(function() {

//景区实时客流

    var JQSSKLChart = echarts.init(document.getElementById('JQSSKL') , 'westeros');

    option = {
        grid: [
            {
                width:'90%',
                left:'6%'
            }
        ],
        tooltip: {
            trigger: "axis",
            axisPointer: {
                lineStyle: {
                    color: "rgb(0, 185, 255)",
                    type: "solid",
                    width: 1
                },
                type: "line",
                areaStyle: {
                    type: "default"
                }
            }
        },
        calculable: true,
        xAxis: [
            {
                type: "category",
                boundaryGap: false,
                axisLine: {
                    show: true
                },
                splitLine: {
                    "show": false
                },
                data: ["8:00", "9:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00"]
            }
        ],
        yAxis: [
            {
                name:'单位：万人',
                type: "value",
                axisLine: {
                    show: true
                }
            }
        ],
        series: [
            {
                name: "在园",
                type: "line",
                smooth: true,
                itemStyle:{
                    normal:{
                        areaStyle: {
                            type: "default",
                            color:new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                offset: 0,
                                color: 'rgba(58,140,251,.6)'
                            }, {
                                offset: 1,
                                color: 'rgba(58,140,251,.2)'
                            }], false)
                        }
                    }
                },
                data: [40, 89, 126, 100, 187, 134, 124, 90, 60],
                markPoint: {
                    data: [
                        {type: 'max', name: '最大值'}
                    ]
                }
            }
        ]
    };

    JQSSKLChart.setOption(option);


    //景区客流统计

    var JQKLCountChart = echarts.init(document.getElementById('JQKLCount') , 'westeros');

    option = {
        tooltip: {
            trigger: 'axis',
            // axisPointer: {
            //     type: 'cross',
            //     crossStyle: {
            //         color: '#999'
            //     }
            // }
        },
        legend: {
            data:['行程单数','接待客流']
        },
        xAxis: [
            {
                type: 'category',
                data: ['9.15','9.16','9.17','9.18','9.19','9.20','9.21'],
                axisPointer: {
                    type: 'line'
                },
                splitLine: {
                    "show": false
                }
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: '单位：人',
                // min: 0,
                // max: 1000,
                // interval: 200
            }
        ],
        series: [
            {
                name:'客流',
                type:'bar',
                barWidth: '30%',
                itemStyle:{
                    normal:{
                        // barBorderRadius: [100, 100, 0, 0],
                        color:new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                            offset: 0,
                            color: '#0286de'
                        }, {
                            offset: .8,
                            color: '#992cee'
                        }], false)
                    }
                },
                data:[12312, 4324, 5332, 7532, 2555, 3421, 8754]
            }
        ]
    };

    JQKLCountChart.setOption(option);





});
