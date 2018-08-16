//售票量统计
function getTicket(s_day) {
    $.get("getTicket",{s_day:s_day},function (res) {
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
                    data: res.ticket_num_date
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
                    data: res.ticket_num
                }
            ]
        };
        ticketCountChart.setOption(option);
    });
}

//提前购票天数统计
function getReservations(s_day) {
    $.get("getReservations",{s_day:s_day},function (res) {
        var advanceDaysChart = echarts.init(document.getElementById('advanceDays') , 'westeros');
        option = {
            title: {
                /*text: '平均提前预定天数',
                subtext: '2天',
                textStyle:{
                    fontSize: 14,
                    fontWight:'normal',
                    color: '#80a6f8'
                },*/
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
                    avoidLabelOverlap: true,
                    label: {
                        normal:{
                            formatter:'{b}\n{d}%'
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
                    data:res
                }
            ]
        };
        advanceDaysChart.setOption(option);
    });
}

//票务预订来源统计
function getSource(s_day) {
    $.get("getSource",{s_day:s_day},function (res) {
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
                    avoidLabelOverlap: true,
                    label: {
                        normal:{
                            formatter: '{b}\n{d}%'
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
                    data:res
                }
            ]
        };
        orderSourceChart.setOption(option);
    });
}

//售票类型统计占比
function getType(s_day) {
    $.get("getType",{s_day:s_day},function (res) {
        var ticketTypeChart = echarts.init(document.getElementById('ticketType') , 'westeros');
        option = {
            tooltip: {
                trigger: 'item',
                formatter: "{b}<br/> 票量：{c} <br/>占比：{d}%"
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
                    avoidLabelOverlap: true,
                    label: {
                        normal: {
                            formatter: '{b}\n{d}%'
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
                    data:res
                }
            ]
        };
        ticketTypeChart.setOption(option);
    });
}

//售票渠道线上线下占比
function getChannel(s_day) {
    $.get("getChannel",{s_day:s_day},function (res) {
        var SalesChannelTFRtChart = echarts.init(document.getElementById('SalesChannelTFRt') , 'westeros');
        option = {
            tooltip: {
                trigger: 'item',
                formatter: "{b} <br/>票量 : {c} <br/>占比 : {d}%"
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
                    avoidLabelOverlap: true,
                    label: {
                        normal: {
                            formatter: '{b}\n{d}%'
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
                    data:res
                }
            ]
        };
        SalesChannelTFRtChart.setOption(option);
    });
}

//支付方式统计分析
function getPay(s_day) {
    $.get("getPay",{s_day:s_day},function (res) {
        var PayWayTFRtChart = echarts.init(document.getElementById('PayWayTFRt') , 'westeros');
        option = {
            tooltip: {
                trigger: 'item',
                formatter: "{b}<br/> 数量：{c} <br/>占比：{d}%"
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
                    avoidLabelOverlap: true,
                    roseType: 'area',
                    label: {
                        normal: {
                            formatter: '{b}\n{d}%'
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
                    data:res
                }
            ]
        };
        PayWayTFRtChart.setOption(option);
    });
}
