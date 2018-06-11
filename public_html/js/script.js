if ($('#back-to-top').length) {
    var scrollTrigger = 100, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#back-to-top').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
            }
        };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
}
$(document).ready( function() {
    
    $('.close-survey').on('click', function (e) {
               e.preventDefault();

               $("#survey-div").fadeOut("normal", function() {
                   $(this).remove();
               });
               
           })

    $("#search-form").on('submit', function (e) {
        e.preventDefault();

        var id = $("input[name='tbSearch']").attr('rel');
        if(id!=null){
            var url =  window.location.href+"/viewProfil";
            $.ajax({
                type: "GET",
                url: url,
                data: {id: id},
                success: function (data) {
                    $('.profilPrikaz').html(data);
                    console.log(data);
                }, error: function(error){
                    console.log(error);
                }
            })
        }
    });


    $(document).on('click', '.btnDel', function (e) {
       e.preventDefault();
       if(confirm('Delete post?')){
           var url = window.location.href+"/deletePost";
           var id = $(this).attr('rel');
           $.ajax({
              url: url,
              type: "GET",
              data: {id: id},
              success: function () {
                  location.reload();
              },error: function (error) {
                   console.log(error);
               }
           });

       }

    });

    $(document).on('click', '.btnDelComm', function (e) {
        e.preventDefault();
        if(confirm('Delete comment?')){
            var url = window.location.href+"/deleteComment";
            var id = $(this).attr('rel');
            $.ajax({
                url: url,
                type: "GET",
                data: {id: id},
                success: function () {
                    location.reload();
                },error: function (error) {
                    console.log(error);
                }
            });
        }
    });


    var progres = 0;

    $("input[name=rbQuestion1]").click(function(){
        progres +=33;
        $('.progress').val(progres);
    });
    $("input[name=rbQuestion2]").click(function(){
        progres +=33;
        $('.progress').val(progres);
    });
    $("input[name=rbQuestion3]").click(function(){
        progres +=34;
        $('.progress').val(progres);
    });

    $('#form-survey').on('submit', function (e) {
        e.preventDefault();
        var q1 = $('input[name=rbQuestion1]:checked').val();
        var q2 = $('input[name=rbQuestion2]:checked').val();
        var q3 = $('input[name=rbQuestion3]:checked').val();
        if(q1 == null || q2 == null || q3 == null)
        {
            var div = document.createElement("DIV");
            div.innerHTML = "<div id='errorMsg' class='alert alert-danger'>Check all the answers!</div>";
            $('#error-survey').html(div);
            $('#errorMsg').delay(2000).fadeOut(400);
        }else{
            var url = window.location.href+"/subSurvey";
            $.ajax({
                type: 'post',
                url: url,
                data: $('#form-survey').serialize(),
                success: function (data) {
                    if(data.trim()==''){
                        $("#survey-div").fadeOut("normal", function() {
                            $(this).remove();
                        });
                    }else{
                        var div = document.createElement("DIV");
                        div.innerHTML = "<div id='errorMsg' class='alert alert-danger'>You already vote, Thank's!</div>";
                        $('#error-survey').html(div);
                        $('#errorMsg').delay(2000).fadeOut(400);
                    }

                }
            });
        }
    });


        $('.noty-item').on('click', function (e) {
        e.preventDefault();
        var url = window.location.href+"/deleteNotification";
        var row = $(this).attr('rel').split('-');
        var post = 'notf'+row[0];
        var idPst = row[1];
        var rows = $('#'+row[0]+'showComm');
        $.ajax({
            type : "GET",
            url: url,
            data: {id: idPst},
            success: function(){
            }, error: function(){
            }
        });
        $('html, body').animate({
            scrollTop: ($('#'+post).offset().top)
        }, 800);
        rows.addClass('highlight');
        setTimeout(function() {
            rows.removeClass("highlight");
        }, 2000);
    })


    $(document).on('click', '.commPost', function () {
       var id = $(this).attr('rel');
       var url = window.location.href+"/insertComment";
       var comment = "<div class='list-group-item list-group-item-action flex-column align-items-start pb-0'>";
       comment += "<form action="+url+" method='get' id='commForm'>";
       comment += "<input type='text' name='tbComment' class='form-control mb-2' placeholder='Enter comment' required autofocus>";
       comment += "<input type='hidden' value="+id+" name='id'/>";
       comment += "</br><button type='submit' class='btn btn-primary btn-sm mb-2'>Comment</button>";
       comment += "</form>";
       comment += "</div>";
       $('#'+id+"comm").html(comment);
        //CHECK COMMENT FORM
        $('#commForm').validate({
            rules: {
                tbComment: {
                    required: true,
                    minlength: 3,
                }
            },
            messages: {
                tbComment: {
                    required: 'Textbox cannot be empty',
                    minlength: jQuery.validator.format("At least {0} characters required!")
                }
            }
        });
    });

    $(document).on('click', '.viewComment', function (e) {
        e.preventDefault();
        var id = $(this).attr('rel');
        var url = window.location.href+"/showLikers";
        $.ajax({
           type: "GET",
           url: url,
           data: {id: id},
           dataType: 'json',
           success: function (data) {
               $('#'+id+'showComm').html(data);
           },error: function (data) {
                console.log(data);
            }
        });
    });

    $(document).on('click', '.ajax-link', function(e){
        e.preventDefault();
        var id = $(this).attr('rel');
        var url = window.location.href+"/like";
        $.ajax({
            type: "GET",
            url: url,
            data : { id: id },
            dataType: "json",
            success: function(podaci){
                var tekst = "";
                $.each(podaci, function(index, podatak){
                    tekst += podatak.likes+" person like";
                });
                $('#'+id).html(tekst);
            }
            ,
            error: function (data) {

                console.log(data);
            }
        });
    });

    $(document).on('click', '.viewLikes', function (e) {
        e.preventDefault();
        var id = $(this).attr('rel');
        var url = window.location.href+"/viewLikes";
        $.ajax({
            type: "GET",
            url: url,
            data : { id: id },
            dataType : "json",
            success: function(podaci){
                var tekst = "<div id='kill' class='card text-center'>";
                tekst += "<div class='card-header'>";
                tekst += "Likes";
                tekst += "</div>";
                tekst += "<div class='card-body'><p class='card-text'>";
                $.each(podaci, function(index, podatak){
                    tekst += podatak.firstname + " " + podatak.lastname + "</br>";
                });
                tekst +="</p>";
                tekst += "<button class='btn btn-secondary seeLikes'>Close</button>";
                tekst +="</div></div>";
                $('body').append(tekst);
                $('.seeLikes').click(function () {
                   $('#kill').remove();
                });
            },error: function (data) {
                console.log(data);
            }
        });

    });


    $(".fade-out").fadeIn(3000, function(){
        setTimeout(function(){
            $(".fade-out").fadeOut("slow");
        },4000);
    });
});