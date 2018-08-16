
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
            separator : ' 到 ',
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

            $('#beginTime').val(start.format('YYYYMMDD'));
            $('#endTime').val(end.format('YYYYMMDD'));

            //---kais====
            $(function(){
//游客分析－游客属性分析
                //游客性别与年龄统计
                var touristProvinceAnalysisChart = echarts.init(document.getElementById('touristProvinceAnalysis') , 'walden');
                var spirit = 'image://data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAASCAIAAADgy6hbAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA4ZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTM4IDc5LjE1OTgyNCwgMjAxNi8wOS8xNC0wMTowOTowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDphNjFlZTI4OS1iMDM0LTQ1NWYtYjA2Zi03NjJkZjUzNGY0YzEiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MjY1NzA3NDgxNDY5MTFFOEFCNEE5N0Q3MzlDQjY2NTAiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MjY1NzA3NDcxNDY5MTFFOEFCNEE5N0Q3MzlDQjY2NTAiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTcgKE1hY2ludG9zaCkiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo2Mjk2YTczZS04MDYzLTQxYWMtOGFjNS0zM2VlNjY4MDljOTUiIHN0UmVmOmRvY3VtZW50SUQ9ImFkb2JlOmRvY2lkOnBob3Rvc2hvcDpkOTE5N2Y2NC00NTQ1LTExN2ItOTZlOS1mYTVlYWNjZWYzOTQiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz72qvLnAAAA1UlEQVR42mL8//8/AyHAhMa/9Jph/R2Gl19RBBmRTTr+lKHlDIjBx8owx5WBmxWbSTsfQhmffjPc/YDDOn0xKANokjgXNuvufWD48pvh+DOG519BqpX5QerEuZEUlRxkuP4Bi79StBkCVcDWAX2EVQUQrLqF6iY/BRRpIFdTAOQDFEVi3CiKgFweVhyBiTPE4TrQADcbgwyy777+BoWv90aoazY9APnLTR6slJWBBaqJlQHTcdwku4kgYEHm8IHNx+KP/0jgxRcQAoKLr/5/+YUQBwgwAKFHXFYKxyGKAAAAAElFTkSuQmCC';


                var spiritb = 'image://data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAASCAIAAADgy6hbAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA4ZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTM4IDc5LjE1OTgyNCwgMjAxNi8wOS8xNC0wMTowOTowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDphNjFlZTI4OS1iMDM0LTQ1NWYtYjA2Zi03NjJkZjUzNGY0YzEiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MjY1NzA3NEMxNDY5MTFFOEFCNEE5N0Q3MzlDQjY2NTAiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MjY1NzA3NEIxNDY5MTFFOEFCNEE5N0Q3MzlDQjY2NTAiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTcgKE1hY2ludG9zaCkiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo2Mjk2YTczZS04MDYzLTQxYWMtOGFjNS0zM2VlNjY4MDljOTUiIHN0UmVmOmRvY3VtZW50SUQ9ImFkb2JlOmRvY2lkOnBob3Rvc2hvcDpkOTE5N2Y2NC00NTQ1LTExN2ItOTZlOS1mYTVlYWNjZWYzOTQiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6ccsVFAAABD0lEQVR42nSRvW7CUAyFTyOkhAmmJixELO1WsZTCgMSCxM7CUKmvx9IdVFVQilQITwAT2UgW2CATPab5uZeGb4gs59g+1zbOV+wP54UnX4UCVHwfw3cJFh7eXlEu/aUNTbQL4+AUYb1J07rIuc+N9XGlMloN7AK4VYkT7ugrDmdz/HhaTaeNl2dlHC1fKcj0G0GYiKII409YppSqbcjoIxEtV9gf0GygaGUivp86+luuDGnIQTUX9SdMZpnoay6GHJtDC3HF44P043pS2JuZXhdb34BpSgVt/TfOvV/+Jq8LApnI5tkybVQcyWt7Um9HBn24bt5ZbqCLrKJ2opyzxOZCnI6itm8dmCj/Un4FGABJkHkR6EIBXgAAAABJRU5ErkJggg==';
                $.get('getTouristSex',{start_time:start_time,end_time:end_time},function (res) {

                    if(res.code == 1){
                       // var average_age= res.average_age +'岁';
                        var age_text = '游客平均年龄';
                        var maxData =res.total_num;
                    }else {
                        res.sex_text =' ';
                    }
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
                            data:  res.sex_text,//['男','女'],
                            inverse: true,
                            axisTick: {show: false},
                            axisLine: {show: false},
                            axisLabel: {
                                margin: 10,
                                textStyle: {
                                    color: '#666',
                                    fontSize: 16
                                }
                            },
                            splitLine: {           // 分隔线
                                show: false
                            }
                        },
                        grid: {
                            width: '25%' ,
                            top: 'center',
                            height: 120,
                            left: 40,
                            right: 100
                        },

                        //年龄
                        title: {
                            width: '65%' ,
                            text: age_text,
                            subtext: res.average_user_age,
                            top: 'center',
                            left: '67%',
                            textAlign: 'center'
                        },
                        tooltip: {
                            trigger: 'item',
                            formatter: "{b} <br/>游客数量： {c} <br/>占比： {d}%"
//                    formatter: "{a}{b} <br/>游客数量： {c} <br/>占比： {d}%"
                        },
                        series: [

                            //性别比例
                            {
                                // current data
                                type: 'pictorialBar',
                                symbol: spiritb,
                                symbolRepeat: 'fixed',
                                symbolMargin: ['20%'],
                                symbolClip: true,
                                symbolSize: 20,
                                symbolBoundingData: maxData,
                                data: [{value: res.male_num,symbol: spirit},{value: res.female_num,symbol: spiritb}],//res.user_num,  //[890, 120],
                                z: 10,
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
                                        offset: [0, 40],
                                        textStyle: {
                                            color: 'green',
                                            fontSize: 12
                                        }
                                    }
                                },
                                animationDuration: 0,
                                symbolRepeat: 'fixed',
                                symbolMargin: ['20%'],
                                // symbol: spiritb,
                                symbolSize: 20,
                                symbolBoundingData: maxData,
                                data: [{value: res.male_num,symbol: spirit},{value: res.female_num,symbol: spiritb}], //res.user_num,
                                z: 5
                            },

                            //年龄
                            {
                                type:'pie',
                                radius: ['35%', '50%'],
                                center: ['68%', '50%'],
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
                                data:res.age_data
//                        data:[
//                            {value:135, name:'<16岁'},
//                            {value:332, name:'16-24岁'},
//                            {value:435, name:'25-35岁'},
//                            {value:355, name:'36-46岁'},
//                            {value:232, name:'>46岁'}
//                        ]
                            }
                        ]
                    };
                    touristProvinceAnalysisChart.setOption(option);
                });

                //游客景区停留时间统计
                var touristStayTimeChart = echarts.init(document.getElementById('touristStayTime') , 'walden');
                $.get('getTouristRemai',{start_time:start_time,end_time:end_time},function (remai_data) {

                    if(remai_data.code == 1){
                        var remai_text ='平均停留时长';
                    }else {
                       var remai_text =' ';
                    }

                    option = {
                        title: {
                            text: remai_text,
                            subtext: remai_data.average_remain_time,
                            top: 'center',
                            left: '40%',
                            textAlign: 'center'
                        },
                        tooltip: {
                            trigger: 'item',
                            formatter: "{a}{b} <br/>客流： {c} <br/>占比： {d}%"
                        },
                        legend: {
                            orient: 'vertical',
                            x: 'right',
                            y: 'bottom',
                            data: remai_data.time_phase
                        },
                        series: [
                            {
                                name:remai_text,
                                type:'pie',
                                radius: ['50%', '70%'],
                                center: ['40%', '50%'],
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
                                data:remai_data.remai
//							[
//                            {value:335, name:'<0.5H'},
//                            {value:310, name:'0.5-1H'},
//                            {value:310, name:'1-2H'},
//                            {value:310, name:'2-3H'},
//                            {value:234, name:'>3H'}
//                        ]
                            }
                        ]
                    };
                    touristStayTimeChart.setOption(option);
                });

                //游客提前预定天数统计
                var advanceDaysChart = echarts.init(document.getElementById('advanceDays') , 'walden');
                $.get('getTicketReserve',{start_time:start_time,end_time:end_time},function (reserve_data) {
                    if(reserve_data.code == 1){
                       var avg_text ='平均提前预定天数';
                    }else {
                        avg_text = ' ';
                    }
                    option = {
                        title: {
                            text: avg_text,//'平均提前预定天数',
                            subtext: reserve_data.avg_day,
                            top: 'center',
                            left: '64%',
                            textAlign: 'center'
                        },
                        tooltip: {
                            trigger: 'item',
                            formatter: "{b}<br/> 人数: {c} <br/> 占比: {d}%"
                        },
                        legend: {
                            orient: 'vertical',
                            x: '5%',
                            y: 'bottom',
                            data:['0天','1天','2天','3天','>3天']
                        },
                        series: [
                            {
                                type:'pie',
                                radius: ['50%', '70%'],
                                center: ['65%', '50%'],
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
                                data:[
                                    {value:reserve_data.day_0_num, name:'0天'},
                                    {value:reserve_data.day_1_num, name:'1天'},
                                    {value:reserve_data.day_2_num, name:'2天'},
                                    {value:reserve_data.day_3_num, name:'3天'},
                                    {value:reserve_data.day_more_num, name:'>3天'}
                                ]
                            }
                        ]
                    };
                    advanceDaysChart.setOption(option);
                });

                //游客自驾统计分析
                var selfDrivingChart = echarts.init(document.getElementById('selfDriving') , 'walden');
                $.get('getTouristTravel',{start_time:start_time,end_time:end_time},function (travel_data) {
//                var travel_data ={$travel_data};
                    option = {
                        tooltip: {
                            trigger: 'item',
                            formatter: "{a}{b} <br/>车辆数： {c} <br/>占比： {d}%"
                        },
                        legend: {
                            orient: 'vertical',
                            x: 'right',
                            y: 'bottom',
                            data:['自驾','非自驾']
                        },
                        series: [
                            {
                                type:'pie',
                                radius: ['50%', '70%'],
                                center: ['40%', '50%'],
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
                                data:
                                    [
                                        {value:travel_data.self_driving_num, name:'自驾'},
                                        {value:travel_data.driving_num, name:'非自驾'}
                                    ]
                            }
                        ]
                    };
                    selfDrivingChart.setOption(option);
                });

            });
            //----jies======
        });
    });
