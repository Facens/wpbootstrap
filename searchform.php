<div class="inline-inputs">
	<form action="<?php echo home_url( '/' ); ?>" method="get">
	    <fieldset>
        <p>
	        <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
	        <input class="btn secondary small" type="submit" alt="Search" value="Search" />
	    	</p>
	    </fieldset>
	</form>
</div> <!-- /inline-inputs -->