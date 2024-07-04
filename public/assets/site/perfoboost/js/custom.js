$(document).ready(function(){

    $('.contact-form').each(function () {
        
        var formInstance = $(this);
        formInstance.submit(function () {

            var action = $(this).attr('action');

            $('button[type="submit"]', $(this)).attr('disabled', 'disabled');

            
            /*
            var input = document.querySelector('#phoneContact');
            var iti = window.intlTelInputGlobals.getInstance(input);

            var countryData = iti.getSelectedCountryData();

            $('#indicatif').val('+'+countryData.dialCode);
            */

            var params = new FormData(document.getElementById("contact-form"));
                //var params = formInstance.serializeArray();
                $('.form_error_span').html('');
                $.ajax({
                    url: action,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: params,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function(data){

                        $('button[type="submit"]').removeAttr('disabled');
                        if (!data.success) {
                            Object.keys(data.errors).forEach(function (key) {
                                $('.error_'+key).html(data.errors[key]);
                            });
                            $('.sign-up-form img.loader').fadeOut('slow', function () {
                                $(this).remove()
                            });
                            $('.submit-btn', formInstance).removeAttr('disabled');
                        } else {
                            
                            $('.success_form_submit:not(".success_form_telecharger")').slideDown('fast');
                            $('.contact-form').hide();
                            $('.success_form_submit:not(".success_form_telecharger") h6').text(data.title);
                            $('.success_form_submit:not(".success_form_telecharger") p').text(data.message);
                            $('body, html').scrollTop(0);
                            document.getElementById('contact-start').scrollIntoView();

                        }
                        
                    }
                });
            return false;
        });
    });

    $('.telecharger-form').each(function () {
        
        var formInstance = $(this);
        formInstance.submit(function () {
    
            var action = $(this).attr('action');
    
            $('button[type="submit"]', $(this)).attr('disabled', 'disabled');
    
            
            /*
            var input = document.querySelector('#phoneContact');
            var iti = window.intlTelInputGlobals.getInstance(input);
    
            var countryData = iti.getSelectedCountryData();
    
            $('#indicatif').val('+'+countryData.dialCode);
            */
    
            var params = new FormData(document.getElementById("telecharger-form"));
                //var params = formInstance.serializeArray();
                $('.form_error_span').html('');
                $.ajax({
                    url: action,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: params,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function(data){
    
                        $('button[type="submit"]').removeAttr('disabled');
                        if (!data.success) {
                            Object.keys(data.errors).forEach(function (key) {
                                $('.error_'+key).html(data.errors[key]);
                            });
                            $('.sign-up-form img.loader').fadeOut('slow', function () {
                                $(this).remove()
                            });
                            $('.submit-btn', formInstance).removeAttr('disabled');
                        } else {
                            
                            $('.success_form_telecharger').slideDown('fast');
                            $('.telecharger-form').hide();
                            $('.success_form_telecharger h6').text(data.title);
                            $('.success_form_telecharger p').text(data.message);
                            $('.btn-telechargement').attr("href", data.url)
                            $('body, html').scrollTop(0);
                            document.getElementById('contact-start').scrollIntoView();
    
                        }
                        
                    }
                });
            return false;
        });
    });

    $('.disable-paste').on("cut copy paste",function(e) {
        e.preventDefault();
     });

    if($('.trigger-rfq-form').length > 0){
        $(".modal-popup-rfq").trigger("click");
    }

    $('select.rfq-categorie').change(function (e) {

        $("select.rfq-sub-categorie").val('');
        $("select.rfq-sub-categorie option").hide();
        $("select.rfq-sub-categorie option[data-parent="+$(this).val()+"]").show();
         
         $('.selectpicker').selectpicker('refresh');
     });
    
    function setCookie(name,value,days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "")  + expires + "; path=/";
     }

     $('.product-send-msg-form').each(function () {
         var formInstance = $(this);
         formInstance.submit(function () {
 
             var action = $(this).attr('action');
             
             $('button[type="submit"]', $(this)).attr('disabled', 'disabled');
 
             var params = new FormData(document.getElementById("product-send-msg-form"));
                 //var params = formInstance.serializeArray();
                 $('.form_error_span').html('');
                 $.ajax({
                     url: action,
                     data: params,
                     processData: false,
                     contentType: false,
                     headers: {"Authorization": 'Bearer '+ localStorage.getItem('auth_token_default')},
                     type: 'POST',
                     success: function(data){
 
                         $('button[type="submit"]').removeAttr('disabled');
                         if (!data.success) {
                             Object.keys(data.errors).forEach(function (key) {
                                 $('.error_'+key).html(data.errors[key]);
                             });
                             $('.product-send-msg-form img.loader').fadeOut('slow', function () {
                                 $(this).remove()
                             });
                             $('.submit-btn', formInstance).removeAttr('disabled');
                         } else {
                             if(data.logged_in){
 
                                 $('.success_form_submit').slideDown('fast');
                                 $('.product-send-msg-form').hide();
                                 $('.success_form_submit h6').text(data.title);
                                 $('.success_form_submit p').text(data.message);
 
                             }else {
                                 $('.modal-sign-title').html(data.modal_title)
                                 $.magnificPopup.open({
                                     items: {
                                     src: '#register-form'
                                     },
                                     preloader: !1,
                                     blackbg: !0,
                                     type: 'inline'
                                 });
                         
                             }
                         }
                         
                     }
                 });
             return false;
         });
     });


    $('.log-out-form').each(function () {
        var formInstance = $(this);
        formInstance.submit(function () {

            var action = $(this).attr('action');
            
            $('button[type="submit"]', $(this)).attr('disabled', 'disabled');

            var params = new FormData(document.getElementById("log-out-form"));
                //var params = formInstance.serializeArray();
                $('.form_error_span').html('');
                $.ajax({
                    url: action,
                    data: params,
                    processData: false,
                    contentType: false,
                    headers: {"Authorization": 'Bearer '+ localStorage.getItem('auth_token_default')},
                    type: 'POST',
                    success: function(data){
                        window.location.href = data.redirect;
                    }
                });
            return false;
        });
    });
 
    $('.rfq-send-quote-form').each(function () {
        var formInstance = $(this);
        formInstance.submit(function () {
    
            var action = $(this).attr('action');
            
            $('button[type="submit"]', $(this)).attr('disabled', 'disabled');
    
            var params = new FormData(document.getElementById("rfq-send-quote-form"));
                //var params = formInstance.serializeArray();
                $('.form_error_span').html('');
                $.ajax({
                    url: action,
                    data: params,
                    processData: false,
                    contentType: false,
                    headers: {"Authorization": 'Bearer '+ localStorage.getItem('auth_token_default')},
                    type: 'POST',
                    success: function(data){
    
                        $('button[type="submit"]').removeAttr('disabled');
                        if (!data.success) {
                            Object.keys(data.errors).forEach(function (key) {
                                $('.error_'+key).html(data.errors[key]);
                            });
                            $('.rfq-send-quote-form img.loader').fadeOut('slow', function () {
                                $(this).remove()
                            });
                            $('.submit-btn', formInstance).removeAttr('disabled');
                        } else {
                            if(data.logged_in){
    
                                if(data.redirect) {
                                    // REDIRECTT
                                    window.location.href = data.redirect;
                                } else {

                                    $('.success_form_submit').slideDown('fast');
                                    $('.rfq-send-quote-form').hide();
                                    $('.success_form_submit h6').text(data.title);
                                    $('.success_form_submit p').text(data.message);
                                }
    
                            }else {
                                $('.step-row-content').hide();
                                $("label[data-type='importer']").trigger("click");
                                $('.modal-sign-title').html(data.modal_title)
                                $.magnificPopup.open({
                                    items: {
                                    src: '#register-form'
                                    },
                                    preloader: !1,
                                    blackbg: !0,
                                    type: 'inline'
                                });
                        
                            }
                        }
                        
                    }
                });
            return false;
        });
    });

    $('.b2b-send-msg-form').each(function () {
        var formInstance = $(this);
        formInstance.submit(function () {
    
            var action = $(this).attr('action');
            
            $('button[type="submit"]', $(this)).attr('disabled', 'disabled');
    
            var params = new FormData(document.getElementById("b2b-send-msg-form"));
                //var params = formInstance.serializeArray();
                $('.form_error_span').html('');
                $.ajax({
                    url: action,
                    data: params,
                    processData: false,
                    contentType: false,
                    headers: {"Authorization": 'Bearer '+ localStorage.getItem('auth_token_default')},
                    type: 'POST',
                    success: function(data){
    
                        $('button[type="submit"]').removeAttr('disabled');
                        if (!data.success) {
                            Object.keys(data.errors).forEach(function (key) {
                                $('.error_'+key).html(data.errors[key]);
                            });
                            $('.b2b-send-msg-form img.loader').fadeOut('slow', function () {
                                $(this).remove()
                            });
                            $('.submit-btn', formInstance).removeAttr('disabled');
                        } else {
                            if(data.logged_in){
    
                                $('.success_form_submit').slideDown('fast');
                                $('.b2b-send-msg-form').hide();
                                $('.success_form_submit h6').text(data.title);
                                $('.success_form_submit p').text(data.message);
    
                            }else {
                                $('.modal-sign-title').html(data.modal_title)
                                $.magnificPopup.open({
                                    items: {
                                    src: '#register-form'
                                    },
                                    preloader: !1,
                                    blackbg: !0,
                                    type: 'inline'
                                });
                        
                            }
                        }
                        
                    }
                });
            return false;
        });
    });
    

    $('.request-send-msg-form').each(function () {
        var formInstance = $(this);
        formInstance.submit(function () {

            var action = $(this).attr('action');

            $('button[type="submit"]', $(this)).attr('disabled', 'disabled');
            
            var params = new FormData(document.getElementById("request-send-msg-form"));
                //var params = formInstance.serializeArray();
                $('.form_error_span').html('');
                $.ajax({
                    url: action,
                    data: params,
                    processData: false,
                    contentType: false,
                    headers: {"Authorization": 'Bearer '+ localStorage.getItem('auth_token_default')},
                    type: 'POST',
                    success: function(data){
                        $('button[type="submit"]').removeAttr('disabled');
                        if (!data.success) {
                            Object.keys(data.errors).forEach(function (key) {
                                $('.error_'+key).html(data.errors[key]);
                            });
                            $('.request-send-msg-form img.loader').fadeOut('slow', function () {
                                $(this).remove()
                            });
                            $('.submit-btn', formInstance).removeAttr('disabled');
                        } else {
                            if(data.logged_in){

                                $('.success_form_submit').slideDown('fast');
                                $('.request-send-msg-form').hide();
                                $('.success_form_submit h6').text(data.title);
                                $('.success_form_submit p').text(data.message);

                            }else {
                                
                                $('.step-row-content').hide();
                                $("label[data-type='importer']").trigger("click");
                                $('.modal-sign-title').html(data.modal_title);
                                $.magnificPopup.open({
                                    items: {
                                    src: '#register-form'
                                    },
                                    preloader: !1,
                                    blackbg: !0,
                                    type: 'inline'
                                });
                        
                            }
                        }
                        
                    }
                });
            return false;
        });
    });

    

    $('.modal-entreprise-infos').click(function (e) {

        e.preventDefault();

        $this = $(this);

        $('.entreprise-name').html('');
        $('.entreprise-phone').html('');
        $('.entreprise-email').html('');
        $('.entreprise-services').html('');

        $.ajax({
            url: $this.data('action'),
            type: 'GET',
            success: function(data){
                $('.entreprise-name').html(data.name);
                $('.entreprise-phone').html(data.tel);
                $('.entreprise-services').html(data.labels);
                $('.entreprise-email').html(data.email);
                $('.entreprise-email').attr('href', 'mailto:'+data.email);
            }
        });
        
        $.magnificPopup.open({
            items: {
            src: '#entreprise-infos'
            },
            preloader: !1,
            blackbg: !0,
            type: 'inline'
        });
    });

    $('.modal-popup-annonce').click(function (e) {

        $this = $(this);
        $('#annonce-id').val($this.data('id'));
    });

    $('.annonce-send-msg-form').each(function () {
        var formInstance = $(this);
        formInstance.submit(function () {

            var action = $(this).attr('action');

            $('button[type="submit"]', $(this)).attr('disabled', 'disabled');

            /*
            var input = document.querySelector('#phoneContact');
            var iti = window.intlTelInputGlobals.getInstance(input);

            var countryData = iti.getSelectedCountryData();

            $('#indicatif').val('+'+countryData.dialCode);
            */
            
            var params = new FormData(document.getElementById("annonce-send-msg-form"));
                //var params = formInstance.serializeArray();
                $('.form_error_span').html('');
                $.ajax({
                    url: action,
                    data: params,
                    processData: false,
                    contentType: false,
                    headers: {"Authorization": 'Bearer '+ localStorage.getItem('auth_token_default')},
                    type: 'POST',
                    success: function(data){
                        $('button[type="submit"]').removeAttr('disabled');
                        if (!data.success) {
                            Object.keys(data.errors).forEach(function (key) {
                                $('.error_'+key).html(data.errors[key]);
                            });
                            $('.annonce-send-msg-form img.loader').fadeOut('slow', function () {
                                $(this).remove()
                            });
                            $('.submit-btn', formInstance).removeAttr('disabled');
                        } else {
                            
                            $('.success_form_submit').slideDown('fast');
                            $('.annonce-send-msg-form').hide();
                            $('.success_form_submit h6').text(data.title);
                            $('.success_form_submit p').text(data.message);
                        }
                        
                    }
                });
            return false;
        });
    });

    
    $('.new-b2b-meeting-form').each(function () {
        var formInstance = $(this);
        formInstance.submit(function () {

            var action = $(this).attr('action');

            $('button[type="submit"]', $(this)).attr('disabled', 'disabled');
            var params = new FormData(document.getElementById("new-b2b-meeting-form"));
                //var params = formInstance.serializeArray();
                $('.form_error_span').html('');
                $.ajax({
                    url: action,
                    data: params,
                    processData: false,
                    contentType: false,
                    headers: {"Authorization": 'Bearer '+ localStorage.getItem('auth_token_default')},
                    type: 'POST',
                    success: function(data){

                        $('button[type="submit"]').removeAttr('disabled');
                        if (!data.success) {
                            Object.keys(data.errors).forEach(function (key) {
                                $('.error_'+key).html(data.errors[key]);
                            });
                            $('.new-b2b-meeting-form img.loader').fadeOut('slow', function () {
                                $(this).remove()
                            });
                            $('.submit-btn', formInstance).removeAttr('disabled');
                        } else {
                            if(data.logged_in){

                                $('.success_form_submit').slideDown('fast');
                                $('.new-b2b-meeting-form').hide();
                                $('.success_form_submit h6').text(data.title);
                                $('.success_form_submit p').text(data.message);

                            }else {
                                $('.modal-sign-title').html(data.modal_title)
                                $.magnificPopup.open({
                                    items: {
                                    src: '#register-form'
                                    },
                                    preloader: !1,
                                    blackbg: !0,
                                    type: 'inline'
                                });
                        
                            }
                        }
                        
                    }
                });
            return false;
        });
    });

    $('.sign-up-form').each(function () {
        
        var formInstance = $(this);
        formInstance.submit(function () {

            var action = $(this).attr('action');

            $('button[type="submit"]', $(this)).attr('disabled', 'disabled');

            /*
            var input = document.querySelector('#phoneModal');
            var iti = window.intlTelInputGlobals.getInstance(input);

            var countryData = iti.getSelectedCountryData();

            $('#indicatif').val('+'+countryData.dialCode);
            */


            var params = new FormData(document.getElementById("sign-up-form"));
                //var params = formInstance.serializeArray();
                $('.form_error_span').html('');
                $.ajax({
                    url: action,
                    data: params,
                    processData: false,
                    contentType: false,
                    headers: {"Authorization": 'Bearer '+ localStorage.getItem('auth_token_default')},
                    type: 'POST',
                    success: function(data){

                        $('button[type="submit"]').removeAttr('disabled');
                        if (!data.success) {
                            Object.keys(data.errors).forEach(function (key) {
                                $('.error_'+key).html(data.errors[key]);
                            });
                            $('.sign-up-form img.loader').fadeOut('slow', function () {
                                $(this).remove()
                            });
                            $('.submit-btn', formInstance).removeAttr('disabled');
                        } else {
                            $('#register-form').magnificPopup('close');
                            formInstance[0].reset();
                            
                            if(data.rfq_product){
                                $('.success_form_submit').slideDown('fast');
                                $('.product-send-msg-form').hide();
                                $('.success_form_submit h6').text(data.title);
                                $('.success_form_submit p').text(data.message);
                            }
                            
                            
                            if(data.inscription_b2b){
                                $('.success_form_submit').slideDown('fast');
                                $('.b2b-send-msg-form').hide();
                                $('.success_form_submit h6').text(data.title);
                                $('.success_form_submit p').text(data.message);
                            }
                            
                            if(data.rfq_normal){
                                $('.success_form_submit').slideDown('fast');
                                $('.request-send-msg-form').hide();
                                $('.new-b2b-meeting-form').hide();
                                $('.success_form_submit h6').text(data.title);
                                $('.success_form_submit p').text(data.message);

                                $.magnificPopup.open(
                                    {
                                    items: {
                                    src: '#request-form'
                                    },
                                    type: "inline",
                                    fixedContentPos: !1, 
                                    fixedBgPos: !0, 
                                    overflowY: "auto", 
                                    closeBtnInside: !0, 
                                    preloader: !1, 
                                    midClick: !0, 
                                    removalDelay: 300, 
                                    blackbg: !0, 
                                    mainClass: "my-mfp-zoom-in"
                                });
                            }

                            if(data.exporter_register){
                                $('.success_register_exporter').slideDown('fast');
                                $('.success_register_exporter h6').text(data.title);
                                $('.success_register_exporter p').text(data.message);
                                
                                if(data.signin_button){
                                    $('.success_register_exporter a').show();
                                } else {
                                    $('.success_register_exporter a').hide();
                                    
                                }

                                $.magnificPopup.open(
                                    {
                                    items: {
                                    src: '#register-exporter'
                                    },
                                    type: "inline",
                                    fixedContentPos: !1, 
                                    fixedBgPos: !0, 
                                    overflowY: "auto", 
                                    closeBtnInside: !0, 
                                    preloader: !1, 
                                    midClick: !0, 
                                    removalDelay: 300, 
                                    blackbg: !0, 
                                    mainClass: "my-mfp-zoom-in"
                                });
                            }

                            if(data.rfq_quote){
                                $('.success_form_submit').slideDown('fast');
                                $('.rfq-send-quote-form').hide();
                                $('.success_form_submit h6').text(data.title);
                                $('.success_form_submit p').text(data.message);
                            }

                        }
                        
                    }
                });
            return false;
        });
    });

    $('.sign-in-form').each(function () {
        
        var formInstance = $(this);
        formInstance.submit(function () {

            var action = $(this).attr('action');

            $('button[type="submit"]', $(this)).attr('disabled', 'disabled');
            var params = new FormData(document.getElementById("sign-in-form"));
                //var params = formInstance.serializeArray();
                $('.form_error_span').html('');
                $.ajax({
                    url: action,
                    data: params,
                    processData: false,
                    contentType: false,
                    headers: {"Authorization": 'Bearer '+ localStorage.getItem('auth_token_default')},
                    type: 'POST',
                    success: function(data){

                        $('button[type="submit"]').removeAttr('disabled');
                        if (!data.success) {
                            Object.keys(data.errors).forEach(function (key) {
                                $('.error_'+key).html(data.errors[key]);
                            });
                            $('.sign-in-form img.loader').fadeOut('slow', function () {
                                $(this).remove()
                            });
                            $('.submit-btn', formInstance).removeAttr('disabled');
                        } else {
                            $('#register-form').magnificPopup('close');
                            formInstance[0].reset();

                            localStorage.setItem('auth_token_default', data.token);
                            setCookie('auth_token_default', data.token, 365);
                            
                            if(data.rfq_product){
                                $('.success_form_submit').slideDown('fast');
                                $('.product-send-msg-form').hide();
                                $('.success_form_submit h6').text(data.title);
                                $('.success_form_submit p').text(data.message);
                            }
                            
                            if(data.inscription_b2b){
                                $('.success_form_submit').slideDown('fast');
                                $('.b2b-send-msg-form').hide();
                                $('.success_form_submit h6').text(data.title);
                                $('.success_form_submit p').text(data.message);
                            }

                            if(data.rfq_quote){

                                if(data.redirect) {
                                    // REDIRECTT
                                    window.location.href = data.redirect;
                                } else {

                                    $('.success_form_submit').slideDown('fast');
                                    $('.rfq-send-quote-form').hide();
                                    $('.success_form_submit h6').text(data.title);
                                    $('.success_form_submit p').text(data.message);
                                }
                                
                            }


                            if(data.rfq_normal){
                                $('.success_form_submit').slideDown('fast');
                                $('.request-send-msg-form').hide();
                                $('.new-b2b-meeting-form').hide();
                                $('.success_form_submit h6').text(data.title);
                                $('.success_form_submit p').text(data.message);

                                $.magnificPopup.open(
                                    {
                                    items: {
                                    src: '#request-form'
                                    },
                                    type: "inline",
                                    fixedContentPos: !1, 
                                    fixedBgPos: !0, 
                                    overflowY: "auto", 
                                    closeBtnInside: !0, 
                                    preloader: !1, 
                                    midClick: !0, 
                                    removalDelay: 300, 
                                    blackbg: !0, 
                                    mainClass: "my-mfp-zoom-in"
                                });
                            }
                            if(data.redirect)
                            window.location.href = data.redirect;
                        }
                        
                    }
                });
            return false;
        });
    });


    $('.selectpicker').selectpicker();

    load_x_produit = false;
    general_x_produit = 20;
    x_produit = general_x_produit;
    $(document).ready(function() {
        $('.products-liste .row .item-rubrique:lt(' + x_produit + ')').show();
        
        $('.load-more-items').click(function (e) {
            
            $this = $(this);

            if(!load_x_produit){
                
                if($this.data('href')){
                    load_x_produit = true;
                    
                    $('.spinner-load-more').show();
                    $('.load-more-items').hide();
                    
                    $.ajax({
                        url: $this.data('href'),
                        data: [],
                        type: 'GET',
                        success: function(data){
                                    
                            $('.products-liste .row .filter-content ul').append(data);
                            
                            setTimeout(function(){
                                $('.spinner-load-more').hide();
                                $('.portfolio-wrapper').isotope( 'insert', data );
                                $('.load-more-items').show();
                                load_x_produit = false;
            
                            }, 1000);
                            
                        }
                    });
                    
                } else {
                    load_x_produit = true;

                    var checkeds = $('.rubriques_choice:checked').map(function(i, e) {return e.value}).toArray();
                    size_item_produit = 0;
                    if(checkeds.length > 0){
                        checkeds.forEach(function(item) {
                            size_item_produit += $('.item-rubrique-'+item).length;
                        });
                    } else {
                        size_item_produit = $('.item-rubrique').length;
                    }
    
                    numcompetenceShowed = $('.products-liste .item-rubrique:visible').length;
    
                    if (numcompetenceShowed != size_item_produit){
                        $('.spinner-load-more').show();
                        $('.load-more-items').hide();
                    } else {
                        load_x_produit = false;
                        $('.load-more-items').hide();
                        return false;
                    }
                    
                    setTimeout(function(){
                        
                        x_produit = (x_produit + general_x_produit <= size_item_produit) ? x_produit + general_x_produit : size_item_produit;
                        
                        triggerFilterItems(x_produit);
                        $('.spinner-load-more').hide();
                        $('.load-more-items').show();
                        load_x_produit = false;
    
                    }, 1000);
                }
               
            
            }
        });
        if($('.load-more-items').data('href')){
            $('.load-more-items').trigger('click');
        }
        $(window).scroll(function(){
                
            if($("#last-element-produits").length > 0){

                var top_of_element = $("#last-element-produits").offset().top;
                var bottom_of_element = $("#last-element-produits").offset().top + $("#last-element-produits").outerHeight();
                var bottom_of_screen = $(window).scrollTop() + $(window).innerHeight();
                var top_of_screen = $(window).scrollTop();

            
                if (false && (bottom_of_screen > top_of_element) && (top_of_screen < bottom_of_element)){
    
                    if(!load_x_produit){
                        
                        load_x_produit = true;
    
                        var checkeds = $('.rubriques_choice:checked').map(function(i, e) {return e.value}).toArray();
                        size_item_produit = 0;
                        if(checkeds.length > 0){
                            checkeds.forEach(function(item) {
                                size_item_produit += $('.item-rubrique-'+item).length;
                            });
                        } else {
                            size_item_produit = $('.item-rubrique').length;
                        }
        
                        numcompetenceShowed = $('.products-liste .item-rubrique:visible').length;
        
                        if (numcompetenceShowed != size_item_produit){
                            $('.spinner-load-more').show();
                        } else {
                            load_x_produit = false;
                            return false;
                        }
                        
                        setTimeout(function(){
                            
                            x_produit = (x_produit + general_x_produit <= size_item_produit) ? x_produit + general_x_produit : size_item_produit;
                            
                            triggerFilterItems(x_produit);
                            $('.spinner-load-more').hide();
                            load_x_produit = false;
        
                        }, 1000);
                    
                    }
                    
                }
            }
        

        });

        var lastScrollTop = 0;
        $(window).on('scroll', function() {
            st = $(this).scrollTop();
            
            if(st < lastScrollTop && st > 80) {
                $('#sub-filters').addClass('fixed-filters');
            }
            else {
                $('#sub-filters').removeClass('fixed-filters');
            }
            lastScrollTop = st;
        });
    
        if($('.count_items').length > 0 ){
        
            triggerFilterItems();
            $('.reset_items_filter').click(function (e) {
                $('.rubriques_choice').prop('checked', false); // Unchecks it
                $('.parent-category-filter').removeClass('active');
                $('.tab-content-subcategories .tab-pane').removeClass('active show');
                triggerFilterItems();
            });
            $('.rubriques_choice').change(function (e) {
                triggerFilterItems();
            });
        }
    });

    function triggerFilterItems(x_produit_param = general_x_produit) {
        x_produit = x_produit_param;
        var checkedsSelect = $('.rubriques_choice option:selected').map(function(i, e) {return e.value}).toArray();
        var checkedsRadio = $('.rubriques_choice:checked').map(function(i, e) {return e.value}).toArray();
        var checkeds = checkedsSelect.concat(checkedsRadio);
        $('.item-rubrique').hide();
        $('.item-rubrique').removeClass('eligible-show');
        let calculeCount = 0;
        let $labels = [];

        if(checkeds.length > 0){
            checkeds.forEach(function(item) {
                //$('.item-rubrique-'+item).fadeIn();
                $('.products-liste .row .item-rubrique-'+item).addClass('eligible-show');
                calculeCount += $('.item-rubrique-'+item).length;
                $labels.push($('.rubriques_choice[value="' + item + '"]').data('label'));
            });
            
            $('.products-liste .row .item-rubrique.eligible-show:lt(' + x_produit + ')').show();
        } else {
            calculeCount = $('.item-rubrique').length;
            $('.products-liste .row .item-rubrique:lt(' + x_produit + ')').show();
            //fadeIn
        }
        $(".portfolio-wrapper").isotope({ layoutMode: "masonry", itemSelector: ".grid-item", percentPosition: !0, stagger: 0, masonry: { columnWidth: ".grid-sizer" } }),
        $('.selected_rubriques').html(($labels.length > 0?'in : ':'')+$labels.join(', '));
        $('.count_items').html(calculeCount);
        $('.filters-selected').html(checkeds.length > 0?'('+checkeds.length+')':'');
    }

    $('.trigger-register-modal').click(function (e) {

        $this = $(this);
        $('.modal-sign-title').html($this.data('title')?$this.data('title'):'');

        if($this.data('country')) {
            $('.country_register').val($this.data('country'));
            $('.selectpicker').selectpicker('refresh');
        }
        if($this.data('type') == 'exporter') {
            
            $("label[data-type='exporter']").trigger("click");

            $('.step-row-content').hide();
            $('#register-form .nav-tabs').hide();
            //$('.secteurs-inscription').hide();
            
            
            $('.country_register').attr('disabled', 'disabled');
            $('.selectpicker').selectpicker('refresh');

            $('.ville_register').removeClass('d-none');
            $('.ville_register .selectpicker').attr('required', 'required');
            $('<input>').attr({
                type: 'hidden',
                id: 'exporter-id',
                name: 'exporter',
                value: 'exporter'
            }).appendTo('#sign-up-form');
        } else {
            
            //$('.secteurs-inscription').show();
            $('#exporter-id').remove();
            $('.step-row-content').show();

            //$('.country_register option[value="118"]').hide();
            $('.country_register').removeAttr('disabled');
            $('.selectpicker').selectpicker('refresh');
            $('#register-form .nav-tabs').show();

            $('.ville_register').addClass('d-none');
            $('.ville_register .selectpicker').removeAttr('required', 'required');
        }
        if($this.data('b2b-id')) {
            $('<input>').attr({
                type: 'hidden',
                id: 'b2b-id',
                name: 'b2b-id',
                value: $this.data('b2b-id')
            }).appendTo('#sign-up-form');
        }
    });
    $('.parent-category-filter').click(function (e) {
        $this = $(this);
        
        $('.rubriques_choice').prop('checked', false); // Unchecks it
        $('.rubriques_choice', $('#tab-nine'+$this.data('id'))).prop('checked', true); // Unchecks it
        triggerFilterItems(general_x_produit);
    });

    $('.show-rubriques-filter').click(function (e) {
        e.preventDefault();
        $this = $(this);
        
        $('.rubriques-filter').removeClass('d-none'); 
        $('.sub-rubriques-filter').hide(); 
    });

    


});


$(".step-box-content").on('click', function() {

    $(".step-box-content").removeClass("active");
    $(this).addClass("active");

    if($(this).data('type') == 'exporter') {
        //$('.secteurs-inscription').hide();
        $('.country_register option[value="118"]').show();
        $('.country_register').val('118');
        $('.country_register').attr('disabled', 'disabled');
        $('.selectpicker').selectpicker('refresh');
        
        $('.ville_register').removeClass('d-none');
        $('.ville_register .selectpicker').attr('required', 'required');
    } else {
        //$('.secteurs-inscription').show();
        //$('.country_register option[value="118"]').hide();
        $('.country_register').val('');
        $('.country_register').removeAttr('disabled');
        $('.selectpicker').selectpicker('refresh');
        
        $('.ville_register').addClass('d-none');
        $('.ville_register .selectpicker').removeAttr('required', 'required');
    }
});


$(".trigger-signin").on('click', function() {
    
    $('#register-exporter').magnificPopup('close');
    
    setTimeout(function(){ 
        
        $.magnificPopup.open({
            items: {
            src: '#register-form'
            },
            preloader: !1,
            blackbg: !0,
            type: 'inline'
        });
     }, 1000);
    

    $(".signin-tab-action").trigger("click");


    /*
    var inputPhone = document.querySelector("#phoneModal");
    intlTelInput(inputPhone, {
      initialCountry: "auto",
      separateDialCode: true,
      geoIpLookup: function (success, failure) {
        $.get("https://ipinfo.io", function () { }, "jsonp").always(function (resp) {
          var countryCode = (resp && resp.country) ? resp.country : "us";
          success(countryCode);
        });
      },
    });
    */
    
    //$('.country_register option[value="118"]').hide();
    $('.country_register').val('');
    $('.country_register').removeAttr('disabled');
    $('.selectpicker').selectpicker('refresh');
});

/*
var inputPhoneContact = document.querySelector("#phoneContact");
if(inputPhoneContact){
    intlTelInput(inputPhoneContact, {
        initialCountry: "auto",
        separateDialCode: true,
        geoIpLookup: function (success, failure) {
            $.get("https://ipinfo.io", function () { }, "jsonp").always(function (resp) {
            var countryCode = (resp && resp.country) ? resp.country : "us";
            success(countryCode);
            });
        },
      });
}
*/

jQuery('img.svg').each(function(){
	var $img = jQuery(this);
	var imgID = $img.attr('id');
	var imgClass = $img.attr('class');
	var imgURL = $img.attr('src');

	jQuery.get(imgURL, function(data) {
		// Get the SVG tag, ignore the rest
		var $svg = jQuery(data).find('svg');

		// Add replaced image's ID to the new SVG
		if(typeof imgID !== 'undefined') {
			$svg = $svg.attr('id', imgID);
		}
		// Add replaced image's classes to the new SVG
		if(typeof imgClass !== 'undefined') {
			$svg = $svg.attr('class', imgClass+' replaced-svg');
		}

		// Remove any invalid XML tags as per http://validator.w3.org
		$svg = $svg.removeAttr('xmlns:a');
		
		// Check if the viewport is set, else we gonna set it if we can.
		if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
			$svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
		}

		// Replace image with new SVG
		$img.replaceWith($svg);

	}, 'xml');

});

