<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div class="the-search-form">
        <label class="screen-reader-text" for="s" style="float: left;">Search <?php if(is_search()){echo 'Results ';}?>for:</label>
        <input type="text" value="<?php printf( __( '%s', 'bare' ), get_search_query() ); ?>" name="s" id="s" style="float: left;margin: 0px 10px"/>
        <input type="submit" id="searchsubmit" value="Search" style="float: left;margin: 0;" />
    </div>
</form>
<br style="clear:both;" />