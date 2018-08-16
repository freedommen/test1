
//酒店接待客流总数据统计
function getInnOrdertotal(s_day) {
    $.get('getInnOrdertotal',{s_day:s_day},function (res) {
        var KLZSChart = echarts.init(document.getElementById('KLZS') , 'westeros');
        KLZSChart.clear();
        if(res.code == 1){
            var r = res.data;
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
                        data: r.s_date,
                        // data:  ["9.14", "9.15", "9.16", "9.17", "9.18", "9.19", "9.20"],
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
                        name:'单位：人',
                        type: "value",
                        axisLine: {
                            show: true
                        }
                    }
                ],
                series: [
                    {
                        name: "客流",
                        type: "line",
                        smooth: true,
                        data: r.user_num,
                        // data: [40, 89, 126, 200, 187, 134, 124, 90, 60],
                        markPoint: {
                            data: [
                                {type: 'max', name: '最大值'}
                            ]
                        }
                    }
                ]
            };

            KLZSChart.setOption(option);
        }
    });
}

//游客入住时长占比统计
function getInnStayDays(s_day) {

    $.get('getInnStayDays',{s_day:s_day},function (res) {
        var RZSCChart = echarts.init(document.getElementById('RZSC') , 'westeros');
        RZSCChart.clear();
       if(res.code == 1){
           var r =res.data;
           option = {
               legend: {
                   x: 'right',
                   y: 'top',
                   icon: 'circle',
                   data:['1天','2天','3天','4天','5天以上']
               },
               title: {
                   width: '65%' ,
                   text: '平均入住时长',
                   subtext: '2.7天',
                   textStyle:{
                       fontSize: 14,
                       color: '#80a6f8'
                   },
                   subtextStyle:{
                       fontSize: 20,
                       color: '#eee'
                   },
                   top: '47%',
                   left: '49%',
                   textAlign: 'center'
               },
               tooltip: {
                   trigger: 'item',
                   formatter: "{a}： {b} <br/>占比： {d}%"
               },
               series: [
                   {
                       name: '入住时长',
                       type:'pie',
                       radius: ['50%', '65%'],
                       center: ['50%', '55%'],
                       avoidLabelOverlap: true,
                       label: {
                           normal: {
                               formatter: '{b}\n{d}%',
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
                       data:r.list,
                       // data:[
                       //     {value:335, name:'1天'},
                       //     {value:432, name:'2天'},
                       //     {value:335, name:'3天'},
                       //     {value:432, name:'4天'},
                       //     {value:432, name:'5天以上'}
                       // ]
                   }
               ]
           };

           RZSCChart.setOption(option);

       }
    });
}

//接待客流TOP10
function getReceptionTop10(s_day) {
    $.get('getReceptionTop10',{s_day:s_day},function (res) {
        var ReceptionTOP10Chart = echarts.init(document.getElementById('ReceptionTOP10') , 'westeros');
        ReceptionTOP10Chart.clear();
        if(res.code == 1){
            var r = res.data;
            // 指定图表的配置项和数据
            option = {
                tooltip : {
                    trigger: 'axis',
                    axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                        type : 'line'        // 默认为直线，可选为：'line' | 'shadow'
                    }
                },
                grid: {
                    height: '70%',
                    left: '3%',
                    right: '4%',
                    top: '15%',
                    containLabel: true
                },
                xAxis : [
                    {
                        type : 'category',
                        splitLine: {           // 分隔线
                            show: false
                        },
                        data : r.name,
                        // data : ['法门寺大酒店', '佛光阁大酒店', '显示酒店名称三', '显示酒店名称四', '显示酒店名称五', '显示酒店名称六', '显示酒店名称七', '显示酒店名称八', '显示酒店名称九', '显示酒店名称十'],
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
                        data:r.user_num
                        // data:[930, 778, 700, 628, 600, 534, 467, 330, 220, 120]
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
                        // data:[30, 38, 10, 28]
                        data:r.proportion
                    }
                ]
            };
            ReceptionTOP10Chart.setOption(option);

        }
    })
}

/**
 * 酒店预订渠道统计
 */
function getHotelBookingChannel(s_day) {

    $.get('getHotelBookingChannel',{s_day:s_day},function (res) {
        var HotelBookingChannelChart = echarts.init(document.getElementById('HotelBookingChannel') , 'westeros');
        HotelBookingChannelChart.clear();
        if(res.code == 1){
            var r = res.data;
            //酒店预订渠道统计

            option = {
                legend: {
                    x: 'right',
                    y: 'top',
                    icon: 'circle',
                    data: r.name //['飞猪','去哪儿','携程','艺龙','其他']
                },
                tooltip: {
                    trigger: 'item',
                    formatter: "{a}： {b} <br/>预订量： {c} <br/>占比： {d}%"
                },
                series: [
                    {
                        name: '预订渠道',
                        type:'pie',
                        radius: [0, '60%'],
                        center: ['50%', '55%'],
                        avoidLabelOverlap: true,
                        selectedMode: 'single',
                        label: {
                            normal: {
                                formatter: "{b}\n{d}%"
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
                        data : r.list,
                        // data:[
                        //     {value:335, name:'飞猪'},
                        //     {value:432, name:'去哪儿'},
                        //     {value:335, name:'携程', selected:true},
                        //     {value:43, name:'艺龙'},
                        //     {value:432, name:'其他'}
                        // ]
                    }
                ]
            };

            HotelBookingChannelChart.setOption(option);

        }
    })

}

// 酒店类型欢迎程度占比分析
function getFavoriteHotel(s_day) {
    $.get('getFavoriteHotel',{s_day:s_day},function (res) {
        var hotelTypePopularChart = echarts.init(document.getElementById('hotelTypePopular') , 'westeros');
        hotelTypePopularChart.clear();
        if(res.code == 1){
            var r = res.data;

            option = {
                legend: {
                    x: 'right',
                    y: 'top',
                    icon: 'circle',
                    data:r.name,
                },
                tooltip: {
                    trigger: 'item',
                    formatter: "{a}： {b} <br/>入住率： {c}% <br/>占比： {d}%"
                },
                series: [
                    {
                        name: '酒店类型',
                        type:'pie',
                        radius: ['40%', '55%'],
                        center: ['50%', '50%'],
                        avoidLabelOverlap: true,
                        label: {
                            normal: {
                                formatter: "{b}\n{d}%"
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
                        data : r.list,
                        // data:[
                        //     {value:'335.2', name:'星级酒店'},
                        //     {value:132, name:'酒店式公寓'},
                        //     {value:235, name:'客栈'},
                        //     {value:343, name:'民宿'},
                        //     {value:532, name:'其他'}
                        // ]
                    }
                ]
            };
            hotelTypePopularChart.setOption(option);
        }
    })
}


//酒店分销直销占比
function getSaleChannel(s_day) {
    $.get('getSaleChannel',{s_day:s_day},function (res) {
        var FXZXChart = echarts.init(document.getElementById('FXZX') , 'westeros');
        FXZXChart.clear();
        if(res.code ==1 ){
            var r = res.data;

            option = {
                tooltip: {
                    trigger: 'item',
                    formatter: "{a}{b} <br/>客流： {c} <br/>占比： {d}%"
                },
                legend: {
                    x: 'right',
                    y: 'top',
                    icon: 'circle',
                    data: r.name //['分销','直销']
                },
                series: [
                    {
                        type:'pie',
                        radius: ['40%', '55%'],
                        center: ['50%', '50%'],
                        avoidLabelOverlap: true,
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
                        data: r.list
                        // data:[
                        //     {value: 535, name:'分销'},
                        //     {value: 332, name:'直销'}
                        // ]
                    }
                ]
            };
            FXZXChart.setOption(option);
        }
    });
}

//游客性别占比
//游客年龄占比
function getHotelVisitorInfo(s_day) {
    $.get('getHotelVisitorInfo',{s_day:s_day},function (res) {

        //游客性别占比
        var sexRatioChart = echarts.init(document.getElementById('sexRatio') , 'walden');
        sexRatioChart.clear();
        //游客年龄占比
        var AgeRatioChart = echarts.init(document.getElementById('AgeRatio') , 'westeros');
        AgeRatioChart.clear();
        if(res.code == 1 ){
            var r = res.data;

            var women = 'image://data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAACNElEQVRoge1Z0bGCMBC8EighkzRgB88SLMEyvPtKCXagJdCBdKAzCfqZ1wF24PtAFIVAiITwZtyZ/CHuJru5SwAICMNkYphMQv7H6DBMJprTTnEqtKCbFnRTnArNaTd7MTmjRZ34+1CcipzRIjbPVhgmky7ydRGzXAnFSfaRr4mQsfk2oDkaVwGa0zE23wacyd9HbL4N/HsBSmDmnAGBWWy+DeSC1q4CckHr2Hxb4bIKs5z9CobJRAtKOwSks6wB7zgLXGmBeyUwK1cF92eBq9i8rDBMJheGP0PGLFaiatyGbqG1ghavwbuTP3qTr1XlKCJGIR+rtRjSuDkXt6kavJzRYmzyjwI3xVlhVOtMbSWbdaq93p1sWSMmtZLNOorj1TCZKLZZOvudbZblCQ6vk1nJZp2qwg4VAFBV7Ams1LHrpI9nPAQAAGhL7zSalfqs83jOs50ObqU+6zxJ9N9I1Gb35WYimJVcrAMAkHPauu9A99nltH2ZqBBWapvVhnU+KGx1i9ispDgVXuQvbMP6rAMAoAUefAVogYf6u2w58m72NMdTp3UGBNcl0AAtx1KOJy/yAM8johKYvXt2aHBdAw1QZqqq7sFabZ/gugY6OEJ0pJPeWn8WXLdAB8MYwXUNdBAMuoUeOjia4AJsfcs4Aug3uIB7gNPq0upxedWsGV0zfWr8XlAa9fOTbzs9G3wFxMZXQGx8BcwBrgJi87RCd39eqkba/6ZIKA9AuG8/2+I1xAHlD4syumyld28JAAAAAElFTkSuQmCC';

            var men = 'image://data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAABwElEQVRoge2ZwbGCMBCGLeFPKrAEOniWYAmWQAl0gJddj1KCJdDB87zLTOxAO/AdFEcBFRQMz8k/s6fMwP9lQzZLJpMBhdQBqcOQ7+hdSB0sydqQ7i3r0bIeDenekqxHDwOS6Np4NQzpHiSRb5+NQurwyPwNxBgzYUmTZ+YvQZr49luTYXFtAQzJr2+/NbWe/XP49lvTvwcwrHnrJcSa+/ZbE0gWbQFAsvDtt1FtsjDK2S91rgWbBzVgM8oaUBW4mFuWzLDmp6xIBi7mvn3dCCQRWH96iU8eL8DFvEvRar8ziRs8S112mldjsB0KKzcd2vwFYuWmvQNYKpafArBULHsH6FJp3/8eBqgVXwlgWHNLmhjSXWeTpDtLmtx77kcAysbkleyUJpsaoQAQAAJAAAgAAaB3AMuSVV9Unt/fATh1b9VxyXoHAEl0a0C2ZX/7FkDqYFi2NxMzVIcGksiSJmCNr5vz+wCSNWWuukyQOoA1tqSJl7/X9wCw0hlWOnsG4F0BwLcCgG8FAN8KAL4VAHzrawHK8dEDgDWuGSTdlONN105gjX16rgmssSHdGdaDZcmuj9tIHc5XTgdDuuvT/B/L5uw/gnvI3QAAAABJRU5ErkJggg==';

            var maxData = r.userTotal;

            option = {
                //性别
                xAxis: {
                    show: false
                },
                yAxis: {
                    data: r.sexText,
                    // data: ['男', '女'],
                    inverse: true,
                    axisTick: {show: false},
                    axisLine: {show: false},
                    axisLabel: {
                        margin: 10,
                        textStyle: {
                            color: '#eee',
                            fontSize: 14
                        }
                    },
                    splitLine: {           // 分隔线
                        show: false
                    }
                },
                grid: {
                    width: '70%' ,
                    top: 'center',
                    height: 200,
                    left: 40,
                    right: 100
                },

                series: [

                    //性别比例
                    {
                        // current data
                        type: 'pictorialBar',
                        symbolRepeat: 'fixed',
                        symbolMargin: '20%',
                        symbolClip: true,
                        symbolSize: 20,
                        symbolBoundingData: maxData,
                        // data: r.sexInfo,
                        data: [{value: r.sexInfo.male,symbol: men},{value: r.sexInfo.female,symbol: women}],
                        z: 10
                    }, {
                        // full data
                        type: 'pictorialBar',
                        itemStyle: {
                            normal: {
                                opacity: 0.2
                            }
                        },
                        label: {
                            normal: {
                                show: true,
                                formatter: function (params) {
                                    return (params.value / maxData * 100).toFixed(1) + ' %';
                                },
                                position: 'left , bottom',
                                offset: [0, 65],
                                textStyle: {
                                    color: '#fff',
                                    fontSize: 12
                                }
                            }
                        },
                        animationDuration: 0,
                        symbolRepeat: 'fixed',
                        symbolMargin: '20%',
                        symbolSize: 20,
                        symbolBoundingData: maxData,
                        // data: r.sexInfo,
                        data: [{value: r.sexInfo.male,symbol: men},{value: r.sexInfo.female,symbol: women}],
                        // data: [{value: 503, symbol: men},{value: 485,symbol: women}],
                        z: 5,
                    }
                ],
            };

            sexRatioChart.setOption(option);


            // //游客年龄占比
            // var AgeRatioChart = echarts.init(document.getElementById('AgeRatio') , 'westeros');
            option = {
                legend: {
                    x: 'right',
                    y: 'top',
                    icon: 'circle',
                    data: r.ageText
                    // data:['1天','2天','3天','4天','5天以上']
                },
                title: {
                    width: '65%' ,
                    text: '游客平均年龄',
                    subtext: r.ageAvg, //'29岁',
                    textStyle:{
                        fontSize: 14,
                        color: '#80a6f8'
                    },
                    subtextStyle:{
                        fontSize: 20,
                        color: '#eee'
                    },
                    top: '45%',
                    left: '50%',
                    textAlign: 'center'
                },
                tooltip: {
                    trigger: 'item',
                    formatter: "{a}： {b} <br/>客流： {c} <br/>占比： {d}%"
                },
                series: [
                    {
                        name: '游客年龄',
                        type:'pie',
                        radius: ['45%', '60%'],
                        center: ['50%', '50%'],
                        avoidLabelOverlap: true,
                        label: {
                            normal: {
                                formatter: '{b}\n{d}%'
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
                        data: r.ageInfo
                        // data:[
                        //     {value:335, name:'<16岁'},
                        //     {value:432, name:'16-24岁'},
                        //     {value:335, name:'25-35岁'},
                        //     {value:432, name:'36-46岁'},
                        //     {value:432, name:'>46岁'}
                        // ]
                    }
                ]
            };
            AgeRatioChart.setOption(option);
        }
    })
}

//入住率统计折线图
function getOccupancyRate(s_day) {
    $.get('getOccupancyRate',{s_day:s_day},function (res) {

        var occupancyRateChart = echarts.init(document.getElementById('occupancyRate') , 'westeros');
        occupancyRateChart.clear();

        //近7日入住率
        var occupancyRate7DayChart = echarts.init(document.getElementById('occupancyRate7Day') , 'westeros');
        occupancyRate7DayChart.clear();
        if(res.code == 1){
            var r =res.data;

            option = {
                // legend: {
                //     x: 'right',
                //     y: 'top',
                //     data:['客流']
                // },
                tooltip: {
                    trigger: "axis"
                },
                calculable: true,
                xAxis: [
                    {
                        type: "category",
                        boundaryGap: false,
                        data:r.s_date,
                        // data: ["9.14", "9.15", "9.16", "9.17", "9.18", "9.19", "9.20"],
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
                        name: '入住率(%)',
                        type: "value",
                        axisLabel: {
                            show: true,
                            interval: 'auto',
                            formatter: '{value}%'
                        },
                        show: true
                    }
                ],
                series: [
                    {
                        name: "入住率(%)",
                        type: "line",
                        smooth: true,
                        // itemStyle: {
                        //     normal: {
                        //         label: {
                        //             show: true,
                        //             position: 'top',
                        //             formatter: '{c}%'
                        //         }
                        //     }
                        // },
                        data: r.occupancy,
                        //data: [40, 89, 26, 20, 87, 100, 80, 90, 60],
                        markPoint: {
                            data: [
                                {type: 'max', name: '最大值'}
                            ]
                        }
                    }
                ]
            };

            occupancyRateChart.setOption(option);



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
                    text: r.occupancyText, //'近7日入住率',
                    subtext: r.occupancyAvg, //'75%',
                    x: 'center',
                    y: '42%',
                    textStyle: {
                        fontWeight: 'normal',
                        color: "#3dd4de",
                        fontSize: 12
                    },
                    subtextStyle: {
                        fontWeight: 'normal',
                        color: "#3dd4de",
                        fontSize: 22
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
                        value: 75,
                        name: '01',
                        itemStyle: {
                            normal: {
                                color: '#3dd4de',
                                shadowColor: '#3dd4de',
                                shadowBlur: 10
                            }
                        }
                    }, {
                        value: 25,
                        name: 'invisible',
                        itemStyle: placeHolderStyle,
                    }
                    ]
                }
                ]
            };
            occupancyRate7DayChart.setOption(option);
        }
    })
}

// 住客客源地统计分析
function getHotelVisitorArea(sDay){
    $.get('getHotelVisitorArea',{s_day:sDay},function (res) {
        var provinceTop10Chart = echarts.init(document.getElementById('provinceTop10') , 'westeros');
        provinceTop10Chart.clear();
        //客源地城市top10
        var cityTop10Chart = echarts.init(document.getElementById('cityTop10') , 'westeros');
        cityTop10Chart.clear();
        //外省与本省客源分析
        var provinceAnalysisChart = echarts.init(document.getElementById('provinceAnalysis') , 'westeros');
        provinceAnalysisChart.clear();
        if(res.code == 1){
            var r = res.data;
            //客源地省份TOP10
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
                        data : r.provinceName,
                        // data : ['广州', '四川', '贵州', '陕西', '山东', '重庆', '内蒙古', '江苏', '北京', '河北'],
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
                        name:'住客',
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
                        data: r.provinceNum
                        //data:[930, 778, 700, 628, 600, 534, 467, 330, 220, 120]
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

            // //客源地城市top10
            // var cityTop10Chart = echarts.init(document.getElementById('cityTop10') , 'westeros');
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
                        data:r.cityName,
                        //data : ['城市1', '城市2', '城市3', '城市4', '城市5', '城市6', '城市7', '城市8', '城市9', '城市10'],
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
                        name:'住客',
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
                        data: r.cityNum
                        // data:[930, 778, 700, 628, 600, 534, 467, 330, 220, 120]
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

            // //外省与本省客源分析
            // var provinceAnalysisChart = echarts.init(document.getElementById('provinceAnalysis') , 'westeros');
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
                         data : r.provinceVS
                        // data:[
                        //     {value:335, name:'外省'},
                        //     {value:432, name:'本省'}
                        // ]
                    }
                ]
            };
            provinceAnalysisChart.setOption(option);
        }
    })
};
