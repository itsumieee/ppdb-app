<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran PPDB</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
</head>
<body>
    <div style="text-align: center; padding: 50px; font-family: Arial, sans-serif;">
        <h3>⏳ Mengalihkan ke halaman pembayaran...</h3>
        <p>Jangan tutup jendela ini.</p>
    </div>
    <script>
        window.onload = function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    window.location.href = "{{ route('student.payment.status', $payment->id) }}?status=success";
                },
                onPending: function(result) {
                    window.location.href = "{{ route('student.payment.status', $payment->id) }}?status=pending";
                },
                onError: function(result) {
                    alert("Pembayaran gagal. Silakan coba lagi.");
                    window.location.href = "{{ route('student.payment.status', $payment->id) }}?status=error";
                },
                onClose: function() {
                    alert("Anda menutup jendela pembayaran.");
                    window.location.href = "{{ route('student.payment.status', $payment->id) }}?status=pending";
                }
            });
        };
    </script>
</body>
</html>