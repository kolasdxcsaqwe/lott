$(function () {
    let maxBet=info.maxbet;
    let minBet=info.minbet;
    var userInputMoney=minBet
    var hrefData=parseURL(window.location.href)
    var baseUrl=hrefData.protocol+"://"+hrefData.host+":8653";

    var a, b, c, d, bet = 1, bet_n = 0, bline, bval;
    var secTitles=[[""],[""],["万位","千位","十位","个位"],["万位","千位","十位","个位"],
        ["万位","千位","十位"],["万位","千位"],["万位","千位","十位","个位"],["万位","个位"]];
    var gameCodes=['ry3','ry2','dxds','d4','d3','d2','d1','tw']

    $("#orderPrice").on("input",function (){
        $(this).val($(this).val().replace(/^(0+)|[^\d]+/g,''));
        if($(this).val()>parseInt(maxBet))
        {
            $(this).val(maxBet)
        }

        var pVal=$("#orderPrice").val();
        if(pVal.length<1)
        {
            pVal=$("#orderPrice").attr("placeholder");
        }
        var winAmount=getRare()*100*parseInt(pVal)/100;
        $("#availableWin b").html(winAmount+"")
        userInputMoney=pVal
        show_bet();
    })



    function getRare()
    {
        switch (bet)
        {
            case 1:
                return parseFloat(info.anythree);
            case 2:
                return parseFloat(info.anytwo);
            case 3:
                return parseFloat(info.dxds);
            case 4:
                return parseFloat(info.fourfix);
            case 5:
                return parseFloat(info.threefix);
            case 6:
                return parseFloat(info.twofix);
            case 7:
                return parseFloat(info.onefix);
            case 8:
                return parseFloat(info.touweifix);
        }
        return parseFloat("0");
    }

    var show_bet = function () {
        var t = $(".game-type-" + bet);
        bline = []
        t.find('a.on[data-pos]').each(function (i, o) {
            bline.push($(this).data('pos'));
        });

        var isAva=true
        $(".game-type-" + bet+" .btn-box ").each(function (){
            if($(this).find(" a.on ").length<1 && bet!==3 && bet!==7)
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
                bet_n=countOrder1(bline.length,2)
                break;
            case 3:
            case 7:
                bet_n=countOrder3()
                break
            case 4:
            case 5:
            case 6:
            case 8:
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
                isAvailable=count>1;
                break;
            case 3:
            case 7:
                isAvailable=count>0;
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
            $("#payRare b").html(getRare())
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

    function countOrder3()
    {
        var count=0;
        var isAva=true;
        $(".game-type-" + bet+" .btn-box ").each(function (){
            count=count+$(this).find(" a.on ").length
            // console.log("line--->"+$(this).data('line')+" : "+$(this).find(" a.on ").length)
        })
        return count
    }

    //随机数组
    function randomNums10(count)
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

    //随机数组
    function randomNums4(count)
    {
        var nums=[0,1,2,3]
        var result=[]
        for (let i = 0; i < count; i++) {
            let pos=Math.floor(Math.random()*nums.length)
            result.push(nums[pos])
            nums.splice(pos,1)
        }
        return result
    }

    //显示更多下注
    $(".betDialogContent .menu").find("li").click(function () {
        if ($(this).hasClass("more-game")) {
            $(this).toggleClass("on");
            $(this).hasClass("on") ? $(".sub-menu").show() : $(".sub-menu").hide();
        } else {
            $(this).siblings().removeClass('on');
            $(".sub-menu").hide();
        }
    })

    //切换下注方式
    $(".betDialogContent .menu").find("a").click(function () {
        if($(this).hasClass("triangle"))
        {
            return;
        }
        setBtnIsAvailable(false)
        var a = $(this), d = a.data();
        if (!d.t) return;
        bet = d.t;

        $("#orderPrice").val(userInputMoney)
        $("#availableWin b").html(getRare()*userInputMoney)
        $("#orderPrice").attr("placeholder",minBet);

        $(".betDialogContent .menu").find("a").removeClass("on");
        a.addClass("on")
        $("#game-gtype,.game-tit").html(a.text())
        $(".sub-menu").hide()
        $('.gamenum').hide()

        $('.gamenum .rank-tit .lotteryType').html(a.text())
        $('.game-type-' + d.t).html("")

        $('.game-type-' + d.t).append("<div class='rank-tit'><span class='change'>"+a.text()+
            "</span><div><span class='orderEdit'>注单编辑</span><span class='choose'>机选</span></div></div>")
        // $('.game-type-' + d.t).append("<div class='randomChoose'><span class='order'>注单编辑</span> <span class='choose'>机选</span></div>")

        var string="<div class='gameScroll'>"
        for (let j = 0; j < secTitles[d.t-1].length; j++) {


            var title="<span class='secTitle' >%title</span>"
            title=title.replace("%title",secTitles[d.t-1][j])

            string=string+title+"<div class='btn-box btn-grounp' data-line='%line'>"
            string=string.replace("%line",j);

            var itemAmount=bet===3?4:10;
            var items7=['大','小','单','双']
            for (let k = 0; k < itemAmount; k++) {
                var item="<a href='javascript:;' class='btn mini-btn' data-pos='%pos'><div class='h5'>%num</div></a>"
                if(bet===3)
                {
                    //大小单双
                    item=item.replace("%num",items7[k]);
                }
                else
                {
                    item=item.replace("%num",k);
                }

                item=item.replace("%pos",k);
                string=string+item
            }
            string=string+"</div>"
        }
        string=string+"</div>"
        $('.game-type-' + d.t).append(string)
        $('.game-type-' + d.t).show()

        window.scrollTo(0, document.body.scrollHeight);
        //下注选择
        $(".game-bd a.btn").click(function () {
            $(this).toggleClass('on');
            show_bet();
        });

        $(".orderEdit").click(function (){
            $('#orderDialog').modal('show');
            $("#closeOrderDialog").click(function (e){
                $('#orderDialog').modal('hide');
            })
            $("#syncAllBal").on("input",function (){
                $(this).val($(this).val().replace(/^(0+)|[^\d]+/g,''));
                if($(this).val()>maxBet)
                {
                    $(this).val(maxBet)
                }
            })
        })

        $(".botOrderEdit").click(function (){
            $('#orderDialog').modal('show');
            $("#closeOrderDialog").click(function (e){
                $('#orderDialog').modal('hide');
            })
            $("#syncAllBal").on("input",function (){
                $(this).val($(this).val().replace(/^(0+)|[^\d]+/g,''));
                if($(this).val()>maxBet)
                {
                    $(this).val(maxBet)
                }
            })
        })

        $(".rank-tit .choose").click(function (){
            $(".game-bd a.btn").removeClass("on");
            switch (d.t)
            {
                case 1:
                    var nums=randomNums10(3)
                    for (let i = 0; i < nums.length; i++) {
                        $('.game-type-' + d.t+" a.btn:eq("+nums[i]+")").click();
                    }
                    break
                case 2:
                    var nums=randomNums10(2)
                    for (let i = 0; i < nums.length; i++) {
                        $('.game-type-' + d.t+" a.btn:eq("+nums[i]+")").click();
                    }
                    break
                case 3:
                    var v=randomNums4(1)
                    var index=randomNums4(1)
                    $('.game-type-' + d.t+" .btn-box:eq("+v[0]+")").find(" a.btn:eq("+index[0]+")").click();
                    break
                case 4:
                    for (let k = 0; k < 4; k++) {
                        var nums=randomNums10(1)
                        $('.game-type-' + d.t+" .btn-box:eq("+k+")").find(" a.btn:eq("+nums[0]+")").click();
                    }
                    break
                case 5:
                    for (let k = 0; k < 3; k++) {
                        var nums=randomNums10(1)
                        $('.game-type-' + d.t+" .btn-box:eq("+k+")").find(" a.btn:eq("+nums[0]+")").click();
                    }
                    break
                case 6:
                    for (let k = 0; k < 2; k++) {
                        var nums=randomNums10(1)
                        $('.game-type-' + d.t+" .btn-box:eq("+k+")").find(" a.btn:eq("+nums[0]+")").click();
                    }
                    break
                case 7:
                    var v=randomNums4(1)[0]
                    var index=randomNums10(1)[0]
                    $('.game-type-' + d.t+" .btn-box:eq("+v+")").find(" a.btn:eq("+index+")").click();
                    break
                case 8:
                    for (let k = 0; k < 2; k++) {
                        var index=randomNums10(1)[0]
                        $('.game-type-' + d.t+" .btn-box:eq("+k+")").find(" a.btn:eq("+index+")").click();
                    }
                    break
            }
        })

    });

    $(".betDialogContent .menu .on").click()



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

    function parseURL(url) {
        var a = document.createElement('a');
        a.href = url;
        return {
            source: url,
            protocol: a.protocol.replace(':', ''),
            host: a.hostname,
            port: a.port,
            query: a.search,
            params: (function () {
                var ret = {},
                    seg = a.search.replace(/^\?/, '').split('&'),
                    len = seg.length, i = 0, s;
                for (; i < len; i++) {
                    if (!seg[i]) {
                        continue;
                    }
                    s = seg[i].split('=');
                    ret[s[0]] = s[1];
                }
                return ret;
            })(),
            file: (a.pathname.match(/\/([^\/?#]+)$/i) || [, ''])[1],
            hash: a.hash.replace('#', ''),
            path: a.pathname.replace(/^([^\/])/, '/$1'),
            relative: (a.href.match(/tps?:\/\/[^\/]+(.+)/) || [, ''])[1],
            segments: a.pathname.replace(/^\//, '').split('/')
        };
    }

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
        // $("#touzhu").addClass("on"), location.href = "#confirm"
        betNow()
    });

    $(".pour-info").find("a.close,a.cancel").click(function () {
        $("#touzhu").removeClass("on"), location.href = "#main"
    });

    function betNow()
    {
        var betCodes=[]
        $(".game-type-" + bet+" .btn-box ").each(function (){
            var code=""
            $(this).find("a.on[data-pos]").each(function (index,val){
                code=code+$(this).data('pos')
            });

            betCodes.push({pos:$(this).data().line,code:code})
            // console.log("line--->"+$(this).data('line')+" : "+$(this).find(" a.on ").length)
        })

        var arr=[]
        arr.push({gamName:gameCodes[bet-1],
            orderPrice:$("#orderPrice").val(),
            codes:betCodes});

        var postData={userId:info.userid,roomId:info.roomid,betArray:JSON.stringify(arr)}
        $.ajax({
            //几个参数需要注意一下
            type: "POST",//方法类型
            dataType: "json",//预期服务器返回的数据类型
            url: baseUrl+"/QXCSendChat" ,//url
            data: postData,
            crossDomain:true,
            success: function (result) {
                console.log(result);
                if (result.code === 0) {
                    zy.tips('投注已发送!');
                }
                else {
                    zy.tips(result.msg);
                }
            },
            error : function() {
                zy.tips('下注失败，服务器异常！!');
            }
        });
    }
})