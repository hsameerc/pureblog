<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer contents.
 *
 * @package WordPress
 * @subpackage Kumaley
 * @since Kumaley 1.0
 */
?>		 
<!-- footer -->
<div class="footer">
    <div class="container">
        <div class="row">   
            <div class="span6">
                <?php kumaley_copyright(); ?>
                <?php if (kumaley_get_option('kumaley_address') != '') { ?><?php echo kumaley_get_option('kumaley_address'); ?><?php } else { ?><?php
                    _e('Nirmal Lama Marg, Kathmandu, Nepal', 'kumaley');
                }
                ?>
            </div>
            <div class="span6">
                <div class="footer-right">
                    <span class="footer-company"><?php if (kumaley_get_option('kumaley_address') != '') { ?><?php echo kumaley_get_option('kumaley_email'); ?><?php } else { ?><?php
                            echo 'info@lamputer.com';
                        }
                        ?></span>      <?php if (kumaley_get_option('kumaley_phone') != '') { ?><?php echo kumaley_get_option('kumaley_phone'); ?><?php } else { ?><?php
                        _e('+(977) 9851070747', 'kumaley');
                    }
                    ?> 
                    <div class="footer-social">
                        <?php if (kumaley_get_option('kumaley_facebook') != '') { ?><a href="<?php echo kumaley_get_option('kumaley_facebook'); ?>"><i class="fa fa-facebook-official"></i></a><?php } ?>
                        <?php if (kumaley_get_option('kumaley_twitter') != '') { ?><a href="<?php echo kumaley_get_option('kumaley_twitter'); ?>"><i class="fa fa-twitter"></i></a></a><?php } ?>
                        <?php if (kumaley_get_option('kumaley_rss') != '') { ?><a href="<?php echo kumaley_get_option('kumaley_rss'); ?>"><i class="fa fa-rss"></i></a></a><?php } ?>
                        <?php if (kumaley_get_option('kumaley_linkedin') != '') { ?><a href="<?php echo kumaley_get_option('kumaley_linkedin'); ?>"><i class="fa fa-linkedin"></i></a></a><?php } ?>
                        <?php if (kumaley_get_option('kumaley_youtube') != '') { ?><a href="<?php echo kumaley_get_option('kumaley_youtube'); ?>"><i class="fa fa-youtube"></i></a></a><?php } ?> 
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>  
<?php wp_footer(); ?>
<?php if (kumaley_get_option('kumaley_analytics') != '') { ?>
    <script>
    <?php echo kumaley_get_option('kumaley_analytics'); ?>
    </script>
<?php } ?>
</body>
</html>