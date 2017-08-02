<?php
$mts_options = get_option(MTS_THEME_NAME);
/*-----------------------------------------------------------------------------------*/
/*	AJAX Contact Form - mts_contact_form()
/*-----------------------------------------------------------------------------------*/
class mtscontact {
    public $errors = array();
    public $userinput = array('name' => '', 'email' => '', 'message' => '');
    public $success = false;
    
    public function __construct() {
        add_action('wp_ajax_mtscontact', array($this, 'ajax_mtscontact'));
        add_action('wp_ajax_nopriv_mtscontact', array($this, 'ajax_mtscontact'));
        add_action('init', array($this, 'init'));
        add_action('wp_enqueue_scripts', array($this, 'register_scripts'));
    }
    public function ajax_mtscontact() {
        if ($this->validate()) {
            if ($this->send_mail()) {
                echo json_encode('success');
                wp_create_nonce( "mtscontact" ); // purge used nonce
            } else {
                // wp_mail() unable to send
                $this->errors['sendmail'] = __('An error occurred. Please contact site administrator.', MTS_THEME_TEXTDOMAIN );
                echo json_encode($this->errors);
            }
        } else {
            echo json_encode($this->errors);
        }
        die();
    }
    public function init() {
        // No-js fallback
        if ( !defined( 'DOING_AJAX' ) || !DOING_AJAX ) {
            if (!empty($_POST['action']) && $_POST['action'] == 'mtscontact') {
                if ($this->validate()) {
                    if (!$this->send_mail()) {
                        $this->errors['sendmail'] = __('An error occurred. Please contact site administrator.', MTS_THEME_TEXTDOMAIN );
                    } else {
                        $this->success = true;
                    }
                }
            }
        }
    }
    public function register_scripts() {
        wp_register_script('mtscontact', get_template_directory_uri() . '/js/contact.js', true);
        wp_localize_script('mtscontact', 'mtscontact', array('ajaxurl' => admin_url('admin-ajax.php')));
    }
    
    private function validate() {
        // check nonce
        if (!check_ajax_referer( 'mtscontact', 'mtscontact_nonce', false )) {
            $this->errors['nonce'] = __('Please try again.', MTS_THEME_TEXTDOMAIN );
        }
        
        // check honeypot // must be empty
        if (!empty($_POST['mtscontact_captcha'])) {
            $this->errors['captcha'] = __('Please try again.', MTS_THEME_TEXTDOMAIN );
        }
        
        // name field
        $name = trim(str_replace(array("\n", "\r", "<", ">"), '', strip_tags($_POST['mtscontact_name'])));
        if (empty($name)) {
            $this->errors['name'] = __('Please enter your name.', MTS_THEME_TEXTDOMAIN );
        }
        
        // email field
        $useremail = trim($_POST['mtscontact_email']);
        if (!is_email($useremail)) {
            $this->errors['email'] = __('Please enter a valid email address.', MTS_THEME_TEXTDOMAIN );
        }
        
        // message field
        $message = strip_tags($_POST['mtscontact_message']);
        if (empty($message)) {
            $this->errors['message'] = __('Please enter a message.', MTS_THEME_TEXTDOMAIN );
        }
        
        // store fields for no-js
        $this->userinput = array('name' => $name, 'email' => $useremail, 'message' => $message);
        
        return empty($this->errors);
    }
    private function send_mail() {
        $contact_page_mail = isset( $mts_options['mts_contact_email'] ) ? $mts_options['mts_contact_email'] : '';
        $email_to = ( is_email( $contact_page_mail ) && $contact_page_mail !== '' ) ? $contact_page_mail : get_option('admin_email');
        $email_subject = __('Contact Form Message from', MTS_THEME_TEXTDOMAIN ).' '.get_bloginfo('name');
        $email_message = __('Name:', MTS_THEME_TEXTDOMAIN ).' '.$this->userinput['name']."\n\n".
                         __('Email:', MTS_THEME_TEXTDOMAIN ).' '.$this->userinput['email']."\n\n".
                         __('Message:', MTS_THEME_TEXTDOMAIN ).' '.$this->userinput['message'];
        return wp_mail($email_to, $email_subject, $email_message);
    }
    public function get_form() {
        wp_enqueue_script('mtscontact');
        
        $return = '';
        if (!$this->success) {
            $return .= '<form method="post" action="" id="mtscontact_form" class="contact-form">
            <input type="text" name="mtscontact_captcha" value="" style="display: none;" />
            <input type="hidden" name="mtscontact_nonce" value="'.wp_create_nonce( "mtscontact" ).'" />
            <input type="hidden" name="action" value="mtscontact" />
            
            <label for="mtscontact_name">'.__('Name', MTS_THEME_TEXTDOMAIN ).'</label>
            <input type="text" name="mtscontact_name" value="'.esc_attr($this->userinput['name']).'" id="mtscontact_name" />
            
            <label for="mtscontact_email">'.__('Email', MTS_THEME_TEXTDOMAIN ).'</label>
            <input type="text" name="mtscontact_email" value="'.esc_attr($this->userinput['email']).'" id="mtscontact_email" />
            
            <label for="mtscontact_message">'.__('Message', MTS_THEME_TEXTDOMAIN ).'</label>
            <textarea name="mtscontact_message" id="mtscontact_message">'.esc_textarea($this->userinput['message']).'</textarea>
            
            <input type="submit" value="'.__('Send', MTS_THEME_TEXTDOMAIN ).'" id="mtscontact_submit" />
        </form>';
        }
        $return .= '<div id="mtscontact_success"'.($this->success ? '' : ' style="display: none;"').'>'.__('Your message has been sent.', MTS_THEME_TEXTDOMAIN ).'</div>';
        return $return;
    }
    public function get_errors() {
        $html = '';
        foreach ($this->errors as $error) {
            $html .= '<div class="mtscontact_error">'.$error.'</div>';
        }
        return $html;
    }
}
$mtscontact = new mtscontact;

// Simple wrappers, to be used in template files
function mts_contact_form() {
    global $mtscontact;
    echo $mtscontact->get_errors(); // if there are any
    echo $mtscontact->get_form();
}
function mts_get_contact_form() { // this could be used for shortcode support
    global $mtscontact;
    return $mtscontact->get_errors() . $mtscontact->get_form();
}

?>