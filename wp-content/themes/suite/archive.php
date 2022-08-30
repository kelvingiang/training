<?php get_header(); ?>

<div class="row col-md-4" style="margin-top: 100px;"> 
    <!-- lay ra ten category -->
    <?php $member_group = get_query_var('member-member_group');?>       
    <div class="group-border" >
        <div class="group-title">
            <label><?php  echo $member_group; ?> </label>
        <div>
            <ul class="article-list" >
                <?php
                $member_team = array(
                    'post_type' => 'member',
                    'posts_per_page' => 5,
                    'orderby' => 'ID',
                    'order' => 'DESC',
                    'member-member_group' => $member_group);
                $wp_query = new WP_Query($member_team);
                if ($wp_query->have_posts()):
                    while ($wp_query->have_posts()):
                        $wp_query->the_post();
                        ?>
                        <li>
                            <a class="article-title" href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                        </li>
                        <?php
                    endwhile;
                endif;
                wp_reset_postdata();
                wp_reset_query();
                ?>
            </ul>
        </div>
    </div>
</div>    

<?php //get_footer(); ?>