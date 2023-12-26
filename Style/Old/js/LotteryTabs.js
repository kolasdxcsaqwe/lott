var hrefData = parseURL(window.location.href)
var baseUrl = hrefData.protocol + "://" + hrefData.host + ":8653";
var tabsCode=["xy28","ny28","jnd28","qxc","pl5","lhc","twk3","jslhc","jsssc","pk10","fc3d"]
var logoPath={xy28:'/Style/Home/images/xy28-logo.png',
    ny28:'/Style/Home/images/ny28-logo.png',
    jnd28:'/Style/Home/images/jnd28-logo.png',
    qxc:'/Style/Home/images/qxc-logo.png?t=324',
    pl5:'/Style/Home/images/pl5-logo.png?t=324',
    lhc:'/Style/Home/images/lhc-logo.png',
    twk3:'/Style/Home/images/twk3-logo.png',
    jslhc:'/Style/Home/images/jslhc-logo.png',
    jsssc:'/Style/Home/images/jsssc-logo.png',
    fc3d:'/Style/Home/images/fc3d-logo.png?t=324',
    pk10:'/Style/Home/images/pk10-logo.png'
}

$(function(){
    makeTabs();

    function makeTabs()
    {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: baseUrl + "/getALlLotteryStatus",//url
            data: {game:"xy28,ny28,jnd28,qxc,pl5,lhc,twk3,jslhc,jsssc,pk10,fc3d"},
            crossDomain: true,
            success: function (result) {
                $(".zytips").css("display", "none")
                if (result.code === 0) {
                    for (let i = 0; i <tabsCode.length ; i++) {
                        let obj=result.datas[tabsCode[i]]
                        if(obj!==undefined && obj.status>0)
                        {
                            addTab(tabsCode[i],obj.title,logoPath[tabsCode[i]])
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

    function addTab(gameName,title,logo)
    {
        var item="<li> <a href='/qr.php?room=%roomId&amp;g=%gameName'>" +
            "<img src='%logo' title='%title'> " +
            "<font>%title</font></a> </li>"
        item=item.replace("%gameName",gameName)
        item=item.replaceAll("%title",title)
        item=item.replace("%logo",logo)
        item=item.replace("%roomId",info.roomid)
        $("#ss_menu ul").append(item)
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
})
