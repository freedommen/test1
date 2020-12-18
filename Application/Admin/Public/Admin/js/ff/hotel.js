
$(function() {

    $(".hotel-main-top-right ul li a").click(function () {
        $(this).parent().css("display","none");
    });

    $(".hotel-main-top-left td>span").click(function () {

        console.log(this.innerHTML);
        if(this.innerHTML==="<i class=\"fa fa-minus\"></i>取消对比"){
            this.innerHTML="<i class='fa fa-plus'></i>加入分析";
        }
        else {
            this.innerHTML="<i class='fa fa-minus'></i>取消对比";
        }

        $(this).toggleClass("cancel-link");
        $(this).toggleClass("add-link");
    });


    //弹窗中的下拉框
    $(document).on('click', '.contrastPop .box-content-top-right>input', function() {
        $(this).next("ul").slideToggle(150);
        $(this).next().next("span.triangle").toggleClass("drop-down-span");
        $(this).next().next("span.triangle").toggleClass("upward-span")
    });
    $(document).on('click', '.contrastPop .box-content-top-right>ul>li', function() {
        var text = $(this).text();
        $(this).parent().parent().children("input").val(text);
        $(this).parent("ul").slideToggle(150);
        $(this).parent().parent().children("span.triangle").toggleClass("drop-down-span");
        $(this).parent().parent().children("span.triangle").toggleClass("upward-span");
    });
    $(document).on('click', '.contrastPop .box-content-top-right>span', function() {
        $(this).toggleClass("drop-down-span");
        $(this).toggleClass("upward-span");
        $(this).parent().children("ul").slideToggle(150);
    });


    /*checkbox样式更改*/
    $(document).on('click', '.contrastPop .checkboxDiv label', function() {
        for (i = 0; i < 2; i++)          //对div#checkbox下的input[checkbox]进行遍历
        {
            var ifchecked = $(this).children("input").eq(i).prop("checked");
            //取其checked属性值赋给变量ifchecked
            if (ifchecked == true) {
                $(this).children("i").css("display", "block");
                $(this).children(".labelSpan").css("color", "#0d6ece");
            }
            if(ifchecked == false) {
                $(this).children("i").css("display", "none");
                $(this).children(".labelSpan").css("color", "#666");
            }
        }
    });

});
