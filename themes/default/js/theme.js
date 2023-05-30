$(function () {
	$('[data-toggle="popover"]').popover()
	$('[data-toggle="tooltip"]').tooltip()

	$("[data-mobile-show]").bind("click", function () {

		var isActive = $(this).hasClass("active");

		$("[data-mobile-show]").each(function () {
			$(this).removeClass("active").blur();
			var selector = $(this).attr("data-mobile-show")
			$(selector).hide();
		});

		var selector = $(this).attr("data-mobile-show");
		if (isActive && selector != ".game-area") {
			console.log(2);
			return $("[data-mobile-show='.game-area']").click();
		}

		$(selector).show();
		$(this).addClass("active").focus();
	})

})