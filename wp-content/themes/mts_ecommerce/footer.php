

<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<?php
// default = 3
$first_footer_num  = empty($mts_options['mts_first_footer_num']) ? 3 : $mts_options['mts_first_footer_num'];
?>


<div style="clear: both;"></div>
</div><!--#page-->


    <?php if ( is_single() ) mts_related_posts(); ?>
    <?php mts_payment_guarantee(); ?>
    <?php 
        $title = get_the_title();
        if ($title != "Blog") {
            include('home/section-posts.php');        
        } else {

        }
    ?>
    
    
<div class="custom-widget">
    <?php
        $widgetNL = new WYSIJA_NL_Widget(true);
        echo $widgetNL->widget(array('form' => 4, 'form_type' => 'php'));
    ?>

    <ul class="top-social list-inline">
        <li><a class="tooltip-on" title="Facebook" href="https://www.facebook.com"><img src=""></a></li>
        <li><a class="tooltip-on" title="Twitter" href="https://twitter.com"><img src=""></a></li>
        <li><a class="tooltip-on" title="Linkedin" href="https://www.linkedin.com"><img src=""></a></li>
        <li><a class="tooltip-on" title="Pinterest" href="https://www.pinterest.com"><img src=""></a></li>
    </ul>
</div>

    <footer id="site-footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
        <div class="container">
            <?php if ($mts_options['mts_top_footer']) : ?>
            <div class="footer-icons clearfix">
                <?php mts_credit_cards(); ?>
                <?php mts_footer_icons(); ?>
            </div><!--.footer-icons-->
            <?php endif; ?>
            <?php if ($mts_options['mts_first_footer']) : ?>
                <div class="footer-widgets first-footer-widgets widgets-num-<?php echo $first_footer_num; ?>">
                <?php
                for ( $i = 1; $i <= $first_footer_num; $i++ ) {
                    $sidebar = ( $i == 1 ) ? 'footer-first' : 'footer-first-'.$i;
                    $class = ( $i == $first_footer_num ) ? 'f-widget last f-widget-'.$i : 'f-widget f-widget-'.$i;
                    ?>
                    <div class="<?php echo $class;?>">
                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( $sidebar ) ) : ?><?php endif; ?>
                    </div>
                    <?php
                }
                ?>
                </div><!--.first-footer-widgets-->
            <?php endif; ?>

            <div class="copyrights">
                <?php mts_copyrights_credit(); ?>
            </div> <!--.copyrights-->
        </div><!--.container-->
    </footer><!--#site-footer-->
</div><!--.main-container-->
<?php mts_footer(); ?>
<?php wp_footer(); ?>
</body>
</html>