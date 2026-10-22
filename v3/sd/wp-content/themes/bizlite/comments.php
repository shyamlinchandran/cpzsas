     <?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage bizlite
 * @since bizlite 
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */          
             
                         
if ( post_password_required() ) {
    return;
}
?>
                        
    <div class="row">
        <div class="col-sm-12">
            <div class="comment-box">
                <?php if ( have_comments() ) : ?>
                      <div class="comment_title h3"> 
                        <?php
                            $bizlite_comments_number = get_comments_number();
                            if ( 1 === $bizlite_comments_number ) {
                              /* translators: %s: post title */
                              printf( esc_html__( 'One thought on &ldquo;%s&rdquo;','bizlite' ), get_the_title() );
                             } else{
                                printf(
                                /* translators: 1: number of comments, 2: post title */
                                _nx('%1$s Comment found on this post','%1$s comments on this post</h3>',    $bizlite_comments_number, 'comments title', 'bizlite' ),
                                esc_html (number_format_i18n( $bizlite_comments_number ) ),
                                get_the_title()
                                );
                            }
                        ?>
                      </div>
                      <?php the_comments_navigation(); ?>

                      <ul>
                          <?php
                                wp_list_comments( array(
                                    'style'       => 'ul',
                                    'short_ping'  => true,
                                    'avatar_size' => 42,
                                    'callback' => 'bizlite_comments',
                              ) );
                          ?>
                      </ul><!-- .comment-list -->

                      <?php the_comments_navigation(); ?>

                <?php endif; // Check for have_comments(). ?>
            </div>
            <?php
            // If comments are closed and there are comments, let's leave a little note, shall we?
            if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'bizlite' ) ) :
            ?>
              <p class="no-comments"><?php esc_html__( 'Comments are closed.', 'bizlite' ); ?></p> 
            <?php endif; ?>
    
            <?php 
            $bizlite_req      = get_option( 'require_name_email' );
            $bizlite_aria_req = ( $bizlite_req ? " aria-required='true'" : '' );

            $bizlite_comments_args = array
           (
            'submit_button' => '<div class="form-group">'.
              '<input  name="%1$s" type="submit" id="%2$s" class="btn-submit" value="Leave Comment" />'.
            '</div>',

            'title_reply'  =>  __( '<div class="h3">Leave a comment</div>', 'bizlite'  ), 
            'comment_notes_after' => '',  
                
            'comment_field' =>  
                '<textarea class="form-control" id="comment" name="comment" placeholder="' . esc_attr( 'Comment here', 'bizlite' ) . '" rows="12" aria-required="true" '. $bizlite_aria_req . '>' .
                '</textarea>',

            'fields' => apply_filters( 'comment_form_default_fields', array (
                'author' =>                
                    '<input id="author" class="form-control inn" name="author" placeholder="' . esc_attr( 'Your Name *', 'bizlite' ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                    '" size="30"' . $bizlite_aria_req . ' />',

            'email' =>
                    '<input id="email" class="form-control" name="email" placeholder="' . esc_attr( 'Your Email *', 'bizlite' ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                    '" size="30"' . $bizlite_aria_req . ' />',
            
               ) ),
            );
          ?>
    
        </div>
    </div>
    <div class="comment_form">
        <?php
          comment_form($bizlite_comments_args);
        ?>
    </div>