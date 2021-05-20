<ul class="cart-dropdown" id="cartItem">
                          
    <li class="single-product-cart">
        <div class="cart-img">
            <a href="#"><img src="{{ asset('website/img/cart/1.jpg')}}" alt=""></a>
        </div>
        <div class="cart-title">
            <h5><a href="#"> Bits Headphone</a></h5>
            <h6><a href="#">Black</a></h6>
            <span>$80.00 x 1</span>
        </div>
        <div class="cart-delete">
            <a href="#"><i class="ti-trash"></i></a>
        </div>
    </li>
    <li class="cart-space">
        <div class="cart-sub">
            <h4>Subtotal</h4>
        </div>
        <div class="cart-price">
            <h4>$240.00</h4>
        </div>
    </li>
    <li class="cart-btn-wrapper">
        <a class="cart-btn btn-hover" href="#">view cart</a>
        <a class="cart-btn btn-hover" href="#">checkout</a>
    </li>
</ul>



<script>
  var myArray = []

  $.ajax({
    method: 'GET',
    url: 'http://shopcorner.saz/navcart',
    success: (response) => {
        myArray = response.items
        // buildCart(myArray)
        console.log(myArray)
    }
  })

  function buildCart(items) {
    var ul = document.getElementById('cartItem')

    for (var i = 0; i < items.length; i++) {
        var li=`<li class="single-product-cart">
                    <div class="cart-title">
                        <h5><a href="#">${items[i].name}</a></h5>
                        <h6><a href="#">Black</a></h6>
                        <span>${items[i].price} x ${items[i].qty}</span>
                    </div>
                </li>`
      ul.innerHTML += li
    }
  }

</script>