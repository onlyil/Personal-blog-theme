/**
 *
 * @authors Your Name (you@example.org)
 * @date    2017-04-22 16:14:22
 * @version $Id$
 */
// 点赞
$(document).ready(function() {
    $.fn.postLike = function() {
        if ($(this).hasClass('done')) {
            alert('您已赞过本博客');
            return false;
        } else {
            $(this).addClass('done');
            var id = $(this).data("id"),
            action = $(this).data('action'),
            rateHolder = $(this).children('.count');
            var ajax_data = {
                action: "bigfa_like",
                um_id: id,
                um_action: action
            };
            $.post("<?php bloginfo('url');?>/wp-admin/admin-ajax.php", ajax_data, function(data) {
                $(rateHolder).html(data);
            });
            return false;
        }
    };
    $(document).on("click", ".favorite", function() {
        $(this).postLike();
    });
});
