
$(function() {

//车辆实时监控数据

    var carMonitorChart = echarts.init(document.getElementById('carMonitor') , 'westeros');

    option = {
        grid: [
            {
                width:'90%',
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
                boundaryGap: false,
                axisLine: {
                    show: true
                },
                splitLine: {
                    "show": false
                },
                data: ["8:00", "9:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00"]
            }
        ],
        yAxis: [
            {
                name:'单位：辆',
                type: "value",
                axisLine: {
                    show: true
                }
            }
        ],
        series: [
            {
                name: "实时车辆",
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
                data: [40, 89, 126, 100, 187, 134, 124, 90, 60],
                markPoint: {
                    data: [
                        {type: 'max', name: '最大值'}
                    ]
                }
            }
        ]
    };

    carMonitorChart.setOption(option);


    //车辆类型占比

    var carTypeChart = echarts.init(document.getElementById('carType') , 'westeros');

    option = {
        tooltip: {
            trigger: 'item',
            formatter: "{b}<br/> 车辆数：{c} <br/> 占比：{d}%"
        },
        legend: {
            orient: 'vertical',
            x: '5%',
            y: 'bottom',
            icon: 'square',
            data:['5座小车','大巴车辆','中巴车辆']
        },
        series: [
            {
                type:'pie',
                roseType:'area',
                radius: ['0', '40%'],
                center: ['50%', '40%'],
                avoidLabelOverlap: false,
                label: {
                    normal:{
                        formatter:'{b}\n\n{d}'
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
                    {value:6472, name:'5座小车'},
                    {value:4533, name:'大巴车辆'},
                    {value:3124, name:'中巴车辆'}
                ]
            }
        ]
    };

    carTypeChart.setOption(option);


    //车辆来源省份TOP10统计（外省）

    var carSourceOtherProvincesChart = echarts.init(document.getElementById('carSourceOtherProvinces') , 'westeros');


    var data = [
        {name: '海南', value: 9},
        {name: '山东', value: 12},
        {name: '河南', value: 12},
        {name: '重庆', value: 14},
        {name: '四川', value: 15},
        {name: '北京', value: 19},
        {name: '广西', value: 24},
        {name: '西藏', value: 25},
        {name: '天津', value: 26},
        {name: '上海', value: 27},
        {name: '浙江', value: 38},
        {name: '福建', value: 54}
    ];

    var geoCoordMap = {
        '海门':[121.15,31.89],
        '鄂尔多斯':[109.781327,39.608266],
        '招远':[120.38,37.35],
        '舟山':[122.207216,29.985295],
        '齐齐哈尔':[123.97,47.33],
        '盐城':[120.13,33.38],
        '赤峰':[118.87,42.28],
        '青岛':[120.33,36.07],
        '乳山':[121.52,36.89],
        '金昌':[102.188043,38.520089],
        '泉州':[118.58,24.93],
        '莱西':[120.53,36.86],
        '日照':[119.46,35.42],
        '胶南':[119.97,35.88],
        '南通':[121.05,32.08],
        '拉萨':[91.11,29.97],
        '云浮':[112.02,22.93],
        '梅州':[116.1,24.55],
        '文登':[122.05,37.2],
        '上海':[121.48,31.22],
        '攀枝花':[101.718637,26.582347],
        '威海':[122.1,37.5],
        '承德':[117.93,40.97],
        '厦门':[118.1,24.46],
        '汕尾':[115.375279,22.786211],
        '潮州':[116.63,23.68],
        '丹东':[124.37,40.13],
        '太仓':[121.1,31.45],
        '曲靖':[103.79,25.51],
        '烟台':[121.39,37.52],
        '福州':[119.3,26.08],
        '瓦房店':[121.979603,39.627114],
        '即墨':[120.45,36.38],
        '抚顺':[123.97,41.97],
        '玉溪':[102.52,24.35],
        '张家口':[114.87,40.82],
        '阳泉':[113.57,37.85],
        '莱州':[119.942327,37.177017],
        '湖州':[120.1,30.86],
        '汕头':[116.69,23.39],
        '昆山':[120.95,31.39],
        '宁波':[121.56,29.86],
        '湛江':[110.359377,21.270708],
        '揭阳':[116.35,23.55],
        '荣成':[122.41,37.16],
        '连云港':[119.16,34.59],
        '葫芦岛':[120.836932,40.711052],
        '常熟':[120.74,31.64],
        '东莞':[113.75,23.04],
        '河源':[114.68,23.73],
        '淮安':[119.15,33.5],
        '泰州':[119.9,32.49],
        '南宁':[108.33,22.84],
        '营口':[122.18,40.65],
        '惠州':[114.4,23.09],
        '江阴':[120.26,31.91],
        '蓬莱':[120.75,37.8],
        '韶关':[113.62,24.84],
        '嘉峪关':[98.289152,39.77313],
        '广州':[113.23,23.16],
        '延安':[109.47,36.6],
        '太原':[112.53,37.87],
        '清远':[113.01,23.7],
        '中山':[113.38,22.52],
        '昆明':[102.73,25.04],
        '寿光':[118.73,36.86],
        '盘锦':[122.070714,41.119997],
        '长治':[113.08,36.18],
        '深圳':[114.07,22.62],
        '珠海':[113.52,22.3],
        '宿迁':[118.3,33.96],
        '咸阳':[108.72,34.36],
        '铜川':[109.11,35.09],
        '平度':[119.97,36.77],
        '佛山':[113.11,23.05],
        '海口':[110.35,20.02],
        '江门':[113.06,22.61],
        '章丘':[117.53,36.72],
        '肇庆':[112.44,23.05],
        '大连':[121.62,38.92],
        '临汾':[111.5,36.08],
        '吴江':[120.63,31.16],
        '石嘴山':[106.39,39.04],
        '沈阳':[123.38,41.8],
        '苏州':[120.62,31.32],
        '茂名':[110.88,21.68],
        '嘉兴':[120.76,30.77],
        '长春':[125.35,43.88],
        '胶州':[120.03336,36.264622],
        '银川':[106.27,38.47],
        '张家港':[120.555821,31.875428],
        '三门峡':[111.19,34.76],
        '锦州':[121.15,41.13],
        '南昌':[115.89,28.68],
        '柳州':[109.4,24.33],
        '三亚':[109.511909,18.252847],
        '自贡':[104.778442,29.33903],
        '吉林':[126.57,43.87],
        '阳江':[111.95,21.85],
        '泸州':[105.39,28.91],
        '西宁':[101.74,36.56],
        '宜宾':[104.56,29.77],
        '呼和浩特':[111.65,40.82],
        '成都':[104.06,30.67],
        '大同':[113.3,40.12],
        '镇江':[119.44,32.2],
        '桂林':[110.28,25.29],
        '张家界':[110.479191,29.117096],
        '宜兴':[119.82,31.36],
        '北海':[109.12,21.49],
        '西安':[108.95,34.27],
        '金坛':[119.56,31.74],
        '东营':[118.49,37.46],
        '牡丹江':[129.58,44.6],
        '遵义':[106.9,27.7],
        '绍兴':[120.58,30.01],
        '扬州':[119.42,32.39],
        '常州':[119.95,31.79],
        '潍坊':[119.1,36.62],
        '重庆':[106.54,29.59],
        '台州':[121.420757,28.656386],
        '南京':[118.78,32.04],
        '滨州':[118.03,37.36],
        '贵阳':[106.71,26.57],
        '无锡':[120.29,31.59],
        '本溪':[123.73,41.3],
        '克拉玛依':[84.77,45.59],
        '渭南':[109.5,34.52],
        '马鞍山':[118.48,31.56],
        '宝鸡':[107.15,34.38],
        '焦作':[113.21,35.24],
        '句容':[119.16,31.95],
        '北京':[116.46,39.92],
        '徐州':[117.2,34.26],
        '衡水':[115.72,37.72],
        '包头':[110,40.58],
        '绵阳':[104.73,31.48],
        '乌鲁木齐':[87.68,43.77],
        '枣庄':[117.57,34.86],
        '杭州':[120.19,30.26],
        '淄博':[118.05,36.78],
        '鞍山':[122.85,41.12],
        '溧阳':[119.48,31.43],
        '库尔勒':[86.06,41.68],
        '安阳':[114.35,36.1],
        '开封':[114.35,34.79],
        '济南':[117,36.65],
        '德阳':[104.37,31.13],
        '温州':[120.65,28.01],
        '九江':[115.97,29.71],
        '邯郸':[114.47,36.6],
        '临安':[119.72,30.23],
        '兰州':[103.73,36.03],
        '沧州':[116.83,38.33],
        '临沂':[118.35,35.05],
        '南充':[106.110698,30.837793],
        '天津':[117.2,39.13],
        '富阳':[119.95,30.07],
        '泰安':[117.13,36.18],
        '诸暨':[120.23,29.71],
        '郑州':[113.65,34.76],
        '哈尔滨':[126.63,45.75],
        '聊城':[115.97,36.45],
        '芜湖':[118.38,31.33],
        '唐山':[118.02,39.63],
        '平顶山':[113.29,33.75],
        '邢台':[114.48,37.05],
        '德州':[116.29,37.45],
        '济宁':[116.59,35.38],
        '荆州':[112.239741,30.335165],
        '宜昌':[111.3,30.7],
        '义乌':[120.06,29.32],
        '丽水':[119.92,28.45],
        '洛阳':[112.44,34.7],
        '秦皇岛':[119.57,39.95],
        '株洲':[113.16,27.83],
        '石家庄':[114.48,38.03],
        '莱芜':[117.67,36.19],
        '常德':[111.69,29.05],
        '保定':[115.48,38.85],
        '湘潭':[112.91,27.87],
        '金华':[119.64,29.12],
        '岳阳':[113.09,29.37],
        '长沙':[113,28.21],
        '衢州':[118.88,28.97],
        '廊坊':[116.7,39.53],
        '菏泽':[115.480656,35.23375],
        '合肥':[117.27,31.86],
        '武汉':[114.31,30.52],
        '大庆':[125.03,46.58]
    };

    function convertData(data) {
        var res = [];
        for (var i = 0; i < data.length; i++) {
            var geoCoord = geoCoordMap[data[i].name];
            if (geoCoord) {
                res.push({
                    name: data[i].name,
                    value: geoCoord.concat(data[i].value)
                });
            }
        }
        return res;
    };

    function randomValue() {
        return Math.round(Math.random()*1000);
    }


    option = {
        //tooltip: {},
        visualMap: {
            min: 0,
            max: 1500,
            left: '2%',
            top: '2%',
            text: ['High','Low'],
            textStyle: {
                color: '#3986d8'
            },
            seriesIndex: [1],
            inRange: {
                color: ['#7fe1ef', '#0286de']
            },
            calculable : true,
            itemWidth: 8,
            itemHeight: 50
        },
        geo: {
            width: '40%',
            left: '10%',
            map: 'china',
            roam: true,
            label: {
                normal: {
                    show: true,
                    textStyle: {
                        color: 'rgba(0,0,0,0.4)'
                    }
                }
            },
            itemStyle: {
                normal:{
                    borderColor: 'rgba(0, 0, 0, 0.2)'
                },
                emphasis:{
                    areaColor: null,
                    shadowOffsetX: 0,
                    shadowOffsetY: 0,
                    shadowBlur: 20,
                    borderWidth: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        },

        //排行
        tooltip: {
            trigger: 'axis',
            formatter: "{a}{b} <br/> 车流： {c} <br/> 占比： {d}%",
            axisPointer: {
                type: 'shadow'
            }
        },
        legend: {
            x: 'right',
            y: 'top',
            icon: 'circle',
            data: ['车流量']
        },
        grid: {
            width: '35%' ,
            left: '60%',
            right: '2%',
            bottom: '2%',
            containLabel: true
        },
        xAxis: {
            show: false
            // type: 'value',
            // boundaryGap: [0, 0.01]
        },
        yAxis: {
            splitLine: {           // 分隔线
                show: false
            },
            axisLine: {show: false},
            inverse: false,
            axisTick: {show: false},
            color: '#666',
            data: ['省份1','省份2','省份3','省份4','省份5','省份6','省份7','省份8','省份9','省份10']
        },

        series : [
            {
                type: 'scatter',
                coordinateSystem: 'geo',
                itemStyle: {
                    show:false,
                    normal: {
                        color: '#F06C00'
                    }
                }
            },
            {
                name: 'categoryA',
                type: 'map',
                geoIndex: 0,
                // tooltip: {show: false},
                data:[
                    {name: '北京', value: randomValue()},
                    {name: '天津', value: randomValue()},
                    {name: '上海', value: randomValue()},
                    {name: '重庆', value: randomValue()},
                    {name: '河北', value: randomValue()},
                    {name: '河南', value: randomValue()},
                    {name: '云南', value: randomValue()},
                    {name: '辽宁', value: randomValue()},
                    {name: '黑龙江', value: randomValue()},
                    {name: '湖南', value: randomValue()},
                    {name: '安徽', value: randomValue()},
                    {name: '山东', value: randomValue()},
                    {name: '新疆', value: randomValue()},
                    {name: '江苏', value: randomValue()},
                    {name: '浙江', value: randomValue()},
                    {name: '江西', value: randomValue()},
                    {name: '湖北', value: randomValue()},
                    {name: '广西', value: randomValue()},
                    {name: '甘肃', value: randomValue()},
                    {name: '山西', value: randomValue()},
                    {name: '内蒙古', value: randomValue()},
                    {name: '陕西', value: randomValue()},
                    {name: '吉林', value: randomValue()},
                    {name: '福建', value: randomValue()},
                    {name: '贵州', value: randomValue()},
                    {name: '广东', value: randomValue()},
                    {name: '青海', value: randomValue()},
                    {name: '西藏', value: randomValue()},
                    {name: '四川', value: randomValue()},
                    {name: '宁夏', value: randomValue()},
                    {name: '海南', value: randomValue()},
                    {name: '台湾', value: randomValue()},
                    {name: '香港', value: randomValue()},
                    {name: '澳门', value: randomValue()}
                ]
            },
            //排行
            {
                width: '40%',
                name: '车流量',
                type: 'bar',
                barWidth: '30%',
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
                        formatter: "{d}%",
                        show: true,
                        textStyle:{
                            color:'#ddd'
                        },
                        position:  "right"
                    }
                },
                data: [407, 541, 607, 641, 794, 800, 843, 935, 978, 1020]
            }
        ]
    };

    carSourceOtherProvincesChart.setOption(option);



    //车辆来源地城市分布（本省）

    var carSourceThisProvinceChart = echarts.init(document.getElementById('carSourceThisProvince') , 'westeros');

    option = {
        tooltip: {
            trigger: 'item',
            formatter: "{a}{b} <br/> 车流： {c} <br/> 占比： {d}%"
        },
        legend: {
            orient: 'vertical',
            x: '2%',
            y: 'top',
            icon: 'square',
            data:['城市1','城市2','城市3','城市4','城市5']
        },
        series: [
            {
                type:'pie',
                radius: ['40%', '60%'],
                center: ['60%', '50%'],
                avoidLabelOverlap: false,
                label: {
                    normal:{
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
                data:[
                    {value:335, name:'城市1'},
                    {value:310, name:'城市2'},
                    {value:234, name:'城市3'},
                    {value:123, name:'城市4'},
                    {value:432, name:'城市5'}
                ]
            }
        ]
    };
    carSourceThisProvinceChart.setOption(option);


    //外省与本省车流统计分析

    var carProvinceAnalysisChart = echarts.init(document.getElementById('carProvinceAnalysis') , 'westeros');

    option = {
        tooltip: {
            trigger: 'item',
            formatter: "{a}{b} <br/>车辆数： {c} <br/>占比： {d}%"
        },
        legend: {
            orient: 'vertical',
            x: '2%',
            y: 'top',
            icon: 'square',
            data:['外省','本省']
        },
        series: [
            {
                type:'pie',
                radius: ['40%', '60%'],
                center: ['60%', '50%'],
                avoidLabelOverlap: false,
                label: {
                    normal:{
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
                    {value:335, name:'外省'},
                    {value:432, name:'本省'}
                ]
            }
        ]
    };
    carProvinceAnalysisChart.setOption(option);


    //车辆停留时长统计

    var carStayTimeChart = echarts.init(document.getElementById('carStayTime') , 'westeros');

    option = {
        title: {
            text: '平均停留时长',
            subtext: '2.1H',
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
            formatter: "{a}{b} <br/>客流： {c} <br/>占比： {d}%"
        },
        legend: {
            orient: 'vertical',
            x: '2%',
            y: 'top',
            icon: 'square',
            data:['<0.5H', '0.5-1H', '1-2H' ,'2-3H', '>3H']
        },
        series: [
            {
                name:'平均停留时长',
                type:'pie',
                radius: ['40%', '60%'],
                center: ['60%', '50%'],
                avoidLabelOverlap: false,
                label: {
                    normal:{
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
                data:[
                    {value:335, name:'<0.5H'},
                    {value:310, name:'0.5-1H'},
                    {value:310, name:'1-2H'},
                    {value:310, name:'2-3H'},
                    {value:234, name:'>3H'}
                ]
            }
        ]
    };
    carStayTimeChart.setOption(option);


    //车流量TOP10景区
    var carTOP10ScenicChart = echarts.init(document.getElementById('carTOP10Scenic') , 'westeros');

    option = {
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
                data : ['景区名称显示区域', '景区名称显示区域', '景区名称显示区域', '景区名称显示区域', '景区名称显示区域', '景区名称显示区域', '景区名称显示区域', '景区名称显示区域', '景区名称显示区域', '景区名称显示区域'],
                axisTick: {
                    alignWithLabel: true
                },
                axisLabel: {rotate: 50, interval: 0}
            }
        ],
        yAxis : [
            {
                name:'单位：辆',
                type : 'value'
            }
        ],
        series : [
            {
                name:'车流',
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
    carTOP10ScenicChart.setOption(option);

});
