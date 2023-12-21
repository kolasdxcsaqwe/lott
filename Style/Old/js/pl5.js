$(function () {
    let maxBet = info.maxbet;
    let minBet = info.minbet;
    var userInputMoney = minBet
    var hrefData = parseURL(window.location.href)
    var baseUrl = hrefData.protocol + "://" + hrefData.host + ":8653";
    var orderListDialogRemainTime = 0
    var isStopCountDown = false
    var nowTerm = ""
    var orderCacheArray = new Map()//注单列表数据
    var autoIncrease = 0;//pos 计数
    var timeoutId = 0
    var a, b, c, d, bet = 1, bet_n = 0, bline, bval;
    var douNiuTitles = ["无牛", "牛一", "牛二", "牛三", "牛四", "牛五", "牛六", "牛七", "牛八", "牛九", "牛牛"]

    var secTitles = [[""], [""], ["万位", "千位", "百位", "十位", "个位"], ["niu"],
        ["万位", "千位", "千位", "百位", "十位"], ["千位", "百位", "十位"], ["万位", "千位",], ["万位", "千位", "百位", "十位", "个位"]];
    var gameCodes = ['ry3', 'ry2', 'dxds', 'dn', 'd5', 'd3', 'd2', 'd1']
    var gameTitles = ['任选3', '任选2', '大小单双', '斗牛', '前5定位', '前3定位', '前2定位', '定位胆']

    var tabsCode = ["xy28", "ny28", "jnd28", "qxc", "pl5", "lhc", "twk3", "jslhc", "jsssc", "pk10", "fc3d"]
    var logoPath = {
        xy28: '/Style/Home/images/xy28-logo.png',
        ny28: '/Style/Home/images/ny28-logo.png',
        jnd28: '/Style/Home/images/jnd28-logo.png',
        qxc: '/Style/Home/images/qxc-logo.png',
        pl5: '/Style/Home/images/pl5-logo.png',
        lhc: '/Style/Home/images/lhc-logo.png',
        twk3: '/Style/Home/images/twk3-logo.png',
        jslhc: '/Style/Home/images/jslhc-logo.png',
        jsssc: '/Style/Home/images/jsssc-logo.png',
        fc3d: '/Style/Home/images/fc3d-logo.png',
        pk10: '/Style/Home/images/pk10-logo.png'
    }

    makeTabs();

    function makeTabs() {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: baseUrl + "/getALlLotteryStatus",//url
            data: {game: "xy28,ny28,jnd28,qxc,pl5,lhc,twk3,jslhc,jsssc,pk10,fc3d"},
            crossDomain: true,
            success: function (result) {
                $(".zytips").css("display", "none")
                if (result.code === 0) {
                    for (let i = 0; i < tabsCode.length; i++) {
                        let obj = result.datas[tabsCode[i]]
                        if (obj !== undefined && obj.status > 0) {
                            addTab(tabsCode[i], obj.title, logoPath[tabsCode[i]])
                        }
                    }

                } else {
                    zy.tips(result.msg);
                }
            },
            error: function () {
            },
            complete: function (a, b) {
                $("#loadingDiv").hide()
            }
        });
    }

    function addTab(gameName, title, logo) {
        var item = "<li> <a href='/qr.php?room=%roomId&amp;g=%gameName'>" +
            "<img src='%logo' title='%title'> " +
            "<font>%title</font></a> </li>"
        item = item.replace("%gameName", gameName)
        item = item.replaceAll("%title", title)
        item = item.replace("%logo", logo)
        item = item.replace("%roomId", info.roomid)
        $("#ss_menu ul").append(item)
    }

    var dialogCountDown = function () {
        orderListDialogRemainTime--
        if (orderListDialogRemainTime < 1) {
            $(".timeBalance .betLimit b").html("00:00:00")
        } else {
            $(".timeBalance .betLimit b").html(formatCountDown(orderListDialogRemainTime))
        }
        if (!isStopCountDown && orderListDialogRemainTime > 0) {
            clearTimeout(timeoutId)
            timeoutId = setTimeout(function () {
                dialogCountDown()
            }, 1000)
        }
    }


    $('#betDialog').on("hide.bs.modal", function () {
        clearSelectButtons();
        $(".infuse").hide();

    })

    $('#orderDialog').on("show.bs.modal", function () {
        fetchCountDownAndMoney()
        $(".timeBalance .betLimit").unbind('click')
        $(".timeBalance .betLimit").click(function (e) {
            fetchCountDownAndMoney()
        })
    })
    $('#orderDialog').on("hide.bs.modal", function () {
        isStopCountDown = true
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
                return parseFloat(info.anythree);
            case 2:
                return parseFloat(info.anytwo);
            case 3:
                return parseFloat(info.dxds);
            case 4:
                var rate = 0.0
                var t = $(".game-type-" + bet);
                t.find('a.on[data-pos]').each(function (i, o) {
                    var pos = $(this).data('pos')
                    rate = pos > 0 ? info.youniu : info.wuniu
                });
                return rate;
            case 5:
                return parseFloat(info.fivefix);
            case 6:
                return parseFloat(info.threefix);
            case 7:
                return parseFloat(info.twofix);
            case 8:
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
            if ($(this).css("display") !== "none" && $(this).find(" a.on ").length < 1 && bet !== 3 && bet !== 7) {
                //只要有一行没选中就不算
                isAva = false
            }
            // console.log("line--->"+$(this).data('line')+" : "+$(this).find(" a.on ").length)
        })


        bet_n = 0;

        //计算注数 bet_n注数
        switch (bet) {
            case 1:
                bet_n = countOrder1(bline.length, 3)
                break;
            case 2:
                bet_n = countOrder1(bline.length, 2)
                break;
            case 3:
            case 7:
                bet_n = countOrder3()
                break
            case 4:
            case 5:
            case 6:
            case 8:
                bet_n = countOrder2()
                break;
        }

        isAva = isAva && setOrderCount(bline.length, bet)
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

    function setOrderCount(count, index) {
        var isAvailable = true
        switch (index) {
            case 1:
                isAvailable = count > 2;
                break;
            case 2:
                isAvailable = count > 1;
                break;
            case 3:
            case 7:
                isAvailable = count > 0;
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
            if ($(this).css("display") !== "none") {
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
            "</span><div><span class='orderEdit'>注单编辑 (" + orderCacheArray.size + ")</span><span class='choose'>机选</span></div></div>")
        // $('.game-type-' + d.t).append("<div class='randomChoose'><span class='order'>注单编辑</span> <span class='choose'>机选</span></div>")

        var string = "<div class='gameScroll'>"
        for (let j = 0; j < secTitles[d.t - 1].length; j++) {


            var title = "<span class='secTitle' >%title</span>"
            if (secTitles[d.t - 1][j] === "niu") {
                title = "<span class='secTitle' style='display: none'>%title</span>"
            }
            title = title.replace("%title", secTitles[d.t - 1][j])

            var itemDiv = "<div class='btn-box btn-grounp' data-line='%line'>"

            string = string + title + itemDiv
            string = string.replace("%line", j);

            var itemAmount = 10;
            switch (bet) {
                case 3:
                    //大小单双
                    itemAmount = 4;
                    break
                case 4:
                    //斗牛
                    itemAmount = 11;
                    break
            }
            var items7 = ['大', '小', '单', '双']
            for (let k = 0; k < itemAmount; k++) {
                var item = "<a href='javascript:;' class='btn mini-btn' data-pos='%pos'><div class='h5'>%num</div></a>"
                if (bet === 3) {
                    //大小单双
                    item = item.replace("%num", items7[k]);
                } else if (bet === 4) {
                    item = item.replace("%num", douNiuTitles[k]);
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

        function onCLickEditOrder() {

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

                let bal = $(this).val()
                $(".orderList .singleOrderPrice").each(function () {
                    $(this).val(bal)
                    let key = $(this).data('pos')
                    var data = orderCacheArray.get(key)
                    if (data != null) {
                        data.unitPrice = parseInt($(this).val())
                        data.money = parseInt($(this).val())
                        orderCacheArray.set(key, data)
                    }
                    calOrderDialogOrder()
                })
            })

            $("#delAllOrders").unbind('click')
            $("#delAllOrders").click(function () {
                orderCacheArray.clear()
                $(".orderEdit").text("注单编辑 (" + orderCacheArray.size + ")")
                $(".botOrderEdit").text("注单编辑 (" + orderCacheArray.size + ")")
                $(".orderList").html("")
                calOrderDialogOrder();
            })

            $("#random5order").unbind('click')
            $("#random5order").click(function () {
                makeRandomOrder(5)
            })

            $("#random1order").unbind('click')
            $("#random1order").click(function () {
                makeRandomOrder(1)
            })

            $("#confirmOrder").unbind('click')
            $("#confirmOrder").click(function () {
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
            switch (d.t) {
                case 1:
                    var nums = randomNums(10, 3)
                    for (let i = 0; i < nums.length; i++) {
                        $('.game-type-' + d.t + " a.btn:eq(" + nums[i] + ")").click();
                    }
                    break
                case 2:
                    var nums = randomNums(10, 2)
                    for (let i = 0; i < nums.length; i++) {
                        $('.game-type-' + d.t + " a.btn:eq(" + nums[i] + ")").click();
                    }
                    break
                case 3:
                    var v = randomNums(5, 1)
                    var index = randomNums(4, 1)
                    $('.game-type-' + d.t + " .btn-box:eq(" + v[0] + ")").find(" a.btn:eq(" + index[0] + ")").click();
                    break
                case 4:
                    var nums = randomNums(11, 1)
                    $('.game-type-' + d.t + " .btn-box:eq(" + 0 + ")").find(" a.btn:eq(" + nums[0] + ")").click();
                    break
                case 5:
                    for (let k = 0; k < 5; k++) {
                        var nums = randomNums(10, 1)
                        $('.game-type-' + d.t + " .btn-box:eq(" + k + ")").find(" a.btn:eq(" + nums[0] + ")").click();
                    }
                    break
                case 6:
                    for (let k = 0; k < 3; k++) {
                        var nums = randomNums(10, 1)
                        $('.game-type-' + d.t + " .btn-box:eq(" + k + ")").find(" a.btn:eq(" + nums[0] + ")").click();
                    }
                    break
                case 7:
                    for (let k = 0; k < 2; k++) {
                        var nums = randomNums(10, 1)
                        $('.game-type-' + d.t + " .btn-box:eq(" + k + ")").find(" a.btn:eq(" + nums[0] + ")").click();
                    }
                    break
                case 8:
                    var pos = randomNums(5, 1)
                    var num = randomNums(10, 1)
                    $('.game-type-' + d.t + " .btn-box:eq(" + pos + ")").find(" a.btn:eq(" + num + ")").click();
                    break
            }
        })

    });


    function makeRandomOrder(amount) {
        //[{"money":3,"orders":1,"gameName":"ry3","unitPrice":"3","codes":[{"pos":0,"code":"579"}]}]
        for (let i = 0; i < amount; i++) {
            var codes = []
            var completeCodes = []
            switch (bet) {
                case 1:
                    codes.push({pos: 0, code: randomNumsStr(10,3, true)})
                    completeCodes.push({pos: 0, code: randomNumsStr(10,3, true)})
                    break
                case 2:
                    codes.push({pos: 0, code: randomNumsStr(10,2, true)})
                    completeCodes.push({pos: 0, code: randomNumsStr(10,2, true)})
                    break
                case 3:
                    codes.push({pos: randomNumsStr(5,1, true), code: randomNumsStr(4,1, true)})
                    completeCodes.push({pos: randomNumsStr(5,1, true), code: randomNumsStr(4,1, true)})
                    break
                case 4:
                    codes.push({pos: 0, code: randomNumsStr(11,1, true)})
                    completeCodes.push({pos: 0, code: randomNumsStr(11,1, true)})
                    break
                case 5:
                    for (let k = 0; k < 5; k++) {
                        codes.push({pos: k, code: randomNumsStr(10,1)})
                        completeCodes.push({pos: k, code: randomNumsStr(10,1)})
                    }
                    break
                case 6:
                    for (let k = 0; k < 3; k++) {
                        codes.push({pos: k, code: randomNumsStr(10,1)})
                        completeCodes.push({pos: k, code: randomNumsStr(10,1)})
                    }
                    break
                case 7:
                    for (let k = 0; k < 2; k++) {
                        codes.push({pos: k, code: randomNumsStr(10,1)})
                        completeCodes.push({pos: k, code: randomNumsStr(10,1)})
                    }
                    break
                case 8:
                    var pos= randomNumsStr(5,1, true)
                    var code=randomNumsStr(10,1, true)
                    codes.push({pos: pos, code: code})
                    completeCodes.push({pos: pos, code: code})
                    break
            }

            var data = {
                money: parseInt(minBet),
                gameNameCn: gameTitles[bet - 1],
                gameName: gameCodes[bet - 1],
                unitPrice: minBet,
                orders: 1,
                codes: codes,
                completeCodes: completeCodes
            }
            var arrTemp = []
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

    function calOrderDialogOrder() {
        var values = orderCacheArray.values()
        var totalMoney = 0
        var totalOrders = 0
        for (let i = 0; i < orderCacheArray.size; i++) {
            let item = values.next().value
            totalMoney = totalMoney + item.money
            totalOrders = totalOrders + item.orders
        }

        $(".totalMoneySpan").text("共" + totalMoney + "元")
        $(".totalOrderSpan").text("共" + totalOrders + "注")
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
        // $("#touzhu").addClass("on"), location.href = "#confirm"
        betNow()
    });

    $(".addOrder").click(function () {
        if (!$(this).hasClass("on")) return;
        // $("#touzhu").addClass("on"), location.href = "#confirm"
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
        if (h < 10) {
            h = "0" + h
        }
        if (m < 10) {
            m = "0" + m
        }
        if (s < 10) {
            s = "0" + s
        }
        return h + ":" + m + ":" + s;
    }

    function makeOrderData() {
        var betCodes = []
        var completeCodes = []
        $(".game-type-" + bet + " .btn-box ").each(function () {
            var code = ""
            $(this).find("a.on[data-pos]").each(function (index, val) {
                code = code + $(this).data('pos') + ","
            });


            if (code.length > 0) {
                code = code.substring(0, code.length - 1)
                betCodes.push({pos: $(this).data().line, code: code})
            }
            completeCodes.push({pos: $(this).data().line, code: code})
            // console.log("line--->"+$(this).data('line')+" : "+$(this).find(" a.on ").length)
        })

        var pVal = $("#orderPrice").val();
        if (pVal.length < 1) {
            pVal = $("#orderPrice").attr("placeholder");
        }
        var money = parseInt(pVal) * bet_n

        var arr = []
        arr.push({
            money: money,
            orders: bet_n,
            gameNameCn: gameTitles[bet - 1],
            gameName: gameCodes[bet - 1],
            unitPrice: $("#orderPrice").val(),
            codes: betCodes,
            completeCodes: completeCodes
        });

        return arr
    }

    function deleteOrder(pos) {
        orderCacheArray.delete(pos)
        $(".orderEdit").text("注单编辑 (" + orderCacheArray.size + ")")
        $(".botOrderEdit").text("注单编辑 (" + orderCacheArray.size + ")")
        $(".orderList .orderListItem img").each(function () {
            if ($(this).data("pos") === pos) {
                $(this).parent().remove()
            }
        })
        calOrderDialogOrder();
    }

    function addNewOrder(orderData) {

        var itemStr = " <div class='orderListItem'>" +
            "                    <img data-pos='%pos' src='/Templates/Old/images/icon_qingchu.png' alt=''>" +
            "                    <div class='orderListContent'>" +
            "                        <p class='itemContent'>%itemContent</p>" +
            "                        <span class='gameItemDetail'>%gameItemDetail</span></div>" +
            "                    <input class='%inclass' %isMul data-pos='%pos' type='number' value='%unitPrice'/>" +
            "                </div>"

        var codes = ""
        let list = orderData[0].completeCodes
        let titleSuffix = ["万位", "千位", "百位", "十位", "个位"]
        for (let i = 0; i < list.length; i++) {
            if (list.length > 1) {
                if (list[i].code.length > 0) {
                    codes = codes + titleSuffix[list[i].pos] + list[i].code + "|"
                }
            } else {
                codes = codes + list[i].code + "|"
            }

        }
        codes = codes.substring(0, codes.length - 1)

        var gameDetail = orderData[0].gameNameCn + " " + orderData[0].orders + "注 " + orderData[0].money + "元"
        itemStr = itemStr.replaceAll("%pos", "" + autoIncrease)
        itemStr = itemStr.replace("%isMul", orderData[0].orders > 1 ? "readonly" : "")
        itemStr = itemStr.replace("%inclass", orderData[0].orders > 1 ? "singleOrderPriceNoEdit" : "singleOrderPrice")

        var showContent = codes
        if (orderData[0].gameName === 'dxds') {
            showContent = codes.replaceAll("0", "大")
                .replaceAll("1", "小")
                .replaceAll("2", "单")
                .replaceAll("3", "双")
        }

        itemStr = itemStr.replace('%itemContent', showContent)
        itemStr = itemStr.replace('%gameItemDetail', gameDetail)
        itemStr = itemStr.replace('%unitPrice', orderData[0].unitPrice)
        $(".orderList").prepend(itemStr)

        $(".orderList img").click(function () {
            deleteOrder($(this).data('pos'))
        })
        $(".orderList .singleOrderPrice").on("input", function () {
            $(this).val($(this).val().replace(/^(0+)|[^\d]+/g, ''));
            if ($(this).val() > parseInt(maxBet)) {
                $(this).val(maxBet)
            }

            let key = $(this).data('pos')
            var data = orderCacheArray.get(key)
            if (data != null) {

                data.unitPrice = parseInt($(this).val())
                data.money = parseInt($(this).val())
                let detail = orderData[0].gameNameCn + " " + orderData[0].orders + "注 " + data.money + "元"
                $(this).parent().find(".gameItemDetail").text(detail)
                orderCacheArray.set(key, data)
            }
            calOrderDialogOrder()
        })


        orderCacheArray.set(autoIncrease, orderData[0])
        autoIncrease++
        $(".orderEdit").text("注单编辑 (" + orderCacheArray.size + ")")
        $(".botOrderEdit").text("注单编辑 (" + orderCacheArray.size + ")")
    }

    function betNow() {

        var array = makeOrderData()
        if (array.length < 1) {
            zy.tips('下注格式错误,请重新选择号码');
            return
        }
        delete array[0].completeCodes

        $("#loadingDiv").show()
        var postData = {game: info.game, userId: info.userid, roomId: info.roomid, betArray: JSON.stringify(array)}
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
                    zy.tips(result.msg, 4);
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
                    orderListDialogRemainTime = result.datas.remainTime
                    nowTerm = result.datas.term
                    $(".timeBalance .betLimit b").html(formatCountDown(orderListDialogRemainTime))
                    $(".timeBalance .betLimit b").data()
                    $(".timeBalance .bal b").html(result.datas.money)
                    isStopCountDown = false
                    clearTimeout(timeoutId)
                    timeoutId = setTimeout(dialogCountDown, 1000)
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

        if (orderCacheArray.size < 1) {
            zy.tips('请先下注')
            return
        }
        $("#loadingDiv").show()
        let array = []
        var values = orderCacheArray.values()
        for (let i = 0; i < orderCacheArray.size; i++) {
            var val = values.next().value
            delete val.completeCodes
            array.push(val)
        }
        var postData = {game: info.game, userId: info.userid, roomId: info.roomid, betArray: JSON.stringify(array)}

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

})