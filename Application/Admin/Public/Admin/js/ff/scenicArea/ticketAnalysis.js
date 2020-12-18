
$(function() {

//售票量统计

    var ticketCountChart = echarts.init(document.getElementById('ticketCount') , 'westeros');

    option = {
        legend:{
            data:['票量'],
            right:'0',
            icon:'circle'
        },
        grid: [
            {
                width:'85%',
                left:'10%'
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
                boundaryGap: true,
                axisLine: {
                    show: true
                },
                splitLine: {
                    "show": false
                },
                data: ['9.15','9.16','9.17','9.18','9.19','9.20','9.21']
            }
        ],
        yAxis: [
            {
                name:'单位：张',
                type: "value",
                axisLine: {
                    show: true
                }
            }
        ],
        series: [
            {
                name: "票量",
                type: "bar",
                barWidth:'40%',
                smooth: true,
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
                data: [1212, 4324, 5332, 7532, 2555, 3421, 8754]
            }
        ]
    };

    ticketCountChart.setOption(option);


    //提前购票天数统计

    var advanceDaysChart = echarts.init(document.getElementById('advanceDays') , 'westeros');

    option = {
        title: {
            text: '平均提前预定天数',
            subtext: '2天',
            textStyle:{
                fontSize: 14,
                fontWight:'normal',
                color: '#80a6f8'
            },
            subtextStyle:{
                fontSize: 20,
                color: '#eee'
            },
            top: '45%',
            left: '60%',
            textAlign: 'center'
        },
        tooltip: {
            trigger: 'item',
            formatter: "{b}<br/> 人数：{c} <br/> 占比：{d}%"
        },
        legend: {
            orient: 'vertical',
            x: '5%',
            y: 'top',
            icon: 'square',
            data:['0天','1天','2天','3天','>3天']
        },
        series: [
            {
                type:'pie',
                radius: ['50%', '70%'],
                center: ['60%', '50%'],
                avoidLabelOverlap: false,
                label: {
                    normal:{
                        formatter:'{b}\n{d}'
                    },
                    emphasis: {
                        show: true,
                        textStyle: {
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
                    {value:335, name:'0天'},
                    {value:310, name:'1天'},
                    {value:234, name:'2天'},
                    {value:135, name:'3天'},
                    {value:1548, name:'>3天'}
                ]
            }
        ]
    };

    advanceDaysChart.setOption(option);


    //票务预订来源统计

    var orderSourceChart = echarts.init(document.getElementById('orderSource') , 'westeros');

    option = {
        tooltip: {
            trigger: 'item',
            formatter: "{b}<br/> 票量：{c} <br/> 占比： {d}%"
        },
        legend: {
            orient: 'vertical',
            x: '5%',
            y: 'top',
            icon: 'square',
            data:['窗口或自助机','携程','美团','驴妈妈','其他']
        },
        series: [
            {
                name:'售票预定来源',
                type:'pie',
                // roseType: 'area',
                radius: ['50%', '70%'],
                center: ['60%', '50%'],
                avoidLabelOverlap: false,
                label: {
                    normal:{
                        formatter: '{b}\n{d}'
                    },
                    emphasis: {
                        show: true,
                        textStyle: {
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
                    {value:335, name:'窗口或自助机'},
                    {value:310, name:'携程'},
                    {value:234, name:'美团'},
                    {value:135, name:'驴妈妈'},
                    {value:89, name:'其他'}
                ]
            }
        ]
    };

    orderSourceChart.setOption(option);


    //售票类型统计占比

    var ticketTypeChart = echarts.init(document.getElementById('ticketType') , 'westeros');

    option = {
        tooltip: {
            trigger: 'item',
            formatter: "{a}：{b}<br/>占比：{d}%"
        },
        legend: {
            orient: 'vertical',
            x: '5%',
            y: 'top',
            icon: 'square',
            data:[ '散客票','团队票','活动票']
        },
        series: [
            {
                name:'售票类型',
                type:'pie',
                // roseType : 'area',
                radius: ['50%', '70%'],
                center: ['60%', '50%'],
                avoidLabelOverlap: false,
                label: {
                    normal: {
                        formatter: '{b}\n\n{d}%'
                    },
                    emphasis: {
                        show: true,
                        textStyle: {
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
                    {value:108, name:'散客票'},
                    {value:310, name:'团队票'},
                    {value:450, name:'活动票'}
                ]
            }
        ]
    };

    ticketTypeChart.setOption(option);


    //售票渠道线上线下占比

    var SalesChannelTFRtChart = echarts.init(document.getElementById('SalesChannelTFRt') , 'westeros');
    option = {
        tooltip: {
            trigger: 'item',
            formatter: "{a}{b} <br/>售票量 : {c} <br/>占比 : {d}%"
        },
        legend: {
            orient: 'vertical',
            x: '5%',
            y: 'top',
            icon: 'square',
            data:['OTA','自助机','窗口']
        },
        series: [
            {
                type:'pie',
                roseType: 'area',
                radius: ['40%', '70%'],
                center: ['60%', '50%'],
                avoidLabelOverlap: false,
                label: {
                    normal: {
                        formatter: '{b}\n\n{d}%'
                    },
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
                    {value:335, name:'OTA'},
                    {value:102, name:'自助机'},
                    {value:234, name:'窗口'}
                ]
            }
        ]
    };
    SalesChannelTFRtChart.setOption(option);



//支付方式统计分析

    var PayWayTFRtChart = echarts.init(document.getElementById('PayWayTFRt') , 'westeros');
    option = {
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            x: '5%',
            y: 'top',
            icon: 'square',
            data:['支付宝','微信','现金', '其他']
        },
        series: [
            {
                name:'支付方式',
                type:'pie',
                radius: ['40%', '70%'],
                center: ['60%', '50%'],
                avoidLabelOverlap: false,
                roseType: 'area',
                label: {
                    normal: {
                        formatter: '{b}\n\n{d}%'
                    },
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
                    {value:335, name:'支付宝'},
                    {value:310, name:'微信'},
                    {value:310, name:'现金'},
                    {value:234, name:'其他'}
                ]
            }
        ]
    };
    PayWayTFRtChart.setOption(option);

});
