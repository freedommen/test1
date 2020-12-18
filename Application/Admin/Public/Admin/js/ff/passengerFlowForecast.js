/**
 * 预测未来游客
 */
function getTouristFlow(days) {
    $.get('getFlow',{days:days},function (res) {
        //未来客流预测
        var klForecastChart = echarts.init(document.getElementById('klForecast') , 'westeros');
        klForecastChart.clear();
        klForecastChart.getOption();
        var option = '';
        if(res.code == 1){
            var r = res.data;
            option = {
                tooltip: {
                    trigger: "axis"
                },
                grid: [
                    {x: '15%', y: '15%', width: '76%', height: '75%'}
                ],
                calculable: true,
                xAxis: [
                    {
                        type: "category",
                        boundaryGap: false,
                        data: r.date,
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
                        name:'人数',
                        type: "value",
                        axisLine: {
                            show: true
                        }
                    }
                ],
                series: [
                    {
                        name: "预测客流",
                        type: "line",
                        smooth: true,
                        data: r.user_num,
                        // data: [40, 89, 126, 100, 187, 134, 124, 90, 60],
                        markPoint: {
                            data: [
                                {type: 'max', name: '最大值'}
                            ]
                        }
                    }
                ]
            };

        }
        klForecastChart.setOption(option);
    })

}

function getCarFlow(days) {
    $.get('getFlow',{days:days},function (res) {
        //未来车流预测
        var carForecastChart = echarts.init(document.getElementById('carForecast') , 'westeros');
        carForecastChart.clear();
        carForecastChart.getOption();
        var option = '';
        if(res.code == 1){
            var r = res.data;
            option = {
                tooltip: {
                    trigger: "axis"
                },
                grid: [
                    {x: '15%', y: '15%', width: '76%', height: '75%'}
                ],
                calculable: true,
                xAxis: [
                    {
                        type: "category",
                        boundaryGap: false,
                        data: r.date,
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
                        name:'人数',
                        type: "value",
                        axisLine: {
                            show: true
                        }
                    }
                ],
                series: [
                    {
                        name: "预测车流",
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
                        data: r.car_num,
                        // data: [40, 89, 126, 100, 187, 134, 124, 90, 60],
                        markPoint: {
                            data: [
                                {type: 'max', name: '最大值'}
                            ]
                        }
                    }
                ]
            };
        }
        carForecastChart.setOption(option);
    })
}

// 游客客源地预测
function getSourceArea(days) {
    $.get('getSourceArea',{days:days},function (res) {
        //客源地省份预测TOP1
        var provinceTop10Chart = echarts.init(document.getElementById('provinceTop10') , 'westeros');
       //省
        provinceTop10Chart.clear();
        // provinceTop10Chart.getOption();
        //市
        var cityTop10Chart = echarts.init(document.getElementById('cityTop10') , 'westeros');
        cityTop10Chart.clear();
        //省对比
        var provinceAnalysisChart = echarts.init(document.getElementById('provinceAnalysis') , 'westeros');
        provinceAnalysisChart.clear();
        var option = '';
        if(res.code == 1){
            var r =res.data;
            // var saleDate=[
            //     {name:'北京',age:132},
            //     {name:'陕西',age:321},
            //     {name:'江苏',age:452},
            //     {name:'广东',age:190},
            //     {name:'内蒙古',age:176},
            //     {name:'湖北',age:376},
            //     {name:'辽宁',age:387},
            //     {name:'山东',age:176},
            //     {name:'四川',age:376},
            //     {name:'福建',age:387}
            // ];
            var saleDate = r.province;
            //desc 倒序 asc 正序 固定写法 对 saleDate.age进行排序
            saleDate.sort(getSortFun('asc','value'));
            function getSortFun(order, sortBy) {
                var ordAlpah = (order == 'asc') ?'>' : '<';
                var sortFun = new Function('a', 'b', 'return a.'+ sortBy + ordAlpah + 'b.'+ sortBy + '?1:-1');
                return sortFun;
            }
            var datale=[], datale2=[];
            for(var i=0; i<saleDate.length; i++){
                datale.push(saleDate[i].name);
                datale2.push(saleDate[i].value)
            }
            option= {
                tooltip : {
                    trigger: 'axis',
                },
                title:{
                    text: '客源地省份预测TOP10',
                    textStyle: {
                        fontSize: "12",
                        color: "#77a6ff"
                    }
                },
                grid: {
                    left: '3%',
                    bottom: '1%',
                    containLabel: true
                },
                yAxis : [
                    {
                        type : 'category',
                        data : datale,
                        textStyle:{
                            verticalAlign:'bottom',
                            lineHeight: 88,
                        },
                        axisLabel: {
                            show: true,
                            margin: 12,
                            color: '#6da2f7',
                            verticalAlign: 'middle',
                            textAlign: 'right'
                        },
                        axisTick: {
                            show:false,
                            alignWithLabel: true
                        },
                        axisLine:{
                            show:false
                        },
                        splitLine: {
                            "show": false
                        }
                    }
                ],
                xAxis : [
                    {
                        type : 'value',
                        show:false
                    }
                ],
                series : [
                    {
                        name:'预测客流量',
                        type:'bar',
                        barWidth: '25%',
                        itemStyle:{
                            normal:{
                                barBorderRadius:[5],
                                color: {
                                    type: 'bar',
                                    colorStops:[{
                                        offset: 0,
                                        color: '#0286de'
                                    }, {
                                        offset: .8,
                                        color: '#992cee'
                                    }],
                                    globalCoord: false
                                }
                            }
                        },
                        label: {
                            normal: {
                                show: true,
                                position:  "right",
                                textStyle:{
                                    color: '#cedfff'
                                }
                            }
                        },
                        data:datale2
                    }
                ]
            };
            provinceTop10Chart.setOption(option);

            //客源地城市预测TOP10
            var cityTop10Chart = echarts.init(document.getElementById('cityTop10') , 'westeros');
            // var saleDate=[
            //     {name:'城市名',age:132},
            //     {name:'城市名称',age:321},
            //     {name:'城市名称',age:452},
            //     {name:'城市名称',age:190},
            //     {name:'城市名称',age:176},
            //     {name:'城市名称',age:376},
            //     {name:'城市名称',age:387},
            //     {name:'城市名称',age:176},
            //     {name:'城市名称',age:376},
            //     {name:'城市名称',age:387}
            // ];
            var saleDate = r.city;
            // //desc 倒序 asc 正序 固定写法 对 saleDate.age进行排序
            saleDate.sort(getSortFun('asc','value'));
            function getSortFun(order, sortBy) {
                var ordAlpah = (order == 'asc') ?'>' : '<';
                var sortFun = new Function('a', 'b', 'return a.'+ sortBy + ordAlpah + 'b.'+ sortBy + '?1:1');
                return sortFun;
            }
            var datale=[], datale2=[];
            for(var i=0; i<saleDate.length; i++){
                datale.push(saleDate[i].name);
                datale2.push(saleDate[i].value)
            }
            option= {
                tooltip : {
                    trigger: 'axis',
                },
                title:{
                    text: '客源地城市预测TOP10',
                    textStyle: {
                        fontSize: "12",
                        color: "#77a6ff"
                    }
                },
                grid: {
                    left: '3%',
                    bottom: '1%',
                    containLabel: true
                },
                yAxis : [
                    {
                        type : 'category',
                        data : datale,
                        textStyle:{
                            verticalAlign:'bottom',
                            lineHeight: 88,
                        },
                        axisLabel: {
                            show: true,
                            margin: 12,
                            color: '#6da2f7',
                            verticalAlign: 'middle',
                            textAlign: 'right'
                        },
                        axisTick: {
                            show:false,
                            alignWithLabel: true
                        },
                        axisLine:{
                            show:false
                        },
                        splitLine: {
                            "show": false
                        }
                    }
                ],
                xAxis : [
                    {
                        type : 'value',
                        show:false
                    }
                ],
                series : [
                    {
                        name:'预测客流量',
                        type:'bar',
                        barWidth: '25%',
                        itemStyle:{
                            normal:{
                                barBorderRadius:[5],
                                color: {
                                    type: 'bar',
                                    colorStops:[{
                                        offset: 0,
                                        color: '#0286de'
                                    }, {
                                        offset: .8,
                                        color: '#992cee'
                                    }],
                                    globalCoord: false
                                }
                            }
                        },

                        label: {
                            normal: {
                                show: true,
                                position:  "right",
                                textStyle:{
                                    color: '#cedfff'
                                }
                            }
                        },
                        data:datale2
                    }
                ]
            };
            cityTop10Chart.setOption(option);

            //外省与本省客源预测
            var provinceAnalysisChart = echarts.init(document.getElementById('provinceAnalysis') , 'westeros');
            option = {
                tooltip: {
                    trigger: 'item',
                    formatter: "{a}{b} <br/>预测客流： {c} <br/>占比： {d}%"
                },
                title:{
                    text: '外省与本省客源预测',
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
                                formatter: '{b}\n\n{d}%'
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
        provinceTop10Chart.setOption('');
        cityTop10Chart.setOption('');
        provinceAnalysisChart.setOption('');
    })
}
