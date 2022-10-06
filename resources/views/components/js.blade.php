<!-- Jquery js-->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}

<!-- Bootstrap js-->
<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> --}}

<!-- Internal Chart.Bundle js-->
{{-- <script src="{{ asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script> --}}

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
{{-- <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('assets/plugins/morris.js/morris.min.js') }}"></script> --}}

<!-- Circle Progress js-->
{{-- <script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>
<script src="{{ asset('assets/js/chart-circle.js') }}"></script> --}}

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
{{-- <script src="{{ asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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

    // var personalChart = document.getElementById("personalChart");
    var personalChart = $('#personalChart')[0];
    var personalData = {
        labels: ["Sistem Proteksi", "Pengaturan Daya Dan Eksitasi", "Perencanaan Dan Pengendalian Operasi", "Optimalisasi Operasi PLTGU", "Analisa Air Pembangkit"],
        datasets: [
            {
                label: "Sistem Proteksi",
                backgroundColor: "rgba(200,0,0,0.2)",
                data: [65, 75, 70, 80, 60]
            },
            {
                label: "Pengaturan Daya Dan Eksitasi",
                backgroundColor: "rgba(0,0,200,0.2)",
                data: [54, 65, 60, 70, 70]
            },
            {
                label: "Perencanaan Dan Pengendalian Operasi",
                backgroundColor: "rgba(76,255,0, 0.2)",
                data: [20, 50, 80, 90, 10]
            },
            {
                label: "Optimalisasi Operasi PLTGU",
                backgroundColor: "rgba(255,180,0,0.2)",
                data: [15, 40, 20, 40, 90]
            },
            {
                label: "Analisa Air Pembangkit",
                backgroundColor: "rgba(255,600,0,0.2)",
                data: [15, 40, 20, 40, 90]
            },
        ]
    };

    var radarPersonalChart = new Chart(personalChart, {
        type: 'radar',
        data: personalData
    });

    // var teamChart = document.getElementById("teamCanvasChart");
    var teamChart = $('#teamChart')[0];
    var teamData = {
        labels: ["Sistem Proteksi", "Pengaturan Daya Dan Eksitasi", "Perencanaan Dan Pengendalian Operasi", "Optimalisasi Operasi PLTGU", "Analisa Air Pembangkit"],
        datasets: [
            {
                label: "Fawwaz Hudzalfah Saputra",
                backgroundColor: "rgba(200,0,0,0.2)",
                data: [65, 75, 70, 80, 60]
            },
            {
                label: "Agus Wijayanto",
                backgroundColor: "rgba(0,0,200,0.2)",
                data: [54, 65, 60, 70, 70]
            },
            {
                label: "Udin Syarifudin",
                backgroundColor: "rgba(76,255,0, 0.2)",
                data: [20, 50, 80, 90, 10]
            },
            {
                label: "Jonathan Hasyim",
                backgroundColor: "rgba(255,180,0,0.2)",
                data: [15, 40, 20, 40, 90]
            },
        ]
    };

    var radarTeamChart = new Chart(teamChart, {
        type: 'radar',
        data: teamData
    });


    $('#fileSlider').on('change', function(){
        var value = $(this).val().replace(/C:\\fakepath\\/i, '');

        $('#textFileSlider').val(value).trigger('change');
    });
</script>
