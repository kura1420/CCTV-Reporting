$(document).ready(function() {

	$("#account_username").change(function() {
		if ($(this).val() != '') {
			
			$.ajax({
				type: "POST",
				data: { account_username: $(this).val() },
				url: getStore,
				success: function(result, status, xhr) {
					$("#store_id").html(result);
				}
			});
		} else {
			alert("Anda tidak memilih Pic. CCTV");

			$("#store_id").html('<option value="">- Pilih Store -</option>');
			$("#issue_id").html('<option value="">- Pilih ID Issue -</option>');
			$("#resultData").html('');
		}
	});

	$("#store_id").change(function() {
		if ($(this).val() != '') {

			$.ajax({
				type: "POST",
				data: {
					account_username: $("#account_username").val(),
					store_id: $(this).val()
				},
				url: getIssue,
				success: function(result, status, xhr) {
					$("#issue_id").html(result);
					$("#resultData").html();
				}
			});
		} else {
			alert("Anda tidak memilih Store");

			$("#issue_id").html('<option value="">- Pilih ID Issue -</option>');
			$("#resultData").html('');
		}
	});

	$("#issue_id").change(function() {
		if ($(this).val() == '') { $("#resultData").html(''); }
	});

	$("#btnLoadData").click(function() {
		var account = $("#account_username").val();
		var store = $("#store_id").val();
		var issue = $("#issue_id").val();

		if (issue != '' || store != '' || account != '') {
			$.ajax({
				type: "POST",
				data: {
					account_username: account,
					store_id: store,
					issue_id: issue
				},
				url: getData,
				success: function(result, status, xhr) {
					$("#resultData").html(result);
				}
			});
		} else {
			alert("Anda tidak memilih data apapun");
		}
	});

});