<?php
use yii\helpers\Url;
?>
<meta charset="utf8">
<style>
table{ border-collapse: collapse; border: 1px solid #ddd; width: 800px; margin: 0 auto;margin-top: 50px; background: rgba(121, 217, 221, 0.4); color: #666}
table tr{ height: 40px;}
table td{ border: 1px solid #ddd; text-align: center}

*{margin: 0; padding:0 ; font-family: 微软雅黑}
a{ text-decoration: none; color: #666;}

.top{ width: 100%; text-align: center;}
.top h2{ margin-top: 50px;}

form{ width: 450px; margin: 0 auto; margin-top: 50px;}
form input{
    width: 300px;
    height: 40px;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding-left: 5px;
    font-size: 14px;
}

form p{
    margin-top: 20px;
    width: 100%;
}

form span{
    width: 100px;
    text-align: right;
    display: inline-block;
}

.a_button{
    width: 150px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    background: green;
    color: #fff;
    display: block;
    border: 1px solid green;
    border-radius: 5px;
    margin: 0 auto;
}

form .time{
    width: auto;
    padding: 0 5px;
    font-size: 16px;
    font-weight: bold;
}

.remind{
    text-align: center;
    color: red;
}
</style>

<div class="top">
    <h2>登 录</h2>
</div>
<form>
<div class="main">
    <p>
        <span>手机号：</span>
        <input type="text" placeholder="请输入手机号">
    </p>
    <p>
        <span>密码：</span>
        <input type="password" placeholder="请输入密码">
    </p>
    <p class="remind"></p>
    <p>
        <a class="a_button" href="javascript:;">登录</a>
    </p>
</div>
</form>
<script type="text/javascript" src="assets/d4a662e6/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('.a_button').click(function(){
            var phone = $('input[type=text]').val();
            var pwd = $('input[type=password]').val();
            var url = "<?=Url::to(['login/login'])?>";
            $.post(url,{'phone':phone,'pwd':pwd},function(res){
                if(res.static){
                    alert('登陆成功')
                }else{
                    fun(res.errorSum);
                }
            },'json');
        })
        function fun(sum){
            if(sum==1){
                var str = '请60秒后再次登陆';
            }
            if(sum==2){
                var str = '请120秒后再次登陆';
            }
            if(sum==3){
                var str = '您已三次登录失败，请明天再次尝试。';
            }
            $('.remind').text(str);
        }

    })
</script>
