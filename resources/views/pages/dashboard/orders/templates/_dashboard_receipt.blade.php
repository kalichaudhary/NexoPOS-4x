@extends( 'layout.dashboard' )
@section( 'layout.dashboard.body' )
    <div>
        @include( '../common/dashboard-header' )
        <div id="dashboard-content" class="px-4">
            <div class="page-inner-header mb-4">
                <h3 class="text-3xl text-gray-800 font-bold">{!! sprintf( __( 'Receipt &mdash; %s' ), $order->code ) !!}</h3>
                <p class="text-gray-600">{{ __( 'Order receipt' ) }}</p>
            </div>
            <div class="my-2 w-full mx-auto">                
                <ns-link type="info" href="{{ url( '/dashboard/orders/receipt/' . $order->id . '?dashboard=disabled' ) }}">{{ __( 'Hide Dashboard' ) }}</ns-link>
                @include( 'pages.dashboard.orders.templates._receipt' )
            </div>
        </div>
    </div>
@endsection