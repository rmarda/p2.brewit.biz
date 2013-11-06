
$(document).ready(
    function() {

        // edit post
        $( ".editbutton" ).click(function(e) {

            var buttonClicked = $(this);
            var sectionClicked = buttonClicked.closest("blockquote");
            var userpost = sectionClicked.find("textarea");

            var msgClicked = sectionClicked.closest("div");
            var modifiedSpan = msgClicked.find("span");


            if($(this).text() == "Edit Post") {
                $(this).text("Done");
                userpost.removeAttr( "readonly" );
            }
            else{

                $(this).text("Edit Post");
                userpost.attr( "readonly", "readonly" );
                var modifiedPost = userpost.val();
                var id = userpost.attr( "title" );

                $.ajax({
                    type: 'POST',
                    url: '/posts/p_modify',
                    success: function(response) {
                        // Put the results we get back from the ajax receiver into the results div
                        // change the modified date in div
                        var utcSeconds = response;
                        var d = new Date(0); // The 0 there is the key, which sets the date to the epoch
                        d.setUTCSeconds(utcSeconds);
                        msgClicked.find("time:last").html(d.toString());


                    },
                    data: {
                        // Pass data to the ajax receiver
                        postid: id,
                        modifiedPost: modifiedPost
                    }
                });
            }
        }); // end edit post


        //here

        // delete post
        $( ".deletebutton" ).click(function(e) {

            var buttonClicked = $(this);
            var sectionClicked = buttonClicked.closest("blockquote");
            var msgClicked = sectionClicked.closest("div");
            var userpost = sectionClicked.find("textarea");


            var id = userpost.attr( "title" );

            $.ajax({
                type: 'POST',
                url: '/posts/p_deletePost',
                success: function(response) {
                    // Put the results we get back from the ajax receiver into the results div

                    //alert("Value passed back from the php file... " + response );
                    // remove time information and the post
                    msgClicked.remove();
                },
                data: {
                    // Pass data to the ajax receiver
                    postid: id

                }
            });




        }); // end delete post

    })();
