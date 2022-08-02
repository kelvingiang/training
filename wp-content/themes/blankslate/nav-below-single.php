<nav id="nav-below" class="navigation" role="navigation">
    <div class="nav-previous"><?php previous_post_link('%link', '<span class="meta-nav">&larr;</span> %title'); ?></div>
    <div class="nav-next"><?php next_post_link('%link', '%title <span class="meta-nav">&rarr;</span>'); ?></div>
</nav>
<style type="text/css">
    #nav-below{
        min-height:  40px;
        border-top: 1px solid #ccc;
        border-bottom:  1px solid #ccc;
        line-height: 40px;
        background-color:#ffeea9;
    }   
    
    #nav-below a{
        font-size: 16px;
        text-decoration: none;
        font-weight: bold;
    }

    #nav-below .nav-previous{
        float: left;
    }
    
    #nav-below .nav-next{
        float: right;
    }
</style>