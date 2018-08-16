
//日历js
$(document).ready(function() {

    // $("#enddate").datetimepicker({
    //     language : 'zh-CN',
    //     format : "yyyy-mm-dd",
    //     sideBySide: true,
    //     // autoclose : true,
    //     // todayBtn : true,
    //     // pickerPosition : "bottom-left",
    //     minView : 2			//最精准的时间选择为日期0-分 1-时 2-日 3-月
    // });
    //
    // $("#enddate").datetimepicker({
    //     language : 'zh-CN',
    //     format : "yyyy-mm-dd",
    //     autoclose : true,
    //     todayBtn : true,
    //     pickerPosition : "bottom-left",
    //     minView : 2
    // });

    $('#adddate').daterangepicker({
            startDate: moment().startOf('day'),
            endDate: moment(),
            minDate: '2016-01-01',    //最小时间  =====>>格式要跟格式化的样式一致
            endDate : moment(), //最大时间
            //dateLimit : {days : 30}, //起止时间的最大间隔
            showDropdowns : true,
            showWeekNumbers : false, //是否显示第几周
            timePicker : false, //是否显示小时和分钟
            timePickerIncrement : 60, //时间的增量，单位为分钟
            timePicker12Hour : false, //是否使用12小时制来显示时间
            ranges : {
                '昨日' : [
                    moment().subtract('days', 1).startOf('day'),
                    moment().subtract('days', 1).endOf('day') ],
                '今日' : [ moment(), moment() ],
                '上周' : [ moment().startOf('week').day(-6).format('MM-DD-YYYY'),moment().endOf('week').day(0).format('MM-DD-YYYY') ],
                '本周' : [ moment().isoWeekday(1).format('MM-DD-YYYY'), moment().isoWeekday(7).format('MM-DD-YYYY') ],
                '上月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                '本月': [moment().startOf('month'), moment().endOf('month')],
                '去年': [moment().subtract(1, "years").startOf('year'), moment().subtract(1, "years").endOf('year').format('MM-DD-YYYY') ],
                '本年': [moment().startOf('year').format('MM-DD-YYYY'), moment().endOf('year').format('MM-DD-YYYY')],
                '最近7日' : [ moment().subtract('days', 6),
                    moment() ],
                '最近30日' : [ moment().subtract('days', 29),
                    moment() ],
            },
            opens : 'right', //日期选择框的弹出位置
            buttonClasses : [ 'btn btn-default' ],
            applyClass : 'btn-small btn-primary blue',
            cancelClass : 'btn-small',
            format : 'YYYY-MM-DD', //控件中from和to 显示的日期格式
            separator : ' 至 ',
            locale : {
                applyLabel : '确定',
                cancelLabel : '取消',
                fromLabel : '起始时间',
                toLabel : '结束时间',
                customRangeLabel : '自定义',
                daysOfWeek : [ '日', '一', '二', '三', '四', '五','六' ],
                monthNames : [ '一月', '二月', '三月', '四月', '五月',
                    '六月', '七月', '八月', '九月', '十月', '十一月',
                    '十二月' ],
                firstDay : 1
            },
        },
        function(start, end, label) {//格式化日期显示框
            var start_time = start.format('YYYY-MM-DD');
            var end_time = end.format('YYYY-MM-DD');
            if(start.format('MM-DD-YYYY') == moment().subtract('days', 1).startOf('day').format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().subtract('days', 1).endOf('day').format('MM-DD-YYYY') ){
                var someday = '昨日';
                $("#alarm").html(someday);
                $("input[name='alarm']").val(' 今天12昨日');
            }else if(start.format('MM-DD-YYYY') == moment().subtract('days', 6).format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().format('MM-DD-YYYY') ){
                var someday = '最近7日';
                $("#alarm").html(someday);
                $("input[name='alarm']").val('最近7日');
            }else if(start.format('MM-DD-YYYY') == moment().subtract('days', 29).format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().format('MM-DD-YYYY') ){
                var someday  = '最近30日';
                $("#alarm").html(someday);
                $("input[name='alarm']").val('最近30日');
            }else if(start.format('MM-DD-YYYY') == moment().isoWeekday(1).format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().isoWeekday(7).format('MM-DD-YYYY') ){
                var someday = '本周';
                $("#alarm").html(someday);
                $("input[name='alarm']").val('本周');
            }else if(start.format('MM-DD-YYYY') == moment().startOf('week').day(-6).format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().startOf('week').format('MM-DD-YYYY') ){
                var someday = '上周';
                $("#alarm").html(someday);
                $("input[name='alarm']").val('上周');
            }else if(start.format('MM-DD-YYYY') == moment().startOf('month').format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().endOf('month').format('MM-DD-YYYY') ){
                var someday = '本月';
                $("#alarm").html(someday);
                $("input[name='alarm']").val('本月');
            }else if(start.format('MM-DD-YYYY') == moment().subtract(1, 'month').startOf('month').format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().subtract(1, 'month').endOf('month').format('MM-DD-YYYY') ){
                var someday = '上月';
                $("#alarm").html(someday);
                $("input[name='alarm']").val('上月');
            }else if(start.format('MM-DD-YYYY') == moment().startOf('year').format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().endOf('year').format('MM-DD-YYYY') ){
                var someday = '本年';
                $("#alarm").html(someday);
                $("input[name='alarm']").val('本年');
            }else if(start.format('MM-DD-YYYY') == moment().subtract(1, "years").startOf('year').format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().subtract(1, "years").endOf('year').format('MM-DD-YYYY') ){
                var someday = '去年';
                $("#alarm").html(someday);
                $("input[name='alarm']").val('去年');
            }else if(start.format('MM-DD-YYYY') == moment().startOf('day').format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().format('MM-DD-YYYY') ){
                var someday = '今日';
                $("#alarm").html(someday);
                $("input[name='alarm']").val('今日');
            }else{
                var someday = '自定义'
                $("#alarm").html(someday);
                $("input[name='alarm']").val('自定义');
            }
            $(".date-search").html(start_time + ' 至 ' + end_time+' | ' + someday);
            //$('#adddate span').html(start.format('MM-DD-YYYY') + ' - '+ end.format('YYYY-MM-DD'));
            var start_time = start.format('YYYYMMDD');
            var end_time = end.format('YYYYMMDD');

            //游客统计高峰洼值
            $.get('getVisitorHistory',{start_time:start_time,end_time:end_time},function (res) {
                if(res.history_pcu > 0){
                    document.getElementById('history_pcu').innerHTML = res.history_pcu + "<span>人</span>";
                    document.getElementById('history_vcu').innerHTML = res.history_vcu + "<span>人</span>";
                }

            });
            //----图形开始 tuxing-------
            $(function(){
                //景区客流统计（按天）
//            var carMonitorChart = echarts.init(document.getElementById('carMonitor'));
                var carMonitorChart = echarts.init(document.getElementById('carMonitor') , 'walden');
                $.get('getVisitorDay',{start_time:start_time,end_time:end_time},function (res) {
                    var day_data = res,
                        option = {
                            tooltip : {
                                trigger: 'axis',
                                axisPointer: {
                                    type: 'cross',
                                    label: {
                                        backgroundColor: '#6a7985'
                                    }
                                }
                            },
                            legend: {
                                data:['客流']
                            },
                            /*    toolbox: {
                                    feature: {
                                        saveAsImage: {}
                                    }
                                },*/
                            grid: {
                                left: '3%',
                                right: '4%',
                                bottom: '3%',
                                containLabel: true
                            },
                            xAxis : [
                                {
                                    type : 'category',
                                    boundaryGap : false,
                                    data : day_data.s_date
                                }
                            ],
                            yAxis : [
                                {
                                    type : 'value'
                                }
                            ],
                            series : [
                                {
                                    name:'客流数',
                                    type:'line',
                                    stack: '总量',
                                    areaStyle: {
                                        normal: {
                                            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                                offset: 0,
                                                color: '#3fb1e3'
                                            }, {
                                                offset: 0.3,
                                                color: '#3fb1e3'
                                            }, {
                                                offset: 1,
                                                color: '#fff'
                                            }])
                                        }
                                    },
                                    markPoint: {
                                        data: [
                                            {type: 'max', name: '最大值'},
                                            {type: 'min', name: '最小值'}
                                        ]
                                    },
                                    data: day_data.user_num//[230, 456, 578, 389, 689, 830, 901, 509, 409, 398, 290]
                                }
                            ]
                        };
                    carMonitorChart.setOption(option);
                });




//景点客流密度排行

                var touristDensityChart = echarts.init(document.getElementById('touristDensity') , 'walden');
                $.get('getVisitorSpotTop',{start_time:start_time,end_time:end_time},function (res) {
                    var spot = res; //{$spot_data};
                    option = {

                        tooltip: {
                            trigger: 'axis',
                            axisPointer: {
                                type: 'shadow'
                            }
                        },
                        legend: {
                            x: 'right',
                            y: 'top',
                            data: ['客流量']
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis: {
                            type: 'value',
                            boundaryGap: [0, 0.01]
                        },
                        yAxis: {
                            type: 'category',
                            data: spot.name //['景点的名称1','景点2','景点3排行','景点4','景点5','景点6','景点7','景点8']
                        },
                        series: [
                            {
                                name: '客流量',
                                type: 'bar',
                                barWidth: '30%',
                                data: spot.user_num //[407, 741, 607, 641, 794, 800, 843, 935]
                            }
                        ]
                    };
                    touristDensityChart.setOption(option);

                })


                //检票口流量统计
                var realTimePFlowChart = echarts.init(document.getElementById('realTimePFlow') , 'walden');
                $.get('getScenicHour',{start_time:start_time,end_time:end_time},function (res) {
                    var hour_data = res;
                    option = {
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: {
                                type: 'shadow'
                            }
                        },
                        legend: {
                            x: 'right',
                            y: 'top',
                            data: ['入园', '出园', '在园']
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        yAxis: {
                            type: 'value',
                            boundaryGap: [0, 0.01]
                        },
                        xAxis: {
                            type: 'category',
                            data: hour_data.s_hour //['7:00','8:00','9:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00']
                        },
                        series: [
                            {
                                name: '入园',
                                type: 'bar',
                                data: hour_data.entered_num //[823, 489, 1034, 970, 744, 230, 730, 744, 230, 730]
                            },
                            {
                                name: '出园',
                                type: 'bar',
                                data: hour_data.left_num //[203, 489, 934, 970, 744, 230, 430, 744, 230, 430]
                            },

                            {
                                name: '在园',
                                type: 'bar',
                                data: hour_data.user_num //[325, 438, 1000, 1094, 141, 807, 530, 141, 807, 530]
                            }
                        ]
                    };
                    realTimePFlowChart.setOption(option);
                });

            });
            //=======jies======
        });
    });
