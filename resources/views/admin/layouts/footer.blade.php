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
<script src="{{asset('assets/backend/assets/js/app.js')}}"></script>


<script src="{{asset('assets/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/js/jquery.timepicker.min.js')}}"></script>


<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>p
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- include summernote css/js -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('.summernote').summernote({
      tabsize: 2,
      height: 120,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });

    $('.select2').select2();
  </script>

@if(session('success'))
<script>
    Swal.fire({
 
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
