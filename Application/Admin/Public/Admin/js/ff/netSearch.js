
$(function() {


    //搜索指数排行（美食）

    var MSRankingIDChart = echarts.init(document.getElementById('MSRankingID'), 'westeros');

    option = {
        /* legend: {
         bottom: 20,
         textStyle:{
         color:'#fff',
         },
         data: ['钥匙量', '有效房源量']
         },*/
        grid: {
            width:'96%',
            right: '2%',
            top: '3%',
            containLabel: true
        },

        tooltip: {
            show:"true",
            trigger: 'axis',
            axisPointer: { // 坐标轴指示器，坐标轴触发有效
                type: 'shadow', // 默认为直线，可选为：'line' | 'shadow'
                shadowStyle : {
                    width: 'auto',// 阴影大小
                    color: 'rgba(255,255,255,0.1)'  // 阴影颜色
                }
            },
            formatter: function (params){
                return  params[0].name + '<br/>'
                    + params[0].seriesName + ' : ' + params[0].value
            }
        },
        xAxis:  {
            type: 'value',
            axisLine: {show:false},
            axisTick: {show:false},
            axisLabel: {show:false},
            splitArea: {show:false},
            splitLine: {show:false}
        },
        yAxis: [
            {
                type: 'category',
                axisLine: {show:false},
                axisTick: {show:false},
                axisLabel: {show:false},
                splitArea: {show:false},
                splitLine: {show:false},
                data: ['鹿糕','凉皮','猫耳朵','牛腩','鹿茸']
            },
            {
                type: 'category',
                axisLine: {show:false},
                axisTick: {show:false},
                axisLabel: {show:false},
                splitArea: {show:false},
                splitLine: {show:false},
                data: ['鹿糕','凉皮','猫耳朵','牛腩','鹿茸']
            }

        ],
        series: [
            {
                type: 'bar',
                yAxisIndex:1,
                itemStyle:{
                    normal: {
                        show: false,
                        color: '#040f3e',
                        barBorderRadius:50,
                        borderWidth:0,
                        borderColor:'#333'
                    }
                },
                barGap:'0%',
                barCategoryGap:'70%',
                data: [500, 500, 500, 500, 500]
            },
            {
                name: '数量',
                type: 'bar',
                itemStyle:{
                    normal: {
                        show: true,
                        color: function(params) {
                            // build a color map as your need.
                            var colorList = [
                                '#4f8df3','#4f8df3','#a2b108','#da850f','#ff643d'
                            ];
                            return colorList[params.dataIndex]
                        },
                        barBorderRadius:50,
                        borderWidth:0,
                        borderColor:'#333'
                    }
                },
                barGap:'0%',
                barCategoryGap:'70%',
                data: [98, 109, 123, 210, 300]
            }

        ]
    };
    MSRankingIDChart.setOption(option);


    //搜索指数排行（住宿）

    var ZSRankingIDChart = echarts.init(document.getElementById('ZSRankingID'), 'westeros');

    option = {
        grid: {
            width:'96%',
            right: '2%',
            top: '3%',
            containLabel: true
        },

        tooltip: {
            show:"true",
            trigger: 'axis',
            axisPointer: { // 坐标轴指示器，坐标轴触发有效
                type: 'shadow', // 默认为直线，可选为：'line' | 'shadow'
                shadowStyle : {
                    width: 'auto',// 阴影大小
                    color: 'rgba(255,255,255,0.1)'  // 阴影颜色
                }
            },
            formatter: function (params){
                return  params[0].name + '<br/>'
                    + params[0].seriesName + ' : ' + params[0].value
            }
        },
        xAxis:  {
            type: 'value',
            axisLine: {show:false},
            axisTick: {show:false},
            axisLabel: {show:false},
            splitArea: {show:false},
            splitLine: {show:false}
        },
        yAxis: [
            {
                type: 'category',
                axisLine: {show:false},
                axisTick: {show:false},
                axisLabel: {show:false},
                splitArea: {show:false},
                splitLine: {show:false},
                data: ['鹿糕','凉皮','猫耳朵','牛腩','鹿茸']
            },
            {
                type: 'category',
                axisLine: {show:false},
                axisTick: {show:false},
                axisLabel: {show:false},
                splitArea: {show:false},
                splitLine: {show:false},
                data: ['鹿糕','凉皮','猫耳朵','牛腩','鹿茸']
            }

        ],
        series: [
            {
                type: 'bar',
                yAxisIndex:1,
                itemStyle:{
                    normal: {
                        show: false,
                        color: '#040f3e',
                        barBorderRadius:50,
                        borderWidth:0,
                        borderColor:'#333'
                    }
                },
                barGap:'0%',
                barCategoryGap:'70%',
                data: [500, 500, 500, 500, 500]
            },
            {
                name: '数量',
                type: 'bar',
                itemStyle:{
                    normal: {
                        show: true,
                        color: function(params) {
                            // build a color map as your need.
                            var colorList = [
                                '#4f8df3','#4f8df3','#a2b108','#da850f','#ff643d'
                            ];
                            return colorList[params.dataIndex]
                        },
                        barBorderRadius:50,
                        borderWidth:0,
                        borderColor:'#333'
                    }
                },
                barGap:'0%',
                barCategoryGap:'70%',
                data: [98, 109, 123, 210, 300]
            }

        ]
    };
    ZSRankingIDChart.setOption(option);


    //搜索指数排行（游玩）

    var YWRankingIDChart = echarts.init(document.getElementById('YWRankingID'), 'westeros');

    option = {
        grid: {
            width:'96%',
            right: '2%',
            top: '3%',
            containLabel: true
        },

        tooltip: {
            show:"true",
            trigger: 'axis',
            axisPointer: { // 坐标轴指示器，坐标轴触发有效
                type: 'shadow', // 默认为直线，可选为：'line' | 'shadow'
                shadowStyle : {
                    width: 'auto',// 阴影大小
                    color: 'rgba(255,255,255,0.1)'  // 阴影颜色
                }
            },
            formatter: function (params){
                return  params[0].name + '<br/>'
                    + params[0].seriesName + ' : ' + params[0].value
            }
        },
        xAxis:  {
            type: 'value',
            axisLine: {show:false},
            axisTick: {show:false},
            axisLabel: {show:false},
            splitArea: {show:false},
            splitLine: {show:false}
        },
        yAxis: [
            {
                type: 'category',
                axisLine: {show:false},
                axisTick: {show:false},
                axisLabel: {show:false},
                splitArea: {show:false},
                splitLine: {show:false},
                data: ['鹿糕','凉皮','猫耳朵','牛腩','鹿茸']
            },
            {
                type: 'category',
                axisLine: {show:false},
                axisTick: {show:false},
                axisLabel: {show:false},
                splitArea: {show:false},
                splitLine: {show:false},
                data: ['鹿糕','凉皮','猫耳朵','牛腩','鹿茸']
            }

        ],
        series: [
            {
                type: 'bar',
                yAxisIndex:1,
                itemStyle:{
                    normal: {
                        show: false,
                        color: '#040f3e',
                        barBorderRadius:50,
                        borderWidth:0,
                        borderColor:'#333'
                    }
                },
                barGap:'0%',
                barCategoryGap:'70%',
                data: [500, 500, 500, 500, 500]
            },
            {
                name: '数量',
                type: 'bar',
                itemStyle:{
                    normal: {
                        show: true,
                        color: function(params) {
                            // build a color map as your need.
                            var colorList = [
                                '#4f8df3','#4f8df3','#a2b108','#da850f','#ff643d'
                            ];
                            return colorList[params.dataIndex]
                        },
                        barBorderRadius:50,
                        borderWidth:0,
                        borderColor:'#333'
                    }
                },
                barGap:'0%',
                barCategoryGap:'70%',
                data: [98, 109, 123, 210, 300]
            }

        ]
    };
    YWRankingIDChart.setOption(option);


    //搜索指数排行（购物）

    var GWRankingIDChart = echarts.init(document.getElementById('GWRankingID'), 'westeros');

    option = {
        grid: {
            width:'96%',
            right: '2%',
            top: '3%',
            containLabel: true
        },

        tooltip: {
            show:"true",
            trigger: 'axis',
            axisPointer: { // 坐标轴指示器，坐标轴触发有效
                type: 'shadow', // 默认为直线，可选为：'line' | 'shadow'
                shadowStyle : {
                    width: 'auto',// 阴影大小
                    color: 'rgba(255,255,255,0.1)'  // 阴影颜色
                }
            },
            formatter: function (params){
                return  params[0].name + '<br/>'
                    + params[0].seriesName + ' : ' + params[0].value
            }
        },
        xAxis:  {
            type: 'value',
            axisLine: {show:false},
            axisTick: {show:false},
            axisLabel: {show:false},
            splitArea: {show:false},
            splitLine: {show:false}
        },
        yAxis: [
            {
                type: 'category',
                axisLine: {show:false},
                axisTick: {show:false},
                axisLabel: {show:false},
                splitArea: {show:false},
                splitLine: {show:false},
                data: ['鹿糕','凉皮','猫耳朵','牛腩','鹿茸']
            },
            {
                type: 'category',
                axisLine: {show:false},
                axisTick: {show:false},
                axisLabel: {show:false},
                splitArea: {show:false},
                splitLine: {show:false},
                data: ['鹿糕','凉皮','猫耳朵','牛腩','鹿茸']
            }

        ],
        series: [
            {
                type: 'bar',
                yAxisIndex:1,
                itemStyle:{
                    normal: {
                        show: false,
                        color: '#040f3e',
                        barBorderRadius:50,
                        borderWidth:0,
                        borderColor:'#333'
                    }
                },
                barGap:'0%',
                barCategoryGap:'70%',
                data: [500, 500, 500, 500, 500]
            },
            {
                name: '数量',
                type: 'bar',
                itemStyle:{
                    normal: {
                        show: true,
                        color: function(params) {
                            // build a color map as your need.
                            var colorList = [
                                '#4f8df3','#4f8df3','#a2b108','#da850f','#ff643d'
                            ];
                            return colorList[params.dataIndex]
                        },
                        barBorderRadius:50,
                        borderWidth:0,
                        borderColor:'#333'
                    }
                },
                barGap:'0%',
                barCategoryGap:'70%',
                data: [98, 109, 123, 210, 300]
            }

        ]
    };
    GWRankingIDChart.setOption(option);


    //搜索指数排行（娱乐）

    var YLRankingIDChart = echarts.init(document.getElementById('YLRankingID'), 'westeros');

    option = {
        grid: {
            width:'96%',
            right: '2%',
            top: '3%',
            containLabel: true
        },

        tooltip: {
            show:"true",
            trigger: 'axis',
            axisPointer: { // 坐标轴指示器，坐标轴触发有效
                type: 'shadow', // 默认为直线，可选为：'line' | 'shadow'
                shadowStyle : {
                    width: 'auto',// 阴影大小
                    color: 'rgba(255,255,255,0.1)'  // 阴影颜色
                }
            },
            formatter: function (params){
                return  params[0].name + '<br/>'
                    + params[0].seriesName + ' : ' + params[0].value
            }
        },
        xAxis:  {
            type: 'value',
            axisLine: {show:false},
            axisTick: {show:false},
            axisLabel: {show:false},
            splitArea: {show:false},
            splitLine: {show:false}
        },
        yAxis: [
            {
                type: 'category',
                axisLine: {show:false},
                axisTick: {show:false},
                axisLabel: {show:false},
                splitArea: {show:false},
                splitLine: {show:false},
                data: ['鹿糕','凉皮','猫耳朵','牛腩','鹿茸']
            },
            {
                type: 'category',
                axisLine: {show:false},
                axisTick: {show:false},
                axisLabel: {show:false},
                splitArea: {show:false},
                splitLine: {show:false},
                data: ['鹿糕','凉皮','猫耳朵','牛腩','鹿茸']
            }

        ],
        series: [
            {
                type: 'bar',
                yAxisIndex:1,
                itemStyle:{
                    normal: {
                        show: false,
                        color: '#040f3e',
                        barBorderRadius:50,
                        borderWidth:0,
                        borderColor:'#333'
                    }
                },
                barGap:'0%',
                barCategoryGap:'70%',
                data: [500, 500, 500, 500, 500]
            },
            {
                name: '数量',
                type: 'bar',
                itemStyle:{
                    normal: {
                        show: true,
                        color: function(params) {
                            // build a color map as your need.
                            var colorList = [
                                '#4f8df3','#4f8df3','#a2b108','#da850f','#ff643d'
                            ];
                            return colorList[params.dataIndex]
                        },
                        barBorderRadius:50,
                        borderWidth:0,
                        borderColor:'#333'
                    }
                },
                barGap:'0%',
                barCategoryGap:'70%',
                data: [98, 109, 123, 210, 300]
            }

        ]
    };
    YLRankingIDChart.setOption(option);



    //综合网络搜索指数走势

    var searchIndicesChart = echarts.init(document.getElementById('searchIndices') , 'westeros');

    option = {
        legend: {
            x: 'right',
            y: 'top',
            data:['百度','360']
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
                name:'次',
                type: "value",
                axisLine: {
                    show: true
                }
            }
        ],
        series: [
            {
                name: "百度",
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
                name: "360",
                type: "line",
                smooth: true,
                data: [60, 90, 68, 90, 345, 234, 143, 155, 80],
                markPoint: {
                    data: [
                        {type: 'max', name: '最大值'}
                    ]
                }
            }
        ]
    };

    searchIndicesChart.setOption(option);


    //TOP10关键词百度指数统计

    var keywordIndicesChart = echarts.init(document.getElementById('keywordIndices') , 'westeros');

    option = {
        grid: {
            width:'90%',
            height: "70%",
            right: '5%',
            top: '20%',
            containLabel: true
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
                name:'次',
                type: "value",
                axisLine: {
                    show: true
                }
            }
        ],
        series: [
            {
                name: "搜索量",
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
                data: [600, 9000, 6008, 900, 3465, 2034, 1403, 1505, 1800],
                markPoint: {
                    data: [
                        {type: 'max', name: '最大值'}
                    ]
                }
            }
        ]
    };

    keywordIndicesChart.setOption(option);




//扶风县关键词指数排行统计(近一周)

    var FFKeywordIndicesChart = echarts.init(document.getElementById('FFKeywordIndices') , 'westeros');


    //------------------------------------引用请注明出处

    var myData = ['扶风', '扶风旅游', '法门寺', '宝鸡扶风', '扶风游', '扶风景点', '扶风住宿', '扶风美食', '扶风购物', '扶风特产'];
    var databeast = {
        9.14: [389, 259, 262, 324, 232, 176, 196, 214, 133, 370],
        9.15: [111, 315, 139, 375, 204, 352, 163, 258, 385, 209],
        9.16: [227, 210, 328, 292, 241, 110, 130, 185, 392, 392],
        9.17: [100, 350, 300, 250, 200, 150, 100, 150, 200, 250],
        9.18: [280, 128, 255, 254, 313, 143, 360, 343, 338, 163],
        9.19: [121, 388, 233, 309, 133, 308, 297, 283, 349, 273],
        9.20: [200, 350, 300, 250, 200, 150, 100, 150, 200, 250]
    };
    var databeauty = {
        9.14: [121, 388, 233, 309, 133, 308, 297, 283, 349, 273],
        9.15: [200, 350, 300, 250, 200, 150, 100, 150, 200, 250],
        9.16: [380, 129, 173, 101, 310, 393, 386, 296, 366, 268],
        9.17: [363, 396, 388, 108, 325, 120, 180, 292, 200, 309],
        9.18: [300, 350, 300, 250, 200, 150, 100, 150, 200, 250],
        9.19: [100, 350, 300, 250, 200, 150, 100, 150, 200, 250],
        9.20: [280, 128, 255, 254, 313, 143, 360, 343, 338, 163]
    };
    var timeLineData = [9.14, 9.15, 9.16, 9.17, 9.18, 9.19, 9.20];

    option = {
        baseOption: {
            timeline: {
                show: true,
                axisType: 'category',
                tooltip: {
                    show: true,
                    formatter: function(params) {
                        console.log(params);
                        return params.name + '数据统计';
                    }
                },
                autoPlay: true,
                currentIndex: 6,
                playInterval: 1000,
                label: {
                    normal: {
                        show: true,
                        interval: 'auto',
                        formatter: '{value}',
                    },
                },
                data: [],
            },
            legend: {
                data: ['百度指数', '360指数'],
                top: 4,
                x: 'center',
                textStyle: {
                    color: '#fff',
                },
            },
            tooltip: {
                show: true,
                trigger: 'axis',
                formatter: '{b}<br/>{a}: {c}人',
                axisPointer: {
                    type: 'shadow',
                }
            },

            grid: [{
                show: false,
                left: '4%',
                top: 60,
                bottom: 60,
                containLabel: true,
                width: '46%',
            }, {
                show: false,
                left: '50.5%',
                top: 80,
                bottom: 60,
                width: '0%',
            }, {
                show: false,
                right: '4%',
                top: 60,
                bottom: 60,
                containLabel: true,
                width: '46%',
            }, ],

            xAxis: [
                {
                    type: 'value',
                    inverse: true,
                    axisLine: {
                        show: false,
                    },
                    axisTick: {
                        show: false,
                    },
                    position: 'top',
                    axisLabel: {
                        show: true,
                        textStyle: {
                            color: '#B2B2B2',
                            fontSize: 12,
                        },
                    },
                    splitLine: {
                        show: true,
                        lineStyle: {
                            color: '#0d2d5b',
                            width: 1,
                            type: 'solid',
                        },
                    },
                }, {
                    gridIndex: 1,
                    show: false,
                }, {
                    gridIndex: 2,
                    type: 'value',
                    axisLine: {
                        show: false,
                    },
                    axisTick: {
                        show: false,
                    },
                    position: 'top',
                    axisLabel: {
                        show: true,
                        textStyle: {
                            color: '#B2B2B2',
                            fontSize: 12,
                        },
                    },
                    splitLine: {
                        show: true,
                        lineStyle: {
                            color: '#0d2d5b',
                            width: 1,
                            type: 'solid',
                        },
                    },
                }, ],
            yAxis: [{
                type: 'category',
                inverse: true,
                position: 'right',
                axisLine: {
                    show: false
                },
                splitLine: {
                    show: false
                },
                axisTick: {
                    show: false
                },
                axisLabel: {
                    show: false,
                    margin: 8,
                    textStyle: {
                        color: '#9D9EA0',
                        fontSize: 12,
                    },

                },
                data: myData,
            }, {
                gridIndex: 1,
                type: 'category',
                inverse: true,
                position: 'left',
                axisLine: {
                    show: false
                },
                axisTick: {
                    show: false
                },
                splitLine: {
                    show: false
                },
                axisLabel: {
                    show: true,
                    textStyle: {
                        color: '#9D9EA0',
                        fontSize: 12,
                    },

                },
                data: myData.map(function(value) {
                    return {
                        value: value,
                        textStyle: {
                            align: 'center',
                        }
                    }
                }),
            }, {
                gridIndex: 2,
                type: 'category',
                inverse: true,
                position: 'left',
                axisLine: {
                    show: false
                },
                axisTick: {
                    show: false
                },
                splitLine: {
                    show: false
                },
                axisLabel: {
                    show: false,
                    textStyle: {
                        color: '#9D9EA0',
                        fontSize: 12,
                    },

                },
                data: myData,
            }, ],
            series: [],

        },

        options: [],


    };

    for (var i = 0; i < timeLineData.length; i++) {
        option.baseOption.timeline.data.push(timeLineData[i]);
        option.options.push({
            series: [{
                name: '百度指数',
                type: 'bar',
                barGap: 20,
                barWidth: 10,
                label: {
                    normal: {
                        show: false,
                    },
                    emphasis: {
                        show: true,
                        position: 'left',
                        offset: [0, 0],
                        textStyle: {
                            color: '#fff',
                            fontSize: 14,
                        },
                    },
                },
                /*itemStyle: {
                    normal: {
                        color: '#659F83',
                    },
                    emphasis: {
                        color: '#08C7AE',
                    },
                },*/
                data: databeast[timeLineData[i]],
            },


                {
                    name: '360指数',
                    type: 'bar',
                    barGap: 20,
                    barWidth: 10,
                    xAxisIndex: 2,
                    yAxisIndex: 2,
                    label: {
                        normal: {
                            show: false,
                        },
                        emphasis: {
                            show: true,
                            position: 'right',
                            offset: [0, 0],
                            textStyle: {
                                color: '#fff',
                                fontSize: 14,
                            },
                        },
                    },
                    /*itemStyle: {
                        normal: {
                            color: '#F68989',
                        },
                        emphasis: {
                            color: '#F94646',
                        },
                    },*/
                    data: databeauty[timeLineData[i]],
                }
            ]
        });
    }

    FFKeywordIndicesChart.setOption(option);



    //扶风县关键词指数排行统计(近一周)

    var countyKeywordIndicesChart = echarts.init(document.getElementById('countyKeywordIndices') , 'westeros');


    //------------------------------------引用请注明出处

    var myData = ['扶风县', '金台区', '渭滨区', '陈仓区', '凤翔县', '岐山县', '眉县', '陇县', '千阳县', '麟游县'];
    var databeast = {
        9.14: [389, 259, 262, 324, 232, 176, 196, 214, 133, 370],
        9.15: [111, 315, 139, 375, 204, 352, 163, 258, 385, 209],
        9.16: [227, 210, 328, 292, 241, 110, 130, 185, 392, 392],
        9.17: [100, 350, 300, 250, 200, 150, 100, 150, 200, 250],
        9.18: [280, 128, 255, 254, 313, 143, 360, 343, 338, 163],
        9.19: [121, 388, 233, 309, 133, 308, 297, 283, 349, 273],
        9.20: [200, 350, 300, 250, 200, 150, 100, 150, 200, 250]
    };
    var databeauty = {
        9.14: [121, 388, 233, 309, 133, 308, 297, 283, 349, 273],
        9.15: [200, 350, 300, 250, 200, 150, 100, 150, 200, 250],
        9.16: [380, 129, 173, 101, 310, 393, 386, 296, 366, 268],
        9.17: [363, 396, 388, 108, 325, 120, 180, 292, 200, 309],
        9.18: [300, 350, 300, 250, 200, 150, 100, 150, 200, 250],
        9.19: [100, 350, 300, 250, 200, 150, 100, 150, 200, 250],
        9.20: [280, 128, 255, 254, 313, 143, 360, 343, 338, 163]
    };
    var timeLineData = [9.14, 9.15, 9.16, 9.17, 9.18, 9.19, 9.20];

    option = {
        baseOption: {
            timeline: {
                show: true,
                axisType: 'category',
                tooltip: {
                    show: true,
                    formatter: function(params) {
                        console.log(params);
                        return params.name + '数据统计';
                    }
                },
                autoPlay: true,
                currentIndex: 6,
                playInterval: 1000,
                label: {
                    normal: {
                        show: true,
                        interval: 'auto',
                        formatter: '{value}',
                    },
                },
                data: [],
            },
            legend: {
                data: ['百度指数', '360指数'],
                top: 4,
                x: 'center',
                textStyle: {
                    color: '#fff',
                },
            },
            tooltip: {
                show: true,
                trigger: 'axis',
                formatter: '{b}<br/>{a}: {c}人',
                axisPointer: {
                    type: 'shadow',
                }
            },

            grid: [{
                show: false,
                left: '4%',
                top: 60,
                bottom: 60,
                containLabel: true,
                width: '46%',
            }, {
                show: false,
                left: '50.5%',
                top: 80,
                bottom: 60,
                width: '0%',
            }, {
                show: false,
                right: '4%',
                top: 60,
                bottom: 60,
                containLabel: true,
                width: '46%',
            }, ],

            xAxis: [
                {
                    type: 'value',
                    inverse: true,
                    axisLine: {
                        show: false,
                    },
                    axisTick: {
                        show: false,
                    },
                    position: 'top',
                    axisLabel: {
                        show: true,
                        textStyle: {
                            color: '#B2B2B2',
                            fontSize: 12,
                        },
                    },
                    splitLine: {
                        show: true,
                        lineStyle: {
                            color: '#0d2d5b',
                            width: 1,
                            type: 'solid',
                        },
                    },
                }, {
                    gridIndex: 1,
                    show: false,
                }, {
                    gridIndex: 2,
                    type: 'value',
                    axisLine: {
                        show: false,
                    },
                    axisTick: {
                        show: false,
                    },
                    position: 'top',
                    axisLabel: {
                        show: true,
                        textStyle: {
                            color: '#B2B2B2',
                            fontSize: 12,
                        },
                    },
                    splitLine: {
                        show: true,
                        lineStyle: {
                            color: '#0d2d5b',
                            width: 1,
                            type: 'solid',
                        },
                    },
                }, ],
            yAxis: [{
                type: 'category',
                inverse: true,
                position: 'right',
                axisLine: {
                    show: false
                },
                splitLine: {
                    show: false
                },
                axisTick: {
                    show: false
                },
                axisLabel: {
                    show: false,
                    margin: 8,
                    textStyle: {
                        color: '#9D9EA0',
                        fontSize: 12,
                    },

                },
                data: myData,
            }, {
                gridIndex: 1,
                type: 'category',
                inverse: true,
                position: 'left',
                axisLine: {
                    show: false
                },
                axisTick: {
                    show: false
                },
                splitLine: {
                    show: false
                },
                axisLabel: {
                    show: true,
                    textStyle: {
                        color: '#9D9EA0',
                        fontSize: 12,
                    },

                },
                data: myData.map(function(value) {
                    return {
                        value: value,
                        textStyle: {
                            align: 'center',
                        }
                    }
                }),
            }, {
                gridIndex: 2,
                type: 'category',
                inverse: true,
                position: 'left',
                axisLine: {
                    show: false
                },
                splitLine: {
                    show: false
                },
                axisTick: {
                    show: false
                },
                axisLabel: {
                    show: false,
                    textStyle: {
                        color: '#9D9EA0',
                        fontSize: 12,
                    },

                },
                data: myData,
            }, ],
            series: [],

        },

        options: [],


    };

    for (var i = 0; i < timeLineData.length; i++) {
        option.baseOption.timeline.data.push(timeLineData[i]);
        option.options.push({
            series: [{
                name: '百度指数',
                type: 'bar',
                barGap: 20,
                barWidth: 10,
                label: {
                    normal: {
                        show: false,
                    },
                    emphasis: {
                        show: true,
                        position: 'left',
                        offset: [0, 0],
                        textStyle: {
                            color: '#fff',
                            fontSize: 14,
                        },
                    },
                },
                /*itemStyle: {
                    normal: {
                        color: '#659F83',
                    },
                    emphasis: {
                        color: '#08C7AE',
                    },
                },*/
                data: databeast[timeLineData[i]],
            },


                {
                    name: '360指数',
                    type: 'bar',
                    barGap: 20,
                    barWidth: 10,
                    xAxisIndex: 2,
                    yAxisIndex: 2,
                    label: {
                        normal: {
                            show: false,
                        },
                        emphasis: {
                            show: true,
                            position: 'right',
                            offset: [0, 0],
                            textStyle: {
                                color: '#fff',
                                fontSize: 14,
                            },
                        },
                    },
                    /*itemStyle: {
                        normal: {
                            color: '#F68989',
                        },
                        emphasis: {
                            color: '#F94646',
                        },
                    },*/
                    data: databeauty[timeLineData[i]],
                }
            ]
        });
    }

    countyKeywordIndicesChart.setOption(option);


});
