<?php

/* Template Name: Template */

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();

the_title();
the_content();

endwhile; else:

// nothing found in the loop

endif;

get_footer(); 

?>