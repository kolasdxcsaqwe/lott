$(function(){
    $('#about .btn-close').click(function(){
        $('#about').hide();
    });
    $('.item-about').click(function(){
        $('.about-info').hide();
        $('#about').show();
        return false;
    });
    $('#kefu .btn-close').click(function(){
        $('#kefu').hide();
    });
    $('.item-kefu').click(function(){
        $('.about-info').hide();
        $('#kefu').show();
        return false;
    });
    $('#shangfen .btn-close').click(function(){
        $('#shangfen').hide();
    });
    $('.item-shangfen').click(function(){
        $('.about-info').hide();
        $('#shangfen').show();
        return false;
    });
    $('.style-bt li a').click(function(){
        $('.style-bt li a').removeClass('curr');
        $(this).addClass('curr');
    });
    $('#butSend').click(function(){
        $("#butSend").prop("disabled",true);
        var msgtxt=$('.style-bt ul li a.curr').text();
        var msgnum=$('#msg').val();
        if(isNaN(msgnum) || msgnum==""){
            alert('请正确输入金额');
            return;
        }
        msgtxt+=msgnum;
        $.post('ajax_chat.php',{
            'message':msgtxt,
            'chatroom':"msg"
        },function(data){
            if(data.erroInfo!=""){
                alert(data.erroInfo);
            }
            $('#msg').val('');
            $("#butSend").prop("disabled",false);
        },'JSON');
        return false;
    });
    if($('.head-menu').length>0){
        var len=$('.head-menu li').length;
        var menu=100/len+"%";
        $('.head-menu li').css({'width':menu});
    }
});