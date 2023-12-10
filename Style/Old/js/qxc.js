$(function () {
    var a, b, c, d, bet = 1, bet_n = 0, bline, bval;
    var secTitles=[[""],[""],[""],["头","尾"],["第1位","第2位","第3位","第4位"],["第4位","第5位","第6位","第7位"]
        ];

    $("#orderPrice").on("input",function (){
        $(this).val($(this).val().replace(/^(0+)|[^\d]+/g,''));
        if($(this).val()>10000000)
        {
            $(this).val(10000000)
        }
        show_bet();
    })

    var show_bet = function () {
        var t = $(".game-type-" + bet);
        bline = []
        t.find('a.on[data-line]').each(function (i, o) {
            bline.push($(this).data('line'));
        });

        var isAva=true
        $(".game-type-" + bet+" .btn-box ").each(function (){
            if($(this).find(" a.on ").length<1)
            {
                //只要有一行没选中就不算
                isAva=false
            }
            // console.log("line--->"+$(this).data('line')+" : "+$(this).find(" a.on ").length)
        })


        bet_n = 0;

        //计算注数 bet_n注数
        switch (bet) {
            case 1:
                bet_n=countOrder1(bline.length,3)
                break;
            case 2:
                bet_n=countOrder1(bline.length,4)
                break;
            case 3:
                bet_n=countOrder1(bline.length,2)
                break
            case 4:
            case 5:
            case 6:
                bet_n=countOrder2()
                break;
        }

        isAva= isAva && setOrderCount(bline.length,bet)
        setBtnIsAvailable(isAva)
        if(!isAva)
        {
            return
        }

        console.log("选中:"+bline.length+" 注单："+bet_n)
        var pVal=$("#orderPrice").val();
        if(pVal.length<1)
        {
            pVal=$("#orderPrice").attr("placeholder");
        }
        $("#bet_num").html("共<b>" + bet_n + "</b>注"+"&nbsp;<b>"+(parseInt(pVal)*bet_n)+"</b>元");
        $('.bet_n').html(bet_n);
        var bet_money = $("input.bet_money").val() || 0;
        $('.bet_total').html(bet_n * bet_money);


    }

    function setOrderCount(count,index)
    {
        var isAvailable=true
        switch (index)
        {
            case 1:
                isAvailable=count>2;
                break;
            case 2:
                isAvailable=count>3;
                break;
            case 3:
                isAvailable=count>1;
                break;
            default:
                isAvailable=count>0;
        }

        return isAvailable
    }

    function setBtnIsAvailable(isAvailable)
    {
        if (isAvailable) {
            $(".infuse").show();
            $(".clearnum").addClass('on');
        } else {
            $(".clearnum").removeClass('on');
            $(".infuse").hide();
        }

        if (isAvailable) {
            $(".addOrder").addClass('on');
            $(".confirm-pour").addClass('on');
        } else {
            $(".addOrder").removeClass('on');
            $(".confirm-pour").removeClass('on');
        }
    }

    for (var i = 1; i <= 9; i++) {
        if (!in_array(i, tz_types)) {
            a = $('.menu').find("a[data-t='" + i + "']");
            a.parent().is("li") ? a.parent().remove() : a.remove();
            $('.game-type-' + i).remove();
        }
    }

    function countOrder1(choose,need)
    {
        var n=1
        var nm=1
        var m=1

        for (let i = 0; i < choose; i++) {
            n=n*(i+1);
            if(choose-need-i>0)
            {
                nm=nm*(choose-need-i)
            }
            if(need-i>0)
            {
                m=m*(need-i)
            }
        }
        return n/nm/m;
    }

    function countOrder2()
    {
        var count=1;
        var isAva=true;
        $(".game-type-" + bet+" .btn-box ").each(function (){
            count=count*$(this).find(" a.on ").length
            // console.log("line--->"+$(this).data('line')+" : "+$(this).find(" a.on ").length)
        })
        return count
    }

    //随机数组
    function randomNums(count)
    {
        var nums=[0,1,2,3,4,5,6,7,8,9]
        var result=[]
        for (let i = 0; i < count; i++) {
            let pos=Math.floor(Math.random()*nums.length)
            result.push(nums[pos])
            nums.splice(pos,1)
        }
        return result
    }

    //显示更多下注
    $(".game-hd .menu").find("li").click(function () {
        if ($(this).hasClass("more-game")) {
            $(this).toggleClass("on");
            $(this).hasClass("on") ? $(".sub-menu").show() : $(".sub-menu").hide();
            ;
        } else {
            $(this).siblings().removeClass('on');
            $(".sub-menu").hide();
        }
    })

    //切换下注方式
    $(".game-hd .menu").find("a").click(function () {
        setBtnIsAvailable(false)
        var a = $(this), d = a.data();
        if (!d.t) return;
        bet = d.t;
        $(".game-hd .menu").find("a").removeClass("on");
        a.addClass("on")
        $("#game-gtype,.game-tit").html(a.text())
        $(".sub-menu").hide(), $('.gamenum').hide()

        $('.gamenum .rank-tit .lotteryType').html(a.text())
        $('.game-type-' + d.t).html("")

        $('.game-type-' + d.t).append("<div class='rank-tit'><span class='change'>"+a.text()+
            "</span><div><span class='orderEdit'>注单编辑</span><span class='choose'>机选</span></div></div>")
        // $('.game-type-' + d.t).append("<div class='randomChoose'><span class='order'>注单编辑</span> <span class='choose'>机选</span></div>")

        for (let j = 0; j < secTitles[d.t-1].length; j++) {
            var title="<span class='secTitle' >%title</span>"
            title=title.replace("%title",secTitles[d.t-1][j])
            $('.game-type-' + d.t).append(title)

            var string="<div class='btn-box btn-grounp' data-line='%line'>"
            string=string.replace("%line",j);
            for (let k = 0; k < 10; k++) {
                var item="<a href='javascript:;' class='btn mini-btn' data-line='%line'><div class='h5'>%num</div></a>"
                item=item.replace("%num",k);
                item=item.replace("%line",k+1);
                string=string+item
            }
            string=string+"</div>"
            $('.game-type-' + d.t).append(string)
        }
        $('.game-type-' + d.t).show()

        window.scrollTo(0, document.body.scrollHeight);
        //下注选择
        $(".game-bd a.btn").click(function () {
            $(this).toggleClass('on');
            show_bet();
        });

        $(".rank-tit .choose").click(function (){
            $(".game-bd a.btn").removeClass("on");
            switch (d.t)
            {
                case 1:
                    var nums=randomNums(3)
                    for (let i = 0; i < nums.length; i++) {
                        $('.game-type-' + d.t+" a.btn:eq("+nums[i]+")").click();
                    }
                    break
                case 2:
                    var nums=randomNums(4)
                    for (let i = 0; i < nums.length; i++) {
                        $('.game-type-' + d.t+" a.btn:eq("+nums[i]+")").click();
                    }
                    break
                case 3:
                    var nums=randomNums(2)
                    for (let i = 0; i < nums.length; i++) {
                        $('.game-type-' + d.t+" a.btn:eq("+nums[i]+")").click();
                    }
                    break
                case 4:
                    for (let k = 0; k < 2; k++) {
                        var nums=randomNums(1)
                        $('.game-type-' + d.t+" .btn-box:eq("+k+")").find(" a.btn:eq("+nums[0]+")").click();
                    }
                    break;
                case 5:
                case 6:
                case 7:
                    for (let k = 0; k < 4; k++) {
                        var nums=randomNums(1)
                        $('.game-type-' + d.t+" .btn-box:eq("+k+")").find(" a.btn:eq("+nums[0]+")").click();
                    }
                    break
            }
        })

    });

    $(".game-hd .menu .on").click()

    $(".orderEdit").click(function (){
        $('#orderDialog').modal('show');
    })

    //清空
    $(".clearnum").click(function () {
        $(".game-bd a.btn").removeClass("on");
        show_bet();
    });
    $(".money_clear").click(function () {
        $(this).prev().val('');
        show_bet();
    });
    $("input.bet_money").keyup(function () {
        show_bet();
    });
    $("i[data-money]").click(function () {
        var a = $(".bet_money"), m = $(this).data("money"), n = a.val() * 1;
        a.val(n + m);
        show_bet();
    });


    //确认下注 bl余额 bet_money金额
    $("a.confirm").click(function () {
        var bl = $("b.balance").text() * 1, msg1, msg2, msg = [],
            bet_money = $("input.bet_money").val() * 1;
        if (bet_money == 0) {
            zy.tips("请输入下注金额");
            return;
        }
        if (bet_money * bet_n > bl) {
            zy.tips("您的余额不足");
            return;
        }
        switch (bet) {
            case 1:
                msg1 = '';
                $.each(bline, function (i, v) {
                    if (v != 8) {
                        msg1 = msg1 + String(v);
                    } else {
                        msg.push(bval.join("") + "/" + bet_money);
                    }
                });
                msg.push(msg1 + "/" + bval.join("") + "/" + bet_money);
                console.log(msg);
                break;
            case 2:
                msg1 = bline.join("");
                $.each(bval, function (i, v) {
                    msg[i] = msg1 + "/" + v + "/" + bet_money;
                });
                break;
            case 3:
                msg1 = bline.join("");
                msg2 = bval.join(".");
                msg[0] = msg1 + "/" + msg2 + "/" + bet_money;
                break;
            case 5:
                msg2 = bval.join("");
                $.each(bline, function (i, v) {
                    msg[i] = v + "肖/" + msg2 + "/" + bet_money
                });
                break;
            case 6:
                msg2 = bval.join("");
                $.each(bline, function (i, v) {
                    msg[i] = v + "肖/" + msg2 + "/" + bet_money
                });
                break;
            case 7:
                msg2 = bval.join("");
                $.each(bline, function (i, v) {
                    msg[i] = v + "肖/" + msg2 + "/" + bet_money
                });
                break;
            case 8:
                msg2 = bval.join("");
                $.each(bline, function (i, v) {
                    msg[i] = v + "肖/" + msg2 + "/" + bet_money
                });
                break;
            case 4:
                msg2 = bval.join(".");
                $.each(bline, function (i, v) {
                    msg[i] = v + "中/" + msg2 + "/" + bet_money
                });
                break;
            default:
                msg1 = bline.join("");
                $.each(bval, function (i, v) {
                    msg[i] = msg1 + "/" + v + "/" + bet_money
                });
                break;
        }
        if (msg.count < 1) return;
        $.each(msg, function (i, m) {
            //console.log(m);
            send_msg(m);
        });
        $("#touzhu").removeClass("on");
        $(".clearnum").click();
        zy.tips('投注已发送!');
    });

    $(".confirm-pour").click(function () {
        if (!$(this).hasClass("on")) return;
        $("#touzhu").addClass("on"), location.href = "#confirm"
    });

    $(".pour-info").find("a.close,a.cancel").click(function () {
        $("#touzhu").removeClass("on"), location.href = "#main"
    });
})