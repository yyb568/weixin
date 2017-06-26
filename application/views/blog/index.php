<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog. 尹义斌</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> <link href="<?=static_url("css")?>bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="<?=static_url("css")?>font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="<?=static_url("css")?>animate.min.css" rel="stylesheet">
    <link href="<?=static_url("css")?>style.min862f.css?v=4.1.0" rel="stylesheet">
<style>
.btn-primary{
	background-color:#337AB7;
}
</style>
</head>
<body class="gray-bg">
        <div class="row animated fadeInRight">
            <div class="col-sm-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title" style="border-color:#fff">
                        <h5>个人资料</h5>
                    </div>
                    <div>
                        <div class="ibox-content no-padding border-left-right">
                            <img alt="image" class="img-responsive" src="<?=static_url("img")?>p_big2.jpg">
                        </div>
                        <div class="ibox-content profile-content">
                            <h4><strong>尹义斌</strong></h4>
                            <p><i class="fa fa-map-marker"></i> 山东省历下区水利厅1号楼三单元</p>
                            <h5>关于我</h5>
                            <p>
                                一个Phper,会点前端技术，div+css啊，jQuery之类的，不是很精；热爱生活，热爱互联网，热爱新技术；在不断的寻求新的突破。
                            </p>
                             <h5>联系方式</h5>
                             <p>WeChat: yinyibin</p>
                             <p>Email: yinyibin5683@163.com</p>
                            <div class="row m-t-lg">
                                <div class="col-sm-4">
                                    <span class="bar">5,3,9,6,5,9,7,3,5,2</span>
                                    <h5><strong><?=$total?></strong> 文章</h5>
                                </div>
                                <div class="col-sm-4">
                                    <span class="line">5,3,9,6,5,9,7,3,5,2</span>
                                    <h5><strong>28</strong> 关注</h5>
                                </div>
                                <div class="col-sm-4">
                                    <span class="bar">5,3,2,-1,-3,-2,2,3,5,2</span>
                                    <h5><strong>240</strong> 关注者</h5>
                                </div>
                            </div>
                            <div class="user-button">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> 发送消息</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-default btn-sm btn-block"><i class="fa fa-coffee"></i> 赞助</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title" style="border-color:#fff">
                        <h5>最新动态</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="profile.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="profile.html#">选项1</a>
                                </li>
                                <li><a href="profile.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
        <div class="animated fadeInRight blog">
        <div class="row">
         <div class="col-lg-12">
         <?php foreach ((array)$List as $key => $val){?>
                <div class="ibox">
                    <div class="ibox-content">
                        <a href="<?=site_url("blog/blog/info/{$val['id']}") ?>" class="btn-link">
                            <h2><?=$val['titles'] ?></h2>
                        </a>
                        <div class="small m-b-xs">
                            <strong><?=$userlist[$val['user_id']]['uname'] ?></strong>&nbsp;&nbsp;<span class="text-muted"><i class="fa fa-clock-o"></i>&nbsp;<?=date("Y-m-d",$val['created']) ?></span>
                        </div>
                        <p><?=msubstr(strip_tags($val['content']),0,100)?></p>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>标签：</h5>
                                <button class="btn btn-primary btn-xs" type="button"><?=$ClassList[$val['classify']]['aname'] ?></button>
<!--                                 <button class="btn btn-white btn-xs" type="button">速比涛</button> -->
                            </div>
                            <div class="col-md-6">
                                <div class="small text-right">
                                    <h5>状态：</h5>
                                    <div> <i class="fa fa-comments-o"> </i> 暂无评论 </div>
                                    <i class="fa fa-eye"> </i> <?=$val['pviews']?> 浏览
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             <?php }?>
             </div>
          </div>
        </div>
     </div>
</div>
<script src="<?=static_url("js")?>jquery.min.js?v=2.1.4"></script>
<script src="<?=static_url("js")?>bootstrap.min.js?v=3.3.6"></script>
<script src="<?=static_url("js")?>plugins/peity/jquery.peity.min.js"></script>
<script src="<?=static_url("js")?>demo/peity-demo.min.js"></script>
</body>
</html>
