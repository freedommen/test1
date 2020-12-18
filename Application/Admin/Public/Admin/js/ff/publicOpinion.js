
//负面舆情TOP10
function getNews(hours) {
    $.get("getNews",function (res) {
        if (res.code == 1){
            var r = res.data;
            var str = '';
            $(r).each(function(i,item){
                str += '<li>' +
                    '<a href="#">\n' + '<span>'+item.ranking+'</span>\n' + item.title +
                    '</a></li>';
            });
            $('#getNews').append(str);
        }
    });
}


//舆情正负情感走势
function getSentimentTrend(hours) {
    $.get('getSentimentTrend',{hours:hours},function (res) {
        if(res.code == 1 ){

            var r = res.data;
            var publicOpinionTrendIDChart = echarts.init(document.getElementById('publicOpinionTrendID'), 'westeros');
            publicOpinionTrendIDChart.clear();
            publicOpinionTrendIDChart.getOption();
            // var base = +new Date(2018, 1, 1);
            // var oneDay = 24 * 3600 * 1;
            // var date = [];
            // var data = [Math.random() * 100];
            // for (var i = 1; i < 200; i++) {
            //     var now = new Date(base += oneDay);
            //     date.push([now.getFullYear(), now.getMonth() , now.getDate()].join('/'));
            //     data.push(Math.round((Math.random() - 0.5) * 20 + data[i - 1]));
            // }
            option = {
                tooltip: {
                    trigger: 'axis',
                    position: function (pt) {
                        return [pt[0], '10%'];
                    }
                },
                /*title: {
                    left: 'center',
                    text: '大数据量面积图',
                },*/
                /*toolbox: {
                    feature: {
                        dataZoom: {
                            yAxisIndex: 'none'
                        },
                        restore: {},
                        saveAsImage: {}
                    }
                },*/
                legend: {
                    show: 'true',
                    right: '20px',
                    data: ['正面舆情', '负面舆情', '舆情情感走势'],
                    // icon: 'circle',
                    // left: '3%'
                },
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    //日期 时间
                    data: r.s_time
                },
                yAxis: {
                    type: 'value',
                    boundaryGap: [0, '100%']
                },
                dataZoom: [{
                    type: 'inside',
                    start: 0,
                    end: 100
                }, {
                    height:'24px;',
                    start: 0,
                    end: 100,
                    // handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                    handleSize: '80%',
                    fillerColor:"rgba(13,110,206,0.6)",
                    handleStyle: {
                        color: '#fff',
                        borderColor:'#00b9ff',
                        shadowBlur: 3,
                        shadowColor: 'rgba(0, 0, 0, 0.5)',
                        shadowOffsetX: 2,
                        shadowOffsetY: 2
                    }
                }],
                series: [
                    {
                        name:'正面舆情',
                        type:'line',
                        smooth:true,
                        symbol: 'none',
                        sampling: 'average',
                        itemStyle: {
                            normal: {
                                color: '#ff643d'
                            }
                        },
                        mark:{show:true},
                        areaStyle: {
                            normal: {
                                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                    offset: 0,
                                    color: '#e9943e'
                                }, {
                                    offset: 1,
                                    color: '#ff643d'
                                }])
                            }
                        },
                        data: r.positive_index
                    },
                    {
                        name:'负面舆情',
                        type:'line',
                        smooth:true,
                        symbol: 'none',
                        sampling: 'average',
                        itemStyle: {
                            normal: {
                                color: '#35b7f0'
                            }
                        },
                        areaStyle: {
                            normal: {
                                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                    offset: 0,
                                    color: '#3591f0'
                                }, {
                                    offset: 1,
                                    color: '#35b7f0'
                                }])
                            }
                        },
                        data: r.negative_index
                    },
                    {
                        name:'舆情情感走势',
                        type:'line',
                        smooth:true,
                        symbol: 'none',
                        sampling: 'average',
                        itemStyle: {
                            normal: {
                                color: '#96cc48'
                            }
                        },
                        areaStyle: {
                            normal: {
                                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                    offset: 0,
                                    color: '#c4cc48'
                                }, {
                                    offset: 1,
                                    color: '#96cc48'
                                }])
                            }
                        },
                        data: r.sentiment_index
                    }
                ]
            };
            publicOpinionTrendIDChart.setOption(option);
        }
    });

}


//舆情声量走势分析
function getSlTrend(hours) {
    $.get('getSlTrend',{hours:hours},function (res) {
        if(res.code == 1){
            var r = res.data;
            var SLTrendIDChart = echarts.init(document.getElementById('SLTrendID'), 'westeros');
            SLTrendIDChart.clear();
            SLTrendIDChart.getOption();

            option = {
                tooltip: {
                    trigger: 'axis'
                },
                color: ["#FF0000", "#00BFFF", "#FF00FF", "#1ce322", "#0286de", '#EE7942'],
                legend: {
                    data: r.name
                    // data: ['新闻', '论坛', '微博', '博客', '微信', '全部']
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    data: r.s_date,
                    // data: ['2017/1/16','2017/1/17','2017/1/18','2017/1/19','2017/1/20','2017/1/23','2017/1/24','2017/1/25','2017/1/26','2017/2/3','2017/2/6','2017/2/7','2017/2/8','2017/2/9','2017/2/10分红30万','2017/2/13','2017/2/14','2017/2/15','2017/2/16','2017/2/17','2017/2/20','2017/2/21','2017/2/22','2017/2/23','2017/2/24','2017/2/27','2017/2/28','2017/3/1分红40万','2017/3/2','2017/3/3','2017/3/6','2017/3/7','2017/3/8','2017/3/9','2017/3/10','2017/3/13','2017/3/14','2017/3/15','2017/3/16','2017/3/17','2017/3/20','2017/3/21','2017/3/22','2017/3/23','2017/3/24','2017/3/27','2017/3/28','2017/3/29','2017/3/30',]
                },
                yAxis: [{
                    name: "万次",
                    type: 'value',
                    axisLabel: {
                        formatter: '{value} '
                    },
                    min: r.min,
                    max: r.max
                }],
                dataZoom: [{
                    type: 'inside',
                    start: 50,
                    end: 100
                }, {
                    show: true,
                    type: 'slider',
                    y: '90%',
                    start: 50,
                    end: 100
                }],
                series:r.list,
                // series: [{
                //     name: '新闻',
                //     type: 'line',
                //     lineStyle: {
                //         normal: {
                //             width: 2,
                //         }
                //     },
                //     data: [1,0.999640152,'0',0.991304479,1.00791442,1.015577654,1.008748035,1.015754465,1.022747704,1.016893643,1.030048136,1.025649791,1.03387254,1.041602688,1.013560119,1.021460948,1.021693316,1.014965612,1.015323078,1.007790707,1.011034404,1.023869485,1.026184226,1.029289754,1.034968142,1.030753965,1.033297364,1.005880007,1.001874395,1.006538838,1.018751113,1.024749662,1.018532109,1.014253021,1.012709638,1.016759492,1.01590511,1.016932148,1.027661566,1.024013947,1.025474615,1.024451769,1.017142543,1.015919229,1.018497738,1.016376915,1.016566398,1.010498552,0.983156315,]
                // }]
            };

            SLTrendIDChart.setOption(option);

        }
    });
}

//舆情来源构成
function getSourceStructure(hours) {
    $.get('getSourceStructure',{hours:hours},function (res) {
        if(res.code == 1 ){
            var r = res.data;
            var sourceStructureIDChart = echarts.init(document.getElementById('sourceStructureID'), 'westeros');
            option = {
                tooltip: {
                    trigger: 'item',
                    formatter: "{a}{b} <br/>数量： {c} <br/>占比： {d}%"
                },
                title: {
                    textStyle: {
                        fontSize: "14",
                        color: "#77a6ff"
                    }
                },
                legend: {
                    data: r.media_name,
                    // data: ['新闻', '博客', '微博', '负微信公众号面', '负论坛面'],
                    orient: 'vertical',
                    icon: 'circle',
                    left: '3%'
                },
                series: [
                    {
                        name: '舆情：',
                        type: 'pie',
                        radius: ['50%', '65%'],
                        center: ['50%', '50%'],
                        avoidLabelOverlap: true,
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
                        data: r.info
                        // data: [
                        //     {value: 123, name: '新闻'},
                        //     {value: 234, name: '博客'},
                        //     {value: 432, name: '微博'},
                        //     {value: 756, name: '负微信公众号面'},
                        //     {value: 245, name: '负论坛面'}
                        // ]
                    }
                ]
            };
            sourceStructureIDChart.setOption(option);

        }
    });
}

//舆情来源量媒体排行
function getMediaRanking(hours) {
    $.get('getMediaRanking',{hours:hours},function (res) {
        if(res.code == 1 ){
            var r =res.data;
            var html = '';
            // $('.keyAreaTop').empty();
            $('#getRanking').empty();
            $(r.data).each(function(i,item){
                // console.log(item);
                html += "<li><p><span>"+item.ranking +"</span>"+ item.site_name +"</p></li>";
            });
            $('#getRanking').append(html);

            var mediaRankingIDChart = echarts.init(document.getElementById('mediaRankingID'), 'westeros');

            option = {
                /* legend: {
                     bottom: 20,
                     textStyle:{
                         color:'#fff',
                     },
                     data: ['钥匙量', '有效房源量']
                 },*/
                grid: {
                    width:'90%',
                    right: '3%',
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
                        data: r.site_name.reverse()
                        // data: ['宝鸡信息网','中国旅游新闻网','搜狐网','百度','陕西新闻网','人民日报','新浪网','长城网','云南网','网易']
                    },
                    {
                        type: 'category',
                        axisLine: {show:false},
                        axisTick: {show:false},
                        axisLabel: {show:false},
                        splitArea: {show:false},
                        splitLine: {show:false},
                        data: r.site_name
                        // data: ['宝鸡信息网','中国旅游新闻网','搜狐网','百度','陕西新闻网','人民日报','新浪网','长城网','云南网','网易']
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
                        barCategoryGap:'50%',
                        data: r.value //[500, 500, 500, 500, 500, 500, 500, 500, 500, 500]
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
                                        '#4f8df3','#4f8df3','#4f8df3','#4f8df3','#4f8df3',
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
                        barCategoryGap:'50%',
                        data: r.value.reverse() //[32, 52, 56, 64, 76, 98, 109, 123, 210, 300]
                    }

                ]
            };
            mediaRankingIDChart.setOption(option);
        }
    });
}
