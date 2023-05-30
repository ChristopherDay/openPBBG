$(function () {
	$('input[name="text"]').focus();

	setInterval(function () {
		$.get("?page=shoutbox&action=history", function (data) {
			var tmp = $(data.game).text().trim();
			var history = $(".history").text().trim();
			if (tmp != history) {
				$(".history").html(data.game);
			}
		});
	}, 1000);

});

$.ajaxSetup({
    headers: { 
		'return-json': true
    }
});

function ajaxRequest(method, url, data, options) {

	var defaultOpts = {
		method: method || {}, 
		url: url || {}, 
		data: data || {}
	};

	var opts = $.extend(defaultOpts, (options || {}))

	history.pushState(opts, "", url);


	return $.ajax(opts);

}