$(document).ready(function(){
	$('.fancybox').fancybox();
	
	// invoke date picker for registration page
	$('#date_field').datepicker({dateFormat: 'yy-mm-dd'});

	// ajax save account
	$('#save_account_submit').unbind('click');
	$('#save_account_submit').click(function(){
		// console.log('saved')
		var form_data = {
			user_id: $('.user_id').val(),
			email: $('#email').val(),
			password: $('#password').val(),
			ajax: 1
		}

		$.ajax({
			url: $('#account_form').attr('action'),
			type: 'POST',
			data: form_data,
			success: function(msg) {
				msg = $.parseJSON(msg);
				// console.log(msg.txt);
				if(msg.save) {
					$('#theModal').find('.modal-title').html('Change saved');
				} else {
					$('#theModal').find('.modal-title').html('Error');
				}
				$('#theModal').find('.modal-body').html(msg.txt);
				$('#theModal').modal();
			}
		});

		// console.log(1);

		return false;
	});

	// ajax save basic
	$('#save_basic_submit').unbind('click');
	$('#save_basic_submit').click(function(){
		// console.log('saved')
		var form_data = {
			user_id: $('.user_id').val(),
			firstname: $('#firstname').val(),
			lastname: $('#lastname').val(),
			display_name: $('#display_name').val(),
			about: $('#about').val(),
			date_of_birth: $('#date_field').val(),
			place: $('#place').val(),
			ajax: 1
		}

		// console.log(form_data);

		// return false;

		$.ajax({
			url: $('#basic_form').attr('action'),
			type: 'POST',
			data: form_data,
			success: function(msg) {
				msg = $.parseJSON(msg);
				// console.log(msg.txt);
				if(msg.save) {
					$('#theModal').find('.modal-title').html('Change saved');
				} else {
					$('#theModal').find('.modal-title').html('Error');
				}
				$('#theModal').find('.modal-body').html(msg.txt);
				$('#theModal').modal();
			}
		});

		// console.log(1);

		return false;
	});


	// ajax post
	$('#post_submitt').unbind('click');
	$('#post_submitt').click(function(){
		// console.log('saved')
		var form_data = {
			user_id: $('.user_id').val(),
			post: $('#post').val(),
			ajax: 1
		}

		// console.log(form_data);

		// return false;

		$.ajax({
			url: $('#post_status').attr('action'),
			type: 'POST',
			data: form_data,
			success: function(msg) {
				msg = $.parseJSON(msg);
				// console.log(msg.txt);
				if(msg.save) {
					$('#theModal').find('.modal-title').html('Status Saved');

					// $.ajax({
					// 	url: 'post/view',
					// 	type: 'POST',
					// 	data: {post_id: msg.post_id},
					// 	success: function(pdata) {
					// 		post = $.parseJSON(pdata);

					// 	}
					// });

				} else {
					$('#theModal').find('.modal-title').html('Error');
				}
				$('#theModal').find('.modal-body').html(msg.txt);
				$('#theModal').modal();

				// window.location('bit');
			}
		});

		// console.log(1);

		return false;
	});
});