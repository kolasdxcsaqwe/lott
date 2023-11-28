var sendtime = 0;
var id = 1;
var nowTerm=""

var websocket = null;
var url = "";
var delayRun;
var lockReconnect = false;//避免重复连接


$(function () {

    $('.sendemaill').click(function () { // 重点是这里，从这里向服务器端发送数据
        var msgtxt = $('#Message').val();
        send_msg(msgtxt);
    });

    getUserInfo();
    setInterval(function () {
        getUserInfo()
    }, 30000);

    $(document).ready(function () {
        var myURL = parseURL(window.location.href);
        console.log(myURL.host)
        url = "ws://"+myURL.host+":8653/chat/"+info.roomid+"/" + info.game + "/" + info.userid;
        connect(url,0)
    });

});

function send_msg(msg) {

    // if(info!=undefined && info!=null)
    // {
    //     if(info.game=='ny28' || info.game=='xy28' || info.game=='jnd28')
    //     {
    //         console.log("End--->"+window.frames[0].window.frames[0].document.getElementById("ThisEnd").innerHTML);
    //         var betEnd = window.frames[0].window.frames[0].document.getElementById("ThisEnd").innerHTML;
    //         if (betEnd != null && parseInt(betEnd) < 1) {
    //             zy.tips("下注已截止,请客官等待下期!");
    //             return;
    //         }
    //     }
    // }


    var msgtxt = msg;
    var str = "";
    var date = new Date().format("hh:mm:ss");
    var time = new Date().getTime();

    if (time - sendtime < 2000) {
        zy.tips('距离上次发送时间过短,请稍后再试!');
        return;
    }
    if (msgtxt == "") {
        zy.tips("不能发送空消息!");
    } else {
        $("#loadingDiv").show()
        $.ajax({
            url: '/Application/ajax_chat.php?type=send',
            type: 'post',
            data: {content: msgtxt},
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    sendtime = new Date().getTime();
                    var qihao = "<span style='color:red;font-size:25px;padding:4%;'>" + ' 期号：' + data.betTerm + '</span>'
                    // str = '<div class="saidleft">' +
                    //     '<img src="' + info['headimg'] + '">' +
                    //     '<div class="tousaid">' +
                    //     '<span class="tousaid1">' + info['nickname'] + '</span>&nbsp;&nbsp;' +
                    //     '<span class="tousaid2">' + date + '</span>' + qihao +
                    //     '</div>' +
                    //     '<div class="tsf">' +
                    //     '<b></b>' +
                    //     '<span class="neirongsaid" style="">' + msgtxt + '</span>' +
                    //     '</div>' +
                    //     '</div>';
                    // $('.rightdiv').prepend(str);
                    $('#Message').val('');

                    getUserInfo();
                } else {
                    zy.tips(data.msg);
                }

            },
            error: function () {

            },
            complete: function (a, b) {
                $("#loadingDiv").hide()
            }
        });
    }
}

function getUserInfo() {
    $.ajax({
        url: '/Application/ajax_getuserinfo.php',
        type: 'get',
        cache: false,
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                $('.balance').html(data.price);
                $('.online').html(data.online);
            } else {
                alert('登录过期,请重新登录！');
                //window.location.href="http://" + location.host + "/?room=" + info['roomid'];
                window.location.href = "http://" + location.host + "/LoginAndRegister";
            }
        },
        error: function () {
        }
    });
}

function FirstGetContent() {
    $.ajax({
        url: '/Application/ajax_chat.php?type=first',
        type: 'get',
        dataType: 'json',
        success: function (data) {
            nowTerm=data.betTerm
            addMessage(data.list);
            WelcomMsg(welcome, welHeadimg);

            setInterval(updateContent, 2000);
        },
        error: function () {
        }
    });
    $('#messageLoading').remove();

}

function updateContent() {
    $.ajax({
        url: '/Application/ajax_chat.php?type=update&id=' + id,
        type: 'get',
        dataType: 'json',
        success: function (data) {
            addMessage(data);
        },
        error: function () {
        }
    });
}

function addMessage(data) {
    if (data == null || data.length < 0) {
        return;
    }

    //S1代理  S2待定  S3机器人  S4全局公告
    var str = "";
    for (i = 0; i < data.length; i++) {
        if (parseInt(data[i].id) > id) {
            id = data[i].id;
        }

        var type = data[i].type;
        if (type.substr(0, 1) == 'U') {  //白色
            var qihao = ""
            if(data[i].betTerm!==undefined && data[i].betTerm!=='' && data[i].betTerm!==null)
            {
                qihao="<span style='color:red;font-size:25px;padding:4%;'>" + ' 期号：' + data[i].betTerm + '</span>'
            }

            str += '<div class="saidleft">' +
                '<img src="' + data[i].headimg + '">' +
                '<div class="tousaid">' +
                '<span class="tousaid1">' + data[i].username + '</span>&nbsp;&nbsp;' +
                '<span class="tousaid2">' + data[i].addtime + '</span>' + qihao +
                '</div>' +
                '<div class="tsf">' +
                '<b></b>' +
                '<span class="neirongsaid" style="">' + data[i].content + '</span>' +
                '</div>' +
                '</div>';
        } else if (type == 'S3') {  //黄色
            var headimg = data[i].headimg == "" ? "/Style/images/robot.png" : data[i].headimg;
            str += '<div class="saidright">' +
                '<img src="' + headimg + '">' +
                '<div class="tousaidl">' +
                '<span class="tousaid2">' + data[i].addtime + '</span>&nbsp;&nbsp;' +
                '<span class="tousaid1">' + data[i].username + '</span>' +
                '</div>' +
                '<div class="ts">' +
                '<b></b>' +
                '<span class="neirongsaidl" style="">' + data[i].content + '</span>' +
                '</div>' +
                '</div>';
        } else if (type == 'S1') {  //绿色
            var headimg = data[i].headimg == "" ? "/Style/images/Sys.png" : data[i].headimg;
            str += '<div class="saidright">' +
                '<img src="' + headimg + '">' +
                '<div class="tousaidl">' +
                '<span class="tousaid2">' + data[i].addtime + '</span>&nbsp;&nbsp;' +
                '<span class="tousaid1">' + data[i].username + '</span>' +
                '</div>' +
                '<div class="ts">' +
                '<b style="border-color:transparent transparent transparent #98E165;"></b>' +
                '<span class="neirongsaidl" style="background-color:#98E165;">' + data[i].content + '</span>' +
                '</div>' +
                '</div>';
        }
    }
    $('.rightdiv').prepend(str);
}

function WelcomMsg(data, welHeadimg) {
    if (data == null || data.length < 0) {
        return;
    }
    var str = "";
    if (welHeadimg == '') {
        welHeadimg = "/Style/images/Sys.png";
    }
    for (i = 0; i < data.length; i++) {
        sendtime = new Date().format("hh:mm:ss");
        str += '<div class="saidright">' +
            '<img src="' + welHeadimg + '">' +
            '<div class="tousaidl">' +
            '<span class="tousaid2">' + sendtime + '</span>&nbsp;&nbsp;' +
            '<span class="tousaid1">管理员</span>' +
            '</div>' +
            '<div class="ts">' +
            '<b style="border-color:transparent transparent transparent #98E165;"></b>' +
            '<span class="neirongsaidl" style="background-color:#98E165;">' + data[i] + '</span>' +
            '</div>' +
            '</div>';
    }
    $('.rightdiv').prepend(str);
}

Date.prototype.format = function (format) {
    var o = {
        "M+": this.getMonth() + 1, //month
        "d+": this.getDate(),    //day
        "h+": this.getHours(),   //hour
        "m+": this.getMinutes(), //minute
        "s+": this.getSeconds(), //second
        "q+": Math.floor((this.getMonth() + 3) / 3),  //quarter
        "S": this.getMilliseconds() //millisecond
    }
    if (/(y+)/.test(format)) format = format.replace(RegExp.$1,
        (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o) if (new RegExp("(" + k + ")").test(format))
        format = format.replace(RegExp.$1,
            RegExp.$1.length == 1 ? o[k] :
                ("00" + o[k]).substr(("" + o[k]).length));
    return format;
}

//重试连接socket
function connect(url,delay) {
    if(lockReconnect) {
        return;
    };
    lockReconnect = true;
    //没连接上会一直重连，设置延迟避免请求过多
    clearTimeout(delayRun)
    setTimeout(function () {
        createWebSocket(url);
    },delay);
}

function createWebSocket() {
    //判断当前浏览器是否支持WebSocket
    if('WebSocket' in window){
        websocket = new WebSocket(url);
    }
    else{
        alert('当前浏览器不支持，请更换浏览器')
    }

    //连接发生错误的回调方法
    websocket.onerror = function(){
        // setMessageInnerHTML("error");
        console.log(' onerror');
    };

    //连接成功建立的回调方法
    websocket.onopen = function(){
        //setMessageInnerHTML("open");
        console.log(" Socket is On");
        //心跳检测重置
        websocket.send('heartbeat');

    }

    //接收到消息的回调方法
    websocket.onmessage = function(event){
        // 维持心跳
        console.log("onmessage==>"+event.data)

        if(event.data ==='heartbeat'){
            setTimeout(function(){
                //这里发送一个心跳，后端收到后，返回一个心跳消息，
                //onmessage拿到返回的心跳就说明连接正常
                websocket.send('heartbeat');
            }, 5000)
        }else
        {
            var jsonOBJ=JSON.parse(event.data);
            if(jsonOBJ!=null && jsonOBJ!=undefined)
            {
                if(jsonOBJ.datas.betTerm!=null)
                {
                    if(info!=undefined && info!=null)
                    {
                        if(info.game=='ny28' || info.game=='xy28' || info.game=='jnd28')
                        {
                            if(jsonOBJ.datas.betTerm!==undefined && jsonOBJ.datas.betTerm!=='' && jsonOBJ.datas.betTerm!==null && parseInt(nowTerm) < parseInt(jsonOBJ.datas.betTerm))
                            {
                                nowTerm=jsonOBJ.datas.betTerm;
                                if(window.frames.length>0 && window.frames[0].window.frames.length>0)
                                {
                                    if(window.frames[0].window.frames[0].window!=null)
                                    {
                                        window.frames[0].window.frames[0].window.init()
                                    }
                                }
                            }
                        }
                    }

                }

                addMessage(jsonOBJ.datas.list);
            }
        }
    }

    //连接关闭的回调方法
    websocket.onclose = function(){
        // websocket.setMessageInnerHTML("close");
        console.log(" Socket closed");
        lockReconnect = false;
        connect(url,5000);
    }
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