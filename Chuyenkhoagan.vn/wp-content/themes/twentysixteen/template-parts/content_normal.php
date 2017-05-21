<div id="row">
    <?php
    $tags = wp_get_post_tags(get_the_ID());
    if ($tags) {
        $first_tag = $tags[0]->term_id;
        $args = array('numberposts' => 7, 'offset' => 1);
        $args = array(
            'tag__in' => array($first_tag),
            'post__not_in' => get_the_ID(),
            'posts_per_page' => 7,
            'caller_get_posts' => 0
        );
        $my_query = new WP_Query($args);
    } else {
        $args = array('numberposts' => 7, 'offset' => 0 );
    }

    $posts_related = get_posts($args);

    // Start the loop.
    while (have_posts()) :
        the_post();
        $tags = get_the_tags();
        ?>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 col-tn-12">
            <div class="breadcrumb">
                <?php
                $bread = '';
                $i = 1;
                foreach (get_the_category() as $category) {

                    $bread .= '<i class="fa fa-caret-right"></i> <a href="' . get_category_link($category->term_id) . '" class="active_breadcrumb">' . $category->name . '</a>';
                    if ($i == 1) break;
                    $i++;
                };
                ?>
                <a href="/">Trang chủ</a> <?php echo $bread; ?>
            </div>
            <div id="detail_page">
                <div id="box_detail">
                    <h1 class="title_detail_page"><?php echo get_the_title(); ?></h1>
                    <div class="author_detail_page"><!--<b><?php //echo get_the_author_meta('nickname'); ?></b> |-->
                         <?php echo get_the_time() ?>
                    </div>
                    <div class="block_social_page">
                        <div class="pull-left social_left">
                            <div class="fb-like" data-href="<?php echo get_the_permalink(); ?>" data-layout="standard"
                                 data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <h3 class="lead_detail_page"><?php if(count(get_post_meta(get_the_ID(),'description'))>0){ echo get_post_meta(get_the_ID(),'description')[0]; } ?></h3>
                    
                    <div class="relative_news_detail">
                        <?php
                        $i = 1;
                        foreach ($posts_related as $post) : ?>
                            <div class="item_relative_news"><a
                                                href="<?php echo get_the_permalink($post->postID); ?>"><?php the_title()?></a></div>
                            <?php
                            if ($i === 2) break;
                            $i++;
                        endforeach; ?>
                    </div>
                  <!--  <div class="col-sm-12" style="margin:10px;">
                                <?php //dynamic_sidebar('quangcao'); ?>
                    </div>-->
                    <div class="fck_detail" style="text-align: justify;">
                        <?php
						
						$content = get_the_content();
						$content = apply_filters( 'the_content', $content );
						$content = str_replace( ']]>', ']]&gt;', $content );
						$content = str_replace( 'embed.mecloud.vn', '', $content );
						$content = str_replace('<br />','', $content );

						 $closing_p = '</p>';
						 $paragraphs = explode( $closing_p, $content);
						 $paragraph_id = 5;
					
						 foreach ($paragraphs as $index => $paragraph) {
							// // Only add closing tag to non-empty paragraphs
							 if ( trim( $paragraph ) ) {
								// // Adding closing markup now, rather than at implode, means insertion
								// // is outside of the paragraph markup, and not just inside of it.
								 $paragraphs[$index] .= $closing_p;
						 }
							// // + 1 allows for considering the first paragraph as #1, not #0.
					 if ( $paragraph_id == $index + 1 ) {
								 $output_qc="";
								// $output_qc = $output_qc . " <div class=\"col-sm-12\" style=\"margin:10px;\">";
								 
								 $output_qc = $output_qc .	"<p><a href=\"javascript:void(0)\"><img  src=\"http://chuyenkhoanoitiettonu.vn/wp-content/themes/twentyseventeen/630x90.jpg\"></a></p>";
								// $output_qc = $output_qc . "</div>";
					
								 $paragraphs[$index] .= $output_qc;
							 }
							 
						 }
						 $content = implode( '', $paragraphs );
						echo($content);
						
						?>
                    </div>
                    <div class="block_social_page social_bottom_detail">
                        <div class="pull-left social_left">
                            <div class="fb-like" data-href="<?php echo get_the_permalink(); ?>" data-layout="standard"
                                 data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <?php if (!empty($tags)) : ?>
                        <div class="block_tag_page_detail">
                            <span>Tag</span>
                            <?php foreach ($tags as $tag) : ?>
                                <a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div id="box_tin_lienquan_detail" class="item_box_col_right space_bottom_10">
                        <div class="title_box"><h3><a href="#">Tin liên quan</a></h3>
                            <!--<div class="block_xemthem text-right">
                                <a href="#" class="txt_666"><i class="fa fa-caret-down"></i> Xem thêm</a>
                            </div>-->
                        </div>
                        <div class="content_box">
                            <?php $i = 1;
                            foreach ($posts_related as $post) : ?>
                                <?php if ($i > 2) : ?>
                                    <h5 class="item_tinlienquan_detail"><a
                                                href="<?php echo get_the_permalink($post->postID); ?>"><?php echo $post->post_title; ?></a>
                                       <!-- <span class="txt_666"><?php echo get_the_time($d = '', $post->postID) ?></span>-->
                                    </h5>
                                <?php endif; ?>
                                <?php
                                $i++;
                            endforeach; ?>
                        </div>
                    </div>

                    <div id="box_comment" class="space_bottom_20">
                        <div class="fb-comments" data-href="<?php echo get_the_permalink(); ?>" data-numposts="5"></div>
                    </div>

                </div>
            </div>

        </div>
        <?php
    endwhile;
    ?>
    <?php get_sidebar(); ?>
</div>