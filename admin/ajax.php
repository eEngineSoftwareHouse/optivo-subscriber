<?php
    add_action( 'wp_ajax_optivo_action', 'optivo_action' );
    add_action( 'wp_ajax_nopriv_optivo_action', 'optivo_action' );

    function optivo_action() {
        $email = $_POST['email'];
        if(!$email){
            return false;
        } else {
            $options = get_option( 'op_settings' );
            $authId = $options['op_text_field_0'];
            $doiId = $options['op_text_field_00'];

            $pageURL = 'http';
            if( isset($_SERVER["HTTPS"]) ) {
                if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
            }

            $url = $pageURL.'://api.broadmail.de/http/form/'.$authId.'/subscribe?bmRecipientId='.$email.'&bmOverwrite=true&bmOptInId='.$doiId;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_REFERER, "/");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $output = curl_exec($ch);
            curl_close($ch);

            switch ($output) {
                case 'ok':
                    $response = $options['op_text_field_5'];
                break;
                case 'syntax_error':
                    $response = $options['op_text_field_4'];
                break;
                case 'blacklisted':
                    $response = $options['op_text_field_7'];
                break;
                default:
                    $response = $options['op_text_field_6'];
            }

            echo $response;
        }
        die();
    }
?>