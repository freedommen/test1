
$(function() {

    //游客支付方式统计分析

    var payWayChart = echarts.init(document.getElementById('payWay') , 'westeros');

    option = {
        legend: {
            x: 'right',
            y: 'top',
            icon: 'circle',
            data:['支付宝','银联卡','微信','财付通','现金']
        },
        tooltip: {
            trigger: 'item',
            formatter: "{a}： {b} <br/>占比： {d}%"
        },
        series: [
            {
                name: '支付方式',
                type:'pie',
                radius: [0, '60%'],
                center: ['50%', '55%'],
                avoidLabelOverlap: false,
                selectedMode: 'single',
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
                data:[
                    {value:453, name:'支付宝', selected:true},
                    {value:267, name:'银联卡'},
                    {value:389, name:'微信'},
                    {value:34, name:'财付通'},
                    {value:242, name:'现金'}
                ]
            }
        ]
    };

    payWayChart.setOption(option);


    //旅游消费统计分析

    var consumptionStatisticsChart = echarts.init(document.getElementById('consumptionStatistics') , 'westeros');

    option = {
        legend: {
            x: 'right',
            y: 'top',
            icon: 'circle',
            data:['3000以下','3001-6000','6001-8000','8001-10000','10001以上']
        },
        tooltip: {
            trigger: 'item',
            formatter: "{a}： {b} <br/>占比： {d}%"
        },
        series: [
            {
                name: '消费金额',
                type:'pie',
                radius: [0, '60%'],
                center: ['50%', '55%'],
                avoidLabelOverlap: false,
                selectedMode: 'single',
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
                data:[
                    {value:553, name:'3000以下', selected:true},
                    {value:342, name:'3001-6000'},
                    {value:234, name:'6001-8000'},
                    {value:123, name:'8001-10000'},
                    {value:89, name:'10001以上'}
                ]
            }
        ]
    };

    consumptionStatisticsChart.setOption(option);


    //消费分布统计分析

    var distributionStatisticsChart = echarts.init(document.getElementById('distributionStatistics') , 'westeros');

    option = {
        legend: {
            x: 'right',
            y: 'top',
            icon: 'circle',
            data:['景区','交通','购物','吃喝玩','其他']
        },
        tooltip: {
            trigger: 'item',
            formatter: "{a}： {b} <br/>占比： {d}%"
        },
        series: [
            {
                name: '消费分布',
                type:'pie',
                radius: [0, '60%'],
                center: ['50%', '55%'],
                avoidLabelOverlap: false,
                selectedMode: 'single',
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
                data:[
                    {value:325, name:'景区', selected:true},
                    {value:342, name:'交通'},
                    {value:423, name:'购物'},
                    {value:534, name:'吃喝玩'},
                    {value:312, name:'其他'}
                ]
            }
        ]
    };

    distributionStatisticsChart.setOption(option);



});
