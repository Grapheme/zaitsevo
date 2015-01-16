//validation
$(function(){
    
    // Validation
    $('#feedback-form').validate({
        rules: {
            phone: 'required',
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            phone: 'Обязательное поле',
            email: {
                required: 'Обязательное поле',
                email: 'Неверный формат'
            }
        },
        submitHandler: function(form) {
            //console.log(form);
            sendForm(form);
            return false;
        }
    });


    $('.order-call-form').validate({
        rules: {
            phone: 'required',
            name: 'required'
        },
        messages: {
            phone: 'Обязательное поле',
            name: 'Обязательное поле'
        },
        submitHandler: function(form) {
            //console.log(form);
            sendForm(form);
            return false;
        }
    });

    $('.leave-apply-form').validate({
        errorPlacement: function(error,element) {
            return true;
        },
        rules: {
            projname: 'required',
            address: 'required',
            email: {
                required: true,
                email: true
            },
            phone: 'required',
            rname: 'required',
            remail: {
                required: true,
                email: true
            },
            rphone: 'required'
        },
        messages: {
            projname: 'Обязательное поле',
            address: 'Обязательное поле',
            email: {
                required: 'Обязательное поле',
                email: 'Неверный формат'
            },
            phone: 'Обязательное поле',
            rname: 'Обязательное поле',
            remail: {
                required: 'Обязательное поле',
                email: 'Неверный формат'
            },
            rphone: 'Обязательное поле'
        },
        submitHandler: function(form) {
            //console.log(form);
            sendForm(form);
            return false;
        }
    });
});



function sendForm(form) {

    //console.log(form);

    var options = { target: null, type: $(form).attr('method'), dataType: 'json' };

    options.beforeSubmit = function(formData, jqForm, options){

        $(form).find('button').addClass('loading').attr('disabled', 'disabled');

        var i = 0;
        setInterval(function() {
            i = ++i % 4;
            $(form).find('button').html("Отправка"+Array(i+1).join("."));
        }, 300);

        $(form).find('.error-msg').text('');
    }

    options.success = function(response, status, xhr, jqForm){

        //console.log(response);
        if (response.status) {

            $(form).html('<div style="font-size: 24px; text-align: center;">Ваше сообщение отправлено</div>');

            /*
             $(form).slideUp();
             //*/

            /*
             $(form).find('button').addClass('success').text('Отправлено');
             //*/

            /*
             $(form).find('.popup-body').slideUp(function(){
             setTimeout(function(){ $('.popup .js-popup-close').trigger('click'); }, 3000);
             });
             //*/
        } else {

            console.log(response);
        }
    }

    options.error = function(xhr, textStatus, errorThrown){
        console.log(xhr);
        $(form).find('.error-msg').text('Ошибка при отправке, попробуйте позднее');
    }

    options.complete = function(data, textStatus, jqXHR){
        $(form).find('button').removeClass('loading').removeAttr('disabled');
    }

    $(form).ajaxSubmit(options);
}