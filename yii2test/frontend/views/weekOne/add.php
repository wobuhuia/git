<?php
use yii\helpers\url;
?>
<meta charset="utf8">
<style>
table{ border-collapse: collapse; border: 1px solid #ddd; width: 800px; margin: 0 auto;margin-top: 50px; background: rgba(121, 217, 221, 0.4); color: #666}
table tr{ height: 40px;}
table td{ border: 1px solid #ddd; text-align: center}

*{margin: 0; padding:0 ; font-family: 微软雅黑}
a{ text-decoration: none; color: #666;}
ul{ list-style: none}

.top{ width: 100%; background: rgba(14, 196, 210, 0.99); color: #fff; height: 100px; line-height: 150px; text-align: right;}
.top span{ margin-right: 20px}


.left{ width: 260px; float: left; height: 100%; background: rgba(121, 217, 221, 0.4)}
.left ul{ list-style: none; width: 100%;}
.left ul li{ height: 40px; width: 100%; border: 1px solid #ddd; line-height: 40px; text-align: center;}
.left .selected{ background: rgba(14, 196, 210, 0.99);}
.left .selected a{ color: #fff;}


.right{ float: left; width: 1000px;}
.search-box{ width: 900px; margin: 0 auto; margin-top: 100px; }
.right li{
    margin-top: 20px;
}
.right span{
    display: inline-block;
    width: 200px;
    line-height: 40px;
    height: 40px;
    text-align: right;
    margin-right: 20px;
}

.right .filed-name{
    width: 300px;
    line-height: 40px;
    height: 40px;
    border: 1px solid #ddd;
    border-radius: 3px;
    font-size: 14px;
}

.right .length{
    width: 140px;
    line-height: 40px;
    height: 40px;
    border: 1px solid #ddd;
    border-radius: 3px;
    font-size: 14px;
}

.submit{
    width: 150px;
    height: 40px;
    line-height: 40px;
    border-radius: 3px;
    border: 1px solid #ddd;
    display: inline-block;
    background: rgba(14, 196, 210, 0.99);
    color: #fff;
    text-align: center;
    margin-left: 200px;
    margin-top: 20px;
}
</style>

<div class="top">
    <span>欢迎管理员：admin</span>
</div>

<div class="left">
    <ul>
        <li class="selected"><a href="<?php echo Url::to(['weekone/index'])?>">查看注册字段</a></li>
        <li><a href="<?php echo Url::to(['weekone/add'])?>">添加注册字段</a></li>
    </ul>
</div>

<div class="right">
    <div class="search-box">
        <form action="<?php Url::to(['weekone/add'])?>" method="post">
            <ul>
                <li>
                    <span>请输入字段名称：</span>
                    <input name="field_name" type="text" value="<?php if($arr) echo $arr['field_name']?>">
                </li>
                <li>
                    <span>请输入字段默认值：</span>
                    <input name="field_name_default" type="text" value="<?php if($arr) echo $arr['field_name_default']?>">
                </li>
                <li>
                    <span>请选择字段类型：</span>
                    <select name="field_type" id="">
                        <option value="input-text" <?php if($arr) if($arr['field_type'] == 'input-text') echo 'checked';?>>文本框</option>
                        <option value="input-radio" <?php if($arr) if($arr['field_type'] == 'input-radio') echo 'checked';?>>单选框</option>
                        <option value="input-password" <?php if($arr) if($arr['field_type'] == 'input-password') echo 'checked';?>>密码框</option>
                        <option value="textarea" <?php if($arr) if($arr['field_type'] == 'textarea') echo 'checked';?>>文本域</option>
                    </select>
                </li>
                <li>
                    <span>是否必填：</span>
                    <input name='field_is_write' type="checkbox" value="是" <?php if($arr) if($arr['field_is_write'] == '是') echo 'checked';?>>必填
                </li>
                <li>
                    <span>请选择验证规则：</span>
                    <select name="field_guize" id="">
                        <option value="">无</option>
                        <option value="phone" <?php if($arr) if($arr['field_guize'] == 'phone') echo 'checked';?>>手机号码</option>
                        <option value="length" <?php if($arr) if($arr['field_guize'] == 'length') echo 'checked';?>>长度</option>
                    </select>
                </li>
                <li>
                    <span>请选择填写长度范围：</span>
                    <input name="smail" class="length" type="text" value="<?php if($arr) echo $arr['smail']?>" placeholder="请输入最小长度">
                    ~ 
                    <input name="big" class="length" type="text" value="<?php if($arr) echo $arr['big']?>" placeholder="请输入最大长度">
                </li>
                <li>
                    <input type="submit" class="submit" value="提交">
                     <input name="_csrf-frontend" type="hidden" id="_csrf-frontend" value="<?= Yii::$app->request->csrfToken ?>">
                     <input type="hidden" name="id" value="<?php if($arr) echo $arr['field_id']?>">
                </li>
            </ul>
        </form>
    </div>
</div>