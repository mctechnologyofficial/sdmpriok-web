<!-- Jquery js-->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}

<!-- Bootstrap js-->
<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> --}}

<!-- Internal Chart.Bundle js-->
{{-- <script src="{{ asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script> --}}

<!-- Slick js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Select2 js-->
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

<!-- Perfect-scrollbar js -->
<script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

<!-- Sidemenu js -->
<script src="{{ asset('assets/plugins/sidemenu/sidemenu.js') }}"></script>

<!-- Sidebar js -->
<script src="{{ asset('assets/plugins/sidebar/sidebar.js') }}"></script>

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

    $('.slider').slick({
        dots: true,
        infinite: true,
        speed: 500,
        fade: true,
        adaptiveHeight: true,
        autoplay: true,
        autoplaySpeed: 2000,
        swipeToSlide: true,
    });

    // OPERATOR COMPETENCY TOOLS
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    function createOption(response){
        var len = 0;

        if(response['data'] != null){
            len = response['data'].length;
        }

        if(len > 0){
            for(var i = 0; i < len; i++){
                var lesson =response['data'][i].lesson;

                $("#lesson").append($('<option>', {
                    value: lesson,
                    text: lesson
                }));
            }
        }else{
            var opt = "<option value='' selected disabled>Choose lesson</option>";
            $("#lesson").empty().append(opt).trigger('change');
        }
    }

    function createRows(response){
        var len = 0;
        $('#tblOperatorQuestion tbody').empty();

        if(response['data'] != null){
            len = response['data'].length;
        }

        if(len > 0){
            for(var i=0; i < len; i++){
            var id = response['data'][i].id;
            var competency = response['data'][i].competency;
            // var category = response['data'][i].category;
            // var sub_category = response['data'][i].sub_category;
            var lesson = response['data'][i].lesson;
            var reference = response['data'][i].reference;
            var lesson_plan = response['data'][i].lesson_plan;
            var processing_time = response['data'][i].processing_time;
            var realization = response['data'][i].realization;

            var tr_str = "<tr>" +
                "<td class='questionid' style='display: none;'>" + id + "</td>" +
                "<td>" + competency + "</td>" +
                // "<td>" + category + "</td>" +
                // "<td>" + sub_category + "</td>" +
                "<td>" + lesson + "</td>" +
                "<td>" + reference + "</td>" +
                "<td>" + lesson_plan + "</td>" +
                "<td>" + processing_time + "</td>" +
                "<td>" + realization + "</td>" +
            "</tr>";

            $("#tblOperatorQuestion tbody").append(tr_str);
            }
        }else{
            var tr_str = "<tr>" +
            "<td colspan='6' class='text-center'>No record found</td>" +
            "</tr>";

            $("#tblOperatorQuestion tbody").empty().append(tr_str);
        }
    }

    $('.tools-competency-op').on('click', function(){
        var value = $(this).text();
        $.ajax({
            url: '/operator/competency-tools/getlesson',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                competency: value
            },
            dataType: 'json',
            success: function(response){
                // createRows(response);
                createOption(response);
            }
        });
    });

    $('#lesson').on('change', function(){
        var value = $(this).val();
        $.ajax({
            url: '/operator/competency-tools/getquestion',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                lesson: value
            },
            dataType: 'json',
            success: function(response){
                createRows(response);
            }
        });
    });

    $('#tblOperatorQuestion tbody').on('click', 'tr',function(){
        var id = $(this).find('.questionid').html();

        if(id == undefined){
            // alert('oke');
        }else{
            $('#answerOperatorModal').modal('show');
            $('#questionid').val(id);
        }

    });

    // SUPERVISOR COMPETENCY TOOLS
    $('.tools-competency-spv').on('click', function(){
        var value = $(this).text();
        $.ajax({
            url: '/supervisor/competency-tools/getcategory',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                competency: value
            },
            dataType: 'json',
            success: function(response){
                // createRows(response);
                createOptionCategory(response);
            }
        });
    });

    $('#category').on('change', function(){
        var value = $(this).val();
        $.ajax({
            url: '/supervisor/competency-tools/getsubcategory',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                category: value
            },
            dataType: 'json',
            success: function(response){
                // createRows(response);
                createOptionSubCategory(response);
            }
        });
    });

    $('#subcategory').on('change', function(){
        var value = $(this).val();

        $.ajax({
            url: '/supervisor/competency-tools/getquestion',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                subcategory: value
            },
            dataType: 'json',
            success: function(response){
                createRowsSupervisor(response);
                // createOptionSubCategory(response);
            }
        });
    });

    $('#tblSupervisorQuestion tbody').on('click', 'tr',function(){
        var id = $(this).find('.questionid').html();

        if(id == undefined){
            // alert('oke');
        }else{
            $('#answerSupervisorModal').modal('show');
            $('#questionid').val(id);
        }

    });

    function createOptionCategory(response){
        var len = 0;

        if(response['data'] != null){
            len = response['data'].length;
        }

        if(len > 0){
            for(var i = 0; i < len; i++){
                var category =response['data'][i].category;

                $("#category").append($('<option>', {
                    value: category,
                    text: category
                }));
            }
        }else{
            var opt = "<option value='' selected disabled>Choose category</option>";
            $("#category").empty().append(opt).trigger('change');
        }
    }

    function createOptionSubCategory(response){
        var len = 0;

        if(response['data'] != null){
            len = response['data'].length;
        }

        if(len > 0){
            for(var i = 0; i < len; i++){
                var sub_category = response['data'][i].sub_category;

                $("#subcategory").append($('<option>', {
                    value: sub_category,
                    text: sub_category
                }));
            }
        }else{
            var opt = "<option value='' selected disabled>Choose sub category</option>";
            $("#subcategory").empty().append(opt).trigger('change');
        }
    }

    function createRowsSupervisor(response){
        var len = 0;
        $('#tblSupervisorQuestion tbody').empty();

        if(response['data'] != null){
            len = response['data'].length;
        }

        if(len > 0){
            for(var i=0; i < len; i++){
                var id = response['data'][i].id;
                var competency = response['data'][i].competency;
                // var category = response['data'][i].category;
                // var sub_category = response['data'][i].sub_category;
                // var lesson = response['data'][i].lesson;
                var reference = response['data'][i].reference;
                var lesson_plan = response['data'][i].lesson_plan;
                var processing_time = response['data'][i].processing_time;
                var realization = response['data'][i].realization;

                var tr_str = "<tr>" +
                    "<td class='questionid' style='display: none;'>" + id + "</td>" +
                    "<td>" + competency + "</td>" +
                    // "<td>" + category + "</td>" +
                    // "<td>" + sub_category + "</td>" +
                    // "<td>" + lesson + "</td>" +
                    "<td>" + reference + "</td>" +
                    "<td>" + lesson_plan + "</td>" +
                    "<td>" + processing_time + "</td>" +
                    "<td>" + realization + "</td>" +
                "</tr>";

                $("#tblSupervisorQuestion tbody").append(tr_str);
            }
        }else{
            var tr_str = "<tr>" +
            "<td colspan='6' class='text-center'>No record found</td>" +
            "</tr>";

            $("#tblSupervisorQuestion tbody").empty().append(tr_str);
        }
    }
</script>
