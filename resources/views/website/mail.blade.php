
  <table class="table">
    <!-- Table head -->
    <thead>
        <th scope="col">Index</th>
        <th scope="col">Product</th>
        <th scope="col">Price</th>
        <th scope="col">Quantity</th>
        <th scope="col">Amount</th>
    </thead>
    <tbody>
      @php $i=1; @endphp
      @foreach($cart->items as $product)
      <tr>
        <td> {{ $i++ }}</td>
        <td>{{ $product['name'] }}</td>
        <td> {{ $product['price'] }}</td>
        <td>{{ $product['qty'] }}</td>
        <td>{{ $product['price']*$product['qty'] }}</td>
      </tr>
      @endforeach

      <tr><td>Total Amount : {{ $cart->totalPrice }} Taka</td></tr>
      <tr>Please Click the link to view all of your orders. <a href="{{url('/orders')}}">Click Here</a></tr>
    </tbody>
  </table>