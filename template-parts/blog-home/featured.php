<?php
$featured_post = new WP_Query( array(
    'meta_key' => 'featured',
    'meta_value' => '1',
    'posts_per_page'=> 3
));

$post_data = array();
while ( $featured_post->have_posts()){

    $featured_post->the_post();
    $category = get_the_category();
    $post_data[] = array(
        "title" => get_the_title(),
        "date" => get_the_date(),
        "thumbnail" => get_the_post_thumbnail_url(get_the_ID(),"large"),
        "author" => get_the_author("display_name"),
        "author_avatar" => get_avatar_url(get_the_author_meta("ID")),
        "category" => $category[mt_rand(0,count($category) - 1)]->name,


    );
}


if( $featured_post->post_count > 1 ):
?>

<div class="pageheader-content row">
    <div class="col-full">

        <div class="featured">

            <div class="featured__column featured__column--big">
                <div class="entry" style="background-image:url('<?php echo esc_url($post_data[0]['thumbnail']) ?>');">

                    <div class="entry__content">
                        <span class="entry__category"><a href="#0"><?php echo esc_html($post_data[0]['category']) ?></a></span>

                        <h1><a href="#0" title=""><?php echo esc_html($post_data[0]['title']) ?></a></h1>

                        <div class="entry__info">
                            <a href="#0" class="entry__profile-pic">
                                <img class="avatar" src="<?php echo esc_url($post_data[0]['author_avatar']) ?>" alt="">
                            </a>

                            <ul class="entry__meta">
                                <li><a href="#0"><?php echo esc_html($post_data[0]['author']) ?></a></li>
                                <li><?php echo esc_html($post_data[0]['date']) ?></li>
                            </ul>
                        </div>
                    </div> <!-- end entry__content -->

                </div> <!-- end entry -->
            </div> <!-- end featured_3_big -->

            <div class="featured__column featured__column--small">
                <?php

                for($i=1; $i < 3; $i++):

                ?>

                <div class="entry" style="background-image:url('<?php echo esc_url($post_data[$i]['thumbnail']) ?>');">

                    <div class="entry__content">
                        <span class="entry__category"><a href="#0"><?php echo esc_html($post_data[$i]['category']) ?></a></span>

                        <h1><a href="#0" title="">'<?php echo esc_html($post_data[$i]['title']) ?>'</a></h1>

                        <div class="entry__info">
                            <a href="#0" class="entry__profile-pic">
                                <img class="avatar" src="<?php echo esc_url($post_data[$i]['author_avatar']) ?>" alt="">
                            </a>

                            <ul class="entry__meta">
                                <li><a href="#0"><?php echo esc_html($post_data[$i]['author']) ?></a></li>
                                <li><?php echo esc_html($post_data[$i]['date']) ?></li>
                            </ul>
                        </div>
                    </div> <!-- end entry__content -->

                </div> <!-- end entry -->
                <?php
                    endfor;
                ?>
            </div> <!-- end featured__small -->
        </div> <!-- end featured -->

    </div> <!-- end col-full -->
</div> <!-- end pageheader-content row -->
<?php

endif;
?>