<?php
  /*
  Template Name: 留言页面
  */
  error_reporting(0);
  $wall = cs_get_option('i_comment_wall');
  $num = cs_get_option('i_comment_num');
?>


<?php get_header(); ?>

                      <!-- 留言 -->
        	            <div class="posts">
                            <article <?php post_class('single-post'); ?>>
                                <div class="post-wrap">
                                    <div class="post-inner colbox">
                                        <div class="post-right col">
                                            <header class="post-title">
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </header>
                                            <div class="post-content">
                                                <?php if ( have_posts() ) : the_post(); ?>
                                                    <?php the_content(); ?>
                                                <?php endif; ?>
                                                <!-- start 读者墙  Edited By iSayme-->
                                                <?php if ($wall == true && !is_mobile() ) {
                                                    $query="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 24 MONTH ) AND user_id='0' AND comment_author_email != '改成你的邮箱账号' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT ".$num."";//大家把管理员的邮箱改成你的,最后的这个39是选取多少个头像，大家可以按照自己的主题进行修改,来适合主题宽度
                                                    $wall = $wpdb->get_results($query);
                                                    $maxNum = $wall[0]->cnt;
                                                    foreach ($wall as $comment)
                                                    {
                                                        $width = round(40 / ($maxNum / $comment->cnt),2);
                                                        if( $comment->comment_author_url )
                                                        $url = $comment->comment_author_url;
                                                        else $url="#";
                                                        $avatar = get_avatar( $comment->comment_author_email, $size = '24', $default = get_bloginfo('wpurl').'/avatar/default.jpg' );
                                                        $tmp = "
                                                        <li class=\"fl\">
                                                            <a target=\"_blank\" href=\"".$comment->comment_author_url."\">
                                                                <div class='readers-inner with-tooltip clearfix' data-tooltip=\"".$comment->comment_author_url."\">
                                                                    <div class='avatar-img fl'>
                                                                        ".$avatar."
                                                                    </div>
                                                                    <div class='avatar-msg fl'>
                                                                        <p class='name'>
                                                                            ".$comment->comment_author."
                                                                        </p>
                                                                        <p class='cnt'>
                                                                            ".$comment->cnt."条评论
                                                                        </p>
                                                                    </div>

                                                                </div>
                                                            </a>
                                                        </li>";
                                                        $output .= $tmp;
                                                    }
                                                    $output = "<ul class=\"readers-list clearfix\">".$output."<div class='clearfix'></div></ul>";
                                                    echo $output ;
                                                }?>
                                                <!-- end 读者墙 -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <!-- 评论 -->
                            <?php if ('open' == $post->comment_status) { ?>
                            <div id="comment-jump" class="comments">
                                <?php comments_template(); ?>
                            </div>
                            <?php } ?>
        	            </div>


<?php get_footer(); ?>
