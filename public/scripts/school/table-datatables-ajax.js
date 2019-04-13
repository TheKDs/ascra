var TableDatatablesAjax = function () {
	var handleDatatable = function () {
		var fixedHeaderOffset = 0;
		var grid = new Datatable();

		// if (App.getViewPort().width < App.getResponsiveBreakpoint('md')) {
		// 	if ($('.page-header').hasClass('page-header-fixed-mobile')) {
		// 		fixedHeaderOffset = $('.page-header').outerHeight(true);
		// 	}
		// }
		// else if ($('.page-header').hasClass('navbar-fixed-top')) {
		// 	fixedHeaderOffset = $('.page-header').outerHeight(true);
		// }
		// else if ($('body').hasClass('page-header-fixed')) {
		// 	fixedHeaderOffset = 64; // admin 5 fixed height
		// }

		grid.init({
			src: $("#datatable_ajax"),
			onSuccess: function (grid, response) {
				// grid:		grid object
				// response:	json object of server side ajax response
				// execute some code after table records loaded
			},
			onError: function (grid) {
				// execute some code on network or other general error
			},
			onDataLoad: function(grid) {
				// execute some code on ajax data load
			},
			loadingMessage: 'Loading...',
			dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options
				// Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
				// setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js).
				// So when dropdowns used the scrollable div should be removed.
				//"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",

				// save datatable state(pagination, sort, etc) in cookie.
				"bStateSave": true,

				 // save custom filters to the state
				"fnStateSaveParams":	function ( oSettings, sValue ) {
					$("#datatable_ajax tr.filter .form-control").each(function() {
						sValue[$(this).attr('name')] = $(this).val();
					});

					return sValue;
				},

				// read the custom filters from saved state and populate the filter inputs
				"fnStateLoadParams" : function ( oSettings, oData ) {
					//Load custom filters
					$("#datatable_ajax tr.filter .form-control").each(function() {
						var element = $(this);
						if (oData[element.attr('name')]) {
							element.val( oData[element.attr('name')] );
						}
					});

					return true;
				},
				"ajax": {
					"url": "datatables/school", // ajax source
				},

				"columns": [
					{
						data: null,
						name: "is_active",
						render: function(data) {
							return data[0] == 1 ? '<span class="label label-sm bg-green">Active</span>' : '<span class="label label-sm bg-grey">Inactive</span>';
						}
					},
					{
						data: null,
						name: "name",
						render: function(data) {
							return data[1];
						}
					},
					// {
					// 	data: null,
					// 	name: "address",
					// 	render: function(data) {
					// 		return data[2];
					// 	}
					// },
					{
						data: null,
                        class: "dt-body-center",
						name: "mobile",
						render: function(data) {
							return data[3];
						}
					},
					{
						data: null,
						render: function(data) {
							return '<div style="margin-bottom: 5px;"><a href="loan/' + data[4] + '/edit" title="Edit"><span class="btn btn-xs yellow btn-outline"><i class="fa fa-pencil"></i> Edit</span></a></div>\
								<div style="margin-bottom: 5px;"><a href="loan/' + data[4] + '" title="Details"><span class="btn btn-xs blue btn-outline"><i class="fa fa-info"></i> Details</span></a></div>\
								<a onclick="" title="Delete" id="' + data[4] + '" class="confirmDelete btn btn-xs red btn-outline"><i class="fa fa-trash"></i> Delete</a>';
						}
					}
				],
				"lengthMenu": [
					[25, 50, 100, 150, -1],
					[25, 50, 100, 150, "All"] // change per page values here
				],
				"pageLength": 25, // default record count per page
				"pagingType": "full_numbers",
				"columnDefs": [
					{	// set default column settings
						'orderable': false,
						'targets': [0, 4]
					}
				],
				"order": [
					[1, "asc"]
				],	// set first column as a default sort by asc
				"language": {
					"aria": {
						"sortAscending": ": activate to sort column ascending",
						"sortDescending": ": activate to sort column descending"
					},
					"emptyTable": "No data available in table",
					"info": "Showing _START_ to _END_ of _TOTAL_ entries",
					"infoEmpty": "No entries found",
					"infoFiltered": "(filtered1 from _MAX_ total entries)",
					"lengthMenu": "_MENU_ entries",
					"search": "Search:",
					"zeroRecords": "No matching records found"
				},
				"scrollX": true,
				"scrollY": "375px",
				"deferRender": true,
				"scroller": true
			}
		});
	}

	return {
		//main function to initiate the module
		init: function () {
			handleDatatable();
		}
	};

}();

jQuery(document).ready(function() {
	TableDatatablesAjax.init();
});