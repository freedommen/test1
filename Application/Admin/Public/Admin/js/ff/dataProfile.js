
$(function() {

//实时客流量

    var GZHTotalChart = echarts.init(document.getElementById('GZHTotal') , 'westeros');

    option = {
        grid: [
            {x: '18%', width: '72%'}
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
                name:'人数',
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
                itemStyle:{
                    normal:{
                        color:'#27a6fb',
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

    GZHTotalChart.setOption(option);


    //重点区域客流排行（实时）

    var GZHNewChart = echarts.init(document.getElementById('GZHNew') , 'westeros');

    option = {
        tooltip: {
            trigger: "axis"
        },
        grid: [
            {x: '18%', width: '72%'}
        ],
        calculable: true,
        xAxis: [
            {
                type: "category",
                boundaryGap: false,
                data: ["8:00", "9:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00"],
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
                name: "客流",
                type: "line",
                smooth: true,
                data: [40, 89, 126, 100, 187, 134, 124, 90, 60],
                itemStyle: {
                    normal: {
                        color: '#54b990'
                    }
                },
                markPoint: {
                    data: [
                        {type: 'max', name: '最大值'}
                    ]
                }
            }
        ]
    };

    GZHNewChart.setOption(option);



    //未来7天客流预测

    var klForecastChart = echarts.init(document.getElementById('klForecast') , 'westeros');

    option = {
        tooltip: {
            trigger: "axis"
        },
        grid: [
            {x: '18%', width: '72%'}
        ],
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
                name: "客流",
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
                data: [40, 89, 126, 100, 200, 134, 60],
                markPoint: {
                    data: [
                        {type: 'max', name: '最大值'}
                    ]
                }
            }
        ]
    };

    klForecastChart.setOption(option);




    //客源迁移数据
    var myChart = echarts.init(document.getElementById('kyqy'));
    var geoCoordMap = {
        '上海': [121.4648, 31.2891],
        '东莞': [113.8953, 22.901],
        '东营': [118.7073, 37.5513],
        '中山': [113.4229, 22.478],
        '临汾': [111.4783, 36.1615],
        '临沂': [118.3118, 35.2936],
        '丹东': [124.541, 40.4242],
        '丽水': [119.5642, 28.1854],
        '乌鲁木齐': [87.9236, 43.5883],
        '佛山': [112.8955, 23.1097],
        '保定': [115.0488, 39.0948],
        '兰州': [103.5901, 36.3043],
        '包头': [110.3467, 41.4899],
        '北京': [116.4551, 40.2539],
        '北海': [109.314, 21.6211],
        '南京': [118.8062, 31.9208],
        '南宁': [108.479, 23.1152],
        '南昌': [116.0046, 28.6633],
        '南通': [121.1023, 32.1625],
        '厦门': [118.1689, 24.6478],
        '台州': [121.1353, 28.6688],
        '合肥': [117.29, 32.0581],
        '呼和浩特': [111.4124, 40.4901],
        '咸阳': [108.4131, 34.8706],
        '哈尔滨': [127.9688, 45.368],
        '唐山': [118.4766, 39.6826],
        '嘉兴': [120.9155, 30.6354],
        '大同': [113.7854, 39.8035],
        '大连': [122.2229, 39.4409],
        '天津': [117.4219, 39.4189],
        '太原': [112.3352, 37.9413],
        '威海': [121.9482, 37.1393],
        '宁波': [121.5967, 29.6466],
        '宝鸡': [107.1826, 34.3433],
        '宿迁': [118.5535, 33.7775],
        '常州': [119.4543, 31.5582],
        '广州': [113.5107, 23.2196],
        '廊坊': [116.521, 39.0509],
        '延安': [109.1052, 36.4252],
        '张家口': [115.1477, 40.8527],
        '徐州': [117.5208, 34.3268],
        '德州': [116.6858, 37.2107],
        '惠州': [114.6204, 23.1647],
        '成都': [103.9526, 30.7617],
        '扬州': [119.4653, 32.8162],
        '承德': [117.5757, 41.4075],
        '拉萨': [91.1865, 30.1465],
        '无锡': [120.3442, 31.5527],
        '日照': [119.2786, 35.5023],
        '昆明': [102.9199, 25.4663],
        '杭州': [119.5313, 29.8773],
        "扶风": [107.908753,34.381225],
        '枣庄': [117.323, 34.8926],
        '柳州': [109.3799, 24.9774],
        '株洲': [113.5327, 27.0319],
        '武汉': [114.3896, 30.6628],
        '汕头': [117.1692, 23.3405],
        '江门': [112.6318, 22.1484],
        '沈阳': [123.1238, 42.1216],
        '沧州': [116.8286, 38.2104],
        '河源': [114.917, 23.9722],
        '泉州': [118.3228, 25.1147],
        '泰安': [117.0264, 36.0516],
        '泰州': [120.0586, 32.5525],
        '济南': [117.1582, 36.8701],
        '济宁': [116.8286, 35.3375],
        '海口': [110.3893, 19.8516],
        '淄博': [118.0371, 36.6064],
        '淮安': [118.927, 33.4039],
        '深圳': [114.5435, 22.5439],
        '清远': [112.9175, 24.3292],
        '温州': [120.498, 27.8119],
        '渭南': [109.7864, 35.0299],
        '湖州': [119.8608, 30.7782],
        '湘潭': [112.5439, 27.7075],
        '滨州': [117.8174, 37.4963],
        '潍坊': [119.0918, 36.524],
        '烟台': [120.7397, 37.5128],
        '玉溪': [101.9312, 23.8898],
        '珠海': [113.7305, 22.1155],
        '盐城': [120.2234, 33.5577],
        '盘锦': [121.9482, 41.0449],
        '石家庄': [114.4995, 38.1006],
        '福州': [119.4543, 25.9222],
        '秦皇岛': [119.2126, 40.0232],
        '绍兴': [120.564, 29.7565],
        '聊城': [115.9167, 36.4032],
        '肇庆': [112.1265, 23.5822],
        '舟山': [122.2559, 30.2234],
        '苏州': [120.6519, 31.3989],
        '莱芜': [117.6526, 36.2714],
        '菏泽': [115.6201, 35.2057],
        '营口': [122.4316, 40.4297],
        '葫芦岛': [120.1575, 40.578],
        '衡水': [115.8838, 37.7161],
        '衢州': [118.6853, 28.8666],
        '西宁': [101.4038, 36.8207],
        '西安': [109.1162, 34.2004],
        '贵阳': [106.6992, 26.7682],
        '连云港': [119.1248, 34.552],
        '邢台': [114.8071, 37.2821],
        '邯郸': [114.4775, 36.535],
        '郑州': [113.4668, 34.6234],
        '鄂尔多斯': [108.9734, 39.2487],
        '重庆': [107.7539, 30.1904],
        '金华': [120.0037, 29.1028],
        '铜川': [109.0393, 35.1947],
        '银川': [106.3586, 38.1775],
        '镇江': [119.4763, 31.9702],
        '长春': [125.8154, 44.2584],
        '长沙': [113.0823, 28.2568],
        '长治': [112.8625, 36.4746],
        '阳泉': [113.4778, 38.0951],
        '青岛': [120.4651, 36.3373],
        '韶关': [113.7964, 24.7028]
    };
    var myData = [];
    var BJData = [
        [{
            name: '上海',
            value: 80
        }, {
            name: '扶风'
        }],
        [{
            name: '广州',
            value: 70
        }, {
            name: '扶风'
        }],
        [{
            name: '哈尔滨',
            value: 30
        }, {
            name: '扶风'
        }],
        [{
            name: '青岛',
            value: 50
        }, {
            name: '扶风'
        }],
        [{
            name: '南昌',
            value: 20
        }, {
            name: '扶风'
        }],
        [{
            name: '银川',
            value: 10
        }, {
            name: '扶风'
        }],
        [{
            name: '拉萨',
            value: 80
        }, {
            name: '扶风'
        }],
        [{
            name: '乌鲁木齐',
            value: 90
        }, {
            name: '扶风'
        }]
    ];

    var convertData = function(data) {
        var res = [];
        for (var i = 0; i < data.length; i++) {
            var dataItem = data[i];
            var fromCoord = geoCoordMap[dataItem[0].name];
            var toCoord = geoCoordMap[dataItem[1].name];
            if (fromCoord && toCoord) {
                res.push([{
                    coord: fromCoord,
                    value: dataItem[0].value
                }, {
                    coord: toCoord,
                }]);
            }
        }
        return res;
    };

    // var color = ['#a6c84c', '#ffa022', '#46bee9'];
    var series = [];
    [
        ['扶风', BJData]
    ].forEach(function(item, i) {
        series.push(

            {
                type: 'lines',
                zlevel: 2,
                effect: {
                    show: true,
                    period: 4,
                    trailLength: 0.02,
                    symbol: 'arrow',
                    symbolSize: 5,
                },
                lineStyle: {
                    normal: {
                        width: 1,
                        opacity: 0.6,
                        curveness: 0.2
                    }
                },

                data: convertData(item[1])
            }, {
                type: 'effectScatter',
                coordinateSystem: 'geo',
                zlevel: 2,
                rippleEffect: {
                    period: 4,
                    brushType: 'stroke',
                    scale: 4
                },
                label: {
                    normal: {
                        show: true,
                        position: 'right',
                        offset: [5, 0],
                        formatter: '{b}'
                    },
                    emphasis: {
                        show: true
                    }
                },
                symbol: 'circle',
                symbolSize: function(val) {
                    return 4 + val[2] / 10;
                },
                itemStyle: {
                    normal: {
                        show: false,
                        color: '#00ffff'
                    }
                },
                data: item[1].map(function(dataItem) {
                    return {
                        name: dataItem[0].name,
                        value: geoCoordMap[dataItem[0].name].concat([dataItem[0].value])
                    };
                }),
            },
            //被攻击点
            {
                type: 'scatter',
                coordinateSystem: 'geo',
                zlevel: 2,
                rippleEffect: {
                    period: 4,
                    brushType: 'stroke',
                    scale: 8
                },
                label: {
                    normal: {
                        show: true,
                        // position: 'right',
                        //			                offset:[5, 0],

                        formatter: '{b}',
                        textStyle: {
                            color: "#fff"
                        }
                    },
                    emphasis: {
                        show: true
                    }
                },
                symbol: 'pin',
                symbolSize: 60,
                itemStyle: {
                    normal: {
                        show: true,
                        color: '#00ffff'
                    }
                },
                data: [{
                    name: item[0],
                    value: geoCoordMap[item[0]].concat([100]),
                }],
            }
        );
    });

    option3 = {
        visualMap: {
            left: '8',
            bottom: '40',
            min: 0,
            max: 100,
            calculable: true,
            color: ['#ff5400','#75e83c'],
            itemWidth: 8,
            itemHeight: 50,
            textStyle: {
                color: '#6da2f7'
            }
        },
        geo: {
            map: 'china',
            label: {
                emphasis: {
                    show: false
                }
            },
            roam: true,
            layoutCenter: ['50%', '40%'],
            layoutSize: "100%",
            itemStyle: {
                normal: {
                    color: 'rgba(23, 53, 116, .2)',
                    borderColor: 'rgba(100,149,237,1)'
                },
                emphasis: {
                    color: 'rgba(0, 16, 57, .9)'
                }
            }
        },

        series: series
    };
    myChart.setOption(option3);



//核心客源地TOP10（近一周）

    var coreSourceTop10Chart = echarts.init(document.getElementById('coreSourceTop10') , 'westeros');

    var saleDate=[
        {name:'北京',age:132},
        {name:'陕西',age:321},
        {name:'江苏',age:452},
        {name:'广东',age:190},
        {name:'湖南',age:176},
        {name:'湖北',age:376},
        {name:'辽宁',age:387},
        {name:'山东',age:176},
        {name:'四川',age:376},
        {name:'福建',age:387}
    ];
    //desc 倒序 asc 正序 固定写法 对 saleDate.age进行排序
    saleDate.sort(getSortFun('asc','age'));
    function getSortFun(order, sortBy) {
        var ordAlpah = (order == 'asc') ?'>' : '<';
        var sortFun = new Function('a', 'b', 'return a.'+ sortBy + ordAlpah + 'b.'+ sortBy + '?1:-1');
        return sortFun;
    }
    var datale=[], datale2=[];
    for(var i=0; i<saleDate.length; i++){
        datale.push(saleDate[i].name);
        datale2.push(saleDate[i].age)
    }

    option= {
        tooltip : {
            trigger: 'axis',
        },
        grid: {
            left: '5%',
            right: '4%',
            bottom: '3%',
            top:'5%',
            containLabel: true
        },
        yAxis : [
            {
                type : 'category',
                data : datale,
                textStyle:{
                    verticalAlign:'bottom',
                    lineHeight: 88
                },
                axisLabel: {
                    show: true,
                    margin: 35,
                    align: 'left',
                    color: '#6da2f7',
                    verticalAlign: 'middle',
                    // padding: [0, 0, 15, 0]
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
                type:'bar',
                barWidth: '20%',
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

    coreSourceTop10Chart.setOption(option);



    //游客性别占比

    var sexRatioChart = echarts.init(document.getElementById('sexRatio') , 'walden');


    var women = 'image://data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAACNElEQVRoge1Z0bGCMBC8EighkzRgB88SLMEyvPtKCXagJdCBdKAzCfqZ1wF24PtAFIVAiITwZtyZ/CHuJru5SwAICMNkYphMQv7H6DBMJprTTnEqtKCbFnRTnArNaTd7MTmjRZ34+1CcipzRIjbPVhgmky7ydRGzXAnFSfaRr4mQsfk2oDkaVwGa0zE23wacyd9HbL4N/HsBSmDmnAGBWWy+DeSC1q4CckHr2Hxb4bIKs5z9CobJRAtKOwSks6wB7zgLXGmBeyUwK1cF92eBq9i8rDBMJheGP0PGLFaiatyGbqG1ghavwbuTP3qTr1XlKCJGIR+rtRjSuDkXt6kavJzRYmzyjwI3xVlhVOtMbSWbdaq93p1sWSMmtZLNOorj1TCZKLZZOvudbZblCQ6vk1nJZp2qwg4VAFBV7Ams1LHrpI9nPAQAAGhL7zSalfqs83jOs50ObqU+6zxJ9N9I1Gb35WYimJVcrAMAkHPauu9A99nltH2ZqBBWapvVhnU+KGx1i9ispDgVXuQvbMP6rAMAoAUefAVogYf6u2w58m72NMdTp3UGBNcl0AAtx1KOJy/yAM8johKYvXt2aHBdAw1QZqqq7sFabZ/gugY6OEJ0pJPeWn8WXLdAB8MYwXUNdBAMuoUeOjia4AJsfcs4Aug3uIB7gNPq0upxedWsGV0zfWr8XlAa9fOTbzs9G3wFxMZXQGx8BcwBrgJi87RCd39eqkba/6ZIKA9AuG8/2+I1xAHlD4syumyld28JAAAAAElFTkSuQmCC';

    var men = 'image://data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAABwElEQVRoge2ZwbGCMBCGLeFPKrAEOniWYAmWQAl0gJddj1KCJdDB87zLTOxAO/AdFEcBFRQMz8k/s6fMwP9lQzZLJpMBhdQBqcOQ7+hdSB0sydqQ7i3r0bIeDenekqxHDwOS6Np4NQzpHiSRb5+NQurwyPwNxBgzYUmTZ+YvQZr49luTYXFtAQzJr2+/NbWe/XP49lvTvwcwrHnrJcSa+/ZbE0gWbQFAsvDtt1FtsjDK2S91rgWbBzVgM8oaUBW4mFuWzLDmp6xIBi7mvn3dCCQRWH96iU8eL8DFvEvRar8ziRs8S112mldjsB0KKzcd2vwFYuWmvQNYKpafArBULHsH6FJp3/8eBqgVXwlgWHNLmhjSXWeTpDtLmtx77kcAysbkleyUJpsaoQAQAAJAAAgAAaB3AMuSVV9Unt/fATh1b9VxyXoHAEl0a0C2ZX/7FkDqYFi2NxMzVIcGksiSJmCNr5vz+wCSNWWuukyQOoA1tqSJl7/X9wCw0hlWOnsG4F0BwLcCgG8FAN8KAL4VAHzrawHK8dEDgDWuGSTdlONN105gjX16rgmssSHdGdaDZcmuj9tIHc5XTgdDuuvT/B/L5uw/gnvI3QAAAABJRU5ErkJggg==';

    var maxData = 1000;

    option = {

        //性别
        xAxis: {
            show: false
            // max: maxData,
            // splitLine: {show: false},
            // offset: 10,
            // axisLine: {
            //     lineStyle: {
            //         color: '#999'
            //     }
            // },
            // axisLabel: {
            //     margin: 10
            // }
        },
        yAxis: {
            data: ['男', '女'],
            inverse: true,
            axisTick: {show: false},
            axisLine: {show: false},
            axisLabel: {
                margin: 10,
                textStyle: {
                    color: '#c1d1f3',
                    fontSize: 14
                }
            },
            splitLine: {           // 分隔线
                show: false
            }
        },
        grid: {
            width: '50%' ,
            top: 'center',
            height: 70,
            left: 40,
            right: 100
        },

        series: [

            //性别比例
            {
                // current data
                type: 'pictorialBar',
                symbolRepeat: 'fixed',
                symbolMargin: '50%',
                symbolClip: true,
                symbolSize: 20,
                symbolBoundingData: maxData,
                data: [{value: 891, symbol: men},{value: 120,symbol: women}],
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
                        position: 'right , bottom',
                        offset: [200, 8],
                        textStyle: {
                            color: '#c1d1f3',
                            fontSize: 14
                        }
                    }
                },
                animationDuration: 0,
                symbolRepeat: 'fixed',
                symbolMargin: '50%',
                symbolSize: 20,
                symbolBoundingData: maxData,
                data: [{value: 891, symbol: men},{value: 120,symbol: women}],
                z: 5
            }
        ]
    };
    sexRatioChart.setOption(option);


    //游客年龄占比

    var AgeRatioChart = echarts.init(document.getElementById('AgeRatio') , 'westeros');

    var dataAll = [389, 259, 262, 324, 232, 176];
    var yAxisData = ['17岁及以下','18-24岁','25-30岁','36-40岁','41-50岁','50岁以上'];
    var option = {

        grid: [
            {x: '20%', y: '10%', width: '70%', height: '70%'}
        ],
        tooltip: {
            trigger: 'axis',
            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                type : 'line'        // 默认为直线，可选为：'line' | 'shadow'
            },
            formatter: "{a}{b} <br/>数量： {c} <br/>占比： {d}%"
        },
        xAxis: [
            {
                gridIndex: 0,
                axisTick: {show:false},
                axisLabel: {show:false},
                splitLine: {show:false},
                axisLine: {show:false }}
        ],
        yAxis: [
            {
                gridIndex: 0,
                interval:0,
                data: yAxisData.reverse(),
                axisTick: {show:false},
                axisLabel: {show:true},
                splitLine: {show:false},
                axisLine: {
                    show:true,
                    lineStyle:
                        {
                        color:"#6173a3"
                        }
                    }
            }
        ],
        series: [

            {
                name: '游客年龄',
                type: 'bar',
                xAxisIndex: 0,
                yAxisIndex: 0,
                barWidth:'30%',
                itemStyle:{
                    normal:{
                        barBorderRadius:[0, 10, 10, 0],
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
                label:{
                    normal: {
                        barBorderRadius: [0, 30, 30, 0],
                        show:true,
                        position:"right",
                        textStyle:{
                            color: '#cedfff'
                        }
                    }
                    },
                data: dataAll.sort()
            }

        ]
    };

    AgeRatioChart.setOption(option);



//游客到访频次统计

    var visitTimesChart = echarts.init(document.getElementById('visitTimes') , 'westeros');

    option = {
        tooltip: {
            trigger: 'item',
            formatter: "{a}{b} <br/>数量： {c} <br/>占比： {d}%"
        },
        title:{
            textStyle: {
                fontSize: "14",
                color: "#77a6ff"
            }
        },
        legend: {
            data: ['1次', '2次', '>3次'],
            orient: 'vertical',
            left: '3%',
            icon: 'circle'
        },
        series: [
            {
                name: '游客到访：',
                type:'pie',
                radius: ['50%', '70%'],
                center: ['50%', '50%'],
                avoidLabelOverlap: false,
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
                    {value:335, name:'1次'},
                    {value:432, name:'2次'},
                    {value:120, name:'>3次'}
                ]
            }
        ]
    };
    visitTimesChart.setOption(option);


    //酒店平均价格监测

    var hotelAveragePriceChart = echarts.init(document.getElementById('hotelAveragePrice') , 'westeros');

    option = {
        grid: [
            {x: '12%', y: '25%', width: '75%', height: '60%'},
        ],
        tooltip: {
            trigger: "axis"
        },
        legend: {
            top:'4%',
            data: ['价格', '入住率'],
            icon: 'circle'
        },
        calculable: true,
        xAxis: [
            {
                type: "category",
                boundaryGap: false,
                data: ["10月", "11月", "12月", "1月", "2月", "3月"],
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
                name:'房价／元',
                type: "value",
                axisLine: {
                    show: true
                }
            },
            {
                name:'入住率',
                type: "value",
                axisLine: {
                    show: true
                },
                axisLabel: {
                    show: true,
                    interval: 'auto',
                    formatter: '{value}%'
                },
                min:0,
                max:100,
                interval:25

            }
        ],
        series: [
            {
                name: "价格",
                type: "line",
                smooth: true,
                data: [700, 500, 550, 678, 887, 334],
                markPoint: {
                    data: [
                        {type: 'max', name: '最大值'}
                    ]
                }
            },
            {
                name: "入住率",
                type: "line",
                smooth: true,
                yAxisIndex: 1,
                data: [60, 50, 75, 100, 47, 34],
                markPoint: {
                    data: [{
                        type: 'max', name: '最大值'
                    }]
                }
            }
            ]
    };

    hotelAveragePriceChart.setOption(option);



    //目的地舆情监测

    var publicOpinionChart = echarts.init(document.getElementById('publicOpinion') , 'westeros');

    option = {
        tooltip: {
            trigger: 'item',
            formatter: "{a}{b} <br/>数量： {c} <br/>占比： {d}%"
        },
        title:{
            textStyle: {
                fontSize: "14",
                color: "#77a6ff"
            }
        },
        legend: {
            data: ['正面', '中面', '负面'],
            orient: 'vertical',
            icon: 'circle',
            left: '3%'
        },
        series: [
            {
                name: '舆情：',
                type:'pie',
                radius: ['50%', '70%'],
                center: ['50%', '50%'],
                avoidLabelOverlap: false,
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
                    {value:335, name:'正面'},
                    {value:432, name:'中面'},
                    {value:120, name:'负面'}
                ]
            }
        ]
    };
    publicOpinionChart.setOption(option);


    //游客满意度

    var satisfactionChart = echarts.init(document.getElementById('satisfaction') , 'westeros');

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
            text: '游客满意度',
            subtext: '4.7分',
            x: 'center',
            y: '32%',
            textStyle: {
                fontWeight: 'normal',
                color: "#77a6ff",
                fontSize: 12
            },
            subtextStyle: {
                fontWeight: 'normal',
                color: "#edb053",
                fontSize: 24
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
                value: 4.7,
                name: '01',
                itemStyle: {
                    normal: {
                        color: {
                            colorStops:[{
                                offset: 0,
                                color: '#92e452'
                            }, {
                                offset: .8,
                                color: '#ec4317'
                            }],
                            globalCoord: false
                        },
                        shadowColor: {
                            colorStops:[{
                                offset: 0,
                                color: '#92e452'
                            }, {
                                offset: .8,
                                color: '#ec4317'
                            }],
                            globalCoord: false
                        },
                        shadowBlur: 10
                    }
                }
            }, {
                value: 0.3,
                name: 'invisible',
                itemStyle: placeHolderStyle
            }]
        }
        ]
    };

    satisfactionChart.setOption(option);


    //游客平均驻留时间分析

    var stayTimeChart = echarts.init(document.getElementById('stayTime') , 'westeros');

    option = {
        grid: [
            {x: '15%', y: '20%', width: '75%', height: '60%'}
        ],
        tooltip: {
            trigger: "axis"
        },
        calculable: true,
        xAxis: [
            {
                type: "category",
                boundaryGap: false,
                data: ["10月", "11月", "12月", "1月", "2月", "3月"],
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
                name:'时间／天',
                type: "value",
                axisLine: {
                    show: true
                }
            }
        ],
        series: [
            {
                name: "天数",
                type: "line",
                smooth: true,
                data: [2, 3, 2.5, 3, 2, 1],
                itemStyle: {
                    normal: {
                        color: '#992cee'
                    }
                }
                /*markPoint: {
                    data: [
                        {type: 'max', name: '最大值'}
                    ]
                }*/
            }
        ]
    };

    stayTimeChart.setOption(option);


});
