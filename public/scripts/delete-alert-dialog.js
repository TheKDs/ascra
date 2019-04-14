var UIAlertDialogApi = function () {
	var handleDialogs = function() {
		$("body").on("click", ".confirmDelete", function(event) {	// for deleting an entry
			var id = $(this).attr('id'); console.log(id);
			bootbox.confirm("This entry will be permanently deleted. Do you want to continue?", function(result) {
				if (result === true) {
					var url = $("#DeleteForm").attr("action") + "/" + id;
					$("#DeleteForm").attr("action", url);
					$("#DeleteForm").submit();
				}
			});
		});		
	}
	return {
		//main function to initiate the module
		init: function () {
			handleDialogs();
		}
	};
}();

jQuery(document).ready(function() {
	UIAlertDialogApi.init();
});