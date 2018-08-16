
$(function() {

//扶风旅游客流量统计

    var KLCountChart = echarts.init(document.getElementById('KLCount') , 'westeros');

    option = {
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
                data: ["9.14", "9.15", "9.16", "9.17", "9.18", "9.19", "9.20"]
            }
        ],
        yAxis: [
            {
                name:'人数',
                type: "value",
                axisLine: {
                    show: true
                }
            }
        ],
        series: [
            {
                name: "客流量",
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

    KLCountChart.setOption(option);

    //景区客流对标分析

    var DBFXChart = echarts.init(document.getElementById('DBFX') , 'westeros');

    option = {
        legend: {
            x: 'right',
            y: 'top',
            data:['法门寺','景区一','景区二']
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
                name:'人数',
                type: "value",
                axisLine: {
                    show: true
                }
            }
        ],
        series: [
            {
                name: "法门寺",
                type: "line",
                smooth: true,
                data: [40, 89, 126, 100, 187, 134, 124, 90, 60],
                markPoint: {
                    data: [
                        {type: 'max', name: '最大值'}
                    ]
                }
            },
            {
                name: "景区一",
                type: "line",
                smooth: true,
                data: [60, 90, 68, 90, 345, 234, 143, 155, 80],
                markPoint: {
                    data: [
                        {type: 'max', name: '最大值'}
                    ]
                }
            },
            {
                name: "景区二",
                type: "line",
                smooth: true,
                data: [56, 76, 23, 87, 76, 45, 34, 54, 34],
                markPoint: {
                    data: [
                        {type: 'max', name: '最大值'}
                    ]
                }
            }
        ]
    };

    DBFXChart.setOption(option);



    //重点区域客流统计

    var GZHNewChart = echarts.init(document.getElementById('GZHNew') , 'westeros');

    option = {
        /*legend: {
            x: 'right',
            y: 'top',
            data:['新增人数']
        },*/
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
                name:'人数',
                type: "value",
                axisLine: {
                    show: true
                }
            }
        ],
        series: [
            {
                name: "新增人数",
                type: "line",
                smooth: true,
                data: [40, 89, 126, 100, 187, 134, 124, 90, 60],
                markPoint: {
                    data: [
                        {type: 'max', name: '最大值'}
                    ]
                }
            }
        ]
    };

    GZHNewChart.setOption(option);




// 客源地分析

    //客源地省份top10
    var provinceTop10Chart = echarts.init(document.getElementById('provinceTop10') , 'westeros');

    // 指定图表的配置项和数据
    option = {
        title:{
            text: '客源地省份Top10',
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
                name:'客流量',
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
            }
        ]
    };
    provinceTop10Chart.setOption(option);



    //客源地省份top10
    var cityTop10Chart = echarts.init(document.getElementById('cityTop10') , 'westeros');

    // 指定图表的配置项和数据
    option = {
        title:{
            text: '客源地城市Top10',
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
                name:'客流量',
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
            }
        ]
    };
    cityTop10Chart.setOption(option);



    //外省与本省客源分析

    var provinceAnalysisChart = echarts.init(document.getElementById('provinceAnalysis') , 'westeros');

    option = {
        tooltip: {
            trigger: 'item',
            formatter: "{a}{b} <br/>客流： {c} <br/>占比： {d}%"
        },
        title:{
            text: '外省与本省客源分析',
            textStyle: {
                fontSize: "12",
                color: "#77a6ff"
            }
        },
        series: [
            {
                type:'pie',
                radius: ['50%', '65%'],
                center: ['50%', '50%'],
                avoidLabelOverlap: false,
                label: {
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
