@extends('partner.layouts.template')

@section('main')
    <form action="/partnercp/payments" method="POST" id='rozer-pay' style="display: block;">
        <!-- Note that the amount is in paise = 50 INR -->
        <!--amount need to be in paisa-->
       @php
      if( request()->payment_type == 'offline'){
     $total = 1770.00;
      }
      else{
        $total = 1770.00;
      
      }
       
       @endphph
        <script src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="rzp_live_eiFoCLNPbiIdeD"
                data-amount={{$total * 100}}
                data-currency="INR"
                data-buttontext=""
                data-name="NSN HOTELS"
                data-description="Cart Payment"
                data-image="{{asset(setting('logo') ? 'uploads/' . setting('logo') : 'assets/images/assets/logo.png')}}"
                data-prefill.name= "{{Auth::user()->name}}"
                data-prefill.email= "{{Auth::user()->email}}"
                data-prefill.contact="{{request()->phone_number}}"
                data-theme.color="#ff7529">
        </script>
        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
    </form>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#rozer-pay').submit()
        });
    </script>
@endpush