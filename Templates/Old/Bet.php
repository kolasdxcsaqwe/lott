<?php
include_once(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
$game = $_COOKIE['game'];

$dxdsTitles = array('大', '小', '单', '双');
$douNiuTitles = array("无牛", "牛一", "牛二", "牛三", "牛四", "牛五", "牛六", "牛七", "牛八", "牛九", "牛牛");


function getGameNameCN($str)
{
    $json = json_decode($str);
    return $json->gameNameCn;
}

function formatTime($str)
{
    $time = strtotime($str);
    $front = date("m-d", $time);
    $end = date("H:i:s", $time);
    return $front . "<br>" . $end;
}

function formatJsonContent($str,$game)
{
    global $dxdsTitles,$douNiuTitles;
    $json = json_decode($str);

    $titles=null;
    switch ($game)
    {
        case 'pl5':
            $titles = array('万位','千位', '百位', '十位', '个位');
            break;
        case 'qxc':
            $titles = array('千位', '百位', '十位', '个位');
            break;
        case 'fc3d':
            $titles = array( '百位', '十位', '个位');
            break;
    }
    if($titles==null)
    {
        return $str;
    }

    $result = "";
    $arrayCodes = $json->codes;
    $lines=$json->lines;

    $gameName = $json->gameName;

    for ($i = 0; $i < sizeof($arrayCodes); $i++) {
        $code = $arrayCodes[$i]->code;
        $title = $titles[$arrayCodes[$i]->pos];
        if ($code != null && strlen($code) > 0) {
            if($lines!=null && $lines>1)
            {
                $result = $result . $title . ":";
            }
            $codeArray = explode(',', $code);

            for ($j = 0; $j < count($codeArray); $j++) {
                if ( $gameName == 'dxds') {
                    $result = $result . $dxdsTitles[$codeArray[$j]];
                }
                elseif($gameName=='dn' && $game=='pl5')
                {
                    $result = $result . $douNiuTitles[$codeArray[$j]]." ";
                }
                else {
                    $result = $result . $codeArray[$j];
                }
            }
            $result = $result . "<br>";
        }

    }
    return $result;
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="/Style/Old/css/bootstrap.min.css"/>
    <script src="/Style/Old/js/jquery.min.js"></script>
    <script src="/Style/Old/js/utils.js"></script>
    <script src="/Style/Old/lib/table/bootstrap-table.js"></script>
    <script src="/Style/Old/lib/table/locale/bootstrap-table-zh-CN.js"></script>
    <link rel="stylesheet" href="/Style/Old/lib/table/bootstrap-table.css"/>
</head>
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        background: #000 url(/Style/Xs/Public/images/bg.png);
        font-size: 24px;
        font-weight: bold;
    }
</style>
<style>
    .win {
        color: green;
        width: 10%;
    }

    .lose {
        color: red;
        width: 10%;
    }

    .che {
        color: #428BCA;
        font-weight: bold;
        width: 10%;
    }
    .td20p{
        width: 20%;
        text-align: center;
        vertical-align: middle;
        padding: 10% 0;
    }
    .td10p{
        width: 10%;
        text-align: center;
        padding: 10% 0;
    }
</style>

<body>
<div  align="center">
    <div class="panel panel-info">
        <div class="panel-heading">
            未结算投注
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered " style="text-align:center;">

                <?php
                if ($game == 'qxc' || $game == 'pl5' || $game == 'fc3d') {
                    ?>
                    <thead>
                    <tr>
                        <th class="td10p">期号</th>
                        <th class="td20p">内容</th>
                        <th class="td10p">金额</th>
                        <th class="td10p">投注方式</th>
                        <th class="td10p">投注时间</th>
                        <th class="td10p">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $table = "";
                    switch ($game) {
                        case  'qxc':
                            $table = 'fn_qxcorder';
                            break;
                        case  'pl5':
                            $table = 'fn_pl5order';
                            break;
                        case  'fc3d':
                            $table = 'fn_fc3dorder';
                            break;
                    }
                    select_query($table, '*', "`userid` = '{$_SESSION['userid']}' and status = 0 and roomid = '{$_SESSION['roomid']}' and `gamename` = '{$game}' order by addtime desc");
                    while ($con = db_fetch_array()) {
                        $cons[] = $con;
                        ?>
                        <tr>
                            <td class="td10p"><?php echo $con['term'];
                                ?></td>
                            <td class="td20p"><?php echo formatJsonContent($con['content'],$game);
                                ?></td>
                            <td class="td10p"><?php echo $con['money'];
                                ?></td>
                            <td class="td10p"><?php echo getGameNameCN($con['content']);
                                ?></td>
                            <td class="td10p"><?php echo formatTime($con['addtime']);
                                ?></td>
                            <td class="td10p"><a href="javascript:delBet(<?php echo $con['id'];
                                ?>);" class="btn btn-danger">撤单</a></td>
                        </tr>
                    <?php }
                    if (count($cons) == 0) {
                        echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                    }
                    ?>
                    <script>
                        function delBet(id) {
                            $.ajax({
                                url: getJavaBaseUrl() + '/<?php echo $game?>/cancelOrder',
                                type: 'post',
                                data: {id: id,userId:'<?php echo $_SESSION['userid'] ?>'},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.code===0) {
                                        alert('撤单成功！');
                                        window.location.reload();
                                    } else {
                                        alert(data.msg);
                                    }
                                }
                            });
                        }
                    </script>
                    </tbody>
                <?php } ?>






                <?php
                if ($game == 'xy28' || $game == 'jnd28' || $game == 'ny28') {
                    ?>
                    <thead>
                    <tr>
                        <th>期号</th>
                        <th>内容</th>
                        <th>金额</th>
                        <th>投注时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    select_query('fn_pcorder', '*', "`userid` = '{$_SESSION['userid']}' and `status` = '未结算' and `roomid` = '{$_SESSION['roomid']}' and `gamename` = '{$game}'");
                    while ($con = db_fetch_array()) {
                        $cons[] = $con;
                        ?>
                        <tr>
                            <td><?php echo $con['term'];
                                ?></td>
                            <td><?php echo $con['content'];
                                ?></td>
                            <td><?php echo $con['money'];
                                ?></td>
                            <td><?php echo $con['addtime'];
                                ?></td>
                            <td><a href="javascript:delBet(<?php echo $con['id'];
                                ?>);" class="btn btn-danger">撤单</a></td>
                        </tr>
                    <?php }
                    if (count($cons) == 0) {
                        echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                    }
                    ?>
                    <script>
                        function delBet(id) {
                            $.ajax({
                                url: '/Application/ajax_delPCbet.php',
                                type: 'post',
                                data: {id: id},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.success) {
                                        alert('撤单成功！');
                                        window.location.reload();
                                    } else {
                                        alert(data.msg);
                                    }
                                }
                            });
                        }
                    </script>
                    </tbody>

                <?php } elseif ($game == 'bjl') {
                    ?>
                    <thead>
                    <tr>
                        <th>期号</th>
                        <th>内容</th>
                        <th>金额</th>
                        <th>投注时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    select_query('fn_bjlorder', '*', "`userid` = '{$_SESSION['userid']}' and `status` = '未结算' and `roomid` = '{$_SESSION['roomid']}'");
                    while ($con = db_fetch_array()) {
                        $cons[] = $con;
                        ?>
                        <tr>
                            <td><?php echo $con['term'];
                                ?></td>
                            <td><?php echo $con['content'];
                                ?></td>
                            <td><?php echo $con['money'];
                                ?></td>
                            <td><?php echo $con['addtime'];
                                ?></td>
                            <td><a href="javascript:delBet(<?php echo $con['id'];
                                ?>);" class="btn btn-danger">撤单</a></td>
                        </tr>
                    <?php }
                    if (count($cons) == 0) {
                        echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                    }
                    ?>
                    <script>
                        function delBet(id) {
                            $.ajax({
                                url: '/Application/ajax_delBJLbet.php',
                                type: 'post',
                                data: {id: id},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.success) {
                                        alert('撤单成功！');
                                        window.location.reload();
                                    } else {
                                        alert(data.msg);
                                    }
                                }
                            });
                        }
                    </script>
                    </tbody>
                <?php } elseif ($game == 'lhc') { ?>
                    <thead>
                    <tr>
                        <th>期号</th>
                        <th>球号</th>
                        <th>内容</th>
                        <th>金额</th>
                        <th>投注时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    select_query("fn_lhcorder", '*', "`userid` = '{$_SESSION['userid']}' and `status` = '未结算' and `roomid` = '{$_SESSION['roomid']}'");
                    while ($con = db_fetch_array()) {
                        $cons[] = $con;
                        ?>
                        <tr>
                            <td><?php echo $con['term']; ?></td>
                            <td><?php echo $con['mingci']; ?></td>
                            <td><?php echo $con['content']; ?></td>
                            <td><?php echo $con['money']; ?></td>
                            <td><?php echo $con['addtime']; ?></td>
                            <td><a href="javascript:delBet(<?php echo $con['id']; ?>);" class="btn btn-danger">撤单</a>
                            </td>
                        </tr>
                    <?php }
                    if (count($cons) == 0) {
                        echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                    }
                    ?>
                    <script>
                        function delBet(id) {
                            $.ajax({
                                url: '/Application/ajax_delLHCbet.php',
                                type: 'post',
                                data: {id: id},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.success) {
                                        alert('撤单成功！');
                                        window.location.reload();
                                    } else {
                                        alert(data.msg);
                                    }
                                }
                            });
                        }
                    </script>
                    </tbody>
                    <?php
                } elseif ($game == 'jslhc') { ?>
                    <thead>
                    <tr>
                        <th>期号</th>
                        <th>球号</th>
                        <th>内容</th>
                        <th>金额</th>
                        <th>投注时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    select_query("fn_jslhcorder", '*', "`userid` = '{$_SESSION['userid']}' and `status` = '未结算' and `roomid` = '{$_SESSION['roomid']}'");
                    while ($con = db_fetch_array()) {
                        $cons[] = $con;
                        ?>
                        <tr>
                            <td><?php echo $con['term']; ?></td>
                            <td><?php echo $con['mingci']; ?></td>
                            <td><?php echo $con['content']; ?></td>
                            <td><?php echo $con['money']; ?></td>
                            <td><?php echo $con['addtime']; ?></td>
                            <td><a href="javascript:delBet(<?php echo $con['id']; ?>);" class="btn btn-danger">撤单</a>
                            </td>
                        </tr>
                    <?php }
                    if (count($cons) == 0) {
                        echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                    }
                    ?>
                    <script>
                        function delBet(id) {
                            $.ajax({
                                url: '/Application/ajax_delJSLHCbet.php',
                                type: 'post',
                                data: {id: id},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.success) {
                                        alert('撤单成功！');
                                        window.location.reload();
                                    } else {
                                        alert(data.msg);
                                    }
                                }
                            });
                        }
                    </script>
                    </tbody>
                    <?php
                } elseif ($game == 'jssc') {
                    ?>
                    <thead>
                    <tr>
                        <th>期号</th>
                        <th>球号</th>
                        <th>内容</th>
                        <th>金额</th>
                        <th>投注时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    select_query('fn_jsscorder', '*', "`userid` = '{$_SESSION['userid']}' and `status` = '未结算' and `roomid` = '{$_SESSION['roomid']}'");
                    while ($con = db_fetch_array()) {
                        $cons[] = $con;
                        ?>
                        <tr>
                            <td><?php echo $con['term'];
                                ?></td>
                            <td><?php echo $con['mingci'];
                                ?></td>
                            <td><?php echo $con['content'];
                                ?></td>
                            <td><?php echo $con['money'];
                                ?></td>
                            <td><?php echo $con['addtime'];
                                ?></td>
                            <td><a href="javascript:delBet(<?php echo $con['id'];
                                ?>);" class="btn btn-danger">撤单</a></td>
                        </tr>
                    <?php }
                    if (count($cons) == 0) {
                        echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                    }
                    ?>
                    <script>
                        function delBet(id) {
                            $.ajax({
                                url: '/Application/ajax_delJSSCbet.php',
                                type: 'post',
                                data: {id: id},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.success) {
                                        alert('撤单成功！');
                                        window.location.reload();
                                    } else {
                                        alert(data.msg);
                                    }
                                }
                            });
                        }
                    </script>
                    </tbody>
                <?php } elseif ($game == 'kuai3') {
                    ?>
                    <thead>
                    <tr>
                        <th>期号</th>
                        <th>球号</th>
                        <th>内容</th>
                        <th>金额</th>
                        <th>投注时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    select_query('fn_k3order', '*', "`userid` = '{$_SESSION['userid']}' and `status` = '未结算' and `roomid` = '{$_SESSION['roomid']}'");
                    while ($con = db_fetch_array()) {
                        $cons[] = $con;
                        ?>
                        <tr>
                            <td><?php echo $con['term'];
                                ?></td>
                            <td><?php echo $con['mingci'];
                                ?></td>
                            <td><?php echo $con['content'];
                                ?></td>
                            <td><?php echo $con['money'];
                                ?></td>
                            <td><?php echo $con['addtime'];
                                ?></td>
                            <td><a href="javascript:delBet(<?php echo $con['id'];
                                ?>);" class="btn btn-danger">撤单</a></td>
                        </tr>
                    <?php }
                    if (count($cons) == 0) {
                        echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                    }
                    ?>
                    <script>
                        function delBet(id) {
                            $.ajax({
                                url: '/Application/ajax_belK3bet.php',
                                type: 'post',
                                data: {id: id},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.success) {
                                        alert('撤单成功！');
                                        window.location.reload();
                                    } else {
                                        alert(data.msg);
                                    }
                                }
                            });
                        }
                    </script>
                    </tbody>
                <?php } elseif ($game == 'twk3') {
                    ?>
                    <thead>
                    <tr>
                        <th>期号</th>
                        <th>球号</th>
                        <th>内容</th>
                        <th>金额</th>
                        <th>投注时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    select_query('fn_twk3order', '*', "`userid` = '{$_SESSION['userid']}' and `status` = '未结算' and `roomid` = '{$_SESSION['roomid']}'");
                    while ($con = db_fetch_array()) {
                        $cons[] = $con;
                        ?>
                        <tr>
                            <td><?php echo $con['term'];
                                ?></td>
                            <td><?php echo $con['mingci'];
                                ?></td>
                            <td><?php echo $con['content'];
                                ?></td>
                            <td><?php echo $con['money'];
                                ?></td>
                            <td><?php echo $con['addtime'];
                                ?></td>
                            <td><a href="javascript:delBet(<?php echo $con['id'];
                                ?>);" class="btn btn-danger">撤单</a></td>
                        </tr>
                    <?php }
                    if (count($cons) == 0) {
                        echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                    }
                    ?>
                    <script>
                        function delBet(id) {
                            $.ajax({
                                url: '/Application/ajax_belTWK3bet.php',
                                type: 'post',
                                data: {id: id},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.success) {
                                        alert('撤单成功！');
                                        window.location.reload();
                                    } else {
                                        alert(data.msg);
                                    }
                                }
                            });
                        }
                    </script>
                    </tbody>
                <?php } elseif ($game == 'jsssc') {
                    ?>
                    <thead>
                    <tr>
                        <th>期号</th>
                        <th>球号</th>
                        <th>内容</th>
                        <th>金额</th>
                        <th>投注时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    select_query('fn_jssscorder', '*', "`userid` = '{$_SESSION['userid']}' and `status` = '未结算' and `roomid` = '{$_SESSION['roomid']}'");
                    while ($con = db_fetch_array()) {
                        $cons[] = $con;
                        ?>
                        <tr>
                            <td><?php echo $con['term'];
                                ?></td>
                            <td><?php echo $con['mingci'];
                                ?></td>
                            <td><?php echo $con['content'];
                                ?></td>
                            <td><?php echo $con['money'];
                                ?></td>
                            <td><?php echo $con['addtime'];
                                ?></td>
                            <td><a href="javascript:delBet(<?php echo $con['id'];
                                ?>);" class="btn btn-danger">撤单</a></td>
                        </tr>
                    <?php }
                    if (count($cons) == 0) {
                        echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                    }
                    ?>
                    <script>
                        function delBet(id) {
                            $.ajax({
                                url: '/Application/ajax_delJSSSCbet.php',
                                type: 'post',
                                data: {id: id},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.success) {
                                        alert('撤单成功！');
                                        window.location.reload();
                                    } else {
                                        alert(data.msg);
                                    }
                                }
                            });
                        }
                    </script>
                    </tbody>
                <?php } elseif ($game == 'azxy5') {
                    ?>
                    <thead>
                    <tr>
                        <th>期号</th>
                        <th>球号</th>
                        <th>内容</th>
                        <th>金额</th>
                        <th>投注时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    select_query('fn_azxy5order', '*', "`userid` = '{$_SESSION['userid']}' and `status` = '未结算' and `roomid` = '{$_SESSION['roomid']}'");
                    while ($con = db_fetch_array()) {
                        $cons[] = $con;
                        ?>
                        <tr>
                            <td><?php echo $con['term'];
                                ?></td>
                            <td><?php echo $con['mingci'];
                                ?></td>
                            <td><?php echo $con['content'];
                                ?></td>
                            <td><?php echo $con['money'];
                                ?></td>
                            <td><?php echo $con['addtime'];
                                ?></td>
                            <td><a href="javascript:delBet(<?php echo $con['id'];
                                ?>);" class="btn btn-danger">撤单</a></td>
                        </tr>
                    <?php }
                    if (count($cons) == 0) {
                        echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                    }
                    ?>
                    <script>
                        function delBet(id) {
                            $.ajax({
                                url: '/Application/ajax_delAZXY5bet.php',
                                type: 'post',
                                data: {id: id},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.success) {
                                        alert('撤单成功！');
                                        window.location.reload();
                                    } else {
                                        alert(data.msg);
                                    }
                                }
                            });
                        }
                    </script>
                    </tbody>
                <?php } elseif ($game == 'txffc') {
                    ?>
                    <thead>
                    <tr>
                        <th>期号</th>
                        <th>球号</th>
                        <th>内容</th>
                        <th>金额</th>
                        <th>投注时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    select_query('fn_ffcorder', '*', "`userid` = '{$_SESSION['userid']}' and `status` = '未结算' and `roomid` = '{$_SESSION['roomid']}'");
                    while ($con = db_fetch_array()) {
                        $cons[] = $con;
                        ?>
                        <tr>
                            <td><?php echo $con['term'];
                                ?></td>
                            <td><?php echo $con['mingci'];
                                ?></td>
                            <td><?php echo $con['content'];
                                ?></td>
                            <td><?php echo $con['money'];
                                ?></td>
                            <td><?php echo $con['addtime'];
                                ?></td>
                            <td><a href="javascript:delBet(<?php echo $con['id'];
                                ?>);" class="btn btn-danger">撤单</a></td>
                        </tr>
                    <?php }
                    if (count($cons) == 0) {
                        echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                    }
                    ?>
                    <script>
                        function delBet(id) {
                            $.ajax({
                                url: '/Application/ajax_delFFCbet.php',
                                type: 'post',
                                data: {id: id},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.success) {
                                        alert('撤单成功！');
                                        window.location.reload();
                                    } else {
                                        alert(data.msg);
                                    }
                                }
                            });
                        }
                    </script>
                    </tbody>
                <?php } elseif ($game == 'cqssc') {
                    ?>
                    <thead>
                    <tr>
                        <th>期号</th>
                        <th>球号</th>
                        <th>内容</th>
                        <th>金额</th>
                        <th>投注时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    select_query('fn_sscorder', '*', "`userid` = '{$_SESSION['userid']}' and `status` = '未结算' and `roomid` = '{$_SESSION['roomid']}'");
                    while ($con = db_fetch_array()) {
                        $cons[] = $con;
                        ?>
                        <tr>
                            <td><?php echo $con['term'];
                                ?></td>
                            <td><?php echo $con['mingci'];
                                ?></td>
                            <td><?php echo $con['content'];
                                ?></td>
                            <td><?php echo $con['money'];
                                ?></td>
                            <td><?php echo $con['addtime'];
                                ?></td>
                            <td><a href="javascript:delBet(<?php echo $con['id'];
                                ?>);" class="btn btn-danger">撤单</a></td>
                        </tr>
                    <?php }
                    if (count($cons) == 0) {
                        echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                    }
                    ?>
                    <script>
                        function delBet(id) {
                            $.ajax({
                                url: '/Application/ajax_delSSCbet.php',
                                type: 'post',
                                data: {id: id},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.success) {
                                        alert('撤单成功！');
                                        window.location.reload();
                                    } else {
                                        alert(data.msg);
                                    }
                                }
                            });
                        }
                    </script>
                    </tbody>
                <?php } elseif ($game == 'gd11x5') {
                    ?>
                    <thead>
                    <tr>
                        <th>期号</th>
                        <th>球号</th>
                        <th>内容</th>
                        <th>金额</th>
                        <th>投注时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    select_query('fn_11x5order', '*', "`userid` = '{$_SESSION['userid']}' and `status` = '未结算' and `roomid` = '{$_SESSION['roomid']}'");
                    while ($con = db_fetch_array()) {
                        $cons[] = $con;
                        ?>
                        <tr>
                            <td><?php echo $con['term'];
                                ?></td>
                            <td><?php echo $con['mingci'];
                                ?></td>
                            <td><?php echo $con['content'];
                                ?></td>
                            <td><?php echo $con['money'];
                                ?></td>
                            <td><?php echo $con['addtime'];
                                ?></td>
                            <td><a href="javascript:delBet(<?php echo $con['id'];
                                ?>);" class="btn btn-danger">撤单</a></td>
                        </tr>
                    <?php }
                    if (count($cons) == 0) {
                        echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                    }
                    ?>
                    <script>
                        function delBet(id) {
                            $.ajax({
                                url: '/Application/ajax_del11x5bet.php',
                                type: 'post',
                                data: {id: id},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.success) {
                                        alert('撤单成功！');
                                        window.location.reload();
                                    } else {
                                        alert(data.msg);
                                    }
                                }
                            });
                        }
                    </script>
                    </tbody>
                <?php } elseif ($game == 'jssm') {
                    ?>
                    <thead>
                    <tr>
                        <th>期号</th>
                        <th>车道</th>
                        <th>内容</th>
                        <th>金额</th>
                        <th>投注时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    select_query('fn_smorder', '*', "`userid` = '{$_SESSION['userid']}' and `status` = '未结算' and `roomid` = '{$_SESSION['roomid']}'");
                    while ($con = db_fetch_array()) {
                        $cons[] = $con;
                        ?>
                        <tr>
                            <td><?php echo $con['term'];
                                ?></td>
                            <td><?php if ($con['mingci'] != '和') {
                                    echo $con['mingci'] . '名';
                                } else {
                                    echo "和值";
                                }
                                ?></td>
                            <td><?php echo $con['content'];
                                ?></td>
                            <td><?php echo $con['money'];
                                ?></td>
                            <td><?php echo $con['addtime'];
                                ?></td>
                            <td><a href="javascript:delBet(<?php echo $con['id'];
                                ?>);" class="btn btn-danger">撤单</a></td>
                        </tr>
                    <?php }
                    if (count($cons) == 0) {
                        echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                    }
                    ?>
                    <script>
                        function delBet(id) {
                            $.ajax({
                                url: '/Application/ajax_belSMbet.php',
                                type: 'post',
                                data: {id: id},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.success) {
                                        alert('撤单成功！');
                                        window.location.reload();
                                    } else {
                                        alert(data.msg);
                                    }
                                }
                            });
                        }
                    </script>
                    </tbody>
                <?php } elseif ($game == 'jsmt') {
                    ?>
                    <thead>
                    <tr>
                        <th>期号</th>
                        <th>车道</th>
                        <th>内容</th>
                        <th>金额</th>
                        <th>投注时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    select_query('fn_mtorder', '*', "`userid` = '{$_SESSION['userid']}' and `status` = '未结算' and `roomid` = '{$_SESSION['roomid']}'");
                    while ($con = db_fetch_array()) {
                        $cons[] = $con;
                        ?>
                        <tr>
                            <td><?php echo $con['term'];
                                ?></td>
                            <td><?php if ($con['mingci'] != '和') {
                                    echo $con['mingci'] . '名';
                                } else {
                                    echo "和值";
                                }
                                ?></td>
                            <td><?php echo $con['content'];
                                ?></td>
                            <td><?php echo $con['money'];
                                ?></td>
                            <td><?php echo $con['addtime'];
                                ?></td>
                            <td><a href="javascript:delBet(<?php echo $con['id'];
                                ?>);" class="btn btn-danger">撤单</a></td>
                        </tr>
                    <?php }
                    if (count($cons) == 0) {
                        echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                    }
                    ?>
                    <script>
                        function delBet(id) {
                            $.ajax({
                                url: '/Application/ajax_delMTbet.php',
                                type: 'post',
                                data: {id: id},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.success) {
                                        alert('撤单成功！');
                                        window.location.reload();
                                    } else {
                                        alert(data.msg);
                                    }
                                }
                            });
                        }
                    </script>
                    </tbody>
                <?php } elseif ($game == 'pk10') {
                    ?>
                    <thead>
                    <tr>
                        <th>期号</th>
                        <th>车道</th>
                        <th>内容</th>
                        <th>金额</th>
                        <th>投注时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    select_query('fn_order', '*', "`userid` = '{$_SESSION['userid']}' and `status` = '未结算' and `roomid` = '{$_SESSION['roomid']}'");
                    while ($con = db_fetch_array()) {
                        $cons[] = $con;
                        ?>
                        <tr>
                            <td><?php echo $con['term'];
                                ?></td>
                            <td><?php if ($con['mingci'] != '和') {
                                    echo $con['mingci'] . '名';
                                } else {
                                    echo "和值";
                                }
                                ?></td>
                            <td><?php echo $con['content'];
                                ?></td>
                            <td><?php echo $con['money'];
                                ?></td>
                            <td><?php echo $con['addtime'];
                                ?></td>
                            <td><a href="javascript:delBet(<?php echo $con['id'];
                                ?>);" class="btn btn-danger">撤单</a></td>
                        </tr>
                    <?php }
                    if (count($cons) == 0) {
                        echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                    }
                    ?>
                    <script>
                        function delBet(id) {
                            $.ajax({
                                url: '/Application/ajax_delPKbet.php',
                                type: 'post',
                                data: {id: id},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.success) {
                                        alert('撤单成功！');
                                        window.location.reload();
                                    } else {
                                        alert(data.msg);
                                    }
                                }
                            });
                        }
                    </script>
                    </tbody>
                <?php } elseif ($game == 'azxy10') {
                    ?>
                    <thead>
                    <tr>
                        <th>期号</th>
                        <th>车道</th>
                        <th>内容</th>
                        <th>金额</th>
                        <th>投注时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    select_query('fn_azxy10order', '*', "`userid` = '{$_SESSION['userid']}' and `status` = '未结算' and `roomid` = '{$_SESSION['roomid']}'");
                    while ($con = db_fetch_array()) {
                        $cons[] = $con;
                        ?>
                        <tr>
                            <td><?php echo $con['term'];
                                ?></td>
                            <td><?php if ($con['mingci'] != '和') {
                                    echo $con['mingci'] . '名';
                                } else {
                                    echo "和值";
                                }
                                ?></td>
                            <td><?php echo $con['content'];
                                ?></td>
                            <td><?php echo $con['money'];
                                ?></td>
                            <td><?php echo $con['addtime'];
                                ?></td>
                            <td><a href="javascript:delBet(<?php echo $con['id'];
                                ?>);" class="btn btn-danger">撤单</a></td>
                        </tr>
                    <?php }
                    if (count($cons) == 0) {
                        echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                    }
                    ?>
                    <script>
                        function delBet(id) {
                            $.ajax({
                                url: '/Application/ajax_delAZXY10bet.php',
                                type: 'post',
                                data: {id: id},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.success) {
                                        alert('撤单成功！');
                                        window.location.reload();
                                    } else {
                                        alert(data.msg);
                                    }
                                }
                            });
                        }
                    </script>
                    </tbody>
                <?php } elseif ($game == 'xyft') {
                    ?>
                    <thead>
                    <tr>
                        <th>期号</th>
                        <th>车道</th>
                        <th>内容</th>
                        <th>金额</th>
                        <th>投注时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    select_query('fn_flyorder', '*', "`userid` = '{$_SESSION['userid']}' and `status` = '未结算' and `roomid` = '{$_SESSION['roomid']}'");
                    while ($con = db_fetch_array()) {
                        $cons[] = $con;
                        ?>
                        <tr>
                            <td><?php echo $con['term'];
                                ?></td>
                            <td><?php if ($con['mingci'] != '和') {
                                    echo $con['mingci'] . '名';
                                } else {
                                    echo "和值";
                                }
                                ?></td>
                            <td><?php echo $con['content'];
                                ?></td>
                            <td><?php echo $con['money'];
                                ?></td>
                            <td><?php echo $con['addtime'];
                                ?></td>
                            <td><a href="javascript:delBet(<?php echo $con['id'];
                                ?>);" class="btn btn-danger">撤单</a></td>
                        </tr>
                    <?php }
                    if (count($cons) == 0) {
                        echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                    }
                    ?>
                    <script>
                        function delBet(id) {
                            $.ajax({
                                url: '/Application/ajax_delFTbet.php',
                                type: 'post',
                                data: {id: id},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.success) {
                                        alert('撤单成功！');
                                        window.location.reload();
                                    } else {
                                        alert(data.msg);
                                    }
                                }
                            });
                        }
                    </script>
                    </tbody>
                <?php }
                ?>
            </table>
        </div>
    </div>
</div>

<div  align="center" style="font-size:20px;">
    <div class="panel panel-success">
        <div class="panel-heading">
            今日投注
        </div>
        <div class="panel-body">

            <table data-sort-name="Code" data-sort-order="desc" data-pagination="true" data-page-size="15"
                   data-page-list="[15, 30, 50, 100, All]" data-search="true" data-toggle="table"
                   class="table table-striped table-bordered " style="text-align:center;">

                <!--七星彩 排列5 福彩3d-->
                <?php if ($game == 'qxc' || $game == 'pl5' || $game == 'fc3d') {
                ?>
                <thead>
                <tr>
                    <th class="td10p" data-field="Code">期号</th>
                    <th class="td20p">内容</th>
                    <th class="td10p">金额</th>
                    <th class="td10p">投注方式</th>
                    <th class="td10p">投注时间</th>
                    <th class="td10p">结果</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $table = "";
                switch ($game) {
                    case  'qxc':
                        $table = 'fn_qxcorder';
                        break;
                    case  'pl5':
                        $table = 'fn_pl5order';
                        break;
                    case  'fc3d':
                        $table = 'fn_fc3dorder';
                        break;
                }
                select_query($table, '*', "`roomid` = '{$_SESSION['roomid']}' and `gamename` = '{$game}' and `userid` = '{$_SESSION['userid']}' and `status` > 0 and `addtime` like '" . date('Y-m-d') . "%'");
                $all_m = 0;
                $all_z = 0;
                while ($con = db_fetch_array()) {
                    $cons[] = $con;
                    if ($con['status'] != '已退还' && $con['status'] != '已撤单') {
                        $all_m += (int)$con['money'];
                        if ((int)$con['status'] > 0) $all_z += (int)$con['status'];
                    }
                    ?>
                    <tr>
                        <td class="td10p"><?php echo $con['term'];
                            ?></td>
                        <td class="td20p"><?php echo formatJsonContent($con['content'],$game);
                            ?></td>
                        <td class="td10p"><?php echo $con['money'];
                            ?></td>
                        <td class="td10p"><?php echo getGameNameCN($con['content']);
                            ?></td>
                        <td class="td10p"><?php echo formatTime($con['addtime']);
                            ?></td>
                        <td class="<?php if ($con['status'] == 1) echo 'win';
                        if ($con['status'] == 2) echo 'lose';
                        if ($con['status'] == 9) echo 'che';
                        ?>"><?php if ($con['status'] == 1) echo "+".floatval($con['winmoney']);
                            if ($con['status'] == 2) echo '未中奖';
                            if ($con['status'] == 9) echo '撤单';
                            ?></td>
                    </tr>
                <?php }
                if (count($cons) == 0) {
                    echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                }
                ?>
                </tbody>
            </table>

            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>今日流水</th>
                    <th>今日盈亏(玩家)</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo $all_m;
                        ?></td>
                    <td><?php $a = '-' . $all_m;
                        echo (int)$a + $all_z;
                        ?></td>
                </tr>
                </tbody>
            </table>
            <?php } ?>


            <!--xy28  jnd28 ny28-->
            <?php if ($game == 'xy28' || $game == 'jnd28' || $game == 'ny28') {
                ?>
                <thead>
                <tr>
                    <th data-field="Code">期号</th>
                    <th>内容</th>
                    <th>金额</th>
                    <th>投注时间</th>
                    <th>结果</th>
                </tr>
                </thead>
                <tbody>
                <?php
                select_query('fn_pcorder', '*', "`roomid` = '{$_SESSION['roomid']}' and `gamename` = '{$game}' and `userid` = '{$_SESSION['userid']}' and `status` != '未结算' and `addtime` like '" . date('Y-m-d') . "%'");
                $all_m = 0;
                $all_z = 0;
                while ($con = db_fetch_array()) {
                    $cons[] = $con;
                    if ($con['status'] != '已退还' && $con['status'] != '已撤单') {
                        $all_m += (int)$con['money'];
                        if ((int)$con['status'] > 0) $all_z += (int)$con['status'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $con['term'];
                            ?></td>
                        <td><?php echo $con['content'];
                            ?></td>
                        <td><?php echo $con['money'];
                            ?></td>
                        <td><?php echo $con['addtime'];
                            ?></td>
                        <td class="<?php if ((int)$con['status'] > 0) echo 'win';
                        if ((int)$con['status'] < 0) echo 'lose';
                        if ($con['status'] == '已撤单') echo 'che';
                        ?>"><?php if ($con['status'] == '已撤单') {
                                echo '撤单';
                            } else {
                                echo $con['status'];
                            }
                            ?></td>
                    </tr>
                <?php }
                if (count($cons) == 0) {
                    echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                }
                ?>
                </tbody>
                </table>

                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>今日流水</th>
                        <th>今日盈亏(玩家)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $all_m;
                            ?></td>
                        <td><?php $a = '-' . $all_m;
                            echo (int)$a + $all_z;
                            ?></td>
                    </tr>
                    </tbody>
                </table>
            <?php } elseif ($game == 'lhc') { ?>
                <thead>
                <tr>
                    <th data-field="Code">期号</th>
                    <th>球号</th>
                    <th>内容</th>
                    <th>金额</th>
                    <th>投注时间</th>
                    <th>结果</th>
                </tr>
                </thead>
                <tbody>
                <?php
                select_query("fn_lhcorder", '*', "`roomid` = '{$_SESSION['roomid']}' and `userid` = '{$_SESSION['userid']}' and `status` != '未结算' and `addtime` like '" . date('Y-m-d') . "%'");
                $all_m = 0;
                $all_z = 0;
                while ($con = db_fetch_array()) {
                    $cons[] = $con;
                    if ($con['status'] != '已退还' && $con['status'] != '已撤单') {
                        $all_m += (int)$con['money'];
                        if ((int)$con['status'] > 0) $all_z += (int)$con['status'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $con['term'];
                            ?></td>
                        <td><?php echo $con['mingci'];
                            ?></td>
                        <td><?php echo $con['content'];
                            ?></td>
                        <td><?php echo $con['money'];
                            ?></td>
                        <td><?php echo $con['addtime'];
                            ?></td>
                        <td class="<?php if ((int)$con['status'] > 0) echo 'win';
                        if ((int)$con['status'] < 0) echo 'lose';
                        if ($con['status'] == '已撤单') echo 'che';
                        ?>"><?php if ($con['status'] == '已撤单') {
                                echo '撤单';
                            } else {
                                echo $con['status'];
                            }
                            ?></td>
                    </tr>
                <?php }
                if (count($cons) == 0) {
                    echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                } ?></tbody>
                </table>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>今日流水</th>
                        <th>今日盈亏(玩家)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $all_m;
                            ?></td>
                        <td><?php $a = '-' . $all_m;
                            echo (int)$a + $all_z;
                            ?></td>
                    </tr>
                    </tbody>
                </table>

                <?
            } elseif ($game == 'jslhc') { ?>
                <thead>
                <tr>
                    <th data-field="Code">期号</th>
                    <th>球号</th>
                    <th>内容</th>
                    <th>金额</th>
                    <th>投注时间</th>
                    <th>结果</th>
                </tr>
                </thead>
                <tbody>
                <?php
                select_query("fn_jslhcorder", '*', "`roomid` = '{$_SESSION['roomid']}' and `userid` = '{$_SESSION['userid']}' and `status` != '未结算' and `addtime` like '" . date('Y-m-d') . "%'");
                $all_m = 0;
                $all_z = 0;
                while ($con = db_fetch_array()) {
                    $cons[] = $con;
                    if ($con['status'] != '已退还' && $con['status'] != '已撤单') {
                        $all_m += (int)$con['money'];
                        if ((int)$con['status'] > 0) $all_z += (int)$con['status'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $con['term'];
                            ?></td>
                        <td><?php echo $con['mingci'];
                            ?></td>
                        <td><?php echo $con['content'];
                            ?></td>
                        <td><?php echo $con['money'];
                            ?></td>
                        <td><?php echo $con['addtime'];
                            ?></td>
                        <td class="<?php if ((int)$con['status'] > 0) echo 'win';
                        if ((int)$con['status'] < 0) echo 'lose';
                        if ($con['status'] == '已撤单') echo 'che';
                        ?>"><?php if ($con['status'] == '已撤单') {
                                echo '撤单';
                            } else {
                                echo $con['status'];
                            }
                            ?></td>
                    </tr>
                <?php }
                if (count($cons) == 0) {
                    echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                } ?>

                </tbody>
                </table>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>今日流水</th>
                        <th>今日盈亏(玩家)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $all_m;
                            ?></td>
                        <td><?php $a = '-' . $all_m;
                            echo (int)$a + $all_z;
                            ?></td>
                    </tr>
                    </tbody>
                </table>
                <?
            } elseif ($game == 'jssc') {
                ?>
                <thead>
                <tr>
                    <th data-field="Code">期号</th>
                    <th>球号</th>
                    <th>内容</th>
                    <th>金额</th>
                    <th>投注时间</th>
                    <th>结果</th>
                </tr>
                </thead>
                <tbody>
                <?php
                select_query('fn_jsscorder', '*', "`roomid` = '{$_SESSION['roomid']}' and `userid` = '{$_SESSION['userid']}' and `status` != '未结算' and `addtime` like '" . date('Y-m-d') . "%'");
                $all_m = 0;
                $all_z = 0;
                while ($con = db_fetch_array()) {
                    $cons[] = $con;
                    if ($con['status'] != '已退还' && $con['status'] != '已撤单') {
                        $all_m += (int)$con['money'];
                        if ((int)$con['status'] > 0) $all_z += (int)$con['status'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $con['term'];
                            ?></td>
                        <td><?php echo $con['mingci'];
                            ?></td>
                        <td><?php echo $con['content'];
                            ?></td>
                        <td><?php echo $con['money'];
                            ?></td>
                        <td><?php echo $con['addtime'];
                            ?></td>
                        <td class="<?php if ((int)$con['status'] > 0) echo 'win';
                        if ((int)$con['status'] < 0) echo 'lose';
                        if ($con['status'] == '已撤单') echo 'che';
                        ?>"><?php if ($con['status'] == '已撤单') {
                                echo '撤单';
                            } else {
                                echo $con['status'];
                            }
                            ?></td>
                    </tr>
                <?php }
                if (count($cons) == 0) {
                    echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                }
                ?>
                </tbody>
                </table>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>今日流水</th>
                        <th>今日盈亏(玩家)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $all_m;
                            ?></td>
                        <td><?php $a = '-' . $all_m;
                            echo (int)$a + $all_z;
                            ?></td>
                    </tr>
                    </tbody>
                </table>
            <?php } elseif ($game == 'kuai3') {
                ?>
                <thead>
                <tr>
                    <th data-field="Code">期号</th>
                    <th>球号</th>
                    <th>内容</th>
                    <th>金额</th>
                    <th>投注时间</th>
                    <th>结果</th>
                </tr>
                </thead>
                <tbody>
                <?php
                select_query('fn_k3order', '*', "`roomid` = '{$_SESSION['roomid']}' and `userid` = '{$_SESSION['userid']}' and `status` != '未结算' and `addtime` like '" . date('Y-m-d') . "%'");
                $all_m = 0;
                $all_z = 0;
                while ($con = db_fetch_array()) {
                    $cons[] = $con;
                    if ($con['status'] != '已退还' && $con['status'] != '已撤单') {
                        $all_m += (int)$con['money'];
                        if ((int)$con['status'] > 0) $all_z += (int)$con['status'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $con['term'];
                            ?></td>
                        <td><?php echo $con['mingci'];
                            ?></td>
                        <td><?php echo $con['content'];
                            ?></td>
                        <td><?php echo $con['money'];
                            ?></td>
                        <td><?php echo $con['addtime'];
                            ?></td>
                        <td class="<?php if ((int)$con['status'] > 0) echo 'win';
                        if ((int)$con['status'] < 0) echo 'lose';
                        if ($con['status'] == '已撤单') echo 'che';
                        ?>"><?php if ($con['status'] == '已撤单') {
                                echo '撤单';
                            } else {
                                echo $con['status'];
                            }
                            ?></td>
                    </tr>
                <?php }
                if (count($cons) == 0) {
                    echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                }
                ?>
                </tbody>
                </table>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>今日流水</th>
                        <th>今日盈亏(玩家)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $all_m;
                            ?></td>
                        <td><?php $a = '-' . $all_m;
                            echo (int)$a + $all_z;
                            ?></td>
                    </tr>
                    </tbody>
                </table>
            <?php } elseif ($game == 'twk3') {
                ?>
                <thead>
                <tr>
                    <th data-field="Code">期号</th>
                    <th>球号</th>
                    <th>内容</th>
                    <th>金额</th>
                    <th>投注时间</th>
                    <th>结果</th>
                </tr>
                </thead>
                <tbody>
                <?php
                select_query('fn_twk3order', '*', "`roomid` = '{$_SESSION['roomid']}' and `userid` = '{$_SESSION['userid']}' and `status` != '未结算' and `addtime` like '" . date('Y-m-d') . "%'");
                $all_m = 0;
                $all_z = 0;
                while ($con = db_fetch_array()) {
                    $cons[] = $con;
                    if ($con['status'] != '已退还' && $con['status'] != '已撤单') {
                        $all_m += (int)$con['money'];
                        if ((int)$con['status'] > 0) $all_z += (int)$con['status'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $con['term'];
                            ?></td>
                        <td><?php echo $con['mingci'];
                            ?></td>
                        <td><?php echo $con['content'];
                            ?></td>
                        <td><?php echo $con['money'];
                            ?></td>
                        <td><?php echo $con['addtime'];
                            ?></td>
                        <td class="<?php if ((int)$con['status'] > 0) echo 'win';
                        if ((int)$con['status'] < 0) echo 'lose';
                        if ($con['status'] == '已撤单') echo 'che';
                        ?>"><?php if ($con['status'] == '已撤单') {
                                echo '撤单';
                            } else {
                                echo $con['status'];
                            }
                            ?></td>
                    </tr>
                <?php }
                if (count($cons) == 0) {
                    echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                }
                ?>
                </tbody>
                </table>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>今日流水</th>
                        <th>今日盈亏(玩家)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $all_m;
                            ?></td>
                        <td><?php $a = '-' . $all_m;
                            echo (int)$a + $all_z;
                            ?></td>
                    </tr>
                    </tbody>
                </table>
            <?php } elseif ($game == 'jsssc') {
                ?>
                <thead>
                <tr>
                    <th data-field="Code">期号</th>
                    <th>球号</th>
                    <th>内容</th>
                    <th>金额</th>
                    <th>投注时间</th>
                    <th>结果</th>
                </tr>
                </thead>
                <tbody>
                <?php
                select_query('fn_jssscorder', '*', "`roomid` = '{$_SESSION['roomid']}' and `userid` = '{$_SESSION['userid']}' and `status` != '未结算' and `addtime` like '" . date('Y-m-d') . "%'");
                $all_m = 0;
                $all_z = 0;
                while ($con = db_fetch_array()) {
                    $cons[] = $con;
                    if ($con['status'] != '已退还' && $con['status'] != '已撤单') {
                        $all_m += (int)$con['money'];
                        if ((int)$con['status'] > 0) $all_z += (int)$con['status'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $con['term'];
                            ?></td>
                        <td><?php echo $con['mingci'];
                            ?></td>
                        <td><?php echo $con['content'];
                            ?></td>
                        <td><?php echo $con['money'];
                            ?></td>
                        <td><?php echo $con['addtime'];
                            ?></td>
                        <td class="<?php if ((int)$con['status'] > 0) echo 'win';
                        if ((int)$con['status'] < 0) echo 'lose';
                        if ($con['status'] == '已撤单') echo 'che';
                        ?>"><?php if ($con['status'] == '已撤单') {
                                echo '撤单';
                            } else {
                                echo $con['status'];
                            }
                            ?></td>
                    </tr>
                <?php }
                if (count($cons) == 0) {
                    echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                }
                ?>
                </tbody>
                </table>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>今日流水</th>
                        <th>今日盈亏(玩家)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $all_m;
                            ?></td>
                        <td><?php $a = '-' . $all_m;
                            echo (int)$a + $all_z;
                            ?></td>
                    </tr>
                    </tbody>
                </table>
            <?php } elseif ($game == 'azxy5') {
                ?>
                <thead>
                <tr>
                    <th data-field="Code">期号</th>
                    <th>球号</th>
                    <th>内容</th>
                    <th>金额</th>
                    <th>投注时间</th>
                    <th>结果</th>
                </tr>
                </thead>
                <tbody>
                <?php
                select_query('fn_azxy5order', '*', "`roomid` = '{$_SESSION['roomid']}' and `userid` = '{$_SESSION['userid']}' and `status` != '未结算' and `addtime` like '" . date('Y-m-d') . "%'");
                $all_m = 0;
                $all_z = 0;
                while ($con = db_fetch_array()) {
                    $cons[] = $con;
                    if ($con['status'] != '已退还' && $con['status'] != '已撤单') {
                        $all_m += (int)$con['money'];
                        if ((int)$con['status'] > 0) $all_z += (int)$con['status'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $con['term'];
                            ?></td>
                        <td><?php echo $con['mingci'];
                            ?></td>
                        <td><?php echo $con['content'];
                            ?></td>
                        <td><?php echo $con['money'];
                            ?></td>
                        <td><?php echo $con['addtime'];
                            ?></td>
                        <td class="<?php if ((int)$con['status'] > 0) echo 'win';
                        if ((int)$con['status'] < 0) echo 'lose';
                        if ($con['status'] == '已撤单') echo 'che';
                        ?>"><?php if ($con['status'] == '已撤单') {
                                echo '撤单';
                            } else {
                                echo $con['status'];
                            }
                            ?></td>
                    </tr>
                <?php }
                if (count($cons) == 0) {
                    echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                }
                ?>
                </tbody>
                </table>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>今日流水</th>
                        <th>今日盈亏(玩家)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $all_m;
                            ?></td>
                        <td><?php $a = '-' . $all_m;
                            echo (int)$a + $all_z;
                            ?></td>
                    </tr>
                    </tbody>
                </table>
            <?php } elseif ($game == 'txffc') {
                ?>
                <thead>
                <tr>
                    <th data-field="Code">期号</th>
                    <th>球号</th>
                    <th>内容</th>
                    <th>金额</th>
                    <th>投注时间</th>
                    <th>结果</th>
                </tr>
                </thead>
                <tbody>
                <?php
                select_query('fn_ffcorder', '*', "`roomid` = '{$_SESSION['roomid']}' and `userid` = '{$_SESSION['userid']}' and `status` != '未结算' and `addtime` like '" . date('Y-m-d') . "%'");
                $all_m = 0;
                $all_z = 0;
                while ($con = db_fetch_array()) {
                    $cons[] = $con;
                    if ($con['status'] != '已退还' && $con['status'] != '已撤单') {
                        $all_m += (int)$con['money'];
                        if ((int)$con['status'] > 0) $all_z += (int)$con['status'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $con['term'];
                            ?></td>
                        <td><?php echo $con['mingci'];
                            ?></td>
                        <td><?php echo $con['content'];
                            ?></td>
                        <td><?php echo $con['money'];
                            ?></td>
                        <td><?php echo $con['addtime'];
                            ?></td>
                        <td class="<?php if ((int)$con['status'] > 0) echo 'win';
                        if ((int)$con['status'] < 0) echo 'lose';
                        if ($con['status'] == '已撤单') echo 'che';
                        ?>"><?php if ($con['status'] == '已撤单') {
                                echo '撤单';
                            } else {
                                echo $con['status'];
                            }
                            ?></td>
                    </tr>
                <?php }
                if (count($cons) == 0) {
                    echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                }
                ?>
                </tbody>
                </table>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>今日流水</th>
                        <th>今日盈亏(玩家)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $all_m;
                            ?></td>
                        <td><?php $a = '-' . $all_m;
                            echo (int)$a + $all_z;
                            ?></td>
                    </tr>
                    </tbody>
                </table>
            <?php } elseif ($game == 'cqssc') {
                ?>
                <thead>
                <tr>
                    <th data-field="Code">期号</th>
                    <th>球号</th>
                    <th>内容</th>
                    <th>金额</th>
                    <th>投注时间</th>
                    <th>结果</th>
                </tr>
                </thead>
                <tbody>
                <?php
                select_query('fn_sscorder', '*', "`roomid` = '{$_SESSION['roomid']}' and `userid` = '{$_SESSION['userid']}' and `status` != '未结算' and `addtime` like '" . date('Y-m-d') . "%'");
                $all_m = 0;
                $all_z = 0;
                while ($con = db_fetch_array()) {
                    $cons[] = $con;
                    if ($con['status'] != '已退还' && $con['status'] != '已撤单') {
                        $all_m += (int)$con['money'];
                        if ((int)$con['status'] > 0) $all_z += (int)$con['status'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $con['term'];
                            ?></td>
                        <td><?php echo $con['mingci'];
                            ?></td>
                        <td><?php echo $con['content'];
                            ?></td>
                        <td><?php echo $con['money'];
                            ?></td>
                        <td><?php echo $con['addtime'];
                            ?></td>
                        <td class="<?php if ((int)$con['status'] > 0) echo 'win';
                        if ((int)$con['status'] < 0) echo 'lose';
                        if ($con['status'] == '已撤单') echo 'che';
                        ?>"><?php if ($con['status'] == '已撤单') {
                                echo '撤单';
                            } else {
                                echo $con['status'];
                            }
                            ?></td>
                    </tr>
                <?php }
                if (count($cons) == 0) {
                    echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                }
                ?>
                </tbody>
                </table>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>今日流水</th>
                        <th>今日盈亏(玩家)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $all_m;
                            ?></td>
                        <td><?php $a = '-' . $all_m;
                            echo (int)$a + $all_z;
                            ?></td>
                    </tr>
                    </tbody>
                </table>
            <?php } elseif ($game == 'gd11x5') {
                ?>
                <thead>
                <tr>
                    <th data-field="Code">期号</th>
                    <th>球号</th>
                    <th>内容</th>
                    <th>金额</th>
                    <th>投注时间</th>
                    <th>结果</th>
                </tr>
                </thead>
                <tbody>
                <?php
                select_query('fn_11x5order', '*', "`roomid` = '{$_SESSION['roomid']}' and `userid` = '{$_SESSION['userid']}' and `status` != '未结算' and `addtime` like '" . date('Y-m-d') . "%'");
                $all_m = 0;
                $all_z = 0;
                while ($con = db_fetch_array()) {
                    $cons[] = $con;
                    if ($con['status'] != '已退还' && $con['status'] != '已撤单') {
                        $all_m += (int)$con['money'];
                        if ((int)$con['status'] > 0) $all_z += (int)$con['status'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $con['term'];
                            ?></td>
                        <td><?php echo $con['mingci'];
                            ?></td>
                        <td><?php echo $con['content'];
                            ?></td>
                        <td><?php echo $con['money'];
                            ?></td>
                        <td><?php echo $con['addtime'];
                            ?></td>
                        <td class="<?php if ((int)$con['status'] > 0) echo 'win';
                        if ((int)$con['status'] < 0) echo 'lose';
                        if ($con['status'] == '已撤单') echo 'che';
                        ?>"><?php if ($con['status'] == '已撤单') {
                                echo '撤单';
                            } else {
                                echo $con['status'];
                            }
                            ?></td>
                    </tr>
                <?php }
                if (count($cons) == 0) {
                    echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                }
                ?>
                </tbody>
                </table>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>今日流水</th>
                        <th>今日盈亏(玩家)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $all_m;
                            ?></td>
                        <td><?php $a = '-' . $all_m;
                            echo (int)$a + $all_z;
                            ?></td>
                    </tr>
                    </tbody>
                </table>
            <?php } elseif ($game == 'jssm') {
                ?>
                <thead>
                <tr>
                    <th data-field="Code">期号</th>
                    <th>车道</th>
                    <th>内容</th>
                    <th>金额</th>
                    <th>投注时间</th>
                    <th>结果</th>
                </tr>
                </thead>
                <tbody>
                <?php
                select_query('fn_smorder', '*', "`roomid` = '{$_SESSION['roomid']}' and `userid` = '{$_SESSION['userid']}' and `status` != '未结算' and `addtime` like '" . date('Y-m-d') . "%'");
                $all_m = 0;
                $all_z = 0;
                while ($con = db_fetch_array()) {
                    $cons[] = $con;
                    if ($con['status'] != '已退还' && $con['status'] != '已撤单') {
                        $all_m += (int)$con['money'];
                        if ((int)$con['status'] > 0) $all_z += (int)$con['status'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $con['term'];
                            ?></td>
                        <td><?php echo $con['mingci'];
                            ?></td>
                        <td><?php echo $con['content'];
                            ?></td>
                        <td><?php echo $con['money'];
                            ?></td>
                        <td><?php echo $con['addtime'];
                            ?></td>
                        <td class="<?php if ((int)$con['status'] > 0) echo 'win';
                        if ((int)$con['status'] < 0) echo 'lose';
                        if ($con['status'] == '已撤单') echo 'che';
                        ?>"><?php if ($con['status'] == '已撤单') {
                                echo '撤单';
                            } else {
                                echo $con['status'];
                            }
                            ?></td>
                    </tr>
                <?php }
                if (count($cons) == 0) {
                    echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                }
                ?>
                </tbody>
                </table>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>今日流水</th>
                        <th>今日盈亏(玩家)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $all_m;
                            ?></td>
                        <td><?php $a = '-' . $all_m;
                            echo (int)$a + $all_z;
                            ?></td>
                    </tr>
                    </tbody>
                </table>
            <?php } elseif ($game == 'jsmt') {
                ?>
                <thead>
                <tr>
                    <th data-field="Code">期号</th>
                    <th>车道</th>
                    <th>内容</th>
                    <th>金额</th>
                    <th>投注时间</th>
                    <th>结果</th>
                </tr>
                </thead>
                <tbody>
                <?php
                select_query('fn_mtorder', '*', "`roomid` = '{$_SESSION['roomid']}' and `userid` = '{$_SESSION['userid']}' and `status` != '未结算' and `addtime` like '" . date('Y-m-d') . "%'");
                $all_m = 0;
                $all_z = 0;
                while ($con = db_fetch_array()) {
                    $cons[] = $con;
                    if ($con['status'] != '已退还' && $con['status'] != '已撤单') {
                        $all_m += (int)$con['money'];
                        if ((int)$con['status'] > 0) $all_z += (int)$con['status'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $con['term'];
                            ?></td>
                        <td><?php echo $con['mingci'];
                            ?></td>
                        <td><?php echo $con['content'];
                            ?></td>
                        <td><?php echo $con['money'];
                            ?></td>
                        <td><?php echo $con['addtime'];
                            ?></td>
                        <td class="<?php if ((int)$con['status'] > 0) echo 'win';
                        if ((int)$con['status'] < 0) echo 'lose';
                        if ($con['status'] == '已撤单') echo 'che';
                        ?>"><?php if ($con['status'] == '已撤单') {
                                echo '撤单';
                            } else {
                                echo $con['status'];
                            }
                            ?></td>
                    </tr>
                <?php }
                if (count($cons) == 0) {
                    echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                }
                ?>
                </tbody>
                </table>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>今日流水</th>
                        <th>今日盈亏(玩家)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $all_m;
                            ?></td>
                        <td><?php $a = '-' . $all_m;
                            echo (int)$a + $all_z;
                            ?></td>
                    </tr>
                    </tbody>
                </table>
            <?php } elseif ($game == 'pk10') {
                ?>
                <thead>
                <tr>
                    <th data-field="Code">期号</th>
                    <th>车道</th>
                    <th>内容</th>
                    <th>金额</th>
                    <th>投注时间</th>
                    <th>结果</th>
                </tr>
                </thead>
                <tbody>
                <?php
                select_query('fn_order', '*', "`roomid` = '{$_SESSION['roomid']}' and `userid` = '{$_SESSION['userid']}' and `status` != '未结算' and `addtime` like '" . date('Y-m-d') . "%'");
                $all_m = 0;
                $all_z = 0;
                while ($con = db_fetch_array()) {
                    $cons[] = $con;
                    if ($con['status'] != '已退还' && $con['status'] != '已撤单') {
                        $all_m += (int)$con['money'];
                        if ((int)$con['status'] > 0) $all_z += (int)$con['status'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $con['term'];
                            ?></td>
                        <td><?php echo $con['mingci'];
                            ?></td>
                        <td><?php echo $con['content'];
                            ?></td>
                        <td><?php echo $con['money'];
                            ?></td>
                        <td><?php echo $con['addtime'];
                            ?></td>
                        <td class="<?php if ((int)$con['status'] > 0) echo 'win';
                        if ((int)$con['status'] < 0) echo 'lose';
                        if ($con['status'] == '已撤单') echo 'che';
                        ?>"><?php if ($con['status'] == '已撤单') {
                                echo '撤单';
                            } else {
                                echo $con['status'];
                            }
                            ?></td>
                    </tr>
                <?php }
                if (count($cons) == 0) {
                    echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                }
                ?>
                </tbody>
                </table>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>今日流水</th>
                        <th>今日盈亏(玩家)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $all_m;
                            ?></td>
                        <td><?php $a = '-' . $all_m;
                            echo (int)$a + $all_z;
                            ?></td>
                    </tr>
                    </tbody>
                </table>
            <?php } elseif ($game == 'azxy10') {
                ?>
                <thead>
                <tr>
                    <th data-field="Code">期号</th>
                    <th>车道</th>
                    <th>内容</th>
                    <th>金额</th>
                    <th>投注时间</th>
                    <th>结果</th>
                </tr>
                </thead>
                <tbody>
                <?php
                select_query('fn_azxy10order', '*', "`roomid` = '{$_SESSION['roomid']}' and `userid` = '{$_SESSION['userid']}' and `status` != '未结算' and `addtime` like '" . date('Y-m-d') . "%'");
                $all_m = 0;
                $all_z = 0;
                while ($con = db_fetch_array()) {
                    $cons[] = $con;
                    if ($con['status'] != '已退还' && $con['status'] != '已撤单') {
                        $all_m += (int)$con['money'];
                        if ((int)$con['status'] > 0) $all_z += (int)$con['status'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $con['term'];
                            ?></td>
                        <td><?php echo $con['mingci'];
                            ?></td>
                        <td><?php echo $con['content'];
                            ?></td>
                        <td><?php echo $con['money'];
                            ?></td>
                        <td><?php echo $con['addtime'];
                            ?></td>
                        <td class="<?php if ((int)$con['status'] > 0) echo 'win';
                        if ((int)$con['status'] < 0) echo 'lose';
                        if ($con['status'] == '已撤单') echo 'che';
                        ?>"><?php if ($con['status'] == '已撤单') {
                                echo '撤单';
                            } else {
                                echo $con['status'];
                            }
                            ?></td>
                    </tr>
                <?php }
                if (count($cons) == 0) {
                    echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                }
                ?>
                </tbody>
                </table>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>今日流水</th>
                        <th>今日盈亏(玩家)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $all_m;
                            ?></td>
                        <td><?php $a = '-' . $all_m;
                            echo (int)$a + $all_z;
                            ?></td>
                    </tr>
                    </tbody>
                </table>
            <?php } elseif ($game == 'bjl') {
                ?>
                <thead>
                <tr>
                    <th data-field="Code">期号</th>
                    <th>内容</th>
                    <th>金额</th>
                    <th>投注时间</th>
                    <th>结果</th>
                </tr>
                </thead>
                <tbody>
                <?php
                select_query('fn_bjlorder', '*', "`roomid` = '{$_SESSION['roomid']}' and `userid` = '{$_SESSION['userid']}' and `status` != '未结算' and `addtime` like '" . date('Y-m-d') . "%'");
                $all_m = 0;
                $all_z = 0;
                while ($con = db_fetch_array()) {
                    $cons[] = $con;
                    if ($con['status'] != '已退还' && $con['status'] != '已撤单') {
                        $all_m += (int)$con['money'];
                        if ((int)$con['status'] > 0) $all_z += (int)$con['status'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $con['term'];
                            ?></td>
                        <td><?php echo $con['content'];
                            ?></td>
                        <td><?php echo $con['money'];
                            ?></td>
                        <td><?php echo $con['addtime'];
                            ?></td>
                        <td class="<?php if ((int)$con['status'] > 0) echo 'win';
                        if ((int)$con['status'] < 0) echo 'lose';
                        if ($con['status'] == '已撤单') echo 'che';
                        ?>"><?php if ($con['status'] == '已撤单') {
                                echo '撤单';
                            } else {
                                echo $con['status'];
                            }
                            ?></td>
                    </tr>
                <?php }
                if (count($cons) == 0) {
                    echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                }
                ?>
                </tbody>
                </table>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>今日流水</th>
                        <th>今日盈亏(玩家)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $all_m;
                            ?></td>
                        <td><?php $a = '-' . $all_m;
                            echo (int)$a + $all_z;
                            ?></td>
                    </tr>
                    </tbody>
                </table>
            <?php } elseif ($game == 'xyft') {
                ?>
                <thead>
                <tr>
                    <th data-field="Code">期号</th>
                    <th>车道</th>
                    <th>内容</th>
                    <th>金额</th>
                    <th>投注时间</th>
                    <th>结果</th>
                </tr>
                </thead>
                <tbody>
                <?php
                select_query('fn_flyorder', '*', "`roomid` = '{$_SESSION['roomid']}' and `userid` = '{$_SESSION['userid']}' and `status` != '未结算' and `addtime` like '" . date('Y-m-d') . "%'");
                $all_m = 0;
                $all_z = 0;
                while ($con = db_fetch_array()) {
                    $cons[] = $con;
                    if ($con['status'] != '已退还' && $con['status'] != '已撤单') {
                        $all_m += (int)$con['money'];
                        if ((int)$con['status'] > 0) $all_z += (int)$con['status'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $con['term'];
                            ?></td>
                        <td><?php echo $con['mingci'];
                            ?></td>
                        <td><?php echo $con['content'];
                            ?></td>
                        <td><?php echo $con['money'];
                            ?></td>
                        <td><?php echo $con['addtime'];
                            ?></td>
                        <td class="<?php if ((int)$con['status'] > 0) echo 'win';
                        if ((int)$con['status'] < 0) echo 'lose';
                        if ($con['status'] == '已撤单') echo 'che';
                        ?>"><?php if ($con['status'] == '已撤单') {
                                echo '撤单';
                            } else {
                                echo $con['status'];
                            }
                            ?></td>
                    </tr>
                <?php }
                if (count($cons) == 0) {
                    echo '<tr><td colspan="6">没有未结算订单</td></tr>';
                }
                ?>
                </tbody>
                </table>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>今日流水</th>
                        <th>今日盈亏(玩家)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $all_m;
                            ?></td>
                        <td><?php $a = '-' . $all_m;
                            echo (int)$a + $all_z;
                            ?></td>
                    </tr>
                    </tbody>
                </table>
            <?php }
            ?>
        </div>
    </div>
</div>
</html>