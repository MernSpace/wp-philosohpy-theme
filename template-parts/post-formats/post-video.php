<?php
$philosophy_video = get_field('');
if(function_exists('the_field')){
    $philosophy_video = get_field('file_link');
}
?>


<article class="masonry__brick entry format-video" data-aos="fade-up">

    <div class="entry__thumb video-image">
       <?php the_post_thumbnail();?>

    </div>

    <?php get_template_part('template-parts/common/post/summary'); ?>


</article> <!-- end article -->