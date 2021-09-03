<?php


$send = new Form_Send_Mail();


$postArray = filter_input_array(INPUT_POST, FILTER_DEFAULT); 


if(isset($postArray) ? $postArray : ""){
       
    $postArray = filter_input_array(INPUT_POST, FILTER_DEFAULT); 

    $errors = array();
    $hasError = false;   
    
            if (in_array("", $postArray)) {
                
                $errors[] = esc_html__("Please fill in all fields", "jg-mail");
                $hasError = true;
    
            }
            
            if(empty($postArray['message_name'])){ 
            
                $errors[] = esc_html__("Please enter the name", "jg-mail");
                $hasError = true;

            
            }
            
            if (empty($postArray['message_email']) || !is_email($postArray['message_email'])) {
    
                $errors[] = esc_html__("Please enter a valid email address", "jg-mail");
                $hasError = true;
    
            } 

            if(empty($postArray['message_subject'])){ 
            
                $errors[] = esc_html__("Please inform the subject", "jg-mail");
                $hasError = true;
            
            }

            if(empty($postArray['message_text'])){ 
            
                $errors[] = esc_html__("Please enter the message", "jg-mail");
                $hasError = true;
            
            }

            if($hasError === false && isset($postArray['submit'])){

                $name = sanitize_text_field(strip_tags($postArray['message_name']));
                $email = sanitize_email(strip_tags(trim(strtolower($postArray['message_email']))));
                $subject = sanitize_text_field(strip_tags($postArray['message_subject']));
                $message = sanitize_text_field(strip_tags($postArray['message_text']));
                
                $to = get_option('admin_email');
                $namefrom = get_bloginfo('name');
               

                $enviar = $send->sendMail($subject, $message, $email, $name, $to, $namefrom );


                    if($enviar === true){

                        $success_sent = esc_html__("Message sent successfully", "jg-mail");
                        echo "<div class='responsejgmail'><div><p>" .$success_sent . "</p></div></div>";

                    }else{

                        $error_sent = esc_html__("Error to sent a Message", "jg-mail");
                        echo "<div class='responsejgmail responseerrorjgmail'><div><p>" . $error_sent . "</p></div></div>";

                    }
     

            }

}    

?>


<section id="respond" class="container">


    <div class="row d-flex flex-column justify-content-center align-items-center">

        <h2 class="titleform mb-5" aria-labelledby="<?php echo esc_attr_e('Title Form', 'jg-mail'); ?>"><?php echo esc_html_e("Contact form", "jg-mail") ; ?></h2>

        <span class="instructs mb-5"></span>

        <?php 

            if(isset($errors) && $errors != "" ? $errors : ""){

                foreach($errors as $error){
            

                echo "<span class='errors'>" . $error . "</span><br>";
            
                }

            }
        
        ?>
    

        <form action="" method="post" class="col-12 pl-0 pr-0 formjgmail" aria-describedby="<?php echo esc_attr_e('Contact Form', 'jg-mail'); ?>">

            <div class="form-group col-12 pl-0 pr-0 groupmailinput">
                <label for="message_name"><?php echo esc_html_e('Name', 'jg-mail') ;?> <span>*</span></label>
                <input class="form-control pl-0 pr-0 mailinput" id="message_name" type="text" name="message_name" value="<?php echo isset($_POST['message_name']) ? esc_attr($_POST['message_name']) : ''; ?>" aria-describedby="<?php echo esc_attr_e('Informe the Name', 'jg-mail'); ?>" placeholder="<?php echo esc_attr_e('Name', 'jg-mail'); ?>" required >
            </div>

            <div class="form-group col-12 pl-0 pr-0 groupmailinput">
                <label for="message_email"><?php echo esc_html_e('Email', 'jg-mail') ;?> <span>*</span></label>
                <input id="message_email" class="form-control pl-0 pr-0 mailinput" type="email" name="message_email" value="<?php echo isset($_POST['message_email']) ? esc_attr($_POST['message_email']) : ''; ?>" aria-describedby="<?php echo esc_attr_e('Informe the Email', 'jg-mail'); ?>" placeholder="<?php echo esc_attr_e('Email', 'jg-mail'); ?>" required >
            </div>

            <div class="form-group col-12 pl-0 pr-0 groupmailinput">
                <label for="message_subject"><?php echo esc_html_e('Subject', 'jg-mail') ;?> <span>*</span></label>
                <input id="message_subject" class="form-control pl-0 pr-0 mailinput" type="text" name="message_subject" value="<?php echo isset($_POST['message_subject']) ? esc_attr($_POST['message_subject']) : ''; ?>" aria-describedby="<?php echo esc_attr_e('Informe the Subject', 'jg-mail'); ?>" placeholder="<?php echo esc_attr_e('Subject', 'jg-mail'); ?>" required >
            </div>

            <div class="form-group col-12 pl-0 pr-0 groupmailinput">
                <label for="message_text"><?php echo esc_html_e('Message', 'jg-mail') ;?>  <span>*</span></label>
                <textarea id="message_text" class="form-control pl-0 pr-0 mailinput" type="text" name="message_text" rows="6" aria-describedby="<?php echo esc_attr_e('Informe the Message', 'jg-mail'); ?>" placeholder="<?php echo esc_attr_e('Message', 'jg-mail'); ?>" required ><?php echo isset($_POST['message_text']) ? esc_attr($_POST['message_text']) : ''; ?></textarea>
            </div>

            <div class="form-group col-12 pl-0 pr-0">
                <label for="checkbox">
                <input type="checkbox" id="checkboxjgmail" class="form-control col-3 checkbox" aria-describedby="<?php echo esc_attr_e('Consent to the RGPD', 'jg-mail'); ?>">
                    <span class="col-9 consent">
                        <?php echo esc_html_e('I have read and accept the', 'jg-mail') ; ?>

                         <a href="<?php echo esc_attr( esc_url( get_privacy_policy_url() ) ); ?>" target="_self"><?php echo esc_html_e('Privacy Policy', 'jg-mail');?></a>

                    </span>
                </label>
            </div>

            <br>
            
            <button class="col-12 submitjgmail" id="submitjgmail" type="submit" name="submit" value="<?php echo esc_html_e('Send', 'jg-mail'); ?>" aria-label="<?php echo esc_attr_e('Submit', 'jg-mail'); ?>" disabled>
                <?php echo esc_html_e('Send', 'jg-mail') ;?>
            </button>
            <input type="hidden" name="submit" value="send" />

        </form>


    </div>

</section>