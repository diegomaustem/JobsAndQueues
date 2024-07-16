<h2 style="color:#34C38F;">Payment Confirmed</h2></br>
<h3 class="texto-normal"><strong>Hello, we confirm your payment</strong></h3>

<p style="color:#5E5E5E;"><strong>Client code:</strong> {{ $payment->id_client }}</p>
<p style="color:#5E5E5E;"><strong>Document:</strong> {{ $payment->document }}</p>
<p style="color:#5E5E5E;"><strong>Description:</strong> {{ $payment->description }}</p>
<p style="color:#5E5E5E;"><strong>Price:</strong> {{ $payment->price }}</p>
<p style="color:#5E5E5E;"><strong>Status:</strong> {{ $payment->status }}</p>


