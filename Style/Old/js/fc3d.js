function initBetPanel()
{
    initPanel()
}

var initPanel=function () {
    let maxBet = info.maxbet;
    let minBet = info.minbet;
    var userInputMoney = minBet
    var hrefData = parseURL(window.location.href)
    var baseUrl = hrefData.protocol + "://" + hrefData.host + ":8653";
    var orderListDialogRemainTime=0
    var isStopCountDown=false
    var nowTerm=""
    var orderCacheArray=new Map()//注单列表数据
    var autoIncrease=0;//pos 计数
    var timeoutId=0
    var a, b, c, d, bet = 1, bet_n = 0, bline, bval;
    var secTitles = [[""], [""], [ "百位", "十位", "个位"], ["百位", "十位", "个位"],
         [""], [""], [""], [""], [ "百位", "十位","x"], ["x","十位", "个位"], [ "百位", "十位", "个位"]];

    var zu3 = [1, 2, 3, 3, 3, 3, 4, 5, 4, 5, 5, 4, 5, 5, 4, 5, 5, 4, 5, 4, 3, 3, 3, 1, 2, 1]
    var zu6 = [1, 1, 2, 3, 4, 5, 7, 8, 9, 10, 10, 10, 10, 9, 8, 7, 5, 4, 3, 2, 1, 1];

    var gameCodes = ['rx2', 'rx1', 'dxds', 'd3', 'd3z3', 'd3z6', 'd3z3sum', 'd3z6sum', 'd2f', 'd2b','d1']
    var gameTitles = ['任选2', '任选1', '大小单双', '3星直选', '3星组三', '3星组六', '3星组三和值', '3星组六和值', '2星前二直选', '2星后二直选','定位胆']


    var dialogCountDown=function (){
        orderListDialogRemainTime--
        if(orderListDialogRemainTime<1)
        {
            $(".timeBalance .betLimit b").html("00:00:00")
        }
        else
        {
            $(".timeBalance .betLimit b").html(formatCountDown(orderListDialogRemainTime))
        }
        if(!isStopCountDown && orderListDialogRemainTime>0)
        {
            clearTimeout(timeoutId)
            timeoutId=setTimeout(function (){dialogCountDown()},1000)
        }
    }

    $('#betDialog').on("hide.bs.modal", function () {
        clearSelectButtons();
        $(".infuse").hide();

    })

    $('#orderDialog').on("show.bs.modal", function () {
        $("#orderDialogTitle").text("玩法 : "+gameTitles[bet-1])
        fetchCountDownAndMoney()
        $(".timeBalance .betLimit").unbind('click')
        $(".timeBalance .betLimit").click(function (e) {
            fetchCountDownAndMoney()
        })
    })
    $('#orderDialog').on("hide.bs.modal",function (){
        isStopCountDown=true
        clearTimeout(timeoutId)
    })

    $("#orderPrice").on("input", function () {
        $(this).val($(this).val().replace(/^(0+)|[^\d]+/g, ''));
        if ($(this).val() > parseInt(maxBet)) {
            $(this).val(maxBet)
        }

        var pVal = $("#orderPrice").val();
        if (pVal.length < 1) {
            pVal = $("#orderPrice").attr("placeholder");
        }
        var winAmount = getRare() * 1000 * parseInt(pVal) / 1000;
        $("#availableWin b").html(winAmount + "")
        userInputMoney = pVal
        show_bet();
    })


    function clearSelectButtons() {
        $(".game-bd a.btn").removeClass("on");
        $(this).siblings().removeClass('on');
    }

    function getRare() {
        switch (bet) {
            case 1:
                return parseFloat(info.anytwo);
            case 2:
                return parseFloat(info.anyone);
            case 3:
                return parseFloat(info.dxds);
            case 4:
                return parseFloat(info.threefix);
            case 5:
                return parseFloat(info.combinethree);
            case 6:
                return parseFloat(info.combinesix);
            case 7:
                return parseFloat(info.combinethreesum);
            case 8:
                return parseFloat(info.combinesixsum);
            case 9:
                return parseFloat(info.fronttwofix);
            case 10:
                return parseFloat(info.backtwofix);
            case 11:
                return parseFloat(info.onefix);
        }
        return parseFloat("0");
    }

    var show_bet = function () {
        var t = $(".game-type-" + bet);
        bline = []
        t.find('a.on[data-pos]').each(function (i, o) {
            bline.push($(this).data('pos'));
        });

        var isAva = true
        $(".game-type-" + bet + " .btn-box ").each(function () {
            if ($(this).css("display")!=="none" && $(this).find(" a.on ").length < 1 && bet!=11 && bet !== 3 && bet !== 7) {
                //只要有一行没选中就不算
                isAva = false
            }
            // console.log("line--->"+$(this).data('line')+" : "+$(this).find(" a.on ").length)
        })


        bet_n = 0;

        //计算注数 bet_n注数
        switch (bet) {
            case 1:
                bet_n = countOrder1(bline.length, 2)
                break;
            case 2:
                bet_n = countOrder1(bline.length, 1)
                break;
            case 3:
            case 11:
                bet_n = countOrder3()
                break
            case 5:
                bet_n= bline.length * (bline.length - 1)
                break
            case 6:
                bet_n= bline.length * (bline.length - 1) * (bline.length - 2) / 6
                break
            case 7:
                for (let i = 0; i < bline.length; i++) {
                    bet_n=bet_n+zu3[bline[i]-1]
                }
                break
            case 8:
                for (let i = 0; i < bline.length; i++) {
                    bet_n=bet_n+zu6[bline[i]-3]
                }
                break
            case 9:
            case 4:
            case 10:
                bet_n = countOrder2()
                break;
        }

        isAva=isBetAvailable(bline.length,bet)
        setBtnIsAvailable(isAva)
        if (!isAva) {
            return
        }

        console.log("选中:" + bline.length + " 注单：" + bet_n)
        var pVal = $("#orderPrice").val();
        if (pVal.length < 1) {
            pVal = $("#orderPrice").attr("placeholder");
        }

        var winAmount = getRare() * 1000 * parseInt(pVal) / 1000;
        $("#availableWin b").html(winAmount + "")

        $("#bet_num").html("共<b>" + bet_n + "</b>注" + "&nbsp;<b>" + (parseInt(pVal) * bet_n) + "</b>元");
        $('.bet_n').html(bet_n);
        var bet_money = $("input.bet_money").val() || 0;
        $('.bet_total').html(bet_n * bet_money);


    }

    function isBetAvailable(count, index) {
        var isAvailable = true
        switch (index) {
            case 1:
                isAvailable = count > 1;
                break;
            case 4:
                isAvailable = count > 2;
                break
            case 9:
            case 10:
                isAvailable = count > 1;
                break;
            default:
                isAvailable = count > 0;
        }

        return isAvailable
    }

    function setBtnIsAvailable(isAvailable) {
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

    function countOrder1(choose, need) {
        var n = 1
        var nm = 1
        var m = 1

        for (let i = 0; i < choose; i++) {
            n = n * (i + 1);
            if (choose - need - i > 0) {
                nm = nm * (choose - need - i)
            }
            if (need - i > 0) {
                m = m * (need - i)
            }
        }
        return n / nm / m;
    }

    function countOrder2() {
        var count = 1;
        var isAva = true;
        $(".game-type-" + bet + " .btn-box ").each(function () {
            if($(this).css("display")!=="none")
            {
                count = count * $(this).find(" a.on ").length
            }
            // console.log("line--->"+$(this).data('line')+" : "+$(this).find(" a.on ").length)
        })
        return count
    }

    function countOrder3() {
        var count = 0;
        var isAva = true;
        $(".game-type-" + bet + " .btn-box ").each(function () {
            count = count + $(this).find(" a.on ").length
            // console.log("line--->"+$(this).data('line')+" : "+$(this).find(" a.on ").length)
        })
        return count
    }

    //随机数组
    function randomNums(numAmount, count) {
        var nums = [];
        for (let i = 0; i < numAmount; i++) {
            nums.push(i)
        }
        var result = []
        for (let i = 0; i < count; i++) {
            let pos = Math.floor(Math.random() * nums.length)
            result.push(nums[pos])
            nums.splice(pos, 1)
        }
        return result
    }


    //随机数组 返回连接字符串
    function randomNumsStr(numAmount, count, notRepeat) {
        var nums = [];
        for (let i = 0; i < numAmount; i++) {
            nums.push(i)
        }
        var result = ""
        for (let i = 0; i < count; i++) {
            let pos = Math.floor(Math.random() * nums.length)
            result = result + nums[pos] + ","
            if (notRepeat) {
                nums.splice(pos, 1)
            }

        }
        result = result.substring(0, result.length - 1)
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
        if ($(this).hasClass("triangle")) {
            return;
        }
        setBtnIsAvailable(false)
        var a = $(this), d = a.data();
        if (!d.t) return;
        bet = d.t;

        $("#orderPrice").val(userInputMoney)
        $("#availableWin b").html(getRare() * 1000 * userInputMoney / 1000)
        $("#orderPrice").attr("placeholder", minBet);

        $(".betDialogContent .menu").find("a").removeClass("on");
        a.addClass("on")
        $(".sub-menu").hide()
        $('.gamenum').hide()

        $('.gamenum .rank-tit .lotteryType').html(a.text())
        $('.game-type-' + d.t).html("")

        $('.game-type-' + d.t).append("<div class='rank-tit'><span class='change'>" + a.text() +
            "</span><div><span class='orderEdit'>注单编辑 ("+orderCacheArray.size+")</span><span class='choose'>机选</span></div></div>")
        // $('.game-type-' + d.t).append("<div class='randomChoose'><span class='order'>注单编辑</span> <span class='choose'>机选</span></div>")

        var string = "<div class='gameScroll'>"
        for (let j = 0; j < secTitles[d.t - 1].length; j++) {


            var title = "<span class='secTitle' >%title</span>"
            if(secTitles[d.t - 1][j]==="x")
            {
                title= "<span class='secTitle' style='display: none'>%title</span>"
            }
            title = title.replace("%title", secTitles[d.t - 1][j])

            var itemDiv="<div class='btn-box btn-grounp' data-line='%line'>"
            if(secTitles[d.t - 1][j]==="x")
            {
                itemDiv= "<div class='btn-box btn-grounp'  style='display: none' data-line='%line'>"
            }
            string = string + title + itemDiv
            string = string.replace("%line", j);

            var itemAmount = 10;
            var index=0;
            switch (bet)
            {
                case 3:
                    itemAmount=4
                    index=0
                    break
                case 7:
                    itemAmount=27
                    index=1
                    break
                case 8:
                    itemAmount=25
                    index=3
                    break
            }

            var items7 = ['大', '小', '单', '双']
            for (let k = index; k < itemAmount; k++) {
                var item = "<a href='javascript:;' class='btn mini-btn' data-pos='%pos'><div class='h5'>%num</div></a>"
                if (bet === 3) {
                    //大小单双
                    item = item.replace("%num", items7[k]);
                } else {
                    item = item.replace("%num", k);
                }

                item = item.replace("%pos", k);
                string = string + item
            }
            string = string + "</div>"
        }
        string = string + "</div>"
        $('.game-type-' + d.t).append(string)
        $('.game-type-' + d.t).show()

        // window.scrollTo(0, document.body.scrollHeight);
        //下注选择
        $(".game-bd a.btn").click(function () {
            $(this).toggleClass('on');
            show_bet();
        });
        $(".gameScroll").css("maxHeight", document.documentElement.clientHeight * 0.53)

        function onCLickEditOrder()
        {

            $('#orderDialog').modal('show');
            $("#closeOrderDialog").unbind('click')
            $("#closeOrderDialog").click(function (e) {
                $('#orderDialog').modal('hide');
            })

            $("#syncAllBal").unbind('on')
            $("#syncAllBal").on("input", function () {
                $(this).val($(this).val().replace(/^(0+)|[^\d]+/g, ''));
                if (parseInt($(this).val()) > parseInt(maxBet)) {
                    $(this).val(maxBet)
                }

                let bal=$(this).val()
                $(".orderList .singleOrderPrice").each(function (){
                    $(this).val(bal)
                    let key =$(this).data('pos')
                    var data=orderCacheArray.get(key)
                    if(data!=null)
                    {
                        data.unitPrice=parseInt($(this).val())
                        data.money=parseInt($(this).val())
                        orderCacheArray.set(key,data)
                    }
                    calOrderDialogOrder()
                })
            })

            $("#delAllOrders").unbind('click')
            $("#delAllOrders").click(function (){
                orderCacheArray.clear()
                $(".orderEdit").text("注单编辑 ("+orderCacheArray.size+")")
                $(".botOrderEdit").text("注单编辑 ("+orderCacheArray.size+")")
                $(".orderList").html("")
                calOrderDialogOrder();
            })

            $("#random5order").unbind('click')
            $("#random5order").click(function (){
                makeRandomOrder(5)
            })

            $("#random1order").unbind('click')
            $("#random1order").click(function (){
                makeRandomOrder(1)
            })

            $("#confirmOrder").unbind('click')
            $("#confirmOrder").click(function (){
                commitOrders()
            })

            calOrderDialogOrder();
        }

        $(".orderEdit").click(function () {
            onCLickEditOrder()
        })

        $(".botOrderEdit").click(function () {
            onCLickEditOrder()
        })

        $(".rank-tit .choose").click(function () {
            clearSelectButtons()
            var v=0
            var index=0
            switch (d.t) {
                case 1:
                    var nums = randomNums(10,2)
                    for (let i = 0; i < nums.length; i++) {
                        $('.game-type-' + d.t + " a.btn:eq(" + nums[i] + ")").click();
                    }
                    break
                case 2:
                    var nums = randomNums(10,1)
                    for (let i = 0; i < nums.length; i++) {
                        $('.game-type-' + d.t + " a.btn:eq(" + nums[i] + ")").click();
                    }
                    break
                case 3:
                     v = randomNums(3,1)
                     index = randomNums(4,1)
                    $('.game-type-' + d.t + " .btn-box:eq(" + v[0] + ")").find(" a.btn:eq(" + index[0] + ")").click();
                    break
                case 4:
                    for (let k = 0; k < 3; k++) {
                        var nums = randomNums(10,1)
                        $('.game-type-' + d.t + " .btn-box:eq(" + k + ")").find(" a.btn:eq(" + nums[0] + ")").click();
                    }
                    break
                case 5:
                    var nums = randomNums(10,2)
                    for (let i = 0; i < nums.length; i++) {
                        $('.game-type-' + d.t + " a.btn:eq(" + nums[i] + ")").click();
                    }
                    break
                case 6:
                    var nums = randomNums(10,3)
                    for (let i = 0; i < nums.length; i++) {
                        $('.game-type-' + d.t + " a.btn:eq(" + nums[i] + ")").click();
                    }
                    break
                case 7:
                    var nums = randomNums(26,1)
                    for (let i = 0; i < nums.length; i++) {
                        $('.game-type-' + d.t + " a.btn:eq(" + nums[i] + ")").click();
                    }
                    break
                case 8:
                    var nums = randomNums(22,1)
                    for (let i = 0; i < nums.length; i++) {
                        $('.game-type-' + d.t + " a.btn:eq(" + nums[i] + ")").click();
                    }
                    break
                case 9:
                    for (let k = 0; k < 2; k++) {
                        var nums = randomNums(10,1)
                        $('.game-type-' + d.t + " .btn-box:eq(" + k + ")").find(" a.btn:eq(" + nums[0] + ")").click();
                    }
                    break
                case 10:
                    for (let k = 1; k < 3; k++) {
                        var nums = randomNums(10,1)
                        $('.game-type-' + d.t + " .btn-box:eq(" + k + ")").find(" a.btn:eq(" + nums[0] + ")").click();
                    }
                    break
                case 11:
                    v = randomNums(3,1)
                    index = randomNums(10,1)
                    $('.game-type-' + d.t + " .btn-box:eq(" + v[0] + ")").find(" a.btn:eq(" + index[0] + ")").click();
                    break
            }
        })

    });


    function makeRandomOrder(amount)
    {
        //[{"money":3,"orders":1,"gameName":"ry3","unitPrice":"3","codes":[{"pos":0,"code":"579"}]}]
        for (let i = 0; i < amount; i++) {
            var codes=[]
            var sCode=''
            var pos=''
            var completeCodes=[]
            var orders=1

            switch (bet) {
                case 1:
                    sCode=randomNumsStr(10,2,true)
                    codes.push({pos:0,code:sCode})
                    completeCodes.push({pos:0,code:sCode})
                    break
                case 2:
                    sCode=randomNumsStr(10,1,true)
                    codes.push({pos:0,code:sCode})
                    completeCodes.push({pos:0,code:sCode})
                    break
                case 3:
                    pos=randomNumsStr(3,1,true)
                    sCode=randomNumsStr(4,1,true)
                    codes.push({pos:pos,code:sCode})
                    completeCodes.push({pos:pos,code:sCode})
                    break
                case 4:
                    for (let k = 0; k < 3; k++) {
                        var temp=randomNumsStr(10,1,true)
                        codes.push({pos:k,code:temp})
                        completeCodes.push({pos:k,code:temp})
                    }
                    break
                case 5:
                    sCode=randomNumsStr(10,2,true)
                    codes.push({pos:0,code:sCode})
                    completeCodes.push({pos:0,code:sCode})
                    break
                case 6:
                    sCode=randomNumsStr(10,3,true)
                    codes.push({pos:0,code:sCode})
                    completeCodes.push({pos:0,code:sCode})
                    break
                case 7:
                    var num=randomNums(26,1)[0]+1
                    sCode=''+num
                    codes.push({pos:0,code:sCode})
                    completeCodes.push({pos:0,code:sCode})
                    break
                case 8:
                    var num=randomNums(22,1)[0]+3
                    sCode=''+num
                    codes.push({pos:0,code:sCode})
                    completeCodes.push({pos:0,code:sCode})
                    break
                case 9:
                    for (let k = 0; k < 2; k++) {
                        var temp=randomNumsStr(10,1,true)
                        codes.push({pos:k,code:temp})
                        completeCodes.push({pos:k,code:temp})
                    }
                    break
                case 10:
                    for (let k = 1; k < 3; k++) {
                        var temp=randomNumsStr(10,1,true)
                        codes.push({pos:k,code:temp})
                        completeCodes.push({pos:k,code:temp})
                    }
                    break
                case 11:
                    pos=randomNumsStr(3,1,true)
                    sCode=randomNumsStr(10,1,true)
                    codes.push({pos:pos,code:sCode})
                    completeCodes.push({pos:pos,code:sCode})
                    break
            }


            switch (gameCodes[bet-1])
            {
                case 'd3z3':
                    orders= 2
                    break
                case 'd3z6':
                    orders= 1
                    break
                case 'd3z3sum':
                    orders=zu3[parseInt(sCode)-1]
                    break
                case 'd3z6sum':
                    orders=zu6[parseInt(sCode)-3]
                    break
            }

            var data={money:parseInt(minBet)*orders,
                gameNameCn:gameTitles[bet-1],
                gameName:gameCodes[bet-1],
                unitPrice:minBet,
                orders:orders,
                codes:codes,
                completeCodes:completeCodes}
            var arrTemp=[]
            arrTemp.push(data)
            addNewOrder(arrTemp)
        }

        calOrderDialogOrder();
    }

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

    function calOrderDialogOrder()
    {
        var values=orderCacheArray.values()
        var totalMoney=0
        var totalOrders=0
        for (let i = 0; i < orderCacheArray.size; i++) {
            let item=values.next().value
            totalMoney=totalMoney+item.money
            totalOrders=totalOrders+item.orders
        }

        $(".totalMoneySpan").text("共"+totalMoney+"元")
        $(".totalOrderSpan").text("共"+totalOrders+"注")
    }

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

    $(".confirm-pour").click(function () {
        if (!$(this).hasClass("on")) return;

        let num=$("#orderPrice").val()
        if(num.length<1 || parseInt(num)<minBet)
        {
            zy.tips('单注下注金额最少'+minBet+"元");
            return;
        }
        // $("#touzhu").addClass("on"), location.href = "#confirm"
        betNow()
    });

    $(".addOrder").click(function () {
        if (!$(this).hasClass("on")) return;
        // $("#touzhu").addClass("on"), location.href = "#confirm"

        let num=$("#orderPrice").val()
        if(num.length<1 || parseInt(num)<minBet)
        {
            zy.tips('单注下注金额最少'+minBet+"元");
            return;
        }
        addNewOrder(makeOrderData())
        clearSelectButtons()
        show_bet()
    });

    $(".pour-info").find("a.close,a.cancel").click(function () {
        $("#touzhu").removeClass("on"), location.href = "#main"
    });

    function formatDate(time) {
        var date = new Date(time)
        var datevalues = [

            date.getFullYear(),

            date.getMonth(),

            date.getDate(),

            date.getHours(),

            date.getMinutes(),

            date.getSeconds(),

        ];

        return datevalues;

    }

    function formatCountDown(time) {
        var num = parseInt(time)
        var h = Math.floor(time / 3600);
        var m = Math.floor((time / 60 % 60));
        var s = Math.floor((time % 60));
        if(h<10)
        {
            h="0"+h
        }
        if(m<10)
        {
            m="0"+m
        }
        if(s<10)
        {
            s="0"+s
        }
        return h + ":" + m + ":" + s;
    }

    function makeOrderData()
    {
        var betCodes = []
        var completeCodes=[]
        $(".game-type-" + bet + " .btn-box ").each(function () {
            var code = ""
            $(this).find("a.on[data-pos]").each(function (index, val) {
                code = code + $(this).data('pos')+","
            });


            if(code.length>0)
            {
                code=code.substring(0, code.length-1)
                betCodes.push({pos: $(this).data().line, code: code})
            }
            completeCodes.push({pos: $(this).data().line, code: code})
            // console.log("line--->"+$(this).data('line')+" : "+$(this).find(" a.on ").length)
        })

        var pVal = $("#orderPrice").val();
        if (pVal.length < 1) {
            pVal = $("#orderPrice").attr("placeholder");
        }
        var money=parseInt(pVal) * bet_n

        var arr = []
        arr.push({
            money:money,
            orders:bet_n,
            gameNameCn:gameTitles[bet-1],
            gameName: gameCodes[bet - 1],
            unitPrice: $("#orderPrice").val(),
            codes: betCodes,
            completeCodes:completeCodes
        });

        return arr
    }

    function deleteOrder(pos)
    {
        orderCacheArray.delete(pos)
        $(".orderEdit").text("注单编辑 ("+orderCacheArray.size+")")
        $(".botOrderEdit").text("注单编辑 ("+orderCacheArray.size+")")
        $(".orderList .orderListItem img").each(function (){
            if($(this).data("pos")===pos)
            {
                $(this).parent().remove()
            }
        })
        calOrderDialogOrder();
    }

    function addNewOrder(orderData)
    {

        var itemStr=" <div class='orderListItem'>" +
            "                    <img data-pos='%pos' src='/Templates/Old/images/icon_qingchu.png' alt=''>" +
            "                    <div class='orderListContent'>" +
            "                        <p class='itemContent'>%itemContent</p>" +
            "                        <span class='gameItemDetail'>%gameItemDetail</span></div>" +
            "                    <input class='%inclass' %isMul data-pos='%pos' type='number' value='%unitPrice'/>" +
            "                </div>"

        var codes=""
        let list=orderData[0].completeCodes
        let lines=[1,1,3,3,1,1,1,1,2,2,3];
        let titleSuffix=["百位：", "十位：", "个位："]
        for (let i = 0; i < list.length; i++) {
            if(lines[bet-1]>1)
            {
                if(list[i].code.length>0)
                {
                    codes=codes+titleSuffix[list[i].pos]+list[i].code+"|"
                }
            }
            else
            {
                codes=codes+list[i].code+"|"
            }

        }
        codes=codes.substring(0, codes.length-1)

        var gameDetail=orderData[0].gameNameCn+" "+orderData[0].orders+"注 "+orderData[0].money+"元"
        itemStr=itemStr.replaceAll("%pos",""+autoIncrease)
        itemStr=itemStr.replace("%isMul",orderData[0].orders>1?"readonly":"")
        itemStr=itemStr.replace("%inclass",orderData[0].orders>1?"singleOrderPriceNoEdit":"singleOrderPrice")

        var showContent=codes
        if(orderData[0].gameName==='dxds')
        {
            showContent=codes.replaceAll("0","大")
                .replaceAll("1","小")
                .replaceAll("2","单")
                .replaceAll("3","双")
        }

        itemStr=itemStr.replace('%itemContent',showContent)
        itemStr=itemStr.replace('%gameItemDetail',gameDetail)
        itemStr=itemStr.replace('%unitPrice',orderData[0].unitPrice)
        $(".orderList").prepend(itemStr)

        $(".orderList img").click(function (){
            deleteOrder($(this).data('pos'))
        })
        $(".orderList .singleOrderPrice").on("input",function (){
            $(this).val($(this).val().replace(/^(0+)|[^\d]+/g, ''));
            if ($(this).val() > parseInt(maxBet)) {
                $(this).val(maxBet)
            }

            let key =$(this).data('pos')
            var data=orderCacheArray.get(key)
            if(data!=null)
            {

                data.unitPrice=parseInt($(this).val())
                data.money=parseInt($(this).val())
                let detail=orderData[0].gameNameCn+" "+orderData[0].orders+"注 "+data.money+"元"
                $(this).parent().find(".gameItemDetail").text(detail)
                orderCacheArray.set(key,data)
            }
            calOrderDialogOrder()
        })


        orderCacheArray.set(autoIncrease,orderData[0])
        autoIncrease++
        $(".orderEdit").text("注单编辑 ("+orderCacheArray.size+")")
        $(".botOrderEdit").text("注单编辑 ("+orderCacheArray.size+")")
    }

    function betNow() {

        var array=makeOrderData()
        if(array.length<1)
        {
            zy.tips('下注格式错误,请重新选择号码');
            return
        }
        delete array[0].completeCodes

        $("#loadingDiv").show()
        var postData = {game:info.game,userId: info.userid, roomId: info.roomid, betArray: JSON.stringify(array)}
        $.ajax({
            type: "POST",
            dataType: "json",
            url: baseUrl + "/newChatsJava",//url
            data: postData,
            crossDomain: true,
            success: function (result) {
                if (result.code === 0) {
                    clearSelectButtons();
                    show_bet()
                    zy.tips('投注已发送!');
                } else {
                    zy.tips(result.msg,4);
                }
            },
            error: function () {
                zy.tips('下注失败，服务器异常！!');
            },
            complete: function (a, b) {
                $("#loadingDiv").hide()
            }
        });
    }

    function fetchCountDownAndMoney() {
        var postData = {userId: info.userid, roomId: info.roomid, gameName: info.game}

        $.ajax({
            type: "POST",
            dataType: "json",
            url: baseUrl + "/fetchUserWithCountDown",
            data: postData,
            crossDomain: true,
            success: function (result) {
                if (result.code === 0) {
                    orderListDialogRemainTime=result.datas.remainTime
                    nowTerm=result.datas.term
                    $(".timeBalance .betLimit b").html(formatCountDown(orderListDialogRemainTime))
                    $(".timeBalance .betLimit b").data()
                    $(".timeBalance .bal b").html(result.datas.money)
                    isStopCountDown=false
                    clearTimeout(timeoutId)
                    timeoutId=setTimeout(dialogCountDown,1000)
                } else {
                    zy.tips(result.msg);
                }
            },
            error: function () {
                zy.tips('获取用户信息失败');
            }
        });
    }

    function commitOrders() {

        if(orderCacheArray.size<1)
        {
            zy.tips('请先下注')
            return
        }


        let array=[]
        var values=orderCacheArray.values()
        for (let i = 0; i < orderCacheArray.size; i++) {
            const val = values.next().value;
            if(val.unitPrice.length<1 || parseInt(val.unitPrice)<minBet)
            {
                zy.tips('单注下注金额最少'+minBet+"元");
                return;
            }
            delete val.completeCodes
            array.push(val)
        }

        $("#loadingDiv").show()
        var postData = {game:info.game,userId: info.userid, roomId: info.roomid, betArray: JSON.stringify(array)}

        $.ajax({
            type: "POST",
            dataType: "json",
            url: baseUrl + "/newChatsJava",//url
            data: postData,
            crossDomain: true,
            success: function (result) {
                if (result.code === 0) {
                    $("#delAllOrders").click()
                    clearSelectButtons();
                    show_bet()
                    $("#syncAllBal").val("")
                    zy.tips('投注已发送!');
                    fetchCountDownAndMoney();
                } else {
                    zy.tips(result.msg);
                }
            },
            error: function () {
                zy.tips('下注失败，服务器异常！!');
            },
            complete: function (a, b) {
                $("#loadingDiv").hide()
            }
        });
    }

}