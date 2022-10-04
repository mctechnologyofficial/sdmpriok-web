$(function() {
    'use strict'

	$('#example1').DataTable({
        // responsive: true,
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
			lengthMenu: '_MENU_ items/page',
		}
	});
    $('#example1 tbody tr').on('click', function(){
        $('#modaldemo8').modal('show');
    });
    $('#example1 tbody tr').on('mouseover', function(){
        $(this).css('cursor', 'pointer');
    });

    $('#mentoringtable').DataTable({
        // responsive: true,
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
			lengthMenu: '_MENU_ items/page',
		}
	});
    $('#mentoringtable tbody tr').on('mouseover', function(){
        $(this).css('cursor', 'pointer');
    });
});
