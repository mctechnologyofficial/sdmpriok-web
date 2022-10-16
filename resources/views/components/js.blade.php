<!-- Jquery js-->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

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

<!-- chart Script -->
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


</script>

<!-- editable script -->
<script>
    $('#fileSlider').on('change', function(){
        var value = $(this).val().replace(/C:\\fakepath\\/i, '');

        $('#textFileSlider').val(value).trigger('change');

        // $('#textFileSlider').on('change', function(){
        //     $('#image').hide();
        // });
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
    var valueCompetencyOp;
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    function createOption(response){
        var len = 0;
        $("#lesson").find('option:not(:first)').remove();

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

    function createValue(response){
        var len = 0;
        // $("#lesson").find('option:not(:first)').remove();
        $('#idcompetency').empty();

        if(response['data'] != null){
            len = response['data'].length;
        }

        if(len > 0){
            for(var i = 0; i < len; i++){
                var id =response['data'][i].id;
                $('#idcompetency').val(id);
                // $("#lesson").append($('<option>', {
                //     value: lesson,
                //     text: lesson
                // }));
            }
        }else{
            // var opt = "<option value='' selected disabled>Choose lesson</option>";
            // $("#lesson").empty().append(opt).trigger('change');
            $('#idcompetency').val('');
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

            // $('#tblOperatorQuestion').DataTable({
            //     // processing: true,
            //     // serverSide: true,
            //     bDestroy: true,
            //     columns: [
            //         {data: id},
            //         {data: competency},
            //         {data: lesson},
            //         {data: reference},
            //         {data: lesson_plan},
            //         {data: processing_time},
            //         {data: realization},
            //     ],
            // });

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
        valueCompetencyOp = $(this).text();
        $.ajax({
            url: '/operator/competency-tools/getlesson',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                competency: valueCompetencyOp
            },
            dataType: 'json',
            success: function(response){
                // createRows(response);
                createOption(response);
            }
        });

        $.ajax({
            url: '/operator/competency-tools/getIdCompetency',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                competency: valueCompetencyOp
            },
            dataType: 'json',
            success: function(response){
                createValue(response);
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
            $('#competency').val(valueCompetencyOp);
            $('#textlesson').val($('#lesson').val());
            $('#answerOperatorModal').modal('show');
            $('#questionid').val(id);
        }

    });
</script>
