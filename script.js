$('.js-send-form').submit(function(event) {
	event.preventDefault();

	let submitForm = $(this);
	let sendData = submitForm.serialize();

	$.ajax({
		url: 'ajaxSendEmail.php',
		type: 'post',
		data: sendData,
		success: function(result) {
			console.log(result);

			if ( result == 'success' ) {
				submitForm.find('.form-wrapper').hide(600);
				submitForm.find('.js-success-send').show(600);
			}
			else {
				alert('Сталася помилка!');
			}
		}
	});
	// .done(function() {
	// 	console.log("success");
	// })
	// .fail(function() {
	// 	console.log("error");
	// })
	// .always(function() {
	// 	console.log("complete");
	// });
});

http://lessons.lihnazbar.pp.ua/ajaxSendEmail.php

$('.js-send-form input[name="email"], .js-send-form input[name="sendEmail"]').keyup(function() {
	let elem = $(this);
	let value = elem.val();
	let parentElem = elem.parent('.js-validation');

	if ( value.indexOf('@') == -1 ) {
		parentElem.find('span').html('Адрес вказоно не коректно!');

		elem.css({
			"border-color": "red",
			"color": "red"
		});
	}
	else {
		parentElem.find('span').html('');

		elem.css({
			"border-color": "green",
			"color": "green"
		});
	}
});
