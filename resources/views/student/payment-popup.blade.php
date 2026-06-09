<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
</head>
<body>
<script>
    snap.pay('{{ $payment->snap_token }}', {
        onSuccess: function(result) {
            window.location.href = "{{ route('student.payment.status', $payment->id) }}?status=success";
        },
        onPending: function(result) {
            window.location.href = "{{ route('student.payment.status', $payment->id) }}?status=pending";
        },
        onError: function(result) {
            alert("Payment failed");
            window.location.href = "{{ route('student.payment.status', $payment->id) }}?status=error";
        },
        onClose: function() {
            window.location.href = "{{ route('student.payment.status', $payment->id) }}?status=pending";
        }
    });
</script>
</body>
</html>