<footer class="app-footer">
    <div class="container text-center py-3">
              <span class="text-muted">All Rights Reserved &copy; {{date('Y')}} <a href="{{url('/')}}">{!!web_name()!!}</a></span>
    </div>
</footer>
<!--//app-footer-->

</div>
<!--//app-wrapper-->


<!-- Javascript -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="{{asset('assets/backend/assets/plugins/popper.min.js')}}"></script>
<script src="{{asset('assets/backend/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>





<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>p
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title : 'Success',
        text: "{{session('success')}}",
        showConfirmButton: false,
        timer: 3000
    });
</script>
@endif
@if(session('error'))
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'error',
        title : 'Oops...',
        text: "{{session('error')}}",
        showConfirmButton: false,
        timer: 3000
    });
</script>
@endif

@if(session('errors'))
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'error',
        title : 'Oops...',
        text: "{!!session('errors')!!}",
        showConfirmButton: false,
        timer: 3000
    });
</script>
@endif
<script>
$(document).ready(function() {
    $('.datatable').DataTable({
        "order": [[ 0, "desc" ]]
    });
});
</script>


@yield('js')
</body>

</html>
