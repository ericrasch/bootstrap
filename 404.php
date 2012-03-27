<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage BestCollegesOnline.com
 *
 * Edited by Joost de Valk to provide a better user experience, read more here:
 * http://yoast.com/wordpress-404-error-pages/
 */

/**
 * Because of using post_type=any we have to manually weed out the attachments from the query_posts results.
 *
 * @return WHERE statement that strips out attachment
 * @author Joost De Valk
 **/
function yst_strip_attachments($where) {
	$where .= ' AND post_type != "attachment"';
	return $where;
}
add_filter( 'posts_where','yst_strip_attachments' );

get_header();
?>
        <div class="row" id="main-area">

            <div class="span4" id="sidebar">
                <?php get_sidebar(); ?>
            </div><!-- END .span4 #sidebar -->

            <div class="span8" id="content-area">

                <?php  if ( is_404() ) { // ******* Don't display certain content if you are on this page ?>
                <h1><small>Error 404</small> Page Not Found</h1>

                <?php } else { // ******* Display the alternate content ?>

                <h1><small>Ummmm...</small> No Content Found</h1>
                <?php } ?>

                <div id="content">

                    <p>You
                    <?php // Borrowed this section from http://codex.wordpress.org/Creating_an_Error_404_Page#Helpful_404_pages
                    #some variables for the script to use
                    #if you have some reason to change these, do.  but wordpress can handle it
                    $adminemail = get_bloginfo('admin_email'); #the administrator email address, according to wordpress
                    $website = home_url(); #gets your blog's url from wordpress
                    $websitename = get_bloginfo('name'); #sets the blog's name, according to wordpress

                      if (!isset($_SERVER['HTTP_REFERER'])) {
                        #politely blames the user for all the problems they caused
                            echo "tried going to "; #starts assembling an output paragraph
                    	$casemessage = "<strong>Don't panic!</strong>";
                      } elseif (isset($_SERVER['HTTP_REFERER'])) {
                        #this will help the user find what they want, and email me of a bad link
                    	echo "clicked a link to"; #now the message says You clicked a link to...
                            #setup a message to be sent to me
                    	$failuremess = "A user tried to go to $website"
                            .$_SERVER['REQUEST_URI']." and received a 404 (page not found) error. ";
                    	$failuremess .= "It wasn't their fault, so try fixing it.
                            They came from ".$_SERVER['HTTP_REFERER'];

                    	//mail($adminemail, "Bad Link To ".$_SERVER['REQUEST_URI'], $failuremess, "From: $websitename <noreply@$website>"); #email you about problem

                    	$casemessage = "An administrator has been emailed
                            about this problem, too.";#set a friendly message
                      }
                      echo " <strong>".$website.$_SERVER['REQUEST_URI']."</strong>"; ?>
                    and it doesn't exist. <?php echo $casemessage; ?>  Let us help you find what you came here for:
                      <?php //include(TEMPLATEPATH . "/searchform.php"); ?>
                    </p>
            		<?php
            			$s = preg_replace("/(.*)-(html|htm|php|asp|aspx)$/","$1",$wp_query->query_vars['name']);
            			$posts = query_posts( 'post_type=any&name='.$s);
            			$s = str_replace("-"," ",$s);
            			if (count($posts) == 0) {
            				$posts = query_posts( 'post_type=any&s='.$s);
            			}
            			if (count($posts) > 0) {
            				echo "<ol><li>";
            				echo "<p>Were you looking for <strong>one of the following</strong> posts or pages?</p>";
            				echo "<ul>";
            				foreach ($posts as $post) {
            					echo '<li><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></li>';
            				}
            				echo "</ul>";
            				echo "<p>If not, don't worry, we've got a few more tips for you to find it:</p></li>";
            			} else {
            				echo "<ol>";
            			}
            		?>
            			<li>
            				<?php get_search_form(); ?>
            			</li>
            			<li>
            				<strong>If you typed in a URL...</strong> make sure the spelling, capitalization, and punctuation are correct... then try reloading the page.
            			</li>
            			<li>
            				<strong>Look</strong> for it in the <a href="<?php bloginfo( 'siteurl' );?>/sitemap/" title="Sitemap">sitemap</a>.
            			</li>
            			<li>
            				<strong>Start over again</strong> at our <a href="<?php bloginfo( 'siteurl' );?>" title="Let's start over at the homepage!">homepage</a>.
            			</li>
            			<li>
            				<a href="<?php bloginfo( 'siteurl' );?>/contact/" title="Contact <?php bloginfo('name'); ?>"><strong>Contact us!</strong></a> Let us know what went wrong. We'd like to fix it for you.
            			</li>
            		</ol>


                	<script type="text/javascript">
                		// focus on search field after it has loaded
                		document.getElementById( 's' ) && document.getElementById( 's' ).focus();
                	</script>


                </div><!-- END #content -->

            </div><!-- END .span8 #content-area -->
        </div><!-- END .row  -->


<?php get_footer(); ?>