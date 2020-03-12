$(document).ready(function(){

    $(".slide").mouseenter(function(){
        $(this).animate({ width: '+=10px'});
        $(this).toggleClass("shadow");//add shadow class to this
    });

    $(".slide").mouseleave(function(){
        $(this).animate({ width: '-=10px'});
        $(this).toggleClass("shadow");//remove shadow class from this
    });

    $(".slide").css({left:20})  // Set the left to its calculated position
        .animate({"left":"0px"}, "slow");

    // $("#index-search-form").
    $("#index-search-form").on('submit', function(e) {
        e.preventDefault();
        console.log($("#index-search-input").val());
        // var search = $("#index-search-input").text();
        // $('#index-search-form').attr('action', "/posts/s/"+search );
    });

    $(".like").on('click' ,function (e) {
         // console.log(e)
        e.preventDefault();
        var isLike = e.target.parentElement.previousElementSibling == null;
        console.log(isLike);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // var CSRF_TOKEN = $('meta[name="_token"]').attr('content');
        // console.log(route);
        var postId = $("#post_id").text();
        // console.log(postId);
        $.ajax({
            method: 'POST',
            url:route ,
            data:{isLike: isLike ,id: postId, _token: token},
            success: function (data, textStatus, xhr) {

                console.log(data);
            },
            error: function (xhr, textStatus, errorThrown) {

                console.log(errorThrown);
            }
        });
            // .done(function( data ) {
            //     if ( console && console.log ) {
            //         console.log( "Sample of data:", data );
            //     }
            // });

    });

    //set height image equal to width
    //
    // $(window).on('resize', function(){
    //     var cw = $('.slide img').width();
    //     $('.slide').css({'height':cw+'px'});
    //     // $('.slide img').css({'height':cw+'px'});
    // });


    // let navbar = $(".navbar");
    // $(window).scroll(function (){
    //     if ($(window).scrollTop() > 300){
    //         navbar.addClass("sticky-top");
    //     }
    //     else {
    //         navbar.removeClass("sticky-top");
    //     }
    // });

});
