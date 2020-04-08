<section class="services">
    <div class="wrapper">

        <?php $intro = get_option('frontpage', true); ?>
            
        <div class="service_info">
            <?php echo apply_filters( 'the_content',  $intro['content']); ?>
        </div>

        <div class="service_map">
            <?php echo $intro['map_embed']; ?>
        </div>

    </div>
</section>
