@extends('layouts.general')

@section('content')
<div class="modal fade" id="infoStatus" tabindex="-1" aria-labelledby="infoStatus" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fs-3" id="infoStatusLabel">{{__('Information about your status')}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body table-responsive">
          <table class="table">
            <thead>
                <th>STATUS</th>
                <th>{{__('DESCRIPTION')}}</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {!!invoiceStatus('waiting_payment')!!}
                    </td>
                    <td>
                        {{__('Your order is waiting your payment confirmation')}}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!!invoiceStatus('waiting_confirmation')!!}
                    </td>
                    <td>
                        {!!wordwrap(__('You was confirmed your payment, but admin still not confirmed your payment. Please wait for confirmation'),60,"<br>")!!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!!invoiceStatus('confirmed')!!} / {!!invoiceStatus('waiting_pickup')!!}
                    </td>
                    <td>
                        {!!wordwrap(__('Your payment was confirmed by admin. You can pick up your order'),60,"<br>")!!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!!invoiceStatus('on_going')!!}
                    </td>
                    <td>
                        {!!wordwrap(__('you are currently on rent'),60,"<br>")!!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!!invoiceStatus('cancelled')!!}
                    </td>
                    <td>
                        {{__('Your order was cancelled by admin')}}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!!invoiceStatus('finished')!!}
                    </td>
                    <td>
                        {{__('Your order was finished')}}
                    </td>
                </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


    @include('invoice-only')
@endsection


@section('js')
<script>
    function paymentMethodChange()
    {
        let paymentMethod = $('#payment_method').val();
        let DataId = $('#payment_method option:selected').attr('data-id');
        let idPayment = DataId.replace('metot_','');
        let metotArea = $('#metotArea');
        $.ajax({
            url: '/api/payment-method/'+ idPayment,
            type: 'GET',
            dataType: 'json',
            beforeSend: function()
            {
                metotArea.html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
            },
            success:function(data)
            {
                metotArea.html(`<img src="${data.icon}" class="img-fluid" alt="${data.name}" style="max-width:130px;height:autoo;"><br><br><b>${data.description}</b>`);
            },error:function(data)
            {
                window.location.reload();
            }
        });
    }
</script>
@endsection