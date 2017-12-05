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

.top{ width: 100%; background: rgba(14, 196, 210, 0.99); color: #fff; height: 100px; line-height: 150px; text-align: right;}
.top span{ margin-right: 20px}


.left{ width: 260px; float: left; height: 100%; background: rgba(121, 217, 221, 0.4)}
.left ul{ list-style: none; width: 100%;}
.left ul li{ height: 40px; width: 100%; border: 1px solid #ddd; line-height: 40px; text-align: center;}
.left .selected{ background: rgba(14, 196, 210, 0.99);}
.left .selected a{ color: #fff;}


.right{ float: left; width: 1000px;}
.title{ background: rgba(14, 196, 210, 0.99); color: #fff}
.search-box{ width: 900px; margin: 0 auto; margin-top: 100px; }
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
        <table>
            <tr class="title">
                <td>ID</td>
                <td>字段名</td>
                <td>字段类型</td>
                <td>字段默认值</td>
                <td>是否必填</td>
                <td>验证规则</td>
                <td>字符数限制</td>
                <td>操作</td>
            </tr>
        <?php foreach ($arr as $key => $value) {?>
            <tr>
                <td><?= $value['field_id']?></td>
                <td><?= $value['field_name']?></td>
                <td><?= $value['field_type']?></td>
                <td><?= $value['field_name_default']?></td>
                <td><?= $value['field_is_write']?></td>
                <td><?= $value['field_guize']?></td>
                <td><?= $value['field_num']?></td>
                <td>
                    <a href="<?php echo Url::to(['weekone/add','id'=>$value['field_id']])?>">编辑</a>
                    |
                    <a href="<?php echo Url::to(['weekone/del','id'=>$value['field_id']])?>">删除</a>
                </td>
            </tr>
        <?php }?>
        </table>
    </div>
</div>