var form = $('#outofschool');
var start = $(form).find("[id^=am_]");
var end = $(form).find("[id^=pm_]");
var extra = $(form).find("[id^=end_hr_]");
var os_Total = 0;
var os_subtotal = $(form).find("[id^=subtotal_]");
var os_total = $(form).find("#total");
var child = $(form).find('#child');
var payment_type = $('#howtopay');


$(payment_type).on('change', function(){
	if(payment_type.val() == 'Govenment Grants'){
		console.log("govt");
	}
	console.log("govt");
});

$(start).on('change', function(e) {
	main_subtotal = Number(($(e.target.parentNode.parentNode).children().children().filter("[id^=subtotal]").text()));

	if (this.checked) {

		main_subtotal = parseFloat(main_subtotal + 6.5);

	} else {
		main_subtotal = parseFloat(main_subtotal - 6.5);

	}

	$(e.target.parentNode.parentNode).children().children().filter("[id^=subtotal]").text(parseFloat((main_subtotal * 100) / 100).toFixed(2));

	os_getTotal();

});

$(end).on("change", function(e) {
	main_subtotal = Number(($(e.target.parentNode.parentNode).children().children().filter("[id^=subtotal]").text()));

	if (this.checked) {
		main_sub = parseFloat(main_subtotal + 7.5);
		$(e.target.parentNode.nextElementSibling.firstElementChild).prop('disabled', false);
		$(e.target.parentNode.nextElementSibling.lastElementChild).prop("disabled", false);

	} else {
		if (e.target.parentNode.previousElementSibling.firstElementChild.checked) {
			main_sub = parseFloat(6.5);
			//parseFloat(main_subtotal - 7.5);
		} else {
			main_sub = parseFloat(00);
		}
		$(e.target.parentNode.nextElementSibling.firstElementChild).val('18');
		$(e.target.parentNode.nextElementSibling.lastElementChild).val('00');
		$(e.target.parentNode.nextElementSibling.firstElementChild).prop('disabled', true);
		$(e.target.parentNode.nextElementSibling.lastElementChild).prop("disabled", true);

	}

	$(e.target.parentNode.parentNode).children().children().filter("[id^=subtotal]").text(parseFloat((main_sub * 100) / 100).toFixed(2));
	os_getTotal();

});
//that = this;

$(extra).on('change', function(that) {
	main_subtotal = Number(($(that.target.parentNode.parentNode).children().children().filter("[id^=subtotal]").text()));

	if (Number($(this).val()) > 18) {

		ex_hours = Number(($(this).val() - 18 ));

		main_subtotal1 = parseFloat(ex_hours * 6);

		main_subtotal1 = main_sub + main_subtotal1;

	} else {
		main_subtotal1 = main_sub;
	}

	$(that.target.parentNode.parentNode).children().children().filter("[id^=subtotal]").text(parseFloat((main_subtotal1 * 100) / 100).toFixed(2));
	os_getTotal();

});

function os_getTotal() {
	os_Total = 00;
	$(os_subtotal).each(function(index) {
		os_Total = os_Total + Number($(this).text());
	});
	$(os_total).text(parseFloat((os_Total * 100) / 100).toFixed(2));
}

function os_formValidated() {

	var msg = "Please select a child";

	if (child.val() === "0") {
		$(child).focus();
		smoke.alert(msg);
		return false;
	}

	if (os_Total === 0) {

		smoke.alert("No booking has been selected");

		return false;
	}
	
	

	return true;

}

$('#payment_processor').submit(function(){
	
	if(payment_type.val() === '3'){
		smoke.prompt("This will cover for a maximum of £ 54.00 per week", function(e){
	    									5000
												}, {
												ok: 'Got it',
												cancel: 'Nope'	
											});
										
		return false;
	}
});


$("#outofschool").submit(function() {
	return os_formValidated();

});

