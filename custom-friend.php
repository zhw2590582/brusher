<?php
/*
Template Name: 友链页面
*/
error_reporting(0);
?>

<?php get_header(); ?>

                      <!-- 友链 -->
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
                                  <ul class="link_box">
                                      <?php wp_list_bookmarks('orderby=id&category_orderby=id'); ?>
                                  </ul>
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
