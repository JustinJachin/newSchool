<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:76:"F:\phpstudy_pro\WWW\school\public/../application/index\view\login\login.html";i:1584603371;s:68:"F:\phpstudy_pro\WWW\school\application\index\view\common\header.html";i:1584841499;s:68:"F:\phpstudy_pro\WWW\school\application\index\view\common\footer.html";i:1584578646;}*/ ?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo (isset($title) && ($title !== '')?$title:'校园社团活动场地申请系统'); ?></title>
        
        <!--Favicon -->
        <link rel="icon" href="favicon.ico" type="image/x-icon"/>

        <!--Bootstrap.min css-->
        <link rel="stylesheet" href="/../static/plugins/bootstrap/css/bootstrap.min.css">

        <!--Icons css-->
        <link rel="stylesheet" href="/../static/css/icons.css">

        <!--Style css-->
        <link rel="stylesheet" href="/../static/css/style.css">

        <!--mCustomScrollbar css-->
        <link rel="stylesheet" href="/../static/plugins/scroll-bar/jquery.mCustomScrollbar.css">

        <!--Sidemenu css-->
        <link rel="stylesheet" href="/../static/plugins/toggle-menu/sidemenu.css">

        <!--Toastr css 弹框-->
        <link rel="stylesheet" href="/../static/plugins/toastr/build/toastr.css">
        <link rel="stylesheet" href="/../static/plugins/toaster/garessi-notif.css">


        <!--Select2 css 下拉框-->
        <link rel="stylesheet" href="/../static/plugins/select2/select2.css">

     
    </head>
    <body class="bg-primary">
        <div id="app">
            <section class="section section-2">
                <div class="container">
                    <div class="row">
                        <div class="single-page single-pageimage construction-bg cover-image " data-image-src="/../static/img/news/img14.jpg">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="wrapper wrapper2">
                                        <form id="login" class="card-body" tabindex="500" enctype="multipart/form-data" method="POST">
                                            <h3>登录</h3>
                                            <div class="email">
                                                <input type="text" id="username" name="username" >
                                                <label>编号/学号</label>
                                            </div>
                                            <div class="passwd">
                                                <input type="password" id="password" name="password" required="required">
                                                <label>密码</label>
                                            </div>
                                            <div class="mail">
                                                 <div class="form-group overflow-hidden">
                                                    <select class="form-control select2 w-100 select3-d"name="type">
                                                        <option selected="selected" value="0">管理员</option>
                                                        <option value="1">教师</option>
                                                        <option value="2">学生</option>
                                                    </select> 
                                                </div>
                                                <label>角色</label>
                                            </div>
                                            <div class="mail">
                                                <input type="text" id="code" name="code" style="width: 30%;margin-right:80%" required="required" >
                                                <img src="<?php echo url('index/login/verify'); ?>" onclick="changeCode(this)" style="margin-left: 32%;margin-top: -60px"/>
                                                <label>验证码</label>
                                            </div>
                                            

                                            <div class="submit">
                                                
                                                <button type="submit" class="btn btn-primary btn-block">登录</button>
                                            </div>
                                            <p class="mb-2"><a href="forgot.html" >忘记密码？</a></p>
                                        </form>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="log-wrapper text-center">
                                        <img src="/../static/img/brand/logo_whiteo.png" class="mb-2 mt-4 mt-lg-0 " alt="logo">
                                        <p></p>
                                        <p style="font-size: 34px;font-family: 方正舒体;margin-top: 30px">校园社团活动场地申请系统</p>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </section>
        </div>

        <!--Jquery.min js-->
        <script src="/../static/js/jquery.min.js"></script>

        <!--popper js-->
        <script src="/../static/js/popper.js"></script>

        <!--Tooltip js-->
        <script src="/../static/js/tooltip.js"></script>

        <!--Bootstrap.min js-->
        <script src="/../static/plugins/bootstrap/js/bootstrap.min.js"></script>

        <!--Jquery.nicescroll.min js-->
        <script src="/../static/plugins/nicescroll/jquery.nicescroll.min.js"></script>

        <!--Scroll-up-bar.min js-->
        <script src="/../static/plugins/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
        
        <script src="/../static/js/moment.min.js"></script>

        <!--mCustomScrollbar js-->
        <script src="/../static/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

        <!--Sidemenu js-->
        <script src="/../static/plugins/toggle-menu/sidemenu.js"></script>

        <!--Scripts js-->
        <script src="/../static/js/scripts.js"></script>

        <!--Toastr js-->
        <script src="/../static/plugins/toastr/build/toastr.min.js"></script>
        <script src="/../static/plugins/toaster/garessi-notif.js"></script>

        <!--Select2 js-->
        <script src="/../static/plugins/select2/select2.full.js"></script>

        <!--forms js-->
        <script src="/../static/js/forms.js"></script>

    </body>
</html>
<!--Inputmask js-->
<script src="/../static/plugins/inputmask/jquery.inputmask.js"></script>
<!--Bootstrap-daterangepicker js-->
<script src="/../static/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<!--Bootstrap-datepicker js-->
<script src="/../static/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<!--iCheck js-->
<script src="/../static/plugins/iCheck/icheck.min.js"></script>

<!--Bootstrap-colorpicker js-->
<script src="/../static/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>

<!--Bootstrap-timepicker js-->
<script src="/../static/plugins/bootstrap-timepicker/bootstrap-timepicker.js"></script>

<!--mCustomScrollbar js-->
<script src="/../static/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

<script>
    // 点击验证码刷新图片
    function changeCode(obj){
        var url = "<?php echo url('login/verify',['random'=>"+Math.random+"]); ?>";  //兼容低版本的浏览器
        obj.src = url;
    }

    $("#login").submit(function(){
            var formData = $("#login").serialize();//serialize() 方法通过序列化表单值，创建 URL 编码文本
           
            $.ajax({
                type:'post',
                url:"<?php echo url('/index/login/usercheck'); ?>",
                data:formData,
                // async:true,
                dataType:'json',
                success:function(data){
                    if(data.status==1){
                        window.location.href=data.msg;
                    }else if(data.status==2){
                        toastr.error('', '您已经登录，请勿重复登录');
                        setTimeout("window.location.href='index/index'",1000);
                    }else{
                        toastr.error('', data.msg);
                        setTimeout("window.history.back(-1)",200);
                    }
                },
                error:function(msg){
                    toastr.error('请联系管理员admin', '系统错误1111');
                }
            })
        
        });
</script>