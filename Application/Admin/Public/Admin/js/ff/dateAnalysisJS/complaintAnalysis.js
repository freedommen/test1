
$(function() {


    //投诉量统计分析

    var complaintsNumChart = echarts.init(document.getElementById('complaintsNum') , 'westeros');

    option = {
        legend: {
            x: 'right',
            y: 'top',
            data:['客流']
        },
        tooltip: {
            trigger: "axis"
        },
        calculable: true,
        xAxis: [
            {
                type: "category",
                boundaryGap: false,
                data: ["9.14", "9.15", "9.16", "9.17", "9.18", "9.19", "9.20"],
                splitLine: {
                    "show": false
                },
                axisLine: {
                    show: true
                }
            }
        ],
        yAxis: [
            {
                name:'投诉量',
                type: "value",
                axisLine: {
                    show: true
                }
            }
        ],
        series: [
            {
                name: "投诉量",
                type: "line",
                smooth: true,
                data: [4, 8, 26, 20, 17, 14, 14, 10, 9],
                markPoint: {
                    data: [
                        {type: 'max', name: '最大值'}
                    ]
                }
            }
        ]
    };

    complaintsNumChart.setOption(option);



    //各行业投诉数占比统计

    var industryComplaintRatioChart = echarts.init(document.getElementById('industryComplaintRatio') , 'westeros');

    option = {
        legend: {
            x: 'right',
            y: 'top',
            icon: 'circle',
            data:['景点','购物','OTA','餐饮','旅行社','交通']
        },
        tooltip: {
            trigger: 'item',
            formatter: "{a}： {b} <br/>投诉量： {c} <br/>占比： {d}%"
        },
        series: [
            {
                name: '行业',
                type:'pie',
                radius: [0, '60%'],
                center: ['50%', '55%'],
                avoidLabelOverlap: false,
                selectedMode: 'single',
                label: {
                    normal: {
                        formatter: '{b}:  {c}\n{d}%',
                        rich: {
                            b: {
                                fontSize: 20,
                                lineHeight: 20
                            },
                            d: {
                                fontSize: 30,
                                lineHeight: 20
                            }
                        }
                    },
                    emphasis: {
                        show: true,
                        textStyle: {
                            fontSize: '12',
                            fontWeight: 'bold'
                        }
                    }
                },
                labelLine: {
                    normal: {
                        show: true
                    }
                },
                data:[
                    {value:5, name:'景点', selected:true},
                    {value:2, name:'购物'},
                    {value:3, name:'OTA'},
                    {value:4, name:'餐饮'},
                    {value:12, name:'旅行社'},
                    {value:3, name:'交通'}
                ]
            }
        ]
    };

    industryComplaintRatioChart.setOption(option);


// 投诉客源地分析

    //投诉客源地省份top10
    var provinceTop10Chart = echarts.init(document.getElementById('provinceTop10') , 'westeros');

    // 指定图表的配置项和数据
    option = {
        title:{
            text: '投诉客源地省份top10',
            textStyle: {
                fontSize: "12",
                color: "#77a6ff"
            }
        },
        tooltip : {
            trigger: 'axis',
            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                type : 'line'        // 默认为直线，可选为：'line' | 'shadow'
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis : [
            {
                type : 'category',
                splitLine: {           // 分隔线
                    show: false
                },
                data : ['省份一', '省份二', '省份三', '省份四', '省份五', '省份六', '省份七', '省份八', '省份九', '省份十'],
                axisTick: {
                    alignWithLabel: true
                },
                axisLabel: {rotate: 50, interval: 0}
            }
        ],
        yAxis : [
            {
                name:'人数',
                type : 'value'
            }
        ],
        series : [
            {
                name:'投诉量',
                type:'bar',
                barWidth: '30%',
                itemStyle:{
                    normal:{
                        barBorderRadius: [30, 30, 0, 0],
                        color:new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                            offset: 0,
                            color: '#0286de'
                        }, {
                            offset: .8,
                            color: '#992cee'
                        }], false)
                    }
                },
                data:[930, 778, 700, 628, 600, 534, 467, 330, 220, 120]
            },
            {
                name:'占比(%)',
                type:'bar',
                itemStyle: {
                    normal:{
                        label: {
                            normal: {
                                show: false,
                                position: 'right',
                                distance: 10,
                                formatter: function(param) {
                                    return param.value + '%';
                                },
                                textStyle: {
                                    color: '#ffffff',
                                    fontSize: '16'
                                }
                            }
                        }
                    }
                },
                barWidth: '0.000000000000001%',
                data:[ 10.87, 5, 8, 9, 4, 3, 12, 8, 7, 6]
            }
        ]
    };
    provinceTop10Chart.setOption(option);



    //投诉客源地城市top10
    var cityTop10Chart = echarts.init(document.getElementById('cityTop10') , 'westeros');

    // 指定图表的配置项和数据
    option = {
        title:{
            text: '投诉客源地省份top10',
            textStyle: {
                fontSize: "12",
                color: "#77a6ff"
            }
        },
        tooltip : {
            trigger: 'axis',
            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                type : 'line'        // 默认为直线，可选为：'line' | 'shadow'
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis : [
            {
                type : 'category',
                splitLine: {           // 分隔线
                    show: false
                },
                data : ['城市1', '城市2', '城市3', '城市4', '城市5', '城市6', '城市7', '城市8', '城市9', '城市10'],
                axisTick: {
                    alignWithLabel: true
                },
                axisLabel: {rotate: 50, interval: 0}
            }
        ],
        yAxis : [
            {
                name:'人数',
                type : 'value'
            }
        ],
        series : [
            {
                name:'投诉量',
                type:'bar',
                barWidth: '30%',
                itemStyle:{
                    normal:{
                        barBorderRadius: [30, 30, 0, 0],
                        color:new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                            offset: 0,
                            color: '#0286de'
                        }, {
                            offset: .8,
                            color: '#992cee'
                        }], false)
                    }
                },
                data:[930, 778, 700, 628, 600, 534, 467, 330, 220, 120]
            },
            {
                name:'占比(%)',
                type:'bar',
                itemStyle: {
                    normal:{
                        label: {
                            normal: {
                                show: false,
                                position: 'right',
                                distance: 10,
                                formatter: function(param) {
                                    return param.value + '%';
                                },
                                textStyle: {
                                    color: '#ffffff',
                                    fontSize: '16'
                                }
                            }
                        }
                    }
                },
                barWidth: '0.000000000000001%',
                data:[ 10.87, 5, 8, 9, 4, 3, 12, 8, 7, 6]
            }
        ]
    };
    cityTop10Chart.setOption(option);



    //外省与本省投诉客源分析

    var provinceAnalysisChart = echarts.init(document.getElementById('provinceAnalysis') , 'westeros');

    option = {
        tooltip: {
            trigger: 'item',
            formatter: "{a}{b} <br/>客流： {c} <br/>占比： {d}%"
        },
        title:{
            text: '外省与本省投诉客源分析',
            textStyle: {
                fontSize: "12",
                color: "#77a6ff"
            }
        },
        series: [
            {
                name:'投诉来源：',
                type:'pie',
                radius: ['50%', '65%'],
                center: ['50%', '50%'],
                avoidLabelOverlap: false,
                label: {
                    normal: {
                        formatter: "{b}\n\n{d}%"
                    },
                    emphasis: {
                        show: true,
                        textStyle: {
                            fontSize: '12',
                            fontWeight: 'bold'
                        }
                    }
                },
                labelLine: {
                    normal: {
                        show: true
                    }
                },
                data:[
                    {value:335, name:'外省'},
                    {value:432, name:'本省'}
                ]
            }
        ]
    };
    provinceAnalysisChart.setOption(option);




});
