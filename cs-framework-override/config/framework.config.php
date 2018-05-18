<?php
if (!defined('ABSPATH')) {
    die;
} // 不能直接访问网页.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// Island 主题框架设置
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
global $verify;
$Gloom_key = cs_get_customize_option('Gloom_key');
$verify = get_option(THEME_KEY_NAME);
if (!empty($verify) || $Gloom_key == 'zhw2590582') {
    $settings = array(
        'menu_title' => '主题选项',
        'menu_type' => 'menu',
        'menu_slug' => 'cs-framework',
        'ajax_save' => true,
        'show_reset_all' => false,
        'framework_title' => '' . wp_get_theme()->display('Name') . '<small class="oldVer" style="color:red;margin-left:10px">' . wp_get_theme()->display('Version') . '</small><small class="newVer" style="color:#00d800;margin-left:10px"></small>',
    );
} else {
};

// 播放器
$playlists = get_posts(array(
    'post_type'      => 'cue_playlist',
    'orderby'        => 'title',
    'order'          => 'asc',
    'posts_per_page' => -1,
));

$playlistsSelect = array();
foreach ( $playlists as $playlist ) {
    $playlistsSelect[ $playlist->ID ] = $playlist->post_title;
}

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// 框架选项
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options = array();
// ----------------------------------------
// 常规  -
// ----------------------------------------
$options[] = array(
    'name' => 'overwiew',
    'title' => '常规',
    'icon' => 'fa fa-star',
    'fields' => array(
        // Favicon和Logo设置
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => 'Favicon和Logo设置',
        ) ,
        // 自定义收藏站标
        array(
            'id' => 'i_favicon_icon',
            'type' => 'upload',
            'title' => 'Favicon',
            'add_title' => '添加favicon',
            'default' => get_template_directory_uri() . "/images/default/favicon.ico"
        ) ,
        // 自定义logo
        array(
            'id' => 'i_logo',
            'type' => 'upload',
            'title' => 'Logo',
            'add_title' => '添加logo',
            'default' => get_template_directory_uri() . "/images/default/logo.png"
        ) ,
        // 自定义文章布局
        array(
            'id' => 'i_layout_list',
            'type' => 'radio',
            'title' => '文章布局',
            'class' => 'horizontal',
            'options' => array(
                'layout_box' => '盒子布局',
                'layout_width' => '宽屏布局',
            ) ,
            'help' => '默认布局，会被前端设置覆盖',
            'default' => 'i_width'
        ) ,
        // 自定义皮肤
        array(
            'id' => 'i_skin',
            'type' => 'radio',
            'title' => '自定义皮肤',
            'class' => 'horizontal',
            'options' => array(
                'skin01' => '致郁',
                'skin02' => '淡雅',
            ) ,
            'default' => 'skin01'
        ) ,
        // 分页设置
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '分页设置',
        ) ,
        // 分页方式
        array(
            'id' => 'i_pagination',
            'type' => 'radio',
            'title' => '分页方式',
            'class' => 'horizontal',
            'options' => array(
                'i_ajax' => 'ajax无限加载',
                'i_num' => '页码',
            ) ,
            'default' => 'i_num',
            'help' => '后续增加页码显示方式',
        ) ,
        // 无限加载页数
        array(
            'id' => 'i_ajax_num',
            'type' => 'number',
            'default' => '2',
            'title' => 'ajax无限加载页数',
            'help' => 'ajax无限加载到第几页出现下一页按钮，默认为2',
            'after' => ' <i class="cs-text-muted">(页)</i>',
            'dependency' => array(
                'i_pagination_i_ajax',
                '==',
                'true'
            ) ,
        ) ,
        // ajax加载条颜色
        array(
            'id' => 'i_ajax_color',
            'type' => 'color_picker',
            'title' => 'ajax加载条颜色',
            'default' => '#60d778',
            'dependency' => array(
                'i_pagination_i_ajax',
                '==',
                'true'
            ) ,
        ) ,
        // 无限加载中下一页的文字
        array(
            'id' => 'i_ajax_loading',
            'type' => 'text',
            'default' => '加载更多',
            'title' => 'ajax无限加载中下一页的文字',
            'dependency' => array(
                'i_pagination_i_ajax',
                '==',
                'true'
            ) ,
        ) ,
        // 无限加载完结的文字
        array(
            'id' => 'i_ajax_end',
            'type' => 'text',
            'default' => '没有更多文章了',
            'title' => 'ajax无限加载完结的文字',
            'dependency' => array(
                'i_pagination_i_ajax',
                '==',
                'true'
            ) ,
        ) ,
    ) ,
);
// ------------------------------
// 页眉                      -
// ------------------------------
$options[] = array(
    'name' => 'header',
    'title' => '页眉',
    'icon' => 'fa fa-bookmark',
    'fields' => array(
        // 顶部
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '顶部',
        ) ,
        // 隐藏系统工具条
        array(
            'id' => 'i_toolbar',
            'type' => 'switcher',
            'title' => '隐藏系统工具条',
            'label' => '为使页面干净，建议隐藏',
            'default' => true,
            'help' => '因为主题的页尾自带进入后台操作的按钮，建议隐藏;另你也可以进入个人资料禁用工具条',
        ) ,
        // 开启换肤功能
        array(
            'id' => 'i_switcher',
            'type' => 'switcher',
            'title' => '开启前端换肤',
            'label' => '一旦开启，自定义皮肤将失效，且默认显示第一套皮肤',
        ) ,
        // 开启设置按钮
        array(
            'id' => 'i_setting',
            'type' => 'switcher',
            'title' => '开启设置按钮',
        ) ,
        // 小工具1名称
        array(
            'id' => 'i_widget1',
            'type' => 'text',
            'title' => '小工具1名称',
            'default' => '小工具1',
        ) ,
        // 小工具2名称
        array(
            'id' => 'i_widget2',
            'type' => 'text',
            'title' => '小工具2名称',
            'default' => '小工具2',
        ) ,
        // 开启布局切换
        array(
            'id' => 'i_layout',
            'type' => 'switcher',
            'title' => '开启前端布局切换',
        ) ,
        // 开启公告条
        array(
            'id' => 'i_notices',
            'type' => 'switcher',
            'title' => '开启公告条',
        ) ,
        // 公告条特效
        array(
            'id' => 'i_notices_effect',
            'type' => 'radio',
            'title' => '公告条特效',
            'class' => 'horizontal',
            'options' => array(
                'i_fade' => '淡出淡入',
                'i_type' => '打字效果',
            ) ,
            'default' => 'i_fade',
            'dependency' => array(
                'i_notices',
                '==',
                'true'
            ) ,
        ) ,
        // 公告条文本
        array(
            'id' => 'i_notices_text',
            'type' => 'textarea',
            'title' => '公告条文本',
            'after' => '<p class="cs-text-muted">多条可使用换行隔开</p>',
            'dependency' => array(
                'i_notices',
                '==',
                'true'
            ) ,
        ) ,
    ) ,
);
// ------------------------------
// 轮播图                      -
// ------------------------------
$options[] = array(
    'name' => 'slider',
    'title' => '轮播图',
    'icon' => 'fa fa-image',
    'fields' => array(
        // 首页开启轮播图
        array(
            'id' => 'i_slider',
            'type' => 'switcher',
            'title' => '首页开启轮播图',
            'help' => '注意：轮播图只显示在主页',
        ) ,
        // 轮播图设置
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '轮播图设置',
        ) ,
        // 自定义轮播图
        array(
            'id' => 'i_slider_custom',
            'type' => 'group',
            'title' => '自定义轮播图',
            'info' => '更多详细设置方式可以浏览使用说明',
            'button_title' => '添加滑块',
            'accordion_title' => '滑块',
            'fields' => array(
                // 自定义轮播图--标题
                array(
                    'id' => 'i_slider_title',
                    'type' => 'text',
                    'title' => '标题',
                    'attributes' => array(
                        'placeholder' => '例如：滑块01'
                    )
                ) ,
                // 自定义轮播图--图片
                array(
                    'id' => 'i_slider_image',
                    'type' => 'upload',
                    'title' => '图片',
                ) ,
                // 自定义轮播图--描述
                array(
                    'id' => 'i_slider_text',
                    'type' => 'text',
                    'title' => '描述',
                    'attributes' => array(
                        'placeholder' => '输入描述'
                    )
                ) ,
                // 自定义轮播图--链接
                array(
                    'id' => 'i_slider_link',
                    'type' => 'text',
                    'title' => '链接',
                    'default' => '#',
                    'attributes' => array(
                        'placeholder' => 'http://...'
                    )
                ) ,
            )
        ) ,
        // 切换效果
        array(
            'id' => 'i_slider_effect',
            'type' => 'select',
            'title' => '切换效果',
            'options' => array(
                'horizontal' => 'horizontal',
                'vertical' => 'vertical',
                'fade' => 'fade'
            ) ,
            'default' => 'boxRandom',
        ) ,
        // 广告设置
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '广告设置',
        ) ,
        // 自定义广告
        array(
            'id' => 'i_ad_custom',
            'type' => 'group',
            'title' => '自定义广告',
            'info' => '目前最多添加两个广告',
            'button_title' => '添加滑块',
            'accordion_title' => '滑块',
            'fields' => array(
                // 自定义广告--标题
                array(
                    'id' => 'i_ad_title',
                    'type' => 'text',
                    'title' => '标题',
                    'attributes' => array(
                        'placeholder' => '例如：滑块01'
                    )
                ) ,
                // 自定义广告--图片
                array(
                    'id' => 'i_ad_image',
                    'type' => 'upload',
                    'title' => '图片',
                ) ,
                // 自定义广告--描述
                array(
                    'id' => 'i_ad_text',
                    'type' => 'text',
                    'title' => '描述',
                    'attributes' => array(
                        'placeholder' => '输入描述'
                    )
                ) ,
                // 自定义广告--链接
                array(
                    'id' => 'i_ad_link',
                    'type' => 'text',
                    'title' => '链接',
                    'default' => '#',
                    'attributes' => array(
                        'placeholder' => 'http://...'
                    )
                ) ,
            )
        ) ,
    ) ,
);
// ------------------------------
// 文章                       -
// ------------------------------
$options[] = array(
    'name' => 'post',
    'title' => '文章',
    'icon' => 'fa fa-book',
    'fields' => array(
        // 常规设置
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '常规设置',
        ) ,
        // 启用日期
        array(
            'id' => 'i_post_date',
            'type' => 'switcher',
            'default' => true,
            'title' => '启用日期',
        ) ,
        // 启用浏览数目
        array(
            'id' => 'i_post_view',
            'type' => 'switcher',
            'default' => true,
            'title' => '启用浏览数目',
        ) ,
        // 启用评论按钮
        array(
            'id' => 'i_post_com',
            'type' => 'switcher',
            'default' => true,
            'title' => '启用评论',
        ) ,
        // 启用分类
        array(
            'id' => 'i_post_cat',
            'type' => 'switcher',
            'default' => true,
            'title' => '启用分类',
        ) ,
        // 启用标签按钮
        array(
            'id' => 'i_post_tag',
            'type' => 'switcher',
            'default' => true,
            'title' => '启用标签',
        ) ,
        // 启用喜欢按钮
        array(
            'id' => 'i_post_like',
            'type' => 'switcher',
            'default' => true,
            'title' => '启用喜欢按钮',
        ) ,
        // 启用转载链接信息
        array(
            'id' => 'i_post_link',
            'type' => 'switcher',
            'default' => true,
            'title' => '启用转载链接',
        ) ,
        // 启用相关文章
        array(
            'id' => 'i_post_related',
            'type' => 'switcher',
            'default' => true,
            'title' => '启用相关文章',
        ) ,
        // 启用Lazyload加载
        array(
            'id' => 'i_post_image',
            'type' => 'switcher',
            'default' => true,
            'title' => '启用Lazyload加载',
        ) ,
        // 随机特色图数量
        array(
            'id' => 'i_feature_num',
            'type' => 'number',
            'default' => '5',
            'title' => '随机特色图数量',
            'help' => '数目需与你的随机图片数目一致，否则会加载不了图片',
        ) ,
        // 移除修订版本
        array(
            'id' => 'i_post_autosave',
            'type' => 'switcher',
            'title' => '移除修订版本',
        ) ,
        // 移除自动保存
        array(
            'id' => 'i_post_revision',
            'type' => 'switcher',
            'title' => '移除自动保存',
        ) ,
        // 阅读更多设置
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '阅读更多设置',
        ) ,
        // 开启自定义阅读更多
        array(
            'id' => 'i_post_readmore',
            'type' => 'switcher',
            'default' => true,
            'title' => '开启自定义阅读更多',
        ) ,
        // 不过滤html标签
        array(
            'id' => 'i_post_html',
            'type' => 'switcher',
            'title' => '不过滤html标签',
            'help' => '支持截取支持中英文并且不过滤html标签，但对html标签支持不好，截取时会把标签截断而导致显示不全，所以建议配合文章的more标签一起使用',
            'dependency' => array(
                'i_post_readmore',
                '==',
                'true'
            ) ,
        ) ,
        // 自定义主页文章摘录长度
        array(
            'id' => 'i_post_excerpt',
            'type' => 'number',
            'title' => '自定义主页文章摘录长度',
            'after' => ' <i class="cs-text-muted">(字)</i>',
            'default' => '80',
            'dependency' => array(
                'i_post_readmore',
                '==',
                'true'
            ) ,
        ) ,
        // 自定义阅读更多的文字
        array(
            'id' => 'i_post_more',
            'type' => 'text',
            'default' => '阅读更多',
            'title' => '自定义阅读更多的文字',
            'dependency' => array(
                'i_post_readmore',
                '==',
                'true'
            ) ,
        ) ,
    ) ,
);
// ------------------------------
// 评论                       -
// ------------------------------
$options[] = array(
    'name' => 'comment',
    'title' => '评论',
    'icon' => 'fa fa-comments',
    'fields' => array(
        // SMPT设置
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => 'SMPT设置',
        ) ,
        // 启用SMPT功能
        array(
            'id' => 'i_comment_smpt',
            'title' => '启用SMPT功能',
            'type' => 'switcher',
        ) ,
        // 发件人的名称
        array(
            'id' => 'i_smpt_name',
            'type' => 'text',
            'default' => 'Admin',
            'title' => '发件人的名称',
            'dependency' => array(
                'i_comment_smpt',
                '==',
                'true'
            ) ,
        ) ,
        // SMTP服务器
        array(
            'id' => 'i_smpt_server',
            'type' => 'text',
            'default' => 'smtp.qq.com',
            'title' => 'SMTP服务器',
            'dependency' => array(
                'i_comment_smpt',
                '==',
                'true'
            ) ,
        ) ,
        // SMTP端口
        array(
            'id' => 'i_smpt_port',
            'type' => 'text',
            'default' => '25',
            'title' => 'SMTP端口',
            'dependency' => array(
                'i_comment_smpt',
                '==',
                'true'
            ) ,
        ) ,
        // 邮箱账号
        array(
            'id' => 'i_smpt_email',
            'type' => 'text',
            'title' => '邮箱账号',
            'dependency' => array(
                'i_comment_smpt',
                '==',
                'true'
            ) ,
        ) ,
        // 邮箱密码
        array(
            'id' => 'i_smpt_password',
            'type' => 'password',
            'title' => '邮箱密码',
            'dependency' => array(
                'i_comment_smpt',
                '==',
                'true'
            ) ,
        ) ,
        // 提醒设置
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '提醒设置',
        ) ,
        // 启用邮件提醒
        array(
            'id' => 'i_comment_mail',
            'title' => '启用邮件提醒',
            'type' => 'switcher',
            'default' => true,
        ) ,
        // 评论审核通过通知用户
        array(
            'id' => 'i_mail_approve',
            'type' => 'switcher',
            'title' => '评论审核通过通知用户',
            'default' => true,
            'dependency' => array(
                'i_comment_mail',
                '==',
                'true'
            ) ,
        ) ,
        // 评论回复通知用户
        array(
            'id' => 'i_mail_reply',
            'type' => 'switcher',
            'title' => '评论回复通知用户',
            'default' => true,
            'dependency' => array(
                'i_comment_mail',
                '==',
                'true'
            ) ,
        ) ,
        // 网站后台登录失败通知管理员
        array(
            'id' => 'i_mail_login',
            'type' => 'switcher',
            'title' => '网站后台登录失败通知管理员',
            'dependency' => array(
                'i_comment_mail',
                '==',
                'true'
            ) ,
        ) ,
        // 注册用户资料信息更新通知用户
        array(
            'id' => 'i_mail_update',
            'type' => 'switcher',
            'title' => '注册用户资料信息更新通知用户',
            'dependency' => array(
                'i_comment_mail',
                '==',
                'true'
            ) ,
        ) ,
        // 注册用户账户被管理员删除通知用户
        array(
            'id' => 'i_mail_delete',
            'type' => 'switcher',
            'title' => '注册用户账户被管理员删除通知用户',
            'dependency' => array(
                'i_comment_mail',
                '==',
                'true'
            ) ,
        ) ,
        // 网站发布新文章通知用户
        array(
            'id' => 'i_mail_newpost',
            'type' => 'switcher',
            'title' => '网站发布新文章通知用户',
            'dependency' => array(
                'i_comment_mail',
                '==',
                'true'
            ) ,
        ) ,
    ) ,
);
// ------------------------------
// 页面                       -
// ------------------------------
$options[] = array(
    'name' => 'pages',
    'title' => '页面',
    'icon' => 'fa fa-cube',
    'fields' => array(
        // 关于页面
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '关于页面',
        ) ,
        // 归档页面
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '归档页面',
        ) ,
        // 友链页面
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '友链页面',
        ) ,
        // 留言页面
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '留言页面',
        ) ,
        // 启用头像Lazyload功能
        array(
            'id' => 'i_comment_avatar',
            'type' => 'switcher',
            'default' => true,
            'title' => '启用头像Lazyload功能',
        ) ,
        // 启用读者墙
        array(
            'id' => 'i_comment_wall',
            'type' => 'switcher',
            'default' => true,
            'title' => '启用读者墙',
        ) ,
        // 读者墙头像数目
        array(
            'id' => 'i_comment_num',
            'type' => 'number',
            'default' => '20',
            'title' => '读者墙头像数目',
        ) ,
        // 作品页面
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '作品页面',
        ) ,
        // 每页显示作品数目
        array(
            'id' => 'i_works_num',
            'title' => '每页显示作品数目',
            'default' => '20',
            'type' => 'number',
        ) ,
        // 全局关闭评论
        array(
            'id' => 'i_works_comment',
            'type' => 'switcher',
            'title' => '全局关闭评论',
        ) ,
    ) ,
);

// ------------------------------
// 页脚                       -
// ------------------------------
$options[] = array(
    'name' => 'footer',
    'title' => '页脚',
    'icon' => 'fa fa-sliders',
    'fields' => array(
        // 底部编辑器
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '底部编辑器',
        ) ,
        // 底部编辑器
        array(
            'id' => 'i_footer_text',
            'type' => 'switcher',
            'default' => true,
            'title' => '底部编辑器',
        ) ,
        // 底部编辑器
        array(
            'id' => 'i_footer_edit',
            'type' => 'wysiwyg',
            'title' => '底部编辑器',
        ) ,
        // 边栏按钮
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '边栏按钮',
        ) ,
        // 显示回到顶部按钮
        array(
            'id' => 'i_gotop',
            'type' => 'switcher',
            'default' => true,
            'title' => '显示回到顶部按钮',
        ) ,
        // 显示评论按钮
        array(
            'id' => 'i_comment_switch',
            'type' => 'switcher',
            'default' => true,
            'title' => '显示评论按钮',
        ) ,
        // 版权信息
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '版权信息',
        ) ,
        // 版权信息
        array(
            'id' => 'i_foot_copyright',
            'type' => 'textarea',
            'title' => '版权信息',
            'attributes' => array(
                'placeholder' => '© ' . date("Y") . ' All Rights Reserved.'
            ) ,
            'help' => '当右侧边栏隐藏，版权信息将显示在页面底部',
        ) ,
    ) ,
);
// ------------------------------
// SEO                       -
// ------------------------------
$options[] = array(
    'name' => 'seo',
    'title' => 'SEO',
    'icon' => 'fa fa-bug',
    'fields' => array(
        // 百度主动推送
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '百度主动推送',
        ) ,
        // 百度主动推送
        array(
            'id' => 'i_baidu_submit',
            'type' => 'switcher',
            'title' => '百度主动推送',
        ) ,
        // 验证站点域名
        array(
            'id' => 'i_baidu_link',
            'type' => 'text',
            'title' => '验证站点域名',
            'after' => '<p class="cs-text-muted">在站长平台验证的站点，比如www.example.com</p>',
            'dependency' => array(
                'i_baidu_submit',
                '==',
                'true'
            ) ,
        ) ,
        // 站点准入密钥
        array(
            'id' => 'i_baidu_key',
            'type' => 'text',
            'title' => '站点准入密钥',
            'after' => '<p class="cs-text-muted">在站长平台申请的推送用的准入token值,点击<a href="http://zhanzhang.baidu.com/linksubmit/" target="_blank">这里</a>获取</p>',
            'dependency' => array(
                'i_baidu_submit',
                '==',
                'true'
            ) ,
        ) ,
        // 百度手动推送
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '百度手动推送',
        ) ,
        // 百度手动推送
        array(
            'id' => 'i_baidu_manual',
            'type' => 'switcher',
            'title' => '百度手动推送',
            'label' => '推送按钮显示在文章上，管理员可见',
        ) ,
        // Sitemap.xml
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => 'Sitemap.xml',
        ) ,
        // 生成sitemap.xml
        array(
            'id' => 'i_seo_sitemap',
            'type' => 'switcher',
            'title' => '生成sitemap.xml',
        ) ,
        array(
            'type' => 'notice',
            'class' => 'warning',
            'content' => "当前Sitemap地址为： " . home_url() . "/sitemap.xml",
            'dependency' => array(
                'i_seo_sitemap',
                '==',
                'true'
            ) ,
        ) ,
        //基本信息
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '基本信息',
        ) ,
        // 关键词
        array(
            'id' => 'i_seo_keywords',
            'type' => 'textarea',
            'title' => '关键字',
            'help' => '标识页面是关于什么的关键词，通常在搜索引擎中使用',
        ) ,
        // 描述
        array(
            'id' => 'i_seo_description',
            'type' => 'textarea',
            'title' => '描述',
            'help' => '页面的简短描述',
        ) ,
    ) ,
);
// ------------------------------
// 简介                      -
// ------------------------------
$options[] = array(
    'name' => 'social',
    'title' => '简介',
    'icon' => 'fa fa-globe',
    'fields' => array(
        // 显示简介
        array(
            'id' => 'i_profile',
            'type' => 'switcher',
            'default' => true,
            'title' => '显示简介',
        ) ,
        // 头像
        array(
            'id' => 'i_profile_avatar',
            'type' => 'upload',
            'title' => '头像	',
            'default' => get_template_directory_uri() . "/images/default/avatar.png",
        ) ,
        // 昵称
        array(
            'id' => 'i_profile_name',
            'type' => 'text',
            'title' => '昵称',
            'default' => '你的昵称',
        ) ,
        // 头衔
        array(
            'id' => 'i_profile_title',
            'type' => 'text',
            'title' => '头衔',
            'default' => '你的头衔',
        ) ,
        // 简介
        array(
            'id' => 'i_profile_content',
            'type' => 'textarea',
            'title' => '简介',
            'default' => '你的简介',
        ) ,
        // 自定义社交链接
        array(
            'id' => 'i_social',
            'type' => 'group',
            'title' => '自定义社交链接',
            'info' => '更多详细设置方式可以浏览使用说明',
            'button_title' => '添加链接项',
            'accordion_title' => '链接项',
            'help' => '社交链接显示在关于我小工具里面',
            'fields' => array(
                // 自定义社交链接--标题
                array(
                    'id' => 'i_social_title',
                    'type' => 'text',
                    'title' => '菜单标题',
                    'attributes' => array(
                        'placeholder' => '例如：我的微博'
                    )
                ) ,
                // 自定义图标类型
                array(
                    'id' => 'i_icon_style',
                    'type' => 'radio',
                    'title' => '图标类型',
                    'class' => 'horizontal',
                    'options' => array(
                        'i_icon' => '字体图标',
                        'i_image' => '自定义图片',
                    ) ,
                    'default' => 'i_icon',
                ) ,
                // 自定义社交链接--字体图标
                array(
                    'id' => 'i_social_icon',
                    'type' => 'icon',
                    'title' => '字体图标',
                    'dependency' => array(
                        'i_icon_style_i_icon',
                        '==',
                        'true'
                    ) ,
                ) ,
                // 自定义社交链接--自定义图片
                array(
                    'id' => 'i_social_image',
                    'type' => 'upload',
                    'title' => '自定义图片',
                    'dependency' => array(
                        'i_icon_style_i_image',
                        '==',
                        'true'
                    ) ,
                    'help' => '自定义图片大小建议不宜超过100px',
                ) ,
                // 自定义社交链接--链接
                array(
                    'id' => 'i_social_link',
                    'type' => 'text',
                    'title' => '菜单链接',
                    'attributes' => array(
                        'placeholder' => 'http://...'
                    )
                ) ,
                // 自定义社交链接--新标签
                array(
                    'id' => 'i_social_newtab',
                    'type' => 'switcher',
                    'title' => '新标签打开',
                    'dependency' => array(
                        'i_social_link',
                        '!=',
                        ''
                    ) ,
                ) ,
            )
        ) ,
    ) ,
);
// ------------------------------
// 代码                      -
// ------------------------------
$options[] = array(
    'name' => 'code',
    'title' => '代码',
    'icon' => 'fa fa-code',
    'fields' => array(
        // 自定义CSS
        array(
            'id' => 'i_css',
            'type' => 'textarea',
            'before' => '<h4>自定义CSS</h4>',
            'after' => '<p class="cs-text-muted">注意：无需写入<strong>&lt;style></strong>标签。</p>',
        ) ,
        // 自定义javascript
        array(
            'id' => 'i_js',
            'type' => 'textarea',
            'before' => '<h4>自定义javascript</h4>',
            'after' => '<p class="cs-text-muted">注意：无需写入<strong>&lt;script></strong>标签。</p>',
        ) ,
        // 统计代码
        array(
            'id' => 'i_js_tongji',
            'type' => 'textarea',
            'before' => '<h4>统计代码</h4>',
            'after' => '<p class="cs-text-muted">注意：无需写入<strong>&lt;script></strong>标签。',
        ) ,
    ) ,
);
// ------------------------------
// 扩展                      -
// ------------------------------
$options[] = array(
    'name' => 'extension',
    'title' => '扩展',
    'icon' => 'fa fa-cubes',
    'fields' => array(
        array(
            'type' => 'notice',
            'class' => 'warning',
            'content' => '后续版本按用户需求添加各种扩展功能，每个扩展都会额外加载js或css，可按需开启',
        ) ,
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '代码高亮',
        ) ,
        // 代码高亮
        array(
            'id' => 'i_code_prettify',
            'type' => 'switcher',
            'title' => '代码高亮',
            'label' => '使用前请关注使用说明',
        ) ,
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '音乐播放器',
        ) ,
        // 音乐播放器
        array(
            'id' => 'i_player',
            'type' => 'switcher',
            'title' => '开启音乐播放器',
            'label' => '使用前请关注使用说明',
        ) ,
        // 歌单ID
        array(
            'id' => 'i_player_id',
            'type' => 'select',
            'title' => '选择歌单',
            'options' => $playlistsSelect,
        )
    )
);
// ------------------------------
// CDN                       -
// ------------------------------
$options[] = array(
    'name' => 'qiniu',
    'title' => 'CDN',
    'icon' => 'fa fa-cloud-upload',
    'fields' => array(
        array(
            'type' => 'notice',
            'class' => 'warning',
            'content' => '开启CDN加速你的网站，其中需手动修改comments-ajax.js文件，详情请关注老赵博客',
        ) ,
        // 开启加速
        array(
            'id' => 'i_qiniu',
            'type' => 'switcher',
            'title' => '开启加速',
        ) ,
        // CDN域名
        array(
            'id' => 'i_qiniu_link',
            'type' => 'text',
            'title' => 'CDN域名',
            'after' => '<p class="cs-text-muted">注意：开头需写入http://，结尾不需写入/</p>',
            'attributes' => array(
                'placeholder' => 'http://'
            )
        ) ,
        // 包含目录
        array(
            'id' => 'i_qiniu_dir',
            'type' => 'text',
            'title' => '包含目录',
            'default' => 'wp-content,wp-includes',
        ) ,
        // 排除文件
        array(
            'id' => 'i_qiniu_exc',
            'type' => 'text',
            'title' => '排除文件',
            'default' => '.php|.xml|.html|.po|.mo',
        ) ,
    )
);
// ------------------------------
// 备份                       -
// ------------------------------
$options[] = array(
    'name' => 'advanced',
    'title' => '备份',
    'icon' => 'fa fa-shield',
    'fields' => array(
        array(
            'type' => 'notice',
            'class' => 'warning',
            'content' => '您可以保存当前的选项，下载一个备份和导入.',
        ) ,
        // 备份
        array(
            'type' => 'backup',
        ) ,
    )
);
// ------------------------------
// 管理                       -
// ------------------------------
$options[] = array(
    'name' => 'admin',
    'title' => '管理',
    'icon' => 'fa fa-gears',
    'fields' => array(
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '维护模式',
        ) ,
        // 维护模式
        array(
            'id' => 'i_maintenance',
            'type' => 'switcher',
            'title' => '维护模式',
        ) ,
        // 标题
        array(
            'id' => 'i_maintenance_title',
            'type' => 'text',
            'title' => '标题',
            'default' => '维护中...',
            'dependency' => array(
                'i_maintenance',
                '==',
                'true'
            ) ,
        ) ,
        // 通知
        array(
            'id' => 'i_maintenance_notice',
            'type' => 'textarea',
            'title' => '通知',
            'default' => '网站升级维护中...',
            'dependency' => array(
                'i_maintenance',
                '==',
                'true'
            ) ,
        ) ,
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '保护后台登录',
        ) ,
        // 保护登录地址
        array(
            'id' => 'i_login_protection',
            'type' => 'switcher',
            'title' => '保护登录地址',
        ) ,
        // 前缀
        array(
            'id' => 'i_login_prefix',
            'type' => 'text',
            'title' => '前缀',
            'default' => 'admin',
            'dependency' => array(
                'i_login_protection',
                '==',
                'true'
            ) ,
        ) ,
        // 后缀
        array(
            'id' => 'i_login_suffix',
            'type' => 'text',
            'title' => '后缀',
            'default' => 'true',
            'dependency' => array(
                'i_login_protection',
                '==',
                'true'
            ) ,
        ) ,
        // 非法登录跳转
        array(
            'id' => 'i_login_link',
            'type' => 'text',
            'title' => '非法登录跳转',
            'default' => home_url() ,
            'dependency' => array(
                'i_login_protection',
                '==',
                'true'
            ) ,
        ) ,
        array(
            'type' => 'notice',
            'class' => 'warning',
            'content' => "当前登录地址为： " . home_url() . "/wp-login.php?" . cs_get_option('i_login_prefix') . "=" . cs_get_option('i_login_suffix') ,
            'dependency' => array(
                'i_login_protection',
                '==',
                'true'
            ) ,
        ) ,
        // 过滤HTTP 1.0的登录POST请求
        array(
            'id' => 'i_login_http',
            'type' => 'switcher',
            'title' => '过滤HTTP 1.0',
        ) ,
        // POST Cookie 保护
        array(
            'id' => 'i_login_cookie',
            'type' => 'switcher',
            'title' => 'POST Cookie 保护',
        ) ,
        // 增加额外登录验证
        array(
            'id' => 'i_login_auth',
            'type' => 'switcher',
            'title' => '增加额外登录验证',
        ) ,
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '公告弹窗',
        ) ,
        // 弹窗控件
        array(
            'id' => 'i_notice',
            'type' => 'switcher',
            'title' => '启用公告弹窗',
        ) ,
        // 封面
        array(
            'id' => 'i_notice_img',
            'type' => 'upload',
            'title' => '封面',
            'dependency' => array(
                'i_notice',
                '==',
                'true'
            ) ,
        ) ,
        // 标题
        array(
            'id' => 'i_notice_title',
            'type' => 'text',
            'title' => '标题',
            'dependency' => array(
                'i_notice',
                '==',
                'true'
            ) ,
        ) ,
        // 内容
        array(
            'id' => 'i_notice_text',
            'type' => 'textarea',
            'title' => '内容',
            'dependency' => array(
                'i_notice',
                '==',
                'true'
            ) ,
        ) ,
        // 链接
        array(
            'id' => 'i_notice_link',
            'type' => 'text',
            'title' => '链接',
            'dependency' => array(
                'i_notice',
                '==',
                'true'
            ) ,
        ) ,
    )
);

// ------------------------------
// 关于                       -
// ------------------------------
$options[] = array(
    'name' => 'about',
    'title' => '关于',
    'icon' => 'fa fa-info-circle',
    'fields' => array(
        // 关于主题
        array(
            'type' => 'content',
            'content' => '<iframe src="http://7xigsj.com1.z0.glb.clouddn.com/index.html" style="width:100%;height:900px;"></iframe>',
        ) ,
    ) ,
);
CSFramework::instance($settings, $options);
