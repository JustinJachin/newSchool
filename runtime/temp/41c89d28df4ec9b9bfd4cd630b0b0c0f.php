<?php if (!defined('THINK_PATH')) exit(); /*a:8:{s:78:"F:\phpstudy_pro\WWW\school\public/../application/index\view\profile\index.html";i:1584847099;s:68:"F:\phpstudy_pro\WWW\school\application\index\view\public\header.html";i:1584886127;s:65:"F:\phpstudy_pro\WWW\school\application\index\view\public\css.html";i:1584950006;s:66:"F:\phpstudy_pro\WWW\school\application\index\view\public\body.html";i:1584886302;s:66:"F:\phpstudy_pro\WWW\school\application\index\view\public\menu.html";i:1584846844;s:70:"F:\phpstudy_pro\WWW\school\application\index\view\public\menuleft.html";i:1585041408;s:68:"F:\phpstudy_pro\WWW\school\application\index\view\public\footer.html";i:1585128032;s:64:"F:\phpstudy_pro\WWW\school\application\index\view\public\js.html";i:1584926692;}*/ ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo (isset($title) && ($title !== '')?$title:'校园社团活动场地申请系统'); ?></title>
        
<!--favicon -->
<link rel="icon" href="/../static/img/favicon.ico" type="image/x-icon"/>

<!--Bootstrap.min css-->
<link rel="stylesheet" href="/../static/plugins/bootstrap/css/bootstrap.min.css">

<!--Icons css-->
<link rel="stylesheet" href="/../static/css/icons.css">
<link rel="stylesheet" href="/../static/css/common.css">

<!--Style css-->
<link rel="stylesheet" href="/../static/css/style.css">

<!--mCustomScrollbar css-->
<link rel="stylesheet" href="/../static/plugins/scroll-bar/jquery.mCustomScrollbar.css">

<!--Sidemenu css-->
<link rel="stylesheet" href="/../static/plugins/toggle-menu/sidemenu.css">

<!--Morris css-->
<link rel="stylesheet" href="/../static/plugins/morris/morris.css">


<!--Toastr css 弹框-->
<link rel="stylesheet" href="/../static/plugins/toastr/build/toastr.css">
<link rel="stylesheet" href="/../static/plugins/toaster/garessi-notif.css">


<!--Select2 css 下拉框-->
<link rel="stylesheet" href="/../static/plugins/select2/select2.css">
    </head>
    <body class="app ">
    	<div id="spinner"></div>
        <div id="app">
            <div class="main-wrapper" >
      
        
    <nav class="navbar navbar-expand-lg main-navbar">
    <a class="header-brand" href="index.html">
        <img src="/../static/img/brand/logo.png" class="header-brand-img" alt="Kharna-Admin  logo">
    </a>
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="ion ion-navicon-round"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-md-none navsearch"><i class="ion ion-search"></i></a></li>
        </ul>
       <!--  <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-primary" type="submit"><i class="ion ion-search"></i></button>
        </div> -->
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="ion-ios-email-outline"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Messages
                    <div class="float-right">
                        <a href="#">View All</a>
                    </div>
                </div>
                <div class="dropdown-list-content">
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <img alt="image" src="/../static/img/avatar/avatar-1.jpeg.jpg" class="rounded-circle dropdown-item-img">
                        <div class="dropdown-item-desc">
                            <div class="dropdownmsg d-flex">
                                <div class="">
                                    <b>Stewart Ball</b>
                                    <p>Your template awesome</p>
                                </div>
                                <div class="time">6 hours ago</div>
                            </div>

                        </div>
                    </a>
                    
                </div>
            </div>
        </li>
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
            <img src="/../static<?php echo \think\Session::get('pic'); ?>" alt="profile-user" class="rounded-circle w-32">
            <div class="d-sm-none d-lg-inline-block"><?php echo \think\Session::get('admin_name'); ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="<?php echo url('index/profile/index'); ?>" class="dropdown-item has-icon">
                    <i class="ion ion-android-person"></i> 个人信息
                </a>
                <a href="<?php echo url('index/profile/indexPassword'); ?>" class="dropdown-item has-icon">
                    <i class="ion ion-briefcase"></i> 修改密码
                </a>
                <a href="<?php echo url('index/login/logout'); ?>" class="dropdown-item has-icon">
                    <i class="ion-ios-redo"></i> 退出
                </a>
            </div>
        </li>
    </ul>
</nav>


    <aside class="app-sidebar">
    <div class="app-sidebar__user">
        <div class="dropdown">
            <a class="nav-link pl-2 pr-2 leading-none d-flex" data-toggle="dropdown" href="#">
                <img alt="image" src="/../static<?php echo \think\Session::get('pic'); ?>" class=" avatar-md rounded-circle">
                <span class="ml-2 d-lg-block">
                    <span class="text-white app-sidebar__user-name mt-5"><?php echo \think\Session::get('admin_name'); ?></span><br>
                    <span class="text-muted app-sidebar__user-name text-sm">你好，
                    <?php switch(\think\Session::get('admin_type')): case "0": ?>管理员<?php break; case "1": ?>老师<?php break; case "2": ?>学生<?php break; default: ?>未知
                    <?php endswitch; ?>
                    </span>
                </span>
            </a>
        </div>
    </div>
    <ul class="side-menu">
            <li>
                <a class="side-menu__item" href="<?php echo url('index/index'); ?>"><i class="side-menu__icon fa fa-home"></i><span class="side-menu__label">主页</span></a>
            </li>
        <?php switch(\think\Session::get('admin_type')): case "0": ?>
            <li class="slide">
                <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fa fa-users"></i><span class="side-menu__label">用户管理</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <?php if(\think\Session::get('uid') == '1'): ?>
                    <li><a class="slide-item"  href="<?php echo url('Admin/index'); ?>"><span>管理员管理</span></a></li>
                    <?php endif; ?>
                    <li><a class="slide-item" href="<?php echo url('Teacher/index'); ?>"><span>教师管理</span></a></li>
                    <li><a class="slide-item" href="<?php echo url('Student/index'); ?>"><span>学生管理</span></a></li>
                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fa fa-institution"></i><span class="side-menu__label">教室管理</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item"  href="#"><span>教室管理</span></a></li>
                    <li><a class="slide-item" href="index2.html"><span>出借管理</span></a></li>
                    <li><a class="slide-item" href="index3.html"><span>预约审批</span></a></li>
                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fa fa-desktop"></i><span class="side-menu__label">信息管理</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item"  href="#"><span>公告管理</span></a></li>
                    <li><a class="slide-item" href="index2.html"><span>故障申报</span></a></li>
                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fa fa-cogs"></i><span class="side-menu__label">院校管理</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item"  href="<?php echo url('campus/index'); ?>"><span>校区管理</span></a></li>
                    <li><a class="slide-item"  href="<?php echo url('Academey/index'); ?>"><span>学院管理</span></a></li>
                    <li><a class="slide-item"  href="<?php echo url('Profession/index'); ?>"><span>专业管理</span></a></li>
                    <li><a class="slide-item" href="index2.html"><span>班级管理</span></a></li>
                </ul>
            </li>
            <?php break; case "1": ?>
            <li class="slide">
                <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fa fa-user"></i><span class="side-menu__label">教师模块</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item"  href="#"><span>教室审批</span></a></li>
                    <li><a class="slide-item" href="index2.html"><span>公告信息</span></a></li>
                </ul>
            </li>
            <?php break; case "2": ?>
            <li class="slide">
                <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fa fa-user"></i><span class="side-menu__label">学生模块</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item"  href="#"><span>教室申报</span></a></li>
                    <li><a class="slide-item"  href="#"><span>故障申报</span></a></li>
                    <li><a class="slide-item" href="index2.html"><span>公告信息</span></a></li>
                </ul>
            </li>
            <?php break; default: ?>未知
        <?php endswitch; ?>
       
        
        
    </ul>
</aside>
        <div class="app-content">
            <section class="section">
    


        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo url('index/index'); ?>">首页</a></li>
            <li class="breadcrumb-item active" aria-current="page">个人信息修改</li>
        </ol>

        <div class="row">
            <div class="col-lg-12 col-xl-1 col-md-12 col-sm-12">
               
            </div>
            <div class="col-lg-12 col-xl-9 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>个人信息修改</h4>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" id="personal"  method="POST">
                            
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <label class="col-md-2 col-form-label" for="username">用户名</label>
                                <div class="col-md-8">
                                    <input type="text" id="username" name="username" class="form-control" value="<?php echo $list['username']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <label class="col-md-2 col-form-label" >学号/编号</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="" placeholder="学号/编号" value="<?php echo $list['num']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <label class="col-md-2 col-form-label" for="email">Email</label>
                                <div class="col-md-8">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="<?php echo $list['email']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <label class="col-md-2 col-form-label" for="phone">手机号</label>
                                <div class="col-md-8">
                                    <input type="number" id="phone" name="phone" class="form-control" placeholder="手机号" <?php if($list['phone'] != ''): ?> value="<?php echo $list['phone']; ?>" <?php endif; ?>>
                                </div>
                            </div>
                            <?php if($list['ischange'] == '1'): ?>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <label class="col-md-2 col-form-label" for="penname">真实姓名</label>
                                <div class="col-md-8">
                                    <input type="text" id="penname" name="penname" class="form-control" placeholder="请填写真实姓名，只有一次机会，请勿乱填" value="<?php echo $list['penname']; ?>">
                                </div>
                            </div>
                            <input type="hidden" id="ischange" name="ischange" value="0">
                            <?php else: ?>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <label class="col-md-2 col-form-label">真实姓名</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" disabled="" value="<?php echo $list['penname']; ?>">
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <label class="col-md-2 col-form-label" for="sex">性 别</label>
                                <div class="col-md-8">
                                    <select class="form-control select2 w-100 select3-d"name="sex">
                                        <?php if($list['sex'] == '男'): ?>
                                        <option selected="selected" value="1">男</option>
                                        <option value="0">女</option>
                                        <?php else: ?>
                                        <option selected="selected" value="0">女</option>
                                        <option value="1">男</option>
                                        <?php endif; ?>
                                    </select> 
                                </div>
                            </div>
                            
                            <div class="form-group mb-0 mt-4 row justify-content-end">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-info">提交</button>
                                    <!-- <button type="submit" class="btn btn-primary">取消</button> -->
                                    <a href="<?php echo url('index/index'); ?>" class="btn btn-primary">返 回</a> 
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>


    
                    </section>
                </div>

                <footer class="main-footer">
                    <div class="text-center">
                        版权所有&copy;台州学院   邮编：318000   浙ICP备05014578号  地址：浙江省台州市市府大道1139号 党（校）办电话（传真）：0576-88661988  邮箱：tzu@tzc.edu.cn 招生电话：0576-88669696, 0576-85137102 
                    </div>
                </footer>
                
            </div>
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

<!--Jquery.knob js-->
<script src="/../static/plugins/othercharts/jquery.knob.js"></script>

<!--Jquery.sparkline js-->
<script src="/../static/plugins/othercharts/jquery.sparkline.min.js"></script>

<!--othercharts js-->
<script src="/../static/js/othercharts.js"></script>

<!--Morris js-->
<script src="/../static/plugins/morris/morris.min.js"></script>
<script src="/../static/plugins/morris/raphael.min.js"></script>


 <!--Toastr js-->
<script src="/../static/plugins/toastr/build/toastr.min.js"></script>
<script src="/../static/plugins/toaster/garessi-notif.js"></script>

<!--Select2 js-->
<script src="/../static/plugins/select2/select2.full.js"></script>

<!--forms js-->
<!-- <script src="/../static/js/forms.js"></script> -->



<!--Scripts js-->
<script src="/../static/js/scripts.js"></script>
<script src="/../static/js/apexcharts.js"></script>
<script src="/../static/js/common.js"></script>



    </body>
    
</html>
<script type="text/javascript">
     $("#personal").submit(function(){
            var formData = $("#personal").serialize();//serialize() 方法通过序列化表单值，创建 URL 编码文本
            // console.log(formData);debugger;
            $.ajax({
                type:'post',
                url:"<?php echo url('/index/profile/personal'); ?>",
                data:formData,
                // async:true,
                dataType:'json',
                success:function(data){
                    if(data.status==1){
                        toastr.success('', data.msg);
                    }else{
                        toastr.error('', data.msg);
                        // setTimeout("window.history.back(-1)",200);
                    }
                },
                error:function(msg){
                    toastr.error('请联系管理员', '系统错误!!');
                }
            })
        
        });
</script>