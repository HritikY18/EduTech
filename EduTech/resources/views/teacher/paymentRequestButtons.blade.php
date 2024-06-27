<a href="{{ route('payment.update', ['payment' => $payment, 'action' => 'accept']) }}" class="btn btn-success btn-sm">Accept</a>
<a href="{{ route('payment.update', ['payment' => $payment, 'action' => 'decline']) }}" class="btn btn-danger btn-sm">Decline</a>
