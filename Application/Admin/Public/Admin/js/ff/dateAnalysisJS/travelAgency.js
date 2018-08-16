/**
 * 团队运作
 */
function getTravelGroupTotal(days){
    $.get('getTravelGroupTotal',{s_day:days},function (res) {
        //扶风旅游客流量统计
        var teamOperationChart = echarts.init(document.getElementById('teamOperation') , 'westeros');

        //带团导游数统计
        var tourGuideChart = echarts.init(document.getElementById('tourGuide') , 'westeros');
        teamOperationChart.clear();
        var r = res.data;
        if(res.code == 1) {

            $('.planing span').text(r.plan_total);
            $('.doing span').text(r.conduct_total);
            $('.end span').text(r.ends_total);
            r.midify_bfb = Number((r.midify_ordernum/r.conduct_total)*100).toFixed(2)+'%';
            r.guide_bfb = Number((r.guide_usernum/r.guide_total)*100).toFixed(2)+'%';
        }else {
            $('.planing span').text(0);
            $('.doing span').text(0);
            $('.end span').text(0);
             r.midify_ordernum = 0;
            r.guide_usernum = 0;
            r.midify_bfb = r.guide_bfb = '0%';
        }
        // if(res.code == 1){
        //     var r = res.data;
        //     $('.planing span').text(r.plan_total);
        //     $('.doing span').text(r.conduct_total);
        //     $('.end span').text(r.ends_total);

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
                grid: {
                    width:'90%',
                    left:'7%'
                },
                calculable: true,
                xAxis: [
                    {
                        type: "category",
                        boundaryGap: true,
                        axisLine: {
                            show: true
                        },
                        splitLine: {
                            "show": false
                        },
                        data: r.s_date //["9.14", "9.15", "9.16", "9.17", "9.18", "9.19", "9.20",]
                    }
                ],
                yAxis: [
                    {
                        name:'单位：笔',
                        type: "value",
                        axisLine: {
                            show: true
                        }
                    }
                ],
                series: [
                    {
                        name: "待出行",
                        type: "bar",
                        stack: '总量',
                        barWidth: '40%',
                        smooth: true,
                        data:  r.plan_ordernum
                        // data:  [30, 89, 306, 100, 87, 134, 124]
                    },
                    {
                        name: "行程中",
                        type: "bar",
                        stack: '总量',
                        barWidth: '40%',
                        smooth: true,
                        data: r.conduct_ordernum, //[40, 89, 146, 100, 287, 134, 124]
                    },
                    {
                        name: "已结束",
                        type: "bar",
                        stack: '总量',
                        barWidth: '40%',
                        smooth: true,
                        data: r.ends_ordernum //[90, 89, 126, 100, 187, 134, 124]
                    }
                ]
            };
            teamOperationChart.setOption(option);

            //行程变更统计
            var travelChangeChart = echarts.init(document.getElementById('travelChange') , 'westeros');
            var dataStyle = {
                normal: {
                    label: {
                        show: false
                    },
                    labelLine: {
                        show: false
                    },
                    shadowBlur: 40,
                    shadowColor: 'rgba(40, 40, 40, 0.5)',
                }
            };
            var placeHolderStyle = {
                normal: {
                    color: 'rgba(44,59,70,1)',//未完成的圆环的颜色
                    label: {
                        show: false
                    },
                    labelLine: {
                        show: false
                    }
                },
                emphasis: {
                    color: 'rgba(44,59,70 ,1)'//未完成的圆环的颜色
                }
            };
            option = {
                title: {
                    text: r.midify_ordernum+'笔', //'13 笔',
                    subtext:  r.midify_bfb,//'32%',
                    x: 'center',
                    y: '32%',
                    textStyle: {
                        fontWeight: 'normal',
                        color: "#3dd4de",
                        fontSize: 20
                    },
                    subtextStyle: {
                        fontWeight: 'normal',
                        color: "#3dd4de",
                        fontSize: 14
                    }
                },

                tooltip: {
                    show: false,
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    show: false,
                    itemGap: 12,
                    data: ['01', '02']
                },
                toolbox: {
                    show: false,
                    feature: {
                        mark: {
                            show: true
                        },
                        dataView: {
                            show: true,
                            readOnly: false
                        },
                        restore: {
                            show: true
                        },
                        saveAsImage: {
                            show: true
                        }
                    }
                },
                series: [{
                    name: 'Line 1',
                    type: 'pie',
                    clockWise: false,
                    radius: [55, 60],
                    itemStyle: dataStyle,
                    hoverAnimation: false,

                    data: [{
                        value: 13,
                        name: '01',
                        itemStyle: {
                            normal: {
                                color: '#3dd4de',
                                shadowColor: '#3dd4de',
                                shadowBlur: 10
                            }
                        }
                    }, {
                        value: r.midify_ordernum, //87,
                        name: 'invisible',
                        itemStyle: placeHolderStyle,
                    }
                    ]
                }
                ]
            };
            travelChangeChart.setOption(option);

            //带团导游数统计
            // var tourGuideChart = echarts.init(document.getElementById('tourGuide') , 'westeros');
            var dataStyle = {
                normal: {
                    label: {
                        show: false
                    },
                    labelLine: {
                        show: false
                    },
                    shadowBlur: 40,
                    shadowColor: 'rgba(40, 40, 40, 0.5)',
                }
            };
            var placeHolderStyle = {
                normal: {
                    color: 'rgba(187,135,237,.2)',//未完成的圆环的颜色
                    label: {
                        show: false
                    },
                    labelLine: {
                        show: false
                    }
                },
                emphasis: {
                    color: 'rgba(187,135,237,.2)'//未完成的圆环的颜色
                }
            };
            option = {
                title: {
                    formatter: "{a} <br/>{b} : {c} ({d}%)",
                    text: r.guide_usernum +'人', //'131 人',
                    subtext: r.guide_bfb,
                    x: 'center',
                    y: '32%',
                    textStyle: {
                        fontWeight: 'normal',
                        color: "#bb87ea",
                        fontSize: 20
                    },
                    subtextStyle: {
                        fontWeight: 'normal',
                        color: "#bb87ea",
                        fontSize: 14
                    }
                },

                tooltip: {
                    show: false,
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    show: false,
                    itemGap: 12,
                    data: ['01', '02']
                },
                toolbox: {
                    show: false,
                    feature: {
                        mark: {
                            show: true
                        },
                        dataView: {
                            show: true,
                            readOnly: false
                        },
                        restore: {
                            show: true
                        },
                        saveAsImage: {
                            show: true
                        }
                    }
                },
                series: [{
                    name: 'Line 1',
                    type: 'pie',
                    clockWise: false,
                    radius: [55, 60],
                    itemStyle: dataStyle,
                    hoverAnimation: false,

                    data: [{
                        value: 111,
                        name: '01',
                        itemStyle: {
                            normal: {
                                color: '#bb87ea',
                                shadowColor: '#bb87ea',
                                shadowBlur: 10
                            }
                        }
                    }, {
                        value: r.guide_usernum, //300,
                        name: 'invisible',
                        itemStyle: placeHolderStyle
                    }
                    ]
                }
                ]
            };
            tourGuideChart.setOption(option);
        // }else{
        //     $('.planing span').text(0);
        //     $('.doing span').text(0);
        //     $('.end span').text(0);
        //
        //
        //     tourOption = {
        //         title: {
        //             text: 0 + '人', //'131 人',
        //             subtext:'0%',
        //             x: 'center',
        //             y: '0%',
        //         }
        //     }
        //     tourGuideChart.setOption(tourOption);
        // }
    })
}

/**
 * 地接行程数统计
 */
function getTravelLocalOrderInfo(days) {
    $.get('getTravelLocalOrderInfo',{s_day:days},function (res) {
        if(res.code ==1){
            var r = res.data;
            //地接行程数据统计
            var localTravelAgencyChart = echarts.init(document.getElementById('localTravelAgency') , 'westeros');
            option = {
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'cross',
                        crossStyle: {
                            color: '#999'
                        }
                    }
                },
                legend: {
                    data:['行程单数','接待客流']
                },
                xAxis: [
                    {
                        type: 'category',
                        data: r.s_date, //['9.15','9.16','9.17','9.18','9.19','9.20','9.21'],
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
                        name: '行程单：（笔）',
                        min: 0,
                        max: 250,
                        interval: 50
                    },
                    {
                        type: 'value',
                        name: '接待客流：（人）',
                        min: 0,
                        max: 2500,
                        interval: 500
                    }
                ],
                series: [
                    {
                        name:'行程单数',
                        type:'line',
                        data: r.orderNum//[64, 87, 70, 176, 28, 67, 29]
                    },
                    {
                        name:'接待客流',
                        type:'line',
                        yAxisIndex: 1,
                        data: r.userNum //[102, 1033, 1234, 1930, 1305, 1000, 802]
                    }
                ]
            };

            localTravelAgencyChart.setOption(option);
        }
    })
}

/**
 *  组团行程数据统计
 */
function getTravelGroupOrderInfo(days) {
    $.get('getTravelGroupOrderInfo',{s_day:days},function (res) {
        if(res.code == 1){
            var r = res.data;
            //组团行程数据统计
            var tourOrganizingAgencyChart = echarts.init(document.getElementById('tourOrganizingAgency') , 'westeros');
            option = {
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'cross',
                        crossStyle: {
                            color: '#999'
                        }
                    }
                },
                legend: {
                    data:['行程单数','接待客流']
                },
                xAxis: [
                    {
                        type: 'category',
                        data: r.s_date,  //['9.15','9.16','9.17','9.18','9.19','9.20','9.21'],
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
                        name: '行程单：（笔）',
                        min: 0,
                        max: 250,
                        interval: 50,
                        /*axisLine: {
                            onZero: false,
                            lineStyle: {
                                color:'#0286de'
                            }
                        }*/
                    },
                    {
                        type: 'value',
                        name: '接待客流：（人）',
                        min: 0,
                        max: 2500,
                        interval: 500,
                        /*axisLine: {
                            onZero: false,
                            lineStyle: {
                                color:'#ec6f69'
                            }
                        }*/
                    }
                ],
                series: [
                    {
                        name:'行程单数',
                        type:'line',
                        data: r.orderNum //[64, 87, 70, 176, 28, 67, 29]
                    },
                    {
                        name:'接待客流',
                        type:'line',
                        yAxisIndex: 1,
                        data: r.userNum//[102, 1033, 1234, 1930, 1305, 1000, 802]
                    }
                ]
            };
            tourOrganizingAgencyChart.setOption(option);
        }
    })
}


$(function() {





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
                avoidLabelOverlap: true,
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
