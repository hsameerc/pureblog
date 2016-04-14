<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to pureblog_comment() which is
 * located in the functions.php file.
 * 
 * @package WordPress
 * @subpackage Pureblog
 * @since Pureblog 1.0
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required())
    return;
?>

<div class="comments">
    <?php // You can start editing here -- including this comment!  ?>
    <?php if (have_comments()) : ?>
        <h5 class="comments-title">
            <?php
            printf(_n('One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'pureblog'), number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>');
            ?>
        </h5>
        <ol class="comment-list">
    <?php wp_list_comments(array('callback' => 'pureblog_comment', 'style' => 'ol')); ?>
        </ol><!-- .commentlist -->
    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through  ?>
            <nav id="comment-nav-below" class="navigation" role="navigation">
                <h1 class="assistive-text section-heading"><?php _e('Comment navigation', 'pureblog'); ?></h1>
                <div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'pureblog')); ?></div>
                <div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'pureblog')); ?></div>
            </nav>
    <?php endif; // check for comment navigation  ?>
        <?php
        /* If there are no comments and comments are closed, let's leave a note.
         * But we only want the note on posts and pages that had comments in the first place.
         */
        if (!comments_open() && get_comments_number()) :
            ?>
            <p class="nocomments"><?php _e('Comments are closed.', 'pureblog'); ?></p>
        <?php endif; ?>
    <?php endif; // have_comments()  ?>
    <?php comment_form(); ?>
</div><!-- #comments .comments-area -->