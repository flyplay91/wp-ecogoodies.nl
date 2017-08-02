<?php 

add_action( 'admin_enqueue_scripts', 'mts_ecommerce_pointer_header' );
function mts_ecommerce_pointer_header() {
    $enqueue = false;

    $dismissed = explode( ',', (string) get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );

    if ( ! in_array( 'mts_ecommerce_pointer', $dismissed ) ) {
        $enqueue = true;
        add_action( 'admin_print_footer_scripts', 'mts_ecommerce_pointer_footer' );
    }

    if ( $enqueue ) {
        // Enqueue pointers
        wp_enqueue_script( 'wp-pointer' );
        wp_enqueue_style( 'wp-pointer' );
    }
}

function mts_ecommerce_pointer_footer() {
    $pointer_content = '<h3>'.__('Awesomeness!', MTS_THEME_TEXTDOMAIN ).'</h3>';
    $pointer_content .= '<p>'.__('You have just Installed eCommerce WordPress Theme by MyThemeShop.', MTS_THEME_TEXTDOMAIN ).'</p>';
	$pointer_content .= '<p>'.__('You can Trigger The Awesomeness using Amazing Option Panel in <b>Theme Options</b>.', MTS_THEME_TEXTDOMAIN ).'</p>';
    $pointer_content .= '<p>'.__('If you face any problem, head over to', MTS_THEME_TEXTDOMAIN ).' <a href="http://mythemeshop.com/support">'.__('Knowledge Base', MTS_THEME_TEXTDOMAIN ).'</a></p>';
?>
<script type="text/javascript">// <![CDATA[
jQuery(document).ready(function($) {
    $('#menu-appearance').pointer({
        content: '<?php echo $pointer_content; ?>',
        position: {
            edge: 'left',
            align: 'center'
        },
        close: function() {
            $.post( ajaxurl, {
                pointer: 'mts_ecommerce_pointer',
                action: 'dismiss-wp-pointer'
            });
        }
    }).pointer('open');
});
// ]]></script>
<?php
}

?>