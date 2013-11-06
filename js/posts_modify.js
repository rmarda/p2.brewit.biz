/*$(document).ready(
    function() {

        var editable = $(".mypost").attr("readonly");

        $( ".editbutton" ).click(function() {
            var input = $(".mypost");

            if ( input.attr( "readonly" )) {
                input.removeAttr( "readonly" )
            } else {
                input.attr( "readonly", "readonly" );
            }

            if($(this).text() == "Edit Post")
                $(this).text("Done");
            else
                $(this).text("Edit Post");

            $( "#log" ).html( "Post has been successfully saved to " + input.val() );
        });
    })();
*/

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
                        //$('#results').html(response);
                        alert("Value passed back from the php file... " + response );
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
            var userpost = sectionClicked.find("textarea");


            var id = userpost.attr( "title" );

            $.ajax({
                type: 'POST',
                url: '/posts/p_deletePost',
                success: function(response) {
                    // Put the results we get back from the ajax receiver into the results div
                    //$('#results').html(response);
                    alert("Value passed back from the php file... " + response );
                    sectionClicked.remove();
                },
                data: {
                    // Pass data to the ajax receiver
                    postid: id

                }
            });




        }); // end delete post


        //here




        



    })();
