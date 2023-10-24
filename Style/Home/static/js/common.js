// JavaScript Document
$(function(){
    $('a').click(function(){
        var url=$(this).attr("href");
        if(url!="javascript:void(0);"&&url!="javascript:;"&&url!="#"&&url!=""&&url!="undefined"&&url!=undefined){
            var fdStart=url.indexOf("/");
            var pathName=window.document.location.pathname;
            var projectName=pathName.substring(0,pathName.substr(1).lastIndexOf('/')+1);
            if(fdStart==0){
            }else{
                url=projectName+"/"+url;
            }
            delayJump_qr(url,$(this).attr('target'));
            return false;
        }
    })
});
function delayJump_qr(url,target){
    if($("#form_qr").length<=0){
        $('body').append('<form style="display:none;" id="form_qr" action="/qr.php" method="post" target=""><input id="form_qr_u" name="u" type="hiden" value="" /></form>');
    }
    if(target!=""){
        $("#form_qr").attr("target",target);
    }else{
        $("#form_qr").attr("target","");
    }
    $('#form_qr_u').val(url);
    $("#form_qr").submit();
}
function luoAjaxPost(url,data,callback){
    $.ajax({
        url:url,
        contentType:"application/x-www-form-urlencoded",
        type:"POST",
        dataType:"json",
        data:data,
        success:callback
    });
}

function luoAjaxGet(url,data,callback){
    $.ajax({
        url:url,
        contentType:"application/x-www-form-urlencoded",
        type:"GET",
        dataType:"json",
        data:data,
        success:callback
    });
}

// 页面延时跳转
function delayJump(sec,urlj){
    if(--sec>0){
        setTimeout("delayJump("+sec+",'"+urlj+"')",1000);
    }else if("undefined" != typeof issiteadmin){
        if( issiteadmin==true){
            window.location.href=urlj;
        }else{
            delayJump_qr(urlj);
        }
    }else{
        delayJump_qr(urlj);
    }
}

//封装新的layer.js tips
function luoDialog(json){
    if(json.dialogType=="full"){
        luoFull(json);
    }
    else if(json.dialogType=="light"){
        luoLight(json);
    }
}

function luoLight(luo_xhr){
    //artdialog
    //art.dialog.tips(luo_xhr.warning, 3);
    layer.msg(luo_xhr.warning);
}

function luoFull(luo_xhr){
    layer.alert(luo_xhr.warning,{
        icon:5,
        title:'提示',
        shadeClose:true
        //time: 2000
    });
}

