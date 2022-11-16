<?php
function my_paging($intPage, $intCurrentPage, $strUrlArticle)
{
    if ($intPage > 1) {
?>
        <div style="float: right; color:#999; font-size:0.8rem">
            <?php _e('第', 'suite'); ?> <?php echo $intCurrentPage + 1 ?> <?php _e('頁 的', 'suite'); ?>
            <?php echo $intPage ?> <?php _e('頁', 'suite'); ?>
        </div>
<?php
        echo '<ul class="pro-pagination">';
        /* << */
        if ($intCurrentPage >= 1) {
            echo '<li> <a href="' . $strUrlArticle . '"> <i class="fa fa-step-backward" aria-hidden="true"></i></a> </li> ';
        } else {
            echo ' ';
        }

        /* < */
        if ($intPage > 1) {
            if ($intCurrentPage >= 1) {
                if ($intCurrentPage == 1) {
                    echo '<li><a href="' . $strUrlArticle . '"><i class="fa fa-chevron-left" aria-hidden="true"></i></a></li> ';
                } else {
                    echo '<li><a href="' . $strUrlArticle . '?wp=' . $intCurrentPage . '"><</a> </li>';
                }
            } else {
                echo ' ';
            }
        }

        /* Same page */
        if ($intCurrentPage == $intPage - 1) {
            $intMin = $intCurrentPage - 1;
            if ($intPage == 2) {
                $intMin = $intCurrentPage;
            }
            for ($i = $intMin; $i < $intCurrentPage + 2; $i++) {
                if ($i == $intPage) {
                    echo '<li class="selected">' . $i . '</li>';
                } else {
                    echo ' <li><a href="' . $strUrlArticle . '?wp=' . $i . '">' . $i . '</a> </li>';
                }
            }
        } elseif ($intCurrentPage == 0) {
            if ($intPage == 2) {
                $intMax = 3;
            } elseif ($intPage == 1) {
                $intMax = 2;
            } else {
                $intMax = 4;
            }

            for ($i = $intCurrentPage + 1; $i < $intMax; $i++) {
                if ($i == 1) {
                    echo '<li class="selected" >' . $i . '</li> ';
                } else {
                    echo '<li><a href="' . $strUrlArticle . '?wp=' . $i . '">' . $i . '</a> </li>';
                }
            }
        } elseif ($intCurrentPage > 0 && $intCurrentPage < $intPage - 1) {
            for ($i = $intCurrentPage; $i < $intCurrentPage + 3; $i++) {
                if ($i == $intCurrentPage + 1) {
                    echo '<li class="selected" >' . $i . '</li> ';
                } else {
                    echo '<li><a href="' . $strUrlArticle . '?wp=' . $i . '">' . $i . '</a> </li>';
                }
            }
        }

        /* > */
        if ($intPage > 1) {
            if ($intCurrentPage < $intPage - 1) {
                echo '<li><a href="' . $strUrlArticle . '?wp=' . ($intCurrentPage + 2) . '"><i class="fa fa-chevron-right" aria-hidden="true"></i></a></li> ';
            } else {
                echo '';
            }
        }

        /* >> */
        if ($intCurrentPage < $intPage - 1) {
            echo '<li><a href="' . $strUrlArticle . '?wp=' . $intPage . '"><i class="fa fa-step-forward" aria-hidden="true"></i></a> </li>';
        } else {
            echo ' ';
        }

        echo  '</ul>';
    }
};
