<?php get_header(); ?>

<div class="row">
    <section class="col-md-8">
        <?php


                /* thong bao trang khong ton tại */
                _e('<h2>404 NOT FOUND</h2>', 'suite');
                _e('<p>The article you were looking for was not found, but maybe try looking again!</p>', 'suite');

                /* tao textbox serach */
                get_search_form();
                _e('<h3>Content categories</h3>', 'suite')

                        /*hien thi cac category */;
                echo '<div class="404-catlist">';
                wp_list_categories(array('title_li' => ''));
                echo '</div>';

                // hien thi cac tag 
                _e('<h3>Tag Cloud</h3>', 'suite');
                wp_tag_cloud();
                //                             echo '<pre>';
                //                          print_r($wp_query);
                //                          echo '</pre>';   
                ?>
    </section>
    <section class="col-md-4">
        <?php get_sidebar(); ?>
    </section>

</div>

<?php get_footer(); ?>