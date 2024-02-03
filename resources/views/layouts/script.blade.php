    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('template/js/ruang-admin.min.js') }}"></script>
    <script src="{{ asset('template/vendor/chart.js/Chart.min.js') }}"></script>


    {{-- Select2U for multiple select --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.inputbox').select2();
        });
    </script>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#dataTableHover').DataTable();

            // Live search as the user types
            $('#searchInput').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Reset button
            $('#resetBtn').on('click', function() {
                $('#searchInput').val('');
                table.search('').draw();
            });
        });
    </script>
