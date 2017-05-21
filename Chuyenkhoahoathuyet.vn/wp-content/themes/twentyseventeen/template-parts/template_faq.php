<?php
/*
Template Name: câu hỏi thường gặp
*/
get_header(); ?>
    <div id="wrapper_container">
        <div class="container">
            <div id="tuvan_page">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7 col-tn-12 space_bottom_10">
                        <div id="box_tuvan" class="width_common space_bottom_20">
                            <div class="title_box"><h3><a href="" class="text-uppercase">Tư vấn</a></h3></div>
                            <div class="content_box">
                                <?php

                                global $post;

                                $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
                                $args = array('posts_per_page' => 5,'paged'=>$paged,'post_status'=>'publish', 'order' => 'DESC', 'orderby' => 'post_date', 'post_type' => 'dwqa-question');
                                $postslist = get_posts($args);
                                ?>
                                <div class="list_tuvan width_common">

                                    <?php if(count($postslist)>0){ foreach ($postslist as $post) :
                                        setup_postdata($post); ?>

                                        <?php

                                        $user_id = get_post_field('post_author', get_the_ID()) ? get_post_field('post_author', get_the_ID()) : false;

                                        $time = human_time_diff(get_post_time('U', true));
                                        $text = __('asked', 'dwqa');

                                        $latest_answer = get_comments([
                                            'post_id' => get_the_ID()]);

                                        ?>
                                        <div class="item_tuvan width_common">
                                            <div class="user_tuvan"><i class="fa fa-question-circle-o" aria-hidden="true"></i> <strong
                                                        class="txt_666"><?php echo dwqa_the_author(''); ?></strong> - <span
                                                        class="txt_aaa"><?php the_title(); ?></span></div>
                                            <div class="block_question">
                                                <?php the_content(); ?>
                                            </div>
                                            <?php if (!empty($latest_answer)) : ?>
                                                <?php
                                                $i = 1;
                                                foreach ($latest_answer as $item) :?>
                                                    <div class="block_answear">
                                                        <i class="fa fa-caret-up"></i>
                                                        <div> <?php echo($item->comment_content) ?> </div>

                                                        <?php
                                                        $author = get_the_author_meta('nickname' , 1);
                                                        ?>
                                                        <div class="author_answear"><?php echo($author) ?></div>
                                                    </div>
                                                    <?php
                                                    if ($i == 1) break;
                                                endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                        <?php
                                    endforeach;
                                        wp_reset_postdata(); } ?>
                                </div>
                                <?php
                                $current_url = add_query_arg( '', '', home_url( $wp->request ) );
                                ?>
                                <?php if(count($postslist)>=5){ ?>
                                    <div class="block_xemthem text-right">
                                        <a href="<?php echo $current_url.'?page='.($paged+1); ?>" class="txt_666"><i class="fa fa-caret-down"></i> Xem thêm</a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 col-tn-12 space_bottom_10">
                        <div id="box_datcauhoi" class="space_bottom_20 width_common">
                            <div class="title_box"><h3><a class="text-uppercase">đặt câu hỏi</a></h3></div>
                            <div class="content_box_video width_common">
                                <div class="lead_lienhe space_bottom_20">Mọi thắc mắc cần được giải đáp hay tư vấn xin vui lòng đặt câu hỏi tại đây</div>
                                <div class="main_form_input_lienhe width_common">
                                    <?php  dynamic_sidebar('form_faq'); ?>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>