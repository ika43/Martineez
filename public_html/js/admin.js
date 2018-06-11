$(document).ready(function () {

    $('.btn-edit').on('click', function (e) {
        e.preventDefault();
        var url = window.location.href+"/edit";
        var id = $(this).attr('rel');
        $.ajax({
            type: "GET",
            url: url,
            data: {id: id},
            success: function (data) {
                $('#'+id).html(data);
            }, error: function(error){
                console.log(error);
            }
        })

    });

    $('.ddl-cpost').change(function (e) {
        e.preventDefault();
        const id = $(this).val();
        var url = window.location.href+"/show";
        if(id!=='0'){
            $.ajax({
                type: "GET",
                url: url,
                data: {id: id},
                success: function (data) {
                    $('#prikaz').html(data);
                },error: function (error) {
                    console.log(error);
                }
            })
        }
    });

    $(document).on('click','.btn-delete-post', function (e) {
        e.preventDefault();
        var id = $(this).attr('rel');
        var url = window.location.href+"/delete";
        $.ajax({
            type: "GET",
            url: url,
            data: {id: id},
            success: function () {
                location.reload();
            }, error: function (error) {
                console.log(error);
            }
        })
    });

    $('.ddl-comment').on('change', function (e) {
        e.preventDefault();
        var id = $(this).val();
        var url = window.location.href+"/show";
        if(id!=='0'){
            $.ajax({
                type: "GET",
                url: url,
                data: {id: id},
                success: function (data) {
                    $('#shComm').html(data);
                },error: function (error) {
                    console.log(error);
                }
            });
        }
    });
    
    $(document).on('click','.btn-update-post', function (e) {
        e.preventDefault();
        var id = $(this).attr('rel');
        var url = window.location.href+"/showUpdate";
        $.ajax({
            type: "GET",
            url: url,
            data: {id: id},
            success: function (data) {
                $('#prikaz').html(data);
            }, error: function (error) {
                console.log(error);
            }
        })
    });

    $(document).on('click','.btn-del-comment', function (e) {
        e.preventDefault();
        var id = $(this).attr('rel');
        var url = window.location.href+"/delete";
        $.ajax({
            type: "GET",
            url: url,
            data: {id: id},
            success: function () {
                location.reload();
            }, error: function (error) {
                console.log(error);
            }
        })
    });
    
    $('.ddl-cpostCom').change(function (e) {
        e.preventDefault();
        const id = $(this).val();
        var url = window.location.href+"/show/post";
        if(id!=='0'){
            $.ajax({
                type: "GET",
                url: url,
                data: {id: id},
                success: function (data) {
                    $('#prikaz').html(data);
                },error: function (error) {
                    console.log(error);
                }
            })
        }
    });

    $(document).on('click','.btn-upd-comment', function (e) {
        e.preventDefault();
        var id = $(this).attr('rel');
        var value = $('#com'+id).text();
        if (!$('.elementID'+id).length) {
            $('<div class="elementID'+id+'"><div class="form-group"><label for="exampleInputPassword1">Update Comment</label><input type="text" class="form-control" id="text'+id+'" value="'+value+'"><button type="button" class="btn btn-primary btn-sm mt-2 btn-upd" rel="'+id+'">Update</button></div></div>').insertAfter('#'+id);
            $('.btn-upd').on('click', function (e) {
                e.preventDefault();
                var id = $(this).attr('rel');
                var newText = $('#text'+id).val();
                var url = window.location.href+"/updateComment";
                $.ajax({
                    type: "GET",
                    url: url,
                    data: {id: id, txt: newText},
                    success: function () {
                        location.reload();
                    }, error: function (error) {
                        console.log(error);
                    }
                })
            })
        }
    });

    $('.ddl-act').on('change', function (e) {
        e.preventDefault();
        var id = $(this).val();
        var url = window.location.href+"/show";
        if(id!=='0'){
            $.ajax({
                type: "GET",
                url: url,
                data: {id: id},
                success: function (data) {
                    $('#showAct').html(data);
                },error: function (error) {
                    console.log(error);
                }
            });
        }

    });

    $('.ddl-survey').on('change', function(e){
            var id = $(this).val();
            var url = window.location.href+"/show";
            if(id!=='0')
            {
                $.ajax({
                    type: "GET",
                    url: url,
                    data: {id: id},
                    success: function(data){
                        $('#shQuest').html(data);
                    }, error: function (error) {
                        console.log(error);
                    }
                });
            }
    });
    
    $(document).on('click','.btn-comment-post', function (e) {
        e.preventDefault();

        var id = $(this).attr('rel');
        var url = window.location.href+"/insertComment";
        var comment = "<div id='new"+id+"' class='list-group-item list-group-item-action flex-column align-items-start pb-0 mt-2'>";
        comment += "<form action="+url+" method='get' id='commForm'>";
        comment += "<input type='text' name='tbComment' class='form-control mb-2' placeholder='Enter comment' required autofocus>";
        comment += "<input type='hidden' value="+id+" name='id'/>";
        comment += "</br><button type='submit' class='btn btn-primary btn-sm mb-2'>Comment</button>";
        comment += "</form>";
        comment += "</div>";
        if(document.getElementById("new"+id) === null)
        {
            $( comment ).insertAfter( this );
        }

    });

    $(document).on('click','.btn-up-ques', function (e) {
        e.preventDefault();
        var url = window.location.href+"/update";
        var id = $(this).attr('rel');
        if(!$('#in'+id).length){
            $( "<form action='"+url+"' method='get'><input id='in"+id+"' name='tbQuestion' type='text' class='form-control my-2'><input type='hidden' name='idQuestion' value='"+id+"'><button type='submit' class='btn btn-dark btn-sm btn-up-q'>Change</button></form>" ).insertAfter(this);
        }

    });
        $(document).on('submit', '#insertSurvey', function (e) {
            var name = $("input[name='name']").val();
            var q1 = $("input[name='question1']").val();
            var q2 = $("input[name='question2']").val();
            var q3 = $("input[name='question3']").val();
            if(q1 === "" || q2==="" || q3==="" || name===""){
                alert("Morate popuniti sva polja");
                e.preventDefault();
            }
        });

        $('#insertNewSurvey').on('submit', function (e) {
            var id = $('#ddlDel :selected').val();
            if(id==='0'){
                e.preventDefault();
                alert("Morate odabrati anketu!")
            }
        });

        $('#insertAdv').on('submit', function (e) {
            var text = $("input[name='text']").val();
            var title = $("input[name='title']").val();
            var image = $("input[name='image']").val();
            if(text ==="" || title==="" || image===""){
                e.preventDefault();
                alert("Morate popuniti sva polja!")
            }
        })

    $('.ddl-upd-adv').on('change', function (e) {
        var id = $(this).val();
        if(id!=='0'){
            var url = window.location.href+"/update";
            var _token = $("input[name='_token']").val();
            $.ajax({
                url: url,
                type: "POST",
                data: {id: id, _token: _token},
                success: function (data) {
                    $('#showUpdAdv').html(data);
                }, error: function(error){
                    console.log(error);
                }
            })

        }else{
            e.preventDefault();
        }
    });

    $.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            var check = false;
            return this.optional(element) || regexp.test(value);
        },
        "Please check your input."
    );

    $('#adminInsert').validate({
        rules: {
            tbFirstname: {
                required: true,
                minlength: 3
            },
            tbLastname: {
                required: true,
                minlength: 3
            },
            tbPosition: {
                required: true,
                minlength: 3
            },
            tbWorkplace: {
                required: true,
                minlength: 3
            },
            tbCity: {
                required: true,
                minlength: 3
            },
            tbState: {
                required: true,
                minlength: 3
            },
            tbMail: {
                email:true,
                required: true,
                minlength: 3
            },
            tbPassword: {
                required: true,
                minlength: 3,
                regex : /^(?=.*\d)(?=.*[a-zA-Z])[a-zA-Z0-9]{7,}$/
            }

        },
        messages: {
            tbFirstname: {
                required: 'Enter firstname',
                minlength: jQuery.validator.format("At least {0} characters required!")
            },
            tbLastname: {
                required: 'Enter lastname',
                minlength: jQuery.validator.format("At least {0} characters required!")
            },
            tbWorkplace: {
                required: 'Enter workplace',
                minlength: jQuery.validator.format("At least {0} characters required!")
            },
            tbPosition: {
                required: 'Enter position',
                minlength: jQuery.validator.format("At least {0} characters required!")
            },
            tbCity: {
                required: 'Enter city',
                minlength: jQuery.validator.format("At least {0} characters required!")
            },
            tbState: {
                required: 'Enter state',
                minlength: jQuery.validator.format("At least {0} characters required!")
            },
            tbPassword: {
                required: 'Enter password',
                minlength: jQuery.validator.format("At least {0} characters required!"),
                regex: 'At least 4 letters and 3 digit!'
            },
            tbMail: {
                required: 'Enter mail',
                minlength: jQuery.validator.format("At least {0} characters required!"),
            }
        }

    });


});