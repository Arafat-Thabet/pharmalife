@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.checkout.onepage.title') }}
@stop

@section('content-wrapper')

<section class="row justify-content-center mt-5">
    <div class="col-md-10">
<div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Your cart</span>
        <span class="badge badge-secondary badge-pill">3</span>
      </h4>
      <ul class="list-group mb-3">
        @foreach ($cart->items as $key => $item)
        @php
           /* $productBaseImage = $item->product->getTypeInstance()->getBaseImage($item);

            if (is_null ($item->product->url_key)) {
                if (! is_null($item->product->parent)) {
                    $url_key = $item->product->parent->url_key;
                }
            } else {
                $url_key = $item->product->url_key;
            }*/
            $productBaseImage = $item->product->getTypeInstance()->getBaseImage($item);
            // dd($productBaseImage['small_image_url']);
        @endphp

        <li class="list-group-item d-flex justify-content-between lh-condensed">
        @php
        $url_key = '#';
        if (is_null ($item->product->url_key)) {
                if (! is_null($item->product->parent)) {
                    $url_key = $item->product->parent->url_key;
                }
            } else {
                $url_key = $item->product->url_key;
            }
            if(isset($productBaseImage['small_image_url']) && !empty($productBaseImage['small_image_url']))
            {
               echo'<a href="'. url($url_key) .'"><img  width="40" height="40" src="'.$productBaseImage['small_image_url'].'" alt=""></a>';
            }
            @endphp
            <div>
            <h6 class="my-0">{{$item->product->name}}</h6>
            <small class="text-muted">
                @if ($item->product->getTypeInstance()->showQuantityBox() === true)

                   {{$item->quantity}}

            @endif
        </small>
          </div>
          <span class="text-muted">{{ core()->currency($item->base_price*$item->quantity) }}
        </span>
        </li>
        @endforeach

      </ul>

    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">{{ __('shop::app.checkout.onepage.send-order') }}</h4>
      <form method="POST" action="{{ route('shop.checkout.save-full-order') }}" class="needs-validation" >
      {{ csrf_field() }}
    

        <input type="hidden" name="company_name">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">
              {{ __('shop::app.checkout.onepage.first-name') }}
            </label>
            <input name="first_name" type="text" class="form-control" id="firstName" placeholder="" value="" required="">
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">{{ __('shop::app.checkout.onepage.last-name') }}</label>
            <input name="last_name"  type="text" class="form-control" id="lastName" placeholder="" value="" required="">
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <label for="lastName">{{ __('shop::app.checkout.onepage.city') }}</label>
            <input name="city"  type="text" class="form-control" id="city" placeholder="" value="" >
            <div class="invalid-feedback">
              Valid city is required.
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <label for="address1">{{ __('shop::app.checkout.onepage.address1') }}</label>
            <input name="address1"  type="text" class="form-control" id="address1" placeholder="" value="" >
            <div class="invalid-feedback">
              Valid address1 is required.
            </div>
          </div>
   
        </div>

       

        <div class="mb-3">
          <label for="email">{{ __('shop::app.checkout.onepage.email') }}</label>
          <input name="email" type="email" class="form-control" id="email" placeholder="you@example.com">
          <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
          </div>
        </div>

        <div class="mb-3">
          <label for="phone">{{ __('shop::app.checkout.onepage.phone') }}</label>
          <input name="phone" type="text" class="form-control" id="phone"  required="">
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>

  

        <div class="row">
          <div class="col-md-5 mb-3 d-none">
            <label for="country">Country</label>
            <select name="country" class="custom-select d-none w-100" id="country" required="">
              <option value="YE">yemen</option>
          
            </select>
         
          </div>
          <div class="col-md-4 mb-3 d-none">
            <label for="state">State</label>
            <select name="state" class="custom-select d-block w-100" id="state" >
              <option value="">Choose...</option>
             
            </select>
            <div class="invalid-feedback">
              Please provide a valid state.
            </div>
          </div>
          <div class="col-md-3 mb-3 d-none">
            <label for="zip">Zip</label>
            <input name="postcode" type="text" value="" class="form-control" id="zip" placeholder="" >
            <div class="invalid-feedback">
              Zip code required.
            </div>
          </div>
        </div>
    
        
        <div class="row">
          <div class="col-md-5 mb-3 ">
        <button class="btn btn-primary btn-lg btn-block" type="submit">{{ __('shop::app.checkout.onepage.send-order') }}</button>
        </div>
        </div>
      </form>
    </div>
  </div>
</div>
</section>

@endsection