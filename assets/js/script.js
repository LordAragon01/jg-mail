jQuery(function(){


    var instructs = jQuery('.instructs');

    var input = jQuery('.mailinput');

    jQuery(input).focus(function(){

        jQuery(this).addClass('activefocus');


    }).focusin(function(){

        instructs.text('Please inform the ' + jQuery(this).attr('placeholder'));

    }).focusout(function(){

        if(!jQuery(this).val()){

            instructs.text('Before sending a Message, read and accept the Privacy Policy');

        }else{

            instructs.empty();
        }

    }).change(function(){

        instructs.text(jQuery(this).val());

    }).fadeIn(2000);

    //Verifiy if the user checked 

    jQuery('#checkboxjgmail').on('click', function(){

        jQuery('#submitjgmail').prop('disabled', !jQuery('#checkboxjgmail:checked').length);

    });

    jQuery('.formjgmail').on('submit', function(){

        //e.preventDefault();

        var form = jQuery(this);

        form.find('button').text('Sending the Message').attr('disabled', 'true');

    });

    var success = jQuery('.responsejgmail').find('p');

    jQuery(success).remove(function(){

        //jQuery(this).remove();

    }).fadeOut(4000);


});