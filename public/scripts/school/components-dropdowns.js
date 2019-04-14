var ComponentsSelect2 = function() {
	var handleSelect2 = function() {
		$.fn.select2.defaults.set("theme", "bootstrap");
		
		/* GAME TYPE */
		function tagFormatResult(data) {
			return data.text;
		}

		function tagFormatSelection(data) {
			$("#select2_course").val(data.id);

			return data.text;
		}

		$("#select2_course").select2({
			allowClear: true,
			minimumInputLength: 0,
			placeholder: "Select a Tag",
			width: "off",
			ajax: {
				url: APP_URL + "/api/v1/course",
				dataType: "json",
				delay: 250,
				data: function(params) {
					return {
						search: params.term, // search term
						active: 1,
						fields: "id,course_name"
					};
				},
				processResults: function(data, page) {
					for (i=0; i<data.length; i++) {
						data[i].text = data[i].course_name;
					}
					return {
						results: data
					};
				},
				cache: true
			},
			escapeMarkup: function(markup) {
				return markup;
			}, // let our custom formatter work
			// templateResult: tagFormatResult,
			// templateSelection: tagFormatSelection
		});
		/* GAME TYPE */
	};

	return {
		//main function to initiate the module
		init: function() {
			handleSelect2();
		}
	};

}();

jQuery(document).ready(function() {
	ComponentsSelect2.init();
});