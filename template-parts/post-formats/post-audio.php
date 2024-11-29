

<?php
$philosophy_audio = get_field('');
if(function_exists('the_field')){
    $philosophy_audio = the_field('file_link');
}
?>
<article class="masonry__brick entry format-audio" data-aos="fade-up">

    <div class="entry__thumb">
        <a href="<?php the_permalink();?>" class="entry__thumb-link">
           <?php the_post_thumbnail('philosophy-home-thumb'); ?>
        </a>
        <?php if($philosophy_audio): ?>

        <div class="audio-wrap">
            <audio id="player" src="<?php echo esc_url($philosophy_audio);?>" width="100%" height="42" controls="controls"></audio>
        </div>

        <?php endif; ?>
    </div>

    <?php get_template_part('template-parts/common/post/summary'); ?>

</article> <!-- end article -->