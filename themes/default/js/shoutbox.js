$(function () {

    $(".shoutbox-message").on('keypress',function(e) {
        var el  =$(this);
        if(e.which == 13) {
            if (!el.val()) return
            $.post("?page=shoutbox&action=reply", {
                text: el.val()
            }, function () {
                el.val("");
                updateChat();
            });
        }
    }); 

    setInterval(function () {
        updateChat();
    }, 2000);

    updateChat();

});

function updateChat() {

    $.ajaxSetup({
        headers: { 
            'return-json': true
        }
    });


    var opts = {
        method: "GET", 
        url: "?page=shoutbox&action=sidebar", 
        success: function (data) {
            $(".shoutbox-messages").html(data.game);
        }
    };

    $.ajax(opts);
}