<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer contents.
 *
 * @package WordPress
 * @subpackage Pureblog
 * @since Pureblog 1.0
 */
?>		 
<!-- footer -->
<div class="footer">
    <div class="container">
        <div class="row">   
            <div class="span6">
                <?php pureblog_copyright(); ?>
                <?php if (pureblog_get_option('pureblog_address') != '') { ?><?php echo pureblog_get_option('pureblog_address'); ?><?php } else { ?><?php
                    _e('Nirmal Lama Marg, Kathmandu, Nepal', 'pureblog');
                }
                ?>
            </div>
            <div class="span6">
                <div class="footer-right">
                    <span class="footer-company"><?php if (pureblog_get_option('pureblog_address') != '') { ?><?php echo pureblog_get_option('pureblog_email'); ?><?php } else { ?><?php
                            echo 'info@lamputer.com';
                        }
                        ?></span>      <?php if (pureblog_get_option('pureblog_phone') != '') { ?><?php echo pureblog_get_option('pureblog_phone'); ?><?php } else { ?><?php
                        _e('+(977) 9851070747', 'pureblog');
                    }
                    ?> 
                    <div class="footer-social">
                        <?php if (pureblog_get_option('pureblog_facebook') != '') { ?><a href="<?php echo pureblog_get_option('pureblog_facebook'); ?>"><i class="fa fa-facebook-official"></i></a><?php } ?>
                        <?php if (pureblog_get_option('pureblog_twitter') != '') { ?><a href="<?php echo pureblog_get_option('pureblog_twitter'); ?>"><i class="fa fa-twitter"></i></a></a><?php } ?>
                        <?php if (pureblog_get_option('pureblog_rss') != '') { ?><a href="<?php echo pureblog_get_option('pureblog_rss'); ?>"><i class="fa fa-rss"></i></a></a><?php } ?>
                        <?php if (pureblog_get_option('pureblog_linkedin') != '') { ?><a href="<?php echo pureblog_get_option('pureblog_linkedin'); ?>"><i class="fa fa-linkedin"></i></a></a><?php } ?>
                        <?php if (pureblog_get_option('pureblog_youtube') != '') { ?><a href="<?php echo pureblog_get_option('pureblog_youtube'); ?>"><i class="fa fa-youtube"></i></a></a><?php } ?> 
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>  
<?php wp_footer(); ?>
<?php if (pureblog_get_option('pureblog_analytics') != '') { ?>
    <script>
    <?php echo pureblog_get_option('pureblog_analytics'); ?>
    </script>
<?php } ?>
</body>
</html>