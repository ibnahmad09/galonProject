@extends('layouts.customer')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6">Pembayaran Midtrans</h2>
    <p>Silakan selesaikan pembayaran pesanan Anda melalui Midtrans.</p>
    <button id="pay-button" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mt-4">Bayar Sekarang</button>
    <form id="finish-form" action="{{ route('customer.order.history') }}" method="GET" style="display:none;"></form>
</div>
<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function () {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                // Redirect ke riwayat pesanan
                document.getElementById('finish-form').submit();
            },
            onPending: function(result){
                document.getElementById('finish-form').submit();
            },
            onError: function(result){
                alert('Pembayaran gagal. Silakan coba lagi.');
            },
            onClose: function(){
                alert('Anda menutup popup pembayaran tanpa menyelesaikan pembayaran');
            }
        });
    };
</script>
@endsection
