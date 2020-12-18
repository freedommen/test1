
$(function() {

//公众号用户累计人数统计

    var GZHTotalChart = echarts.init(document.getElementById('GZHTotal') , 'westeros');

    option = {
        legend: {
            x: 'right',
            y: 'top',
            data:['累积人数']
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
                name: "累积人数",
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
                data: [40, 89, 126, 100, 187, 134, 124, 90, 60]
            }
        ]
    };

    GZHTotalChart.setOption(option);


    //公众号新增用户人数统计

    var GZHNewChart = echarts.init(document.getElementById('GZHNew') , 'westeros');

    option = {
        legend: {
            x: 'right',
            y: 'top',
            data:['新增人数']
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


    //点赞收藏转发量统计

    var dzzfChart = echarts.init(document.getElementById('dzzf') , 'westeros');

    option = {
        legend: {
            x: 'right',
            y: 'top',
            data:['点赞','转发','收藏']
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
                name: "点赞",
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
                name: "转发",
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
                name: "收藏",
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

    dzzfChart.setOption(option);


    //公众号活跃用户人数统计

    var hyyhChart = echarts.init(document.getElementById('hyyh') , 'westeros');

    option = {
        legend: {
            x: 'right',
            y: 'top',
            data:['新增人数']
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

    hyyhChart.setOption(option);


    //图文阅读人数与次数统计

    var readTimesChart = echarts.init(document.getElementById('readTimes') , 'westeros');

    option = {
        grid: [
            {x: '6%', y: '12%', width: '88%', height: '68%'}
        ],
        legend: {
            x: 'right',
            y: 'top',
            data:['次数','人数']
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
                name: "次数",
                type: "line",
                smooth: true,
                data: [40, 89, 126, 100, 187, 134, 124],
                markPoint: {
                    data: [
                        {type: 'max', name: '最大值'}
                    ]
                }
            },
            {
                name: "人数",
                type: "line",
                smooth: true,
                data: [36, 78, 90, 89, 123, 132, 100],
                markPoint: {
                    data: [
                        {type: 'max', name: '最大值'}
                    ]
                }
            }
        ]
    };

    readTimesChart.setOption(option)



});
