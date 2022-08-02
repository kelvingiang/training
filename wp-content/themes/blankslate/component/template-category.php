<div>
    <?php 
     $choieCate = $wp_query->query['category_name'];

    ?>
    <?php
    $categories = get_categories(array(
        'orderby' => 'name',
        'parent' => 0
    ));
    ?>
    <ul class="cate-list">
        <?php foreach ($categories as $cat) { ?>
            <li class="<?php echo $cat->slug ?>"> <a class="article-title" href="<?php echo get_term_link($cat->slug, $cat->taxonomy) ?>"><?php echo $cat->name ?></a>  </li>
        <?php } ?>
    </ul>
</div>

<script type="text/javascript">
    jQuery(document).ready(function () {
         jQuery('.cate-list li').each(function(){
             var cll = jQuery(this).attr('class');
             var cat = '<?php echo $choieCate ?>';
             console.log(cat);
              if(cll === cat ){
                  jQuery(this).addClass('selectItem');
              }
         });
});
 </script>
 
    

<style>
    .selectItem{
            background-color: #666 !important;
    }
    
    .cate-list{
        background-color: #72001A;
        border-radius:  0 0  5px 5px;
    }
    .cate-list li{
        padding: 8px 5px;
        border-bottom: 1px solid #fff;
        color: white;
        display: block;
    }

    .cate-list li a{
        line-height: 2;
        color: #cccccc;
        font-weight: bold;
        font-size: 15px;
        display: block;
        text-decoration:  none;
    }

    .cate-list li a:hover{
        color: white;
    }



</style>

