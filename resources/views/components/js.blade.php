<!-- Jquery js-->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap js-->
<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
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
<script src="{{ asset('assets/js/table-data.js') }}"></script>

<!-- Modal JS -->
<script src="{{ asset('assets/js/modal.js') }}"></script>

<!-- Chart JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Internal Fileuploads js-->
<script src="../../assets/plugins/fileuploads/js/fileupload.js"></script>
<script src="../../assets/plugins/fileuploads/js/file-upload.js"></script>

<!-- InternalFancy uploader js-->
<script src="../../assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
<script src="../../assets/plugins/fancyuploder/jquery.fileupload.js"></script>
<script src="../../assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
<script src="../../assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
<script src="../../assets/plugins/fancyuploder/fancy-uploader.js"></script>

<!-- editable script -->
<script>
    $('.a-logout').on('click', function(){
        $('.btn-logout').click();
    });
    $('.a-logout-m').on('click', function(){
        $('.btn-logout-m').click();
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
</script>
