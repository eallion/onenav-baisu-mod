<!DOCTYPE html>
<html lang="zh-ch">

    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit|ie-comp|ie-stand">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
        <meta http-equiv="Cache-Control" content="no-transform">
        <meta name="applicable-device" content="pc,wap">
        <meta name="MobileOptimized" content="width">
        <meta name="HandheldFriendly" content="true">
        <meta name="author" content="BaiSu" />
        <title>
            <?php echo $site['title']; ?> -
            <?php echo $site['subtitle']; ?>
        </title>
        <meta name="keywords" content="<?php echo $site['keywords']; ?>" />
        <meta name="description" content="<?php echo $site['description']; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="templates/<?php echo $template; ?>/css/style.css" />
        <link rel="stylesheet" href="static/font-awesome/4.7.0/css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="templates/<?php echo $template; ?>/layui/css/layui.css" />
        <link rel="shortcut icon" href="https://cdn.eallion.com/favicon.ico" />
    </head>

    <body>
        <div class="navlist-main">
            <div class="logo">
                <a href="/">
                    <?php echo $site['title']; ?>
                </a>
            </div>
            <div class="type-list">
                <?php
            //遍历分类目录并显示
            foreach ($category_parent as $category) {
            //var_dump(get_category_sub( $category['id'] ));
            if(get_category_sub( $category['id'] )) {
                $isSub = '<i class="sub layui-icon layui-icon-right"></i>';
            }else {
                $isSub = '';
            }
            $font_icon = empty($category['font_icon']) ? '' : "<i class='{$category['font_icon']}'></i> ";
            //如果分类是私有的
                if( $category['property'] == 1 ) {
                    $property = '<span class="property">私</span> ';
                }
                else {
                    $property = '';
                }
        ?>
                    <div class="list">
                        <a class="typeList" data-id="<?php echo $category['id']; ?>" href="#category-<?php echo $category['id']; ?>">
                            <?php echo $font_icon; ?>
                            <p>
                                <?php echo htmlspecialchars_decode($category['name']); ?>
                            </p>
                            <div class="icon">
                                <?php echo $property; ?>
                                <?php echo $isSub; ?>
                            </div>
                        </a>
                        <div class="list-sub">
                            <!-- 遍历二级分类-->
                            <?php foreach (get_category_sub( $category['id'] ) AS $category_sub){
                                //var_dump($category_sub);
                                if( $category_sub['property'] == 1 ) {
                                    $sub_property = '<span class="property">私</span>';
                                }else {
                                    $sub_property = '';
                                    }
                             ?>
                            <a class="typeList" data-id="<?php echo $category_sub['id']; ?>" href="#category-<?php echo $category_sub['id']; ?>">
                                <i class="<?php echo $category_sub['font_icon']; ?>"></i>
                                <p>
                                    <?php echo htmlspecialchars_decode($category_sub['name']); ?>
                                </p>

                                <div class="icon">
                                    <?php echo $sub_property; ?>
                                </div>
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                        <?php
        if( is_login() ) {
      ?>
                        <div class="list-w2">
                            <div class="list" id="nav-add-type">
                        <a>
                            <i class="layui-icon layui-icon-addition"></i>
                            <p>分类</p>
                        </a>
                    </div>
                    <div class="list" id="nav-add-link">
                        <a>
                            <i class="layui-icon layui-icon-addition"></i>
                            <p>书签</p>
                        </a>
                    </div>
                        </div>
                        <?php } ?>

            </div>

            <div class="user-info">
                <div class="pic">
                    <a href="/"><img src="templates/<?php echo $template; ?>/images/touxiang.png"></a>
                </div>
                <div class="text">
                    <?php
        if( is_login() ) {
      ?>
                        <a href="/index.php?c=admin" target="_blank">
                            <p class="t1"><?php echo $site['title']; ?></p>
                            <p class="t2">进入后台管理</p>
                        </a>
                        <?php }else{ ?>
                        <a href="/index.php?c=login" target="_blank">
                            <p class="t1">尚未登录</p>
                            <p class="t2">立即登陆系统</p>
                        </a>
                        <?php } ?>

                </div>
            </div>
        </div>
        <div class="index-main">
            <div class="header-main">
                <div class="header-search">
                    <div class="seaech-main-w">
                        <div class="seaech-main">
                            <div class="input">
                                <input type="text" id="search" name="search" autofocus="autofocus" placeholder="搜索站内书签或 Google" />
                                <i class="layui-icon layui-icon-search"></i>
                            </div>
                            <div class="btn">
                                <div class="btn-s" id="seaech-to">
                                    <img src="templates/<?php echo $template; ?>/images/google.svg" />Google
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="ticker"></div>
                </div>

                <!--<div class="times-main">-->
                <!--    <div class="time" id="time">-->
                <!--        00:00:00-->
                <!--    </div>-->
                <!--    <div class="date" id="date">-->
                <!--        2022 年 12 月 31 日-->
                <!--    </div>-->
                <!--    <div class="calendar">-->
                <!--        <span id="nowLunar">壬寅年腊月初六</span>-->
                <!--        <span id="nowWeek">星期三</span>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="weather-main">
                    <iframe width="400" height="270" frameborder="0" scrolling="no" hspace="0" allowtransparency="true" src="https://i.tianqi.com/?c=code&a=getcode&id=27&icon=3&bdc=%2300000000"></iframe>
                </div>

            </div>

            <div class="site-main">
                <!-- 遍历分类目录 -->
                <?php foreach ( $categorys as $category ) {
                $fid = $category['id'];
                $links = get_links($fid);
                $font_icon = empty($category['font_icon']) ? '' : "<i class='{$category['font_icon']}'></i> ";
                //如果分类是私有的
                if( $category['property'] == 1 ) {
                    $property = '<span class="property">私</span>';
                }
                else {
                    $property = '';
                }
            ?>

                <div class="site-main-li">
                    <div class="site-tit" id="category-<?php echo $category['id']; ?>">
                        <?php echo $font_icon; ?>
                        <?php echo htmlspecialchars_decode($category['name']); ?>
                        <?php echo $property; ?>
                            <?php if( $theme_config->link_description == "show") { ?>
                                    <div class="desc">
                                <?php echo $category['description']; ?>
                            </div>
                                        <?php }?>

                    </div>
                    <div class="site-list">
                        <!-- 遍历链接 -->
                        <?php
                foreach ($links as $link) {
                    //默认描述
                    $link['description'] = empty($link['description']) ? '作者很懒，没有填写描述。' : $link['description'];
                    $id = $link['id'];
                    //直链模式
                    if( $site['link_model'] === 'direct' ) {
                        $url = $link['url'];
                    }
                    else{
                        $url = '/index.php?c=click&id='.$link['id'];
                    }
                    //如果书签是私有的
                if( $link['property'] == 1 ) {
                    $link_property = '<span class="property">私</span>';
                }
                else {
                    $link_property = '';
                }
                //var_dump($link);
            ?>
                            <div class="list siteList" data-id="<?php echo $link['id']; ?>" data-url="<?php echo $url; ?>" data-links="<?php echo $link['url']; ?>">
                                <!-- 网站图标显示方式 -->
                                <?php if( $theme_config->favicon == "online") { ?>
                                    <?php 
                                        if (!empty($link['font_icon'])) { ?>
                                            <img src="<?php echo $link['font_icon']; ?>" />
                                    <?php 
                                        } else { ?>
                                            <img src="https://favicon.png.pub/v1/<?php echo base64($link['url']); ?>" class="icon" />
                                    <?php } ?>
                                <?php } else { ?>
                                    <img src="/index.php?c=ico&text=<?php echo $link['title']; ?>" class="icon" />
                                <?php } ?>

                                <p class="title">
                                    <?php echo $link['title']; ?>
                                </p>

                                <?php if( $theme_config->link_description == "show") { ?>
                                    <div class="desc">
                                <?php echo $link['description']; ?>
                            </div>
                                        <?php }?>

                                    <?php echo $link_property; ?>
                            </div>
                            <?php } ?>


                            <div class="list kongs"></div>
                            <div class="list kongs"></div>
                            <div class="list kongs"></div>
                            <div class="list kongs"></div>
                            <div class="list kongs"></div>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>

        <footer class="show">
            © <?php echo date("Y"); ?> 大大的小蜗牛，Powered by
            <a target="_blank" href="https://github.com/helloxz/onenav" title="简约导航/书签管理器" rel="nofollow">OneNav</a>，
             Themed by
            <a href="https://github.com/eallion/onenav-baisu-mod" target="_blank">BaiSu Mod</a>

        </footer>

    <?php
        if( is_login() ) {
      ?>
        <!--组件引入-添加分类-->
        <?php include ("type_add.html"); ?>
        <!--组件引入-编辑分类-->
        <?php include ("type_edit.html"); ?>
        <!--组件引入-添加书签-->
        <?php include ("links_add.html"); ?>
        <!--组件引入-编辑书签-->
        <?php include ("links_edit.html"); ?>
        <!--组件引入-图标列表-->
        <?php include ("icons.html"); ?>
  <?php } ?>
        <!--JQ 3.7.1-->
        <script src="templates/<?php echo $template; ?>/js/jquery.min.js?v=3.7.1" type="text/javascript" charset="utf-8"></script>
        <!--layui v2.9.4 -->
        <script src="templates/<?php echo $template; ?>/layui/layui.js?v=2.9.4" type="text/javascript" charset="utf-8"></script>
        <!--Day.js-->
        <!--<script src="templates/<?php echo $template; ?>/js/dayjs.min.js"></script>-->
        <!--lunar.js-->
        <!--<script src="templates/<?php echo $template; ?>/js/lunar.min.js" type="text/javascript" charset="utf-8"></script>-->
        <!--axios.js-->
        <script src="templates/<?php echo $template; ?>/js/axios.min.js?v=1.6.5" type="text/javascript" charset="utf-8"></script>
        <!--clipboard.js-->
        <script src="templates/<?php echo $template; ?>/js/clipboard.min.js"></script>
        <!--holmes.js-->
        <script src="templates/<?php echo $template; ?>/js/holmes.js" type="text/javascript" charset="utf-8"></script>
        <!--common.js-->
        <script src="templates/<?php echo $template; ?>/js/common.js" type="text/javascript" charset="utf-8"></script>
    <script>
        // 远程 JSON API 地址
        let jsonUrl = "https://api.eallion.com/mastodon/api/v1/accounts/111136231674527355/statuses?limit=10&exclude_replies=true&exclude_reblogs=true";

        // 相对时间插件 2.5.2 https://tokinx.github.io/lately/
        (() => {
            window.Lately = new function () {
                this.lang = {
                    second: " 秒",
                    minute: " 分钟",
                    hour: " 小时",
                    day: " 天",
                    month: " 个月",
                    year: " 年",
                    ago: "前",
                    error: "NaN"
                };
                const format = (date) => {
                    date = new Date(_val(date));
                    const floor = (num, _lang) => Math.floor(num) + _lang,
                        obj = new function () {
                            this.second = (Date.now() - date.getTime()) / 1000;
                            this.minute = this.second / 60;
                            this.hour = this.minute / 60;
                            this.day = this.hour / 24;
                            this.month = this.day / 30;
                            this.year = this.month / 12
                        },
                        key = Object.keys(obj).reverse().find(_ => obj[_] >= 1);
                    return (key ? floor(obj[key], this.lang[key]) : this.lang.error) + this.lang.ago;
                },
                    _val = (date) => {
                        date = new Date(date && (typeof date === 'number' ? date : date.replace(/-/g, '/').replace('T', ' ')));
                        return isNaN(date.getTime()) ? false : date.getTime();
                    };
                return {
                    init: ({ target = "time", lang } = {}) => {
                        if (lang) this.lang = lang;
                        for (let el of document.querySelectorAll(target)) {
                            const date = _val(el.dateTime) || _val(el.title) || _val(el.innerHTML) || 0;
                            if (!date) return;
                            el.title = new Date(date).toLocaleString();
                            el.innerHTML = format(date);
                        }
                    },
                    format
                }
            }
        })();

        // 处理 Json 数据
        if (document.querySelector('#ticker')) {
            fetch(jsonUrl)
                .then(res => res.json())
                .then(res => {
                    var result = '';
                    var data = res;
                    for (var i = 0; i < data.length; i++) {
                        var tickerTime = new Date(data[i].created_at).toLocaleString();
                        var tickerContent = getSimpleText(data[i].content)
                        result += `<li class="item"><span class="datetime">${tickerTime}</span>：<a href="https://eallion.com/toot/">${tickerContent}</a></li>`;
                        console.log(tickerContent)
                    }
                    var tickerDom = document.querySelector('#ticker');
                    var tickerBefore = `<div class="ticker-wrap"><ul class="ticker-list">`;
                    var tickerAfter = `</ul></div>`;
                    resultAll = tickerBefore + result + tickerAfter;
                    tickerDom.innerHTML = resultAll;

                    // 相对时间插件
                    window.Lately && Lately.init({
                        target: '.datetime'
                    });
                });

            // 滚动效果
            setInterval(function () {
                var tickerWrap = document.querySelector(".ticker-list");
                var tickerItem = tickerWrap.querySelectorAll(".item");
                for (var i = 0; i < tickerItem.length; i++) {
                    setTimeout(function () {
                        tickerWrap.appendChild(tickerItem[0]);
                    }, 2000);
                }
            }, 2000);
        }

        // 提取 HTML 代码中的纯文本内容
        function getSimpleText(html) {
            var htmlTags = new RegExp("<.+?>", "g");
            var simpleText = html.replace(htmlTags, '');
            return simpleText;
        }
    </script>
        <?php
        if( is_login() ) {
      ?>
        <script src="templates/<?php echo $template; ?>/js/admin.js" type="text/javascript" charset="utf-8"></script>
        <?php } ?>
            <?php
        if( is_login() ) {
      ?>
        <script type="text/javascript">
            layui.use(['form', 'dropdown'], function() {
                var $ = layui.$,
                    dropdown = layui.dropdown,
                    form = layui.form;

                //执行菜单
                dropdown.render({
                    elem: '.typeList',
                    trigger: 'contextmenu',
                    data: [{
                        title: '编辑',
                        id: 'edit',
                    }, {
                        title: '删除',
                        id: 'del'
                    }, {
                        type: '-'
                    }, {
                        title: '添加分类',
                        id: 'add'
                    }],
                    click: function(data, othis) {
                        var elem = $(this.elem),
                            typeId = elem.data('id');
                        if(data.id === 'edit') {
                            //layer.msg('编辑' + typeId);
                            //获取单个分类信息
                            layer.open({
                                type: 1,
                                title: '编辑分类',
                                shadeClose: true,
                                shade: 0.8,
                                area: ['460px'],
                                content: $('#component_type_edit'), //iframe的url
                                success: function(layero, index) {
                                    console.log('123546');
                                    $.post("/index.php?c=api&method=get_a_category", {
                                        id: typeId
                                    }, function(data, status) {
                                        console.log(data)
                                        if(data.data.property == 0) {
                                            data.data.property = false;
                                        }
                                        if(data.code == 0 || data.code == 200) {
                                            form.val("type_edit", data.data);
                                            $('.font_icon_show i').attr('class',data.data.font_icon)
                                            $("#categoryList span").each(function(i, o) {
                                                if($(this).data('fid') == data.data.fid) {
                                                    $(this).addClass('hover').siblings().removeClass('hover');
                                                    return;
                                                }
                                            });

                                            return;
                                        }
                                        post_error()
                                    });
                                }
                            });
                        } else if(data.id === 'del') {
                            //layer.msg('删除'+typeId);
                            layer.confirm('确定删除该分类吗？', {
                                btn: ['确定', '取消'] //按钮
                            }, function() {
                                isnull_type(typeId)
                            });
                        } else if(data.id === 'add') {
                            //layer.msg('添加');
                            layer.open({
                                type: 1,
                                title: '添加分类',
                                shadeClose: true,
                                shade: 0.8,
                                area: ['460px'],
                                content: $('#component_type_add'), //iframe的url
                            });
                        }
                        //layer.msg('得到表格列表的 id：' + listId + '，下拉菜单 id：' + data.id);
                    }
                });
                //执行菜单
                dropdown.render({
                    elem: '.siteList',
                    trigger: 'contextmenu',
                    data: [{
                        title: '打开',
                        id: 'open',
                    }, {
                        title: '复制',
                        id: 'copy',
                    }, {
                        title: '编辑',
                        id: 'edit',
                    }, {
                        title: '删除',
                        id: 'del'
                    }, {
                        type: '-'
                    }, {
                        title: '添加书签',
                        id: 'add'
                    }],
                    click: function(data, othis) {
                        var elem = $(this.elem),
                            linksId = elem.data('id');
                            linksUrl = elem.data('url');
                            links = elem.data('links');
                        if(data.id === 'open') {
                            //layer.msg('打开');
                            open_links(linksUrl);
                        } else if(data.id === 'edit') {
                            //layer.msg('编辑');
                            layer.open({
                                type: 1,
                                title: '编辑书签',
                                shadeClose: true,
                                shade: 0.8,
                                area: ['460px'],
                                content: $('#component_links_edit'), //iframe的url
                                success: function() {
                                    $.post("index.php?c=api&method=get_a_link&id="+linksId, {
                                        id: linksId
                                    }, function(data, status) {
                                        console.log(data)
                                        if(data.data.property == 0) {
                                            data.data.property = false;
                                        }
                                        if(data.code == 0 || data.code == 200) {
                                            form.val("links_edit", data.data);
                                            $("#categoryList span").each(function(i, o) {
                                                if($(this).data('fid') == data.data.fid) {
                                                    $(this).addClass('hover').siblings().removeClass('hover');
                                                    return;
                                                }
                                            });

                                            return;
                                        }
                                        post_error()
                                    });
//                                    $('#component_links_add .list-type span').eq(0).addClass('hover');
//                                    var addfid = $('#component_links_add .list-type span').eq(0).data('fid');
//                                    $('input#fid').val(addfid);
                                }
                            });
                        } else if(data.id === 'del') {
                            //layer.msg('删除');
                            layer.confirm('确定删除该书签吗？', {
                                btn: ['确定', '取消'] //按钮
                            }, function() {
                                del_links(linksId)
                            });
                        } else if(data.id === 'copy') {
                            //layer.msg('复制');
                            copy_link_url('.layui-dropdown-menu li',links)
                        } else if(data.id === 'add') {
                            //layer.msg('添加');
                            layer.open({
                                type: 1,
                                title: '添加书签',
                                shadeClose: true,
                                shade: 0.8,
                                area: ['460px'],
                                content: $('#component_links_add'), //iframe的url
                                success: function() {
                                    $('#component_links_add .list-type span').eq(0).addClass('hover');
                                    var addfid = $('#component_links_add .list-type span').eq(0).data('fid');
                                    $('input#fid').val(addfid);
                                }
                            });
                        }
                        //layer.msg('得到表格列表的 id：' + listId + '，下拉菜单 id：' + data.id);
                    }
                });
            });
        </script>
        <?php } ?>
    </body>

</html>