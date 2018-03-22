<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:88:"/home/wwwroot/au.skxto9314.com/public/../application/admin/view/permission/editrole.html";i:1519888423;}*/ ?>
<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <title>
            X-admin v1.0
        </title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <link rel="stylesheet" href="../../static/admin/css/x-admin.css" media="all">
    </head>
    
    <body>
        <div class="x-body">
            <form action="" method="post" class="layui-form layui-form-pane">
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>角色名
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="username" required="" lay-verify="required" value="<?php echo $rname; ?>" name="rname" 
                        autocomplete="off" class="layui-input">
                    </div>
                </div>










                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">
                        拥有权限
                    </label>
                    <table  class="layui-table layui-input-block">
                        <tbody>
                        <?php if(!empty($res)): foreach($res as $val): if($val['level'] == 2): ?>
                            <tr>
                                <td>
                                    <?php echo $val['name']; ?>
                                </td>
                                <td>
                                    <div class="layui-input-block" id="role_id">
                                        <?php foreach($res as $v): ?>
                                        <!-- 权限表分pid父did 是perid -->
                                            <?php if($val['nid'] == $v['pid']): ?>
                                                <!-- perid 是所有的权限的id所在是数组-->
                                                <?php if(in_array($v['nid'] , $perid)): ?>
                                                    <input name="pid['<?php echo $v['nid']; ?>']" type="checkbox" value="<?php echo $v['pid'].'_'.$v['nid']; ?>" checked=""> <?php echo $v['name']; else: ?>                                              
                                                    <input name="pid['<?php echo $v['nid']; ?>']" type="checkbox" value="<?php echo $v['pid'].'_'.$v['nid']; ?>"> <?php echo $v['name']; endif; endif; endforeach; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; endforeach; endif; ?> 
                        </tbody>
                    </table>
                </div>

















                <div class="layui-form-item layui-form-text">
                    <label for="desc" class="layui-form-label">
                        描述
                    </label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入内容" id="desc" name="desc" class="layui-textarea"><?php echo $remark; ?></textarea>
                    </div>
                </div>
                <input type="hidden" type="text" name='role_id' value="<?php echo $role_id; ?>" />
                <div class="layui-form-item">
                <button id='btn' class="layui-btn" lay-submit="" lay-filter="save">保存</button>
              </div>
            </form>
        </div>
        <script src="../../static/admin/lib/layui/layui.js" charset="utf-8">
        </script>
        <script src="../../static/admin/js/x-layui.js" charset="utf-8">
        </script>
        <script>
            layui.use(['form','layer'], function(){
                $ = layui.jquery;
              var form = layui.form()
              ,layer = layui.layer;


              $('#btn').click(function(){
                    // var name = $('[name=rname]').val();
                    // var remark = $('[name=desc]').val();
                    var role_id = $('[name=role_id]').val();

                var pid_arr = new Array();
                    $("input[name^='pid']:checked").each(function(){
                      pid_arr.push($(this).val());   
                    })

                    $.ajax({

                        type:'post',
                        url:'/admin/permission/doeditrole',
                        data:{id:pid_arr.toString(),role_id:role_id},
                        success:success

                    });

                    function success(data)
                    {
                        var obj = JSON.parse(data);

                        if(obj['state'] == 1)
                        {
                            layer.alert('修改成功' , {icon:6},function () {
                            // 刷新父页面
                            window.location.href = '/admin/permission/rolelist';
                            // 获得frame索引
                            var index = parent.layer.getFrameIndex(window.name);
                            //关闭当前frame
                            parent.layer.close(index);
                            });
                        }else
                        {

                            layer.alert('修改失败' , {icon:6},function () {
                            // 刷新父页面
                            window.location.href = '/admin/permission/rolelist';
                             });
                        }
                    }
                    return false;

              });
              
              
            });
        </script>
        <script>
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
          var s = document.getElementsByTagName("script")[0]; 
          s.parentNode.insertBefore(hm, s);
        })();
        </script>
    </body>

</html>