<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!-- saved from url=(0041)http://porter.weiyinstudio.com/Home/Index/tgbz/ -->

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">



    <meta name="robots" content="noindex,nofollow">

    <meta name="robots" content="noarchive">

    <!-- 屏蔽-->

    <title>EBT
-COIN</title>

    <meta name="keywords" content=" ">

    <meta name="viewport" content="initial-scale=1, maximum-scale=1">

    <meta name="apple-mobile-web-app-capable" content="yes">

    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <meta content="IE=9; IE=EDGE" http-equiv="X-UA-Compatible">

    <link rel="stylesheet" href="/Public/ybt/css/sm.css">

    <script src="/Public/ybt/js/jquery-1.10.2.min.js"></script>

	<script src="/Public/ybt/js/leftTime.min.js"></script>

	



    <link rel="stylesheet" href="/Public/ybt/css/sm-extend.css">



    <link rel="stylesheet" href="/Public/ybt/css/iconfont.css">

    <!--自定义-->

    <link rel="stylesheet" href="/Public/ybt/css/main.css">

    <link rel="stylesheet" href="/Public/ybt/css/order.css">



</head>

<body style="">

<script type="text/javascript">



    var sid = '554076';



</script>

<script language="javascript">

    function get_mobile_code(){



        document.getElementById('zphone').value = '正在发送';

        //document.getElementById('zphone').disabled = true;

        //mobile:jQuery.trim($('#mobile').val()),

        $.post('/Home/Index/fssjyzm', {send_code:sid}, function(msg) {

            alert(jQuery.trim(unescape(msg)));

            if(msg=='验证码发送成功'){

                RemainTime();

            }else{

                document.getElementById('zphone').value = '重新发送';

                document.getElementById('zphone').disabled = false;

            }

        });

    };

    var iTime = 59;

    var Account;

    function RemainTime(){

        document.getElementById('zphone').disabled = true;

        var iSecond,sSecond="",sTime="";

        if (iTime >= 0){

            iSecond = parseInt(iTime%60);

            iMinute = parseInt(iTime/60)

            if (iSecond >= 0){

                if(iMinute>0){

                    sSecond = iMinute + "分" + iSecond + "秒";

                }else{

                    sSecond = iSecond + "秒";

                }

            }

            sTime=sSecond;

            if(iTime==0){

                clearTimeout(Account);

                sTime='获取手机验证码';

                iTime = 59;

                document.getElementById('zphone').disabled = false;

            }else{

                Account = setTimeout("RemainTime()",1000);

                iTime=iTime-1;

            }

        }else{

            sTime='没有倒计时';

        }

        document.getElementById('zphone').value = sTime;

    }

</script>

<!-- <div class="page">-->



<!-- 标题栏 -->

<header class="bar bar-nav">



    <a style="position: absolute;z-index: 19;width: 94%;text-align: center;display: inline-block;line-height: 50px;font-size: 1.1rem; color:#FFF;">交易平台</a>    <div class="logo">

    <a id="cancle" href="javascript:history.go(-1)"><i class="icon icon-left"></i></a>    </div>

    <a class="icon pull-right open-panel"></a>

</header>

<nav class="foot-bar">

    <div class="foot-menu"><a href="<?php echo U('Index/Emoney/shouye');?>">

        <i class="iconfont icon-shouye"></i><span>首页</span></a></div>

    <div class="foot-menu"><a href="<?php echo U('Index/Shop/orderlist');?>">

        <i class="iconfont icon-wxbmingxingdianpu"></i><span>我的矿机</span></a></div>

    <div class="foot-menu"><a href="<?php echo U('Index/Account/myAccount');?>">

        <i class="iconfont icon-gouwuche"></i><span>我的团队</span></a></div>

    <div class="foot-menu"><a href="<?php echo U('Index/Emoney/index');?>">

        <i class="iconfont icon-wxbdingwei"></i><span>交易平台</span></a></div>

    <div class="foot-menu"><a href="/">

        <i class="iconfont icon-geren"></i><span>会员中心</span></a></div>

</nav>



<!-- Main Container start -->

<div class="content" id="main_content">



    <div class="buttons-tab">

        <a href="<?php echo U('Index/Emoney/index');?>" class="button">交易大厅</a>

        <a href="<?php echo U('Index/Emoney/mairu');?>" class="active button">买入EBT
</a>

        <a href="<?php echo U('Index/Emoney/maichu');?>" class=" button">卖出EBT
</a>



    </div>



    <!--表单开始-->

    <br>



    <h4 style="color: #333333; font-size:18px;">申请买入</h4>

    <hr color="#333333" size="1">

    <div class="list-block">

        <form class="cmxform form-horizontal tasi-form" name="form1" id="form1" method="post" action="<?php echo U('Emoney/mrpost');?>">

            <ul>

                <li>

                    <div class="item-content">

                        <div class="item-media"><i class="icon icon-form-name"></i></div>

                        <div class="item-inner">

                            <div class="item-title label">申请数量</div>

                            <div class="item-input">

                                <select id="amount" name="amount">

                                    <option value="0">请选择数量</option>





                                    <option value="10">10</option>

                                    <option value="20">20</option>

                                    <option value="50">50</option>

                                    <option value="100">100</option>

                                    <!-- <option value="200">200</option> -->

                                </select>

                            </div>

                        </div>

                    </div>

                </li>

                <li>

                    <div class="item-content">

                        <div class="item-media"><i class="icon icon-form-name"></i></div>

                        <div class="item-inner">

                            <div class="item-title label">单价</div>

                            <div class="item-input">

                                <!--最低0.0000$,最高0.0000$--><!--指导价:0.0000$-0.0000$--><?php echo ($jiage); ?>                            <!--<input id="dj" name="dj" type="text" value="" placeholder="单价:3.2900" style="font-size:16px;">-->

                            </div>

                        </div>

                    </div>

                </li>

                <!--  <li>

                    <div class="item-content">

                        <div class="item-media"><i class="icon icon-form-name"></i></div>

                        <div class="item-inner">

                            <div class="item-title label">验信验证码</div>

                            <div class="item-input">

                                <input name="mobile_code" type="text"  id="mobile_code" size="6" maxlength="6" placeholder="请输入验证码" /> <input name="button" type="button"   style="width:200px;" id="zphone" onClick="get_mobile_code();" value="获取验证码" />

                            </div>

                        </div>

                    </div>

                </li>-->



            </ul>

        </form>

    </div>

    <div class="content-block">

        <div class="row">



            <div class="col-50"><a onclick="document.getElementById('form1').submit();" id="submit" class="button button-big button-fill button-success js-tixian-submit">确认申请</a></div>

            <div class="col-50"><a href="<?php echo U('Emoney/mairu');?>" class="button button-big button-fill button-dark">取消</a></div>

        </div>

    </div>



    <!--表单结束-->





    <!--表格开始-->

    <div class="tabs"><br>



        <h4 style="color: #333333; font-size:18px;">我的买入列表</h4>

        <hr color="#333333" size="1">

        <div class="card">



            <table width="100%" border="0" cellpadding="0" cellspacing="0" id="table-5">

                <thead>

                <tr>

                    <th align="center"><div align="center">数量</div></th>



                    <th align="center"><div align="center">单价</div></th>

                    <th align="center"><div align="center">合计金额</div></th>

                    <th align="center"><div align="center">状态</div></th>

                    <th align="center"><div align="center">挂单时间</div></th>

                    <th align="center"><div align="center">操作</div></th>

                </tr>

                </thead>

                <tbody>

                <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>

                        <td align="center" valign="middle"><?php echo ($v["cbt"]); ?></td>

                        <td align="center" valign="middle"><?php echo ($v["danjia"]); ?></td>

                        <td align="center" valign="middle"><?php echo ($v["qian"]); ?>$</td>



                        <td align="center" valign="middle">

                            <?php if($v["zt"] == 0): ?><span style="color:red" id="w_<?php echo ($v["id"]); ?>">等待中</span><?php endif; ?> <?php if($v["zt"] == 1): ?>交易中<?php endif; ?>

                            <?php if($v["zt"] == 2): ?>交易完成<?php endif; ?></td>

                        <td align="center" valign="middle"><span  class="money" ><?php echo (date('Y-m-d H:i:s',$v["date"])); ?></span></td>

                        <td align="center" valign="middle">

                            <?php if($v["zt"] == 0): ?><span  class="money" ><a class="button button-fill button-warning" style="width:80px;font-size:16px;" onclick="if(confirm('只有未匹配成功的订单才可以撤销，确认撤销吗?')==false)return false;" href="<?php echo U('Emoney/mrchexiao',array('id'=>$v['id']));?>">撤销</a></span><?php endif; ?>

                            <?php if($v["zt"] == 1): ?><span  class="money" ><a class="button button-fill1 button-warning" style="width:80px;font-size:16px;" onclick="if(confirm('不可操作，订单正在交易中！')==false)return false;">交易中</a></span><?php endif; ?>

                            <?php if($v["zt"] == 2): ?><span  class="money" ><a class="button button-fill2 button-warning" style="width:80px;font-size:16px;" onclick="if(confirm('不可操作，订单已交易完成！')==false)return false;">交易完成</a></span><?php endif; ?>

                        </td>

                    </tr>



<script>		

$.leftTime("<?php echo date('Y/m/d H:i:s',$v['date']+7200);?>",function(d<?php echo ($v["id"]); ?>){

	if(d<?php echo ($v["id"]); ?>.status){

		//d.status 状态

		//d.d 天

		//d.h 时

		//d.m 分

		//d.s 秒

		$("#w_<?php echo ($v["id"]); ?>").text(d<?php echo ($v["id"]); ?>.h+'小时'+d<?php echo ($v["id"]); ?>.m+'分'+d<?php echo ($v["id"]); ?>.s+'秒');

	}else{

		$("#w_<?php echo ($v["id"]); ?>").text('交易中');

		$.get('<?php echo U('jyzx',array('type'=>'mr','id'=>$v['id']));?>',function(res){

		});

	}

});</script><?php endforeach; endif; ?>

                </tbody>

            </table>

        </div>

    </div>

    <div style="text-align: center"><?php echo ($page); ?></div>



    <!--表格结束-->

    <!--表格开始-->

    <div class="tabs"><br>



        <h4 style="color: #333333; font-size:18px;">我的买入交易列表</h4>

        <hr color="#333333" size="1">

        <div class="card">

            <?php if(is_array($lists)): foreach($lists as $key=>$l): ?><table width="100%" border="0" cellpadding="0" cellspacing="0" id="table-5">



                    <tbody>

                    <tr>

                        <th colspan="4" bgcolor="#CCCCCC">



                            <?php if($l['zt'] == 1): if(empty($l['image'])): ?><span id="ww_<?php echo ($l["id"]); ?>">交易状态: 等待打款</span>

									

									

<script>		

$.leftTime("<?php echo date('Y/m/d H:i:s',$l['date']+7200);?>",function(dd<?php echo ($l["id"]); ?>){

	if(dd<?php echo ($l["id"]); ?>.status){

		//d.status 状态

		//d.d 天

		//d.h 时

		//d.m 分

		//d.s 秒

		$("#ww_<?php echo ($l["id"]); ?>").text(dd<?php echo ($l["id"]); ?>.h+'小时'+dd<?php echo ($l["id"]); ?>.m+'分'+dd<?php echo ($l["id"]); ?>.s+'秒');

	}else{

		$("#ww_<?php echo ($l["id"]); ?>").text('交易状态:交易超时');

		$.get('<?php echo U('jyzx',array('type'=>'mr','id'=>$l['id']));?>',function(res){

		});

	}

});</script>

                                    <?php else: ?>

                                    交易状态: 等待确认<?php endif; endif; ?>

                            <?php if($l['zt'] == 2): ?>交易状态: 已确认<?php endif; ?>

                        </th>





                        </th>

                    </tr>

                    <tr>

                        <td><?php echo (date('Y-m-d H:i:s',$l["date"])); ?></td>

                        <td>买入数量:  <font color="red"> <?php echo ($l["cbt"]); ?></font></td>

                        <td>单价:   <font color="red"><?php echo ($l["danjia"]); ?>$</font> </td>

                        <td>总额:   <font color="red"><?php echo ($l["total"]); ?>$</font></td>

                    </tr>



                    <?php if($l['zt'] == 1): ?><tr>



                        <?php if(empty($l['image'])): ?><td><a href="<?php echo U('Emoney/sctp',array('id'=>$l['id']));?>" class="button button-fill button-warning"  style="width:80px;font-size:16px;align:center;" >上传图片</a></td>

                            <?php else: ?>

                            <td><a class="button button-fill1 button-warning" onclick="if(confirm('付款图片已经上传，请等待卖家操作！')==false)return false;" style="width:80px;font-size:16px;align:center;" >已经上传</a></td><?php endif; ?>



                        <td><a class="button button-fill button-warning" href="<?php echo U('Emoney/mcxq',array('id'=>$l['id']));?>" style="width:80px;font-size:16px;align:center;" >详细信息</a></td>





                        <td>

                            <a href="<?php echo U('Emoney/tousu',array('id'=>$l['id']));?>" class="button button-fill button-warning"  style="width:80px;font-size:16px;align:center;" >投诉</a>



                        </td>





                        <td><a class="button button-fill button-warning" href="<?php echo U('Emoney/mrwc',array('id'=>$l['id']));?>"  style="width:80px;font-size:16px;align:center;" >完成交易</a></td>

                    </tr><?php endif; ?>



                    </tbody>

                </table><?php endforeach; endif; ?>

        </div>

    </div>





    <!--表格结束-->



</div>







</body></html>