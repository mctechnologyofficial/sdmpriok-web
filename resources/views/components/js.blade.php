<!-- Jquery js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Bootstrap js-->
<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- Internal Chart.Bundle js-->
<script src="{{ asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>

<!-- Peity js-->
<script src="{{ asset('assets/plugins/peity/jquery.peity.min.js') }}"></script>

<!-- Select2 js-->
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

<!-- Perfect-scrollbar js -->
<script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

<!-- Sidemenu js -->
<script src="{{ asset('assets/plugins/sidemenu/sidemenu.js') }}"></script>

<!-- Sidebar js -->
<script src="{{ asset('assets/plugins/sidebar/sidebar.js') }}"></script>

<!-- Internal Morris js -->
<script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('assets/plugins/morris.js/morris.min.js') }}"></script>

<!-- Circle Progress js-->
<script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>
<script src="{{ asset('assets/js/chart-circle.js') }}"></script>

<!-- Internal Dashboard js-->
<script src="{{ asset('assets/js/index.js') }}"></script>

<!-- Sticky js -->
<script src="{{ asset('assets/js/sticky.js') }}"></script>

<!-- Custom js -->
<script src="{{ asset('assets/js/custom.js') }}"></script>

<!-- DataTable js -->
<script src="{{ asset('assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/fileexport/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/fileexport/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/fileexport/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/fileexport/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/fileexport/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/fileexport/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/fileexport/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/fileexport/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/js/table-data.js') }}"></script>

<!-- Modal JS -->
<script src="{{ asset('assets/js/modal.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/chart.chartjs.js') }}"></script>

<!-- Editable Script -->
<script>
    // bar chart progress-chart.blade.php //
    var marksCanvas = document.getElementById("chartBar");

    var marksData = {
        labels: ["Team A", "Team B", "Team C", "Team D"],
        datasets: [
            {
                label: 'Team Competency Progress',
                data: [65, 59, 80, 81],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 99, 132)',
                    'rgb(255, 99, 132)',
                    'rgb(255, 99, 132)',
                ],
                borderWidth: 1
            }
        ]
    };

    var radarChart = new Chart(marksCanvas, {
        type: 'bar',
        data: marksData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    });
    // bar chart progress-chart.blade.php //

    
</script>