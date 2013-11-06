
$(document).ready(
    function() {

        // edit post
        $( ".editbutton" ).click(function(e) {

            var buttonClicked = $(this);
            var sectionClicked = buttonClicked.closest("blockquote");
            var userpost = sectionClicked.find("textarea");

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
