<?php

function mySlider($cate)
{
?>
    <div class="border_box" style="margin-bottom: 2rem;">
        <div class="box_skitter box_skitter_large">
            <ul>
                <?php
                //  global $post, $posts;
                $args = array(
                    'post_type' => 'slide',
                    'posts_per_page' => -1,
                    'slide_category' => $cate,
                );
                $loop = new WP_Query($args);
                $stt = 0;
                if ($loop->have_posts()) :
                    while ($loop->have_posts()) :
                        $stt++;
                        //cac hieu ung chuyen doi lay
                        $a = array("fade", "circlesRotate", "blindHeight", "circles", "swapBars", "tube", "cubeJelly", "blindWidth", "paralell", "showBarsRandom", "block");
                        $random_keys = array_rand($a); // random array tren de doi hieu ung
                        $loop->the_post();
                ?>
                        <li>
                            <?php the_post_thumbnail('', array('class' => $a[$random_keys], 'title' => the_title_attribute('echo=0'))); ?>
                            <div class="label_text">
                                <h2><?php the_title(); ?></h2>
                            </div>
                        </li>
                <?php
                    endwhile;
                endif;
                wp_reset_postdata()
                ?>
            </ul>
        </div>
    </div>
<?php
}
