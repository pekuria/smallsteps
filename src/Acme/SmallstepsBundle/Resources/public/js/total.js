var form = $('acme_smallstepsbundle_booking');
var sub = $(form).find("#submit");
var total = $(form).find("#total");
var subtotal = $(form).find("[id^=subTotal_]");
var start = $(form).find("[id^=sacme_smallstepsbundle_booking_bookingDetail_0_startTime]");
var end = $(form).find("[id^=acme_smallstepsbundle_booking_bookingDetail_0_endTime]");
var sub_total = Number($(00));
var start_time = Number(00);
var finish_time = Number(00);
var Total = 00;


function formValidated() {

	var child = $("#acme_smallstepsbundle_booking_child");
	var room_name = $("#acme_smallstepsbundle_booking_room");
	var msg = "";
	

	if (child.val() === "0" || room_name.val() === "0") {

		if (child.val() === "0") {
			msg = "Please select a child";			
		}
		
		if (room_name.val() === "0") {
			if(msg === ""){
			msg = "Please select a room name";			
			$(room).focus();
			}
			else{
				msg += "\n" + "Please select a room name";
				$(child).focus();
			}
			
		}

				
		smoke.alert(msg);
		return false;
	}

	if(Total === 0){

		smoke.alert("No booking has been selected");

		return false;
	}	

	return true;
}


$(form).submit(function() {

	

	return formValidated();
});



start.on("change", function(e) {

	start_hr = $(e.currentTarget).val();
	start_min = $(e.target.parentNode.lastElementChild).val();
	end_hr = $(e.target.parentNode.nextElementSibling.firstElementChild).val();
	end_min = $(e.target.parentNode.nextElementSibling.lastElementChild).val();

	if (start_min === '--') {
		$(e.target.parentNode.lastElementChild).val('00');
	}

	if (end_hr !== '--') {
		if (Number(start_hr) >= Number(end_hr)) {
			smoke.alert("start time cannot be greater than end time");
			start_hr = $(e.currentTarget).val('--');
			start_min = $(e.target.parentNode.lastElementChild).val('--');

		}

	}
	start_time = start_hr;
	CalculateTotal(this);
});

end.on("change", function(e) {

	end_hr = $(e.currentTarget).val();
	$(e.target.parentNode.lastElementChild).val('00');
	end_min = $(e.target.parentNode.lastElementChild).val();
	start_hr = $(e.target.parentNode.previousElementSibling.firstElementChild).val();
	start_min = $(e.target.parentNode.previousElementSibling.lastElementChild).val();

	if (end_min === '--') {
		$(e.target.parentNode.lastElementChild).val('00');
	}

	if (Number(end_hr + end_min) <= Number(start_hr + start_min)) {
		smoke.alert("start time cannot be greater than end time and booking should be longer than an hour");
		$(e.currentTarget).val('--');
		$(e.target.parentNode.lastElementChild).val('--');

	}

	
	finish_time = end_hr;
	CalculateTotal(this);
});

function CalculateTotal(e) {

	var full_day = Number(34);
	var half_day = Number(25);
	var flexi = Number(5.40) * 100;
	var out_of_hours = Number(6);
	
	if($(e).context.name.indexOf("5") > 1){
		
		var full_day = Number(40);
		var half_day = Number(30);
	}
	

	if (end_hr !== "--" && start_hr !== "--") {

		if (end_hr > 18){
			finish_time = 18;
		}
		
		else{
			finish_time = end_hr;
		}
		normal_hours = finish_time - start_time;
		booked_hours = end_hr - start_hr;
		
				
		if (booked_hours < 2) {
			smoke.alert("Minimum booking is 2 hours");

			e.value = "--";
			e.nextElementSibling.value = "--";
			e.focus();
			$(e.parentNode.parentNode).children().children().filter("[id^=subtotal]").text("");
			getTotal();
			return;
		
		} else if (normal_hours <= 6) {

			sub_total = half_day;

			$(e.parentNode.parentNode).children().children().filter("[id^=subtotal]").text(parseFloat((sub_total*100)/100).toFixed(2));

		}else if (normal_hours <= 10) {

			sub_total = full_day;

			$(e.parentNode.parentNode).children().children().filter("[id^=subtotal]").text(parseFloat((sub_total*100)/100).toFixed(2));

		}
		
		else if(normal_hours > 10 && end_hr <= 18){
			
			sub_total = full_day + ((normal_hours - 10) * out_of_hours);
			$(e.parentNode.parentNode).children().children().filter("[id^=subtotal]").text(parseFloat((sub_total*100)/100).toFixed(2));
		}			

		if (end_hr > 18) {
			var extra_hours = Number(booked_hours - normal_hours);			
			sub_total = sub_total + (extra_hours * out_of_hours);
			$(e.parentNode.parentNode).children().children().filter("[id^=subtotal]").text(parseFloat((sub_total*100)/100).toFixed(2));
		}	
			
		getTotal();
	}

}


function getTotal() {
	Total = 00;
	$(subtotal).each(function(index) {
		Total = Total +(Number($(this).text()) * 100);		
	});

	$("#total").text(parseFloat(Total/100).toFixed(2));
}
