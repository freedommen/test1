
$(function() {

//国庆假日前后客流走势对比

    var holidayBeforeAndAfterChart = echarts.init(document.getElementById('holidayBeforeAndAfter') , 'westeros');

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
                data: ["9.25", "9.26", "9.27", "9.28", "9.29", "9.30", "10.1", "10.2", "10.3", "10.4", "10.5", "10.6", "10.7", "10.8", "10.9", "10.10", "10.11", "10.12", "10.13", "10.14"]
            }
        ],
        yAxis: [
            {
                type: "value",
                name: "万人次",
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
                data: [40, 89, 126, 100, 187, 134, 124, 90, 60, 40, 89, 126, 100, 187, 134, 124, 90, 60,40, 89],
                /*markPoint: {
                    data: [
                        {type: 'max', name: '最大值'}
                    ]
                }*/
            }
        ]
    };

    holidayBeforeAndAfterChart.setOption(option);




// 客源地分析

    //客源地省份top10
    var provinceTop10Chart = echarts.init(document.getElementById('provinceTop10') , 'westeros');

    // 指定图表的配置项和数据
    option = {
        title:{
            text: '国庆假日客源地省份Top10',
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



    //本省客源地城市top10
    var cityTop10Chart = echarts.init(document.getElementById('cityTop10') , 'westeros');

    // 指定图表的配置项和数据
    option = {
        title:{
            text: '本省客源地城市top10',
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
            text: '国庆假日外省与本省客源分析',
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
                            fontSize: '14',
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



    //旅游类APP使用情况走势（按小时）

    var UsageChart = echarts.init(document.getElementById('Usage') , 'westeros');

    option = {
        title:{
            text: '旅游类APP使用情况走势（按小时）',
            textStyle: {
                fontSize: "12",
                color: "#77a6ff"
            }
        },
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
                data: ["00:00", "04:00", "08:00", "12:00", "16:00", "20:00", "24:00"]
            }
        ],
        yAxis: [
            {
                type: "value",
                name: "万人次",
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
                data: [40, 89, 126, 100, 187, 134, 124]
                /*markPoint: {
                    data: [
                        {type: 'max', name: '最大值'}
                    ]
                }*/
            }
        ]
    };

    UsageChart.setOption(option);



    //国庆假日旅游APP使用TOP5
    var UseAPPTop5Chart = echarts.init(document.getElementById('UseAPPTop5') , 'westeros');

    // 指定图表的配置项和数据
    option = {
        title:{
            text: '国庆假日旅游APP使用TOP5',
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
        yAxis : [
            {
                type : 'category',
                splitLine: {           // 分隔线
                    show: false
                },
                data : ['5.携程', '4.途牛', '3.携程', '2.途牛', '1.途牛'],
                axisTick: {
                    alignWithLabel: true
                },
                // axisLabel: {rotate: 50, interval: 0}
            }
        ],
        xAxis : [
            {
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
                        barBorderRadius: [0, 30, 30, 0],
                        color:new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                            offset: 0,
                            color: '#0286de'
                        }, {
                            offset: .8,
                            color: '#992cee'
                        }], false)
                    }
                },
                data:[330, 629, 700, 828, 930]
            }
        ]
    };
    UseAPPTop5Chart.setOption(option);






});
