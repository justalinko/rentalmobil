@extends('layouts.general')

@section('content')
<!-- modal -->

    @include('invoice-only')
@endsection


@section('js')
<script>
    function paymentMethodChange()
    {
        let paymentMethod = $('#payment_method').val();
        let DataId = $('#payment_method option:selected').attr('data-id');

        $('#'+DataId).show(100);
    }
    $(document).ready(function(){

    });
</script>
@endsection