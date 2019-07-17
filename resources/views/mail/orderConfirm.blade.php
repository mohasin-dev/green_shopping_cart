<style>

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }


        </style>
    </head>

    <body>
        <div class="invoice-box">
            <table cellpadding="15" cellspacing="0">
                <tbody>
                    @php
                        $user_id = App\Order::where('id', $sale_id)->first()->user_id;
                        $sale_info = App\Order::where('id', $sale_id)->first();
                        $user_info = App\User::where('id', $user_id)->first();
                        $sale_details_info = App\OrderDetail::where('order_id', $sale_id)->get();
                        $billing_upazila_info = App\Upazila::where('id', $user_info->upazila_id)->first();
                        $shipping_upazila_info = App\Upazila::where('id', $sale_info->upazila_id)->first();
                        $shipping_district_info = App\District::where('id', $sale_info->district_id)->first();
                    @endphp
                <tr>
                    <td colspan="2"><br>
                        <h5>Billing Address</h5>
                        Customer Name: {{ $user_info->name }} {{ $user_info->last_name }}<br>
                        Customer Email: {{ $user_info->email }}<br>
                        Customer Mobile: {{ $user_info->mobile_number }}<br>
                        Customer Address: {{ $user_info->address }}<br>

                        Customer Upazila:
                        @if ($billing_upazila_info)
                        {{ $billing_upazila_info->upazila_name }}
                        @endif
                        <br>
                        Customer District:
                        @if ($billing_upazila_info)
                        {{ App\District::findOrFail($billing_upazila_info->district_id)->first()->district_name }}
                        @endif
                        <br>
                    </td>
                    <td colspan="3">
                        <h5>Shipping Address</h5>
                        Invoice No: GHB{{ $sale_id }}<br>
                        Date: {{ \Carbon\Carbon::now()->format('d/m/Y')}}<br>
                        Customer Name: {{ $sale_info->name }}<br>
                        Customer Email: {{ $sale_info->email }}<br>
                        Customer Mobile: {{ $sale_info->phone }}<br>
                        Customer Address: {{ $sale_info->address }}<br>

                        Customer Upazila:
                        @if ($shipping_upazila_info)
                        {{ $shipping_upazila_info->upazila_name }}
                        @endif
                        <br>
                        Customer District:
                        @if ($shipping_district_info)
                        {{  $shipping_district_info->district_name }}
                        @endif
                        <br>
                    </td>
                </tr>

                <tr>
                    <td>Payment Method:</td>
                    <td>
                        @if ($sale_info->payment_method == 1)
                        Cash In Delevery
                        @elseif($sale_info->payment_method == 2)
                        Bkash | Transaction Number : {{ $sale_info->transaction_number }}
                        @elseif($sale_info->payment_method == 3)
                        Roket | Transaction Number : {{ $sale_info->transaction_number }}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td>
                        Item
                    </td>

                    <td>
                        Quantity
                    </td>

                    <td>
                        Price
                    </td>
                    <td>
                        Subtotal
                    </td>
                </tr>
                @foreach ($sale_details_info as $item)
                <tr class="item">
                        <td>
                            {{ App\Product::find($item->product_id)->product_title }}
                            @isset($item->product->colors)

                                    @php
                                    $color = DB::table('color_product')->where('product_id', $item->product_id)->where('color_id', $item->color)->get();
                                    @endphp
                                    @foreach ($color as $color_id)
                                        ({{ App\Color::find($color_id->color_id)->first()->color_name }})
                                    @endforeach
                            @endisset
                        </td>

                        <td>
                            {{ $item->quantity }}
                        </td>
                        <td>
                                {{ price_format(App\Product::find($item->product_id)->regular_price) }}
                        </td>
                        <td>
                            {{ price_format(App\Product::find($item->product_id)->regular_price * $item->quantity) }}
                        </td>
                    </tr>
                @endforeach
                @if ($sale_info->discount > 0)
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        Coupon Discount (-)
                    </td>
                    <td>: {{ price_format($sale_info->discount) }}</td>
                </tr>
                @endif
                @if ($sale_info->custom_discount > 0)
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                     Special Discount (-)
                    </td>
                    <td>: {{ price_format($sale_info->custom_discount) }}</td>
                </tr>
                @endif
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                       Shipping (+)
                    </td>
                    <td>: {{ price_format(setting()->shipping_cost) }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                       Grand Total
                    </td>
                    <td>: {{ price_format($sale_info->total) }}</td>
                </tr>
                <tbody>
                <tfoot>
                    <tr>
                        <td style="text-align: center;" colspan="4"> <span>{{ setting()->company_name }},</span> <span>Dhaka office: {{ setting()->address1 }}, Barisal office: {{ setting()->address2 }}</span> <span>{{ setting()->mobile_number1 }}, {{ setting()->mobile_number2 }}.</span></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;" colspan="4">
                                <p class="text-center" style="margin-bottom: 5px;">copyright © 2019. Green Hat Bazar | All right reserved </p>
                                <p class="text-center" style="margin-bottom: 0px;">Design &amp; Developed By <a href="http://intezie.com" target="_blank">Intezie Limited</a> | Powered By Creativity &amp; Technology</p>
                            </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </body>
