<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

    <div id="wrapper_container">
        
        <div class="container">
            <div class="row">
                <div id="box_moinhat" class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-tn-12 space_bottom_10">
                    <div class="title_box"><h3><a href="<?php echo get_site_url().SLUG_TINMOINHAT; ?>">Bài viết mới nhất</a></h3></div>
                    <div class="content_box">
                        <div class="block_news width_common">
                            <?php $the_query = new WP_Query( array( 'category__not_in' => SLIDERIGHT, 'posts_per_page' => 3,
'post_status ' => 'publish',
					'post_type' => 'post',
					'order' => 'DESC',
					'orderby' => 'date'
							) );
                            $stt = 0; ?>
                            <?php if (have_posts()):while ($the_query->have_posts()) :
                            $the_query->the_post();
                            if ($stt == 0){ ?>
                            <?php
                                            $image = get_post_thumb(get_the_ID(), 354, 212);
                                        ?> 
                            <div class="block_thumb_news">
                                <a class="thunb_image thumb_5x3" href="<?php echo get_permalink() ?>"><img
                                            alt="no image"
                                            src="<?php echo  $image ['src'] ?>"></a>
                            </div>
                            <h2 class="title_box_news">
                                <a href="<?php echo get_permalink() ?>" ><?php the_title() ?></a>
                            </h2>
                            <h4 class="lead_box_news">
                                <?php
                                if(get_post_meta(get_the_ID(),'description', true) !=""){
                                $des =  get_post_meta(get_the_ID(),'description')[0];
                                echo wp_trim_words( $des, 48, null );
                                }else{
                                $myExcerpt = get_the_excerpt();
                                $tags = array("<p>", "</p>");
                                $myExcerpt = str_replace($tags, "", $myExcerpt);
                                echo $myExcerpt;
                                }  ?>
                            </h4>
                        </div>

                        <div class="list_sub_news width_common">
                            <?php } else { ?>
                                <div class="item_sub_news">
                                    <div class="block_thumb_news">
                                        <?php
                                            $image = get_post_thumb(get_the_ID(), 354, 212);
                                        ?> 
                                        <a class="thunb_image thumb_5x3" href="<?php echo get_permalink() ?>"><img
                                                    src="<?php echo  $image ['src'] ?>"></a>
                                    </div>
                                    <h2 class="title_box_news">
                                        <a href="<?php echo get_permalink() ?>"><?php the_title() ?></a>
                                    </h2>
                                </div>
                                <?php
                            } $stt++;
                            endwhile ?>

                        <?php endif ?>
                        </div>

                        <div class="block_xemthem text-center">
                            <a href="<?php echo get_site_url().SLUG_TINMOINHAT; ?>" class="txt_666"><i class="fa fa-caret-down"></i> Xem thêm</a>
                        </div>
                    </div>
                </div>

                <?php
              /* $defaults = array(
                    'number_of_posts'		 => 3,
                    'post_type'				 => array( 'post' ),
                    'order'					 => 'desc',
                    'thumbnail_size'		 => 'thumbnail',
                    'show_post_views'		 => true,
                    'show_post_thumbnail'	 => false,
                    'show_post_excerpt'		 => false,
                    'no_posts_message'		 => __( 'No Posts', 'post-views-counter' )
                );

                $args = apply_filters( 'pvc_most_viewed_posts_args', wp_parse_args( $args, $defaults ) );

                $args['show_post_views'] = (bool) $args['show_post_views'];
                $args['show_post_thumbnail'] = (bool) $args['show_post_thumbnail'];
                $args['show_post_excerpt'] = (bool) $args['show_post_excerpt'];

                $postslist = pvc_get_most_viewed_posts(
                    array(
                        'posts_per_page' => (isset( $args['number_of_posts'] ) ? (int) $args['number_of_posts'] : $defaults['number_of_posts']),
                        'order'			 => (isset( $args['order'] ) ? $args['order'] : $defaults['order']),
                        'post_type'		 => (isset( $args['post_type'] ) ? $args['post_type'] : $defaults['post_type'])
                    )
                );
				*/
				$query_xemnhieu = array(
					'posts_per_page' => 3,
					'offset' => 0,
					'cat' => '2',
					'post_status ' => 'publish',
					'post_type' => 'post',
					'order' => 'DESC',
					'orderby' => 'date'
				);
				$postslist = new WP_Query($query_xemnhieu);
	

                $stt = 0; ?>
                <div id="box_tinxemnhieu" class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-tn-12 space_bottom_10">
                   <div class="title_box"><h3><a href="<?php echo get_site_url().SLUG_TINXEMNHIEU; ?>" >Tin Xem Nhiều</a>
                        </h3></div>
                    <div class="content_box">
                        <div class="block_news width_common">

                            <?php 
						   if ($postslist->have_posts()) : while ($postslist->have_posts()) : $postslist->the_post();
						    $post_id = get_the_ID();
							$OTduplicateArray[] = $post_id;
		
							$title = the_title('', '', FALSE);
					
                            $image = get_post_thumb(get_the_ID(), 354, 212);
			
                                $src = $image['src']; 
                            if ($stt == 0){ ?>
                            <div class="block_thumb_news">
                                <a class="thunb_image thumb_5x3" href="<?php echo get_permalink() ?>"><img
                                            alt="no image"
                                            src="<?php echo $src ?>"></a>
                            </div>
                            <h2 class="title_box_news">
                                <a href="<?php echo get_permalink() ?>" ><?php the_title() ?></a>
                            </h2>
                            <h4 class="lead_box_news">
                                <?php
                                if(get_post_meta(get_the_ID(),'description', true) !=""){
                                    $des =  get_post_meta(get_the_ID(),'description')[0];
                                    echo wp_trim_words( $des, 48, null );
                                }else{
                                    $myExcerpt = get_the_excerpt();
                                    $tags = array("<p>", "</p>");
                                    $myExcerpt = str_replace($tags, "", $myExcerpt);
                                    echo $myExcerpt;
                                }  ?>
                            </h4>
                        </div>

                        <div class="list_sub_news width_common">
                            <?php } else { ?>
                                <div class="item_sub_news">
                                    <div class="block_thumb_news">
                                        <a class="thunb_image thumb_5x3" href="<?php echo get_permalink() ?>"><img
                                            alt="no image"
                                            src="<?php echo $src ?>"></a>
                                    </div>
                                    <h2 class="title_box_news">
                                        <a href="<?php echo get_permalink() ?>" ><?php the_title() ?></a>
                                    </h2>
                                </div>
                            <?php }
                            $stt++;
                           endwhile;
        endif;
                            wp_reset_postdata(); ?>
                        </div>

                        <div class="block_xemthem text-center">
                            <a href="<?php echo get_site_url().SLUG_TINXEMNHIEU; ?>" class="txt_666"><i
                                        class="fa fa-caret-down"></i> Xem thêm</a>
                        </div>
                    </div>
                </div>
                <div id="box_slider_banner" class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-tn-12 space_bottom_10">
                    <div class="content_box_video width_common">
                        <?php global $post;
                        $args = array('posts_per_page' => 4, 'order' => 'DESC', 'orderby' => 'post_date', 'category' => SLIDERIGHT); ?>
                        <div class="flexslider">
                            <ul class="slides">
                                <?php $postslist = get_posts($args); ?>
                                        <?php foreach ($postslist as $post) :setup_postdata($post);
                                        $image = get_post_thumb(get_the_ID(), 326, 475);
                                        $src = $image['src']; 
                                        ?>
                                <li><a href="<?php echo the_permalink() ?>"><img
                                            alt="no image"
                                            src="<?php echo $src ?>"></a></li>
                                        <?php endforeach; wp_reset_postdata(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-tn-12">
                    <?php global $post;
                    $args = array('posts_per_page' => 3, 'order' => 'DESC', 'orderby' => 'post_date', 'category' => KIENTHUCHANLAM);
                    $category = get_term(KIENTHUCHANLAM, 'category');
                    $category_link = get_category_link(KIENTHUCHANLAM); $postslist = get_posts($args);
                    $stt = 0; ?>
                    <div id="box_kienthuc_hanlam" class="box_common_site" >
                        <?php if(count($postslist)>0){ ?>
                        <div class="title_box_common">
                            <h3 class="wap_title_box relative">
                                <img src="<?php echo get_theme_file_uri(); ?>/assets/images/icon/ico_non.png"
                                     class="icon_title">
                                <a class="text_title_box"
                                   href="<?php echo esc_url($category_link); ?>"><?php echo $category->name; ?></a>
                            </h3>
                        </div>
                        <?php } ?>
                        <div class="content_box_common width_common">
                            <div class="block_news width_common">

                            <?php foreach ($postslist as $post) :
                            setup_postdata($post);
                            $image = get_post_thumb(get_the_ID(), 354, 212);
                                $src = $image['src']; 
                            if ($stt == 0){ ?>
                                <div class="block_thumb_news">
                                    <a class="thunb_image thumb_5x3" href="<?php the_permalink() ?>"><img
                                            alt="no image"
                                            src="<?php echo $src ?>"></a>
                                </div>
                                <h2 class="title_box_news">
                                    <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                </h2>
                                <h4 class="lead_box_news">
                                    <?php
                                    if(get_post_meta(get_the_ID(),'description', true) !=""){
                                        $des =  get_post_meta(get_the_ID(),'description')[0];
                                        echo wp_trim_words( $des, 48, null );
                                    }else{
                                        $myExcerpt = get_the_excerpt();
                                        $tags = array("<p>", "</p>");
                                        $myExcerpt = str_replace($tags, "", $myExcerpt);
                                        echo $myExcerpt;
                                    }  ?>
                                </h4>
                            </div>
                            <div class="list_sub_news width_common dot_list_sub">
                                <?php } else { ?>
                                    <div class="item_sub_news">
                                        <h2 class="title_box_news">
                                            <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                        </h2>
                                    </div>
                                <?php }
                                $stt++;
                                endforeach;
                                wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </div>

                    <?php global $post;
                    $args = array('posts_per_page' => 3, 'order' => 'DESC', 'orderby' => 'post_date', 'category' => KIENTHUCBENHHOC);
                    $category = get_term(KIENTHUCBENHHOC, 'category');
                    $link_cate = get_category_parents_custom( KIENTHUCBENHHOC, true, '' ); ?>
                    <div id="box_kienthuc_benhhoc" class="box_common_site">
                        <div class="title_box_common">
                            <?php if(isset($category)){ ?>
                            <h3 class="wap_title_box relative">
                                <img src="<?php echo get_theme_file_uri(); ?>/assets/images/icon/ico_sach.png"
                                     class="icon_title">
                                <a class="text_title_box"
                                   href="<?php echo $link_cate; ?>"><?php echo $category->name; ?></a>
                            </h3>
                            <?php } ?>
                        </div>

                        <?php $list_cate = getChildCate(KIENTHUCBENHHOC); if(isset($list_cate)){ foreach($list_cate as $item=>$value){  ?>
                        <?php global $post;
                        $args = array('posts_per_page' => 3, 'order' => 'DESC', 'orderby' => 'post_date', 'category' => $value);
                        $category = get_term($value, 'category');
                        $stt = 0;  $link_cate = get_category_parents_custom( $value, true, '' );
                        $postslist = get_posts($args);
                        ?>
                        <div class="item_box_kienthuc">
                            <?php if(count($postslist)>0){ ?>
                            <h2 class="block_text_info_box">
                                <a href="<?php echo $link_cate; ?>"><?php echo $category->name; ?></a>
                            </h2>
                            <?php }  ?>
                            <div class="content_box_common width_common">
                                <div class="block_news width_common">
                                    <div class="block_news width_common">
                                    <?php foreach ($postslist as $post) :
                                    setup_postdata($post);
                                    $image = get_post_thumb(get_the_ID(), 354, 212);
                                    $src = $image['src']; 
                                    if ($stt == 0){ ?>
                                        <div class="block_thumb_news">
                                            <a class="thunb_image thumb_5x3" href="<?php the_permalink() ?>"><img
                                            alt="no image"
                                            src="<?php echo $src ?>"></a>
                                        </div>
                                        <h2 class="title_box_news">
                                            <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                        </h2>
                                        <h4 class="lead_box_news">
                                            <?php
                                            if(get_post_meta(get_the_ID(),'description', true) !=""){
                                                $des =  get_post_meta(get_the_ID(),'description')[0];
                                                echo wp_trim_words( $des, 48, null );
                                            }else{
                                                $myExcerpt = get_the_excerpt();
                                                $tags = array("<p>", "</p>");
                                                $myExcerpt = str_replace($tags, "", $myExcerpt);
                                                echo $myExcerpt;
                                            }  ?>
                                        </h4>
                                    </div>
                                    <div class="list_sub_news width_common dot_list_sub">
                                        <?php } else { ?>
                                            <div class="item_sub_news">
                                                <h2 class="title_box_news">
                                                    <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                                </h2>
                                            </div>
                                        <?php }
                                        $stt++;
                                        endforeach;
                                        wp_reset_postdata(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                       <?php }} ?>

                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-tn-12">
                    <?php global $post;
                    $args = array('posts_per_page' => 3, 'order' => 'DESC', 'orderby' => 'post_date', 'category' => SUCKHOELAMDEP);
                    $category = get_term(SUCKHOELAMDEP, 'category');
                    $category_link = get_category_link(SUCKHOELAMDEP); $postslist = get_posts($args);
                    $stt = 0;  ?>
                    <div id="box_dieutri" class="box_common_site">
                        <?php if(count($postslist)>0){ ?>
                        <div class="title_box_common">
                            <h3 class="wap_title_box relative">
                                <img src="<?php echo get_theme_file_uri(); ?>/assets/images/icon/ico_dieutri.png"
                                     class="icon_title">
                                <a class="text_title_box"
                                   href="<?php echo esc_url($category_link); ?>"><?php echo $category->name; ?></a>
                            </h3>
                        </div>
                        <?php } ?>
                        <div class="content_box_common width_common">
                            <div class="block_news width_common">
                                <div class="block_news width_common">
                                <?php foreach ($postslist as $post) :
                                setup_postdata($post);
                                $image = get_post_thumb(get_the_ID(), 354, 212);
                                $src = $image['src']; 
                                if ($stt == 0){ ?>
                                    <div class="block_thumb_news">
                                        <a class="thunb_image thumb_5x3" href="<?php the_permalink() ?>"><img
                                            alt="no image"
                                            src="<?php echo $src ?>"></a></a>
                                    </div>
                                    <h2 class="title_box_news">
                                        <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                    </h2>
                                    <h4 class="lead_box_news">
                                        <?php
                                        if(get_post_meta(get_the_ID(),'description', true) !=""){
                                            $des =  get_post_meta(get_the_ID(),'description')[0];
                                            echo wp_trim_words( $des, 48, null );
                                        }else{
                                            $myExcerpt = get_the_excerpt();
                                            $tags = array("<p>", "</p>");
                                            $myExcerpt = str_replace($tags, "", $myExcerpt);
                                            echo $myExcerpt;
                                        }  ?>
                                    </h4>
                                </div>
                                <div class="list_sub_news width_common dot_list_sub">
                                    <?php } else { ?>
                                        <div class="item_sub_news">
                                            <h2 class="title_box_news">
                                                <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                            </h2>
                                        </div>
                                    <?php }
                                    $stt++;
                                    endforeach;
                                    wp_reset_postdata(); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div id="box_tuvan" class="box_common_site">
                            <div class="title_box_common">
                                <h3 class="wap_title_box relative">
                                    <img src="<?php echo get_theme_file_uri(); ?>/assets/images/icon/ico_tuvan.png"
                                         class="icon_title">
                                    <a class="text_title_box"
                                       href="<?php echo esc_url(home_url('/tu-van-chia-se')) ?>">tư vấn - chia sẻ</a>
                                </h3>
                            </div>
                            <div class="content_box_common width_common">
                                <div class="list_tuvan width_common">
                                    <div class="item_tuvan width_common">
                                        <?php echo do_shortcode('[dwqa-list-questions]'); ?>
                                    </div>
                                    <div class="block_txt_datcauhoi text-center"><a href="<?php echo esc_url(home_url('/tu-van-chia-se')) ?>" class="text-uppercase txt_16 txt_site"><b>đặt câu hỏi</b></a></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-tn-12">
                        <div id="box_video" class="width_common space_bottom_20">
                            <?php global $post;
                            $args = array('posts_per_page' => 6, 'order' => 'DESC', 'orderby' => 'post_date', 'category' => KHOVIDEO);
                            $category = get_term(KHOVIDEO, 'category');
                            $category_link = get_category_link(KHOVIDEO); $postslist = get_posts($args);  if(count($postslist)>0){ ?>
                            <div class="title_box_video width_common">
                                <img src="<?php echo get_theme_file_uri(); ?>/assets/images/icon/ico_video.png"
                                     class="icon_title">
                                <a class="text_title_box" href="<?php echo esc_url($category_link) ?>"><?php echo $category->name; ?></a>
                            </div>
                            <?php } ?>
                            <div class="content_box_video width_common">
                                <div class="flexslider">
                                    <ul class="slides">
                                        <?php foreach ($postslist as $post) :
                                            setup_postdata($post);
                                            $image = get_post_thumb(get_the_ID(), 354, 212);
                                            $src = $image['src']; 
                                            ?>
                                            <li>
                                                <div class="item_video">
                                                    <div class="thumb_video relative">
                                                        <div class="thunb_image thumb_5x3"><img
                                            alt="no image"
                                            src="<?php echo $src ?>"></div>
                                                        <a href="<?php the_permalink() ?>" class="masking_video1"> &nbsp;</a>
                                                        <a href="<?php the_permalink() ?>" class="masking_video2"> &nbsp;</a>
                                                    </div>
                                                    <h2 class="title_video"><a href="<?php the_permalink() ?>" class="three-lines"><?php the_title() ?></a>
                                                    </h2>
                                                </div>
                                            </li>
                                            <?php
                                        endforeach;
                                        wp_reset_postdata(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="block_banner_960x90 width_common text-center space_bottom_20">
                    <?php dynamic_sidebar('sidebar-2'); ?>
                </div>
            </div>
        </div>
    <!-- /page -->

<?php get_footer();
