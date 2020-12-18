
//日历js
$(document).ready(
    function() {
        $('#adddate').daterangepicker({
            startDate: moment().startOf('year'),
            //endDate: moment(),
            minDate: '2012-01-01',    //最小时间  =====>>格式要跟格式化的样式一致
            endDate : moment(), //最大时间
            //dateLimit : {days : 30}, //起止时间的最大间隔
            showDropdowns : true,
            showWeekNumbers : false, //是否显示第几周
            timePicker : false, //是否显示小时和分钟
            timePickerIncrement : 60, //时间的增量，单位为分钟
            timePicker12Hour : false, //是否使用12小时制来显示时间
            ranges : {
                //'最近1小时': [moment().subtract('hours',1), moment()],
                '今日': [moment().startOf('day'), moment() ],
                '昨日': [moment().subtract('days', 1).startOf('day'), moment().subtract('days', 1).endOf('day') ],
                '最近7日': [moment().subtract('days', 6),moment() ],
                '最近30日': [moment().subtract('days', 29),moment() ],
                '本周': [moment().isoWeekday(1), moment().isoWeekday(7) ],
                '上周': [moment().startOf('week').day(-6), moment().startOf('week') ],
                '本月': [moment().startOf('month'), moment().endOf('month') ],
                '上月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month') ],
                '本年': [moment().startOf('year'), moment().endOf('year') ],
                '去年': [moment().subtract(1, "years").startOf('year'), moment().subtract(1, "years").endOf('year') ],
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
            }
        },
        function(start, end, label) {//格式化日期显示框
            if(start.format('MM-DD-YYYY') == moment().subtract('days', 1).startOf('day').format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().subtract('days', 1).endOf('day').format('MM-DD-YYYY') ){
                $("#alarm").html('昨日');
                $("input[name='alarm']").val('昨日');
            }else if(start.format('MM-DD-YYYY') == moment().subtract('days', 6).format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().format('MM-DD-YYYY') ){
                $("#alarm").html('最近7日');
                $("input[name='alarm']").val('最近7日');
            }else if(start.format('MM-DD-YYYY') == moment().subtract('days', 29).format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().format('MM-DD-YYYY') ){
                $("#alarm").html('最近30日');
                $("input[name='alarm']").val('最近30日');
            }else if(start.format('MM-DD-YYYY') == moment().isoWeekday(1).format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().isoWeekday(7).format('MM-DD-YYYY') ){
                $("#alarm").html('本周');
                $("input[name='alarm']").val('本周');
            }else if(start.format('MM-DD-YYYY') == moment().startOf('week').day(-6).format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().startOf('week').format('MM-DD-YYYY') ){
                $("#alarm").html('上周');
                $("input[name='alarm']").val('上周');
            }else if(start.format('MM-DD-YYYY') == moment().startOf('month').format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().endOf('month').format('MM-DD-YYYY') ){
                $("#alarm").html('本月');
                $("input[name='alarm']").val('本月');
            }else if(start.format('MM-DD-YYYY') == moment().subtract(1, 'month').startOf('month').format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().subtract(1, 'month').endOf('month').format('MM-DD-YYYY') ){
                $("#alarm").html('上月');
                $("input[name='alarm']").val('上月');
            }else if(start.format('MM-DD-YYYY') == moment().startOf('year').format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().endOf('year').format('MM-DD-YYYY') ){
                $("#alarm").html('本年');
                $("input[name='alarm']").val('本年');
            }else if(start.format('MM-DD-YYYY') == moment().subtract(1, "years").startOf('year').format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().subtract(1, "years").endOf('year').format('MM-DD-YYYY') ){
                $("#alarm").html('去年');
                $("input[name='alarm']").val('去年');
            }else if(start.format('MM-DD-YYYY') == moment().startOf('day').format('MM-DD-YYYY') && end.format('MM-DD-YYYY') == moment().format('MM-DD-YYYY') ){
                $("#alarm").html('今日');
                $("input[name='alarm']").val('今日');
            }else{
                $("#alarm").html('自定义');
                $("input[name='alarm']").val('自定义');
            }
            //$('#adddate span').html(start.format('MM-DD-YYYY') + ' - '+ end.format('YYYY-MM-DD'));
        });
 		/*$("#startdate").datetimepicker({
            language : 'zh-CN',
            format : "yyyy-mm-dd",
            autoclose : true,
            todayBtn : true,
            pickerPosition : "bottom-left",
            minView : 2			//最精准的时间选择为日期0-分 1-时 2-日 3-月
        });

        $("#enddate").datetimepicker({
            language : 'zh-CN',
            format : "yyyy-mm-dd",
            autoclose : true,
            todayBtn : true,
            pickerPosition : "bottom-left",
            minView : 2
        });*/
    });
