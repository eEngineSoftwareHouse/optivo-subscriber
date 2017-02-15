(function ($) {
    var App = {
        app: this,
        init: function () {
            this.newsletterSupport();
        },
        checkEmail: function (e) {
            var a=/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;return 0==a.test(e)||e.length<1?!1:!0
        },
        newsletterSupport: function () {
            $('#optivo_subs_form button').on('click', function(){
                var email = $(this).parent().find('input[name=optivo_subs_email]').val(),
                    rules = $(this).parent().find('input[name=accept_rules]'),
                    weText = $(this).closest('form').data('wrong-email'),
                    rText = $(rules).data('rules-error'),
                    cEmail = App.checkEmail(email);

                if(rules && rules.prop('checked') == false){
                    $('#optivo_message').text(rText);
                    return;
                }

                if(!cEmail){
                    $('#optivo_message').text(weText);
                } else {
                    $(this).parent().remove('.message');
                    var ajaxurl = '/wp-admin/admin-ajax.php';

                    var postData = {};
                    postData['action'] = 'optivo_action';
                    postData['email'] = email;

                    jQuery.post(ajaxurl, postData, function(response) {
                       if(response) {
                           $('#optivo_message').text(response);
                       }
                    });
                }
            });
        }
    };

    $( document ).ready(function(){
       App.init();
    });

})(jQuery);

