jQuery(document).ready(function(){
    jQuery('#load_more_btn').on('click', function() {
        var id = jQuery('#load_more_btn').data('id');
        $.ajax({
            url: "home-load-more.php",
            type: "post",
            data: {
                id: id
            },
            success: function(response) {
                jQuery(".load-more-container").remove();
                jQuery(".home-left-column").append(response);
            }
        })
    });
    jQuery('#category_load_more_btn').on('click', function() {
        console.log("lol");
        var id = jQuery('#category_load_more_btn').data('id');
        var category = jQuery('#category_load_more_btn').data('category');
        $.ajax({
            url: "category-load-more.php",
            type: "post",
            data: {
                id: id,
                category : category
            },
            success: function(response) {
                jQuery(".load-more-container").remove();
                jQuery(".category_page .left-column").append(response);
            }
        })

    })
})