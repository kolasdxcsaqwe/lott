$(function () {
    initQXC();
})


var hrefData = parseURL(window.location.href)
var baseUrl = hrefData.protocol + "://" + hrefData.host + ":8653";
var remainTime=0
var timeOutId=-1

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

function initQXC() {

    clearTimeout(timeOutId)
    var info = window.parent.parent.info
    var postData = {userId: info.userid, roomId: info.roomid, gameName: info.game}

    $.ajax({
        type: "POST",
        dataType: "json",
        url: baseUrl + "/fetchOpenTime",
        data: postData,
        crossDomain: true,
        success: function (result) {
            if (result.code === 0) {
                remainTime=result.datas.remainTime;
                if(remainTime>0)
                {
                    $(".titleEndTime").html(formatCountDown(result.datas.remainTime))
                }

                $(".openTime b").html(formatDate(parseInt(result.datas.openTime)))
                $(".term b").html(result.datas.term)
                $(".ball .resultNums").each(function (e,i){
                    console.log("index--->"+e)
                    var num=result.datas.codes.substring(e,e+1)
                    $(this).html(num)
                })
                countDown()
            } else {
                zy.tips(result.msg);
            }
        },
        error: function () {
            zy.tips('获取开奖信息失败');
        }
    });
}

function countDown()
{
    timeOutId=setTimeout(function (){
        remainTime--;
        $(".titleEndTime").html(formatCountDown(remainTime))

        if(remainTime<=0)
        {
            clearTimeout(timeOutId)
        }
        else {
            countDown()
        }
    },1000)
}

function formatCountDown(time) {
    var num = parseInt(time)
    if(time<=0)
    {
        return "00:00:00";
    }
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

function formatDate(time) {
    var date = new Date(time)
    var datevalues = [

        date.getFullYear(),

        date.getMonth()<10?"0"+date.getMonth():date.getMonth(),

        date.getDate()<10?"0"+date.getDate():date.getDate(),

        date.getHours()<10?"0"+date.getHours():date.getHours(),

        date.getMinutes()<10?"0"+date.getMinutes():date.getMinutes(),

        date.getSeconds()<10?"0"+date.getSeconds():date.getSeconds(),

    ];

    return datevalues[0]+"-"+datevalues[1]+"-"+datevalues[2]+" "+datevalues[3]+":"+datevalues[4]+":"+datevalues[5];

}