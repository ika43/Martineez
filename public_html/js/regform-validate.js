$().ready( function(){

    //ADD NEW METHOD FOR REGEX
    $.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            var check = false;
            return this.optional(element) || regexp.test(value);
        },
        "Please check your input."
    );
    //ADD NEW METHOD FOR IMAGE SIZE
    $.validator.addMethod("filesize_max", function(value, element, param) {
        var isOptional = this.optional(element),
            file;

        if(isOptional) {
            return isOptional;
        }

        if ($(element).attr("type") === "file") {

            if (element.files && element.files.length) {

                file = element.files[0];
                return ( file.size && file.size <= param );
            }
        }
        return false;
    }, "File size is too large. Max 2MB!");

    //regex for fname, lname and pos!
    var reg = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/;

    //CHECK LOGIN FORM
    $("#log-form").validate({
       rules: {
           tbMail: {
               email: true,
               required : true
           },
           tbPassword: {
               required :true,
               regex : /^(?=.*\d)(?=.*[a-zA-Z])[a-zA-Z0-9]{7,}$/
           }
       },
       messages: {
           tbMail: {
               required: 'required',
               mail: 'valid mail'
           },
           tbPassword: {
               required: 'required',
               regex: 'valid password'
           }
       },
        errorPlacement: function(error, element) {
            var el = element.attr('name').toLowerCase();
            var res = el.substring(2);
            var name = '#' + res;
            error.addClass('alert alert-danger');
            error.insertAfter(name);
        }

    });




    //CHECK ARTICLE FORM
    $('#article-form').validate({
       rules: {
           tbArticle: {
               required: true,
               minlength: 3,
           }
       },
        messages: {
           tbArticle: {
               required: 'Textbox cannot be empty',
               minlength: jQuery.validator.format("At least {0} characters required!")
           }
        }
    });


    //CHECK POST IMG

    $('.img-form').validate({
        rules: {
            tbTitle: {
                required: false,
                regex: /^[_A-z0-9]*((-|\s)*[_A-z0-9])*$/

            },
            image: {
                required: true,
                extension: "jpg,jpeg,png,gif",
                filesize_max : 2400000
            }
        },
        messages: {

            tbTitle: 'Only letters and numbers!',
            image: {
                extension: 'only jpg, jpeg, gif, png',
                required: 'required image'
            }
        }

    });
    //CHECK PROFILE IMAGE
    $('#img-prf').validate({
        rules: {
            image: {
                required: true,
                extension: "jpg,jpeg,png,gif",
                filesize_max : 2400000
            }
        },
        messages: {

            image: {
                extension: 'only jpg, jpeg, gif, png',
                required: 'required image'
            }
        }

    });

    //CHECK FILE SIZE
    // $('#img-form').submit(function () {
    //
    //     var s = $("#fileimg")[0].files[0].size;
    //     alert(s);
    //
    //
    // });



    //CHECK REGISTER FORM
    $(".register-form").validate({
        rules: {

            tbFirstname: {
                minlength: 2,
                required: true,
                regex: reg
            },
            tbLastname: {
                minlength: 2,
                required: true,
                regex: reg
            },
            tbMail: {
                email: true,
                required: true

            },
            tbPassword:{
                required: true,
                regex : /^(?=.*\d)(?=.*[a-zA-Z])[a-zA-Z0-9]{7,}$/
            },
            tbPosition: {
                required: true,
                regex: reg,
                minlength: 3
            },
            tbWorkplace: {
                required: true,
                regex: /^[_A-z0-9]*((-|\s)*[_A-z0-9])*$/,
                minlength: 3
            },
            tbCity: {
                minlength: 3,
                regex: reg
            },
            tbState: {
                minlength: 3,
                regex: reg
            }
        },
        messages: {

            tbFirstname: {
                required: "We need your firstname!",
                minlength: jQuery.validator.format("At least {0} characters required!"),
                regex: "Only letters!"
            },
            tbLastname: {
                required: "We need your lastname!",
                minlength: jQuery.validator.format("At least {0} characters required!"),
                regex: "Only letters!"
            },
            tbMail:{
                required: "We need your email address to contact you!",
                email: "Enter valid address!"
            },
            tbPassword: {
                required: "Password is required!",
                regex: "Minimum 7 character length, only digits and letters!"
            },
            tbPosition: {
                required: "Position is required!",
                regex: "Only letters",
                minlength: jQuery.validator.format("At least {0} characters required!"),
            },
            tbWorkplace: {
                required: "If you are unemployed, set unemployed!",
                regex: "Only letters and number!",
                minlength: jQuery.validator.format("At least {0} characters required!"),
            },
            tbCity: {
                minlength: jQuery.validator.format("At least {0} characters required!"),
                regex: 'Only letters'
            },
            tbState: {
                minlength: jQuery.validator.format("At least {0} characters required!"),
                regex: 'Only letters'
            }

        },
        errorPlacement: function(error, element) {
                    var el = element.attr('name').toLowerCase();
                    var res = el.substring(2);
                    var name = '#' + res;
                    error.addClass('alert alert-danger');
                    error.insertAfter(name);
                }

    });
});