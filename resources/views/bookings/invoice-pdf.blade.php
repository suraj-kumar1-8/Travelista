<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice - {{ $booking->booking_reference }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
            font-weight: bold;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                TRAVELISTA
                            </td>
                            <td class="text-right">
                                Invoice #: {{ $booking->invoice->invoice_number ?? 'INV-PENDING' }}<br>
                                Reference: {{ $booking->booking_reference }}<br>
                                Created: {{ now()->format('F j, Y') }}<br>
                                Status: {{ strtoupper($booking->status) }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Travelista Platform, Inc.<br>
                                123 Luxury Avenue<br>
                                New Delhi, India 110001
                            </td>
                            <td class="text-right">
                                <strong>Customer:</strong><br>
                                {{ $booking->user->name }}<br>
                                {{ $booking->user->email }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Description</td>
                <td class="text-right">Price</td>
            </tr>

            <tr class="item">
                <td>
                    <strong>{{ $booking->bookable->name }}</strong><br>
                    {{ $booking->travelers }} Travelers <br>
                    Date: {{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}
                </td>
                <td class="text-right">
                    INR {{ number_format($booking->subtotal ?? $booking->total_price, 2) }}
                </td>
            </tr>

            @if($booking->discount_amount)
            <tr class="item">
                <td>Discount ({{ $booking->coupon_code ?? 'Promo' }})</td>
                <td class="text-right">- INR {{ number_format($booking->discount_amount, 2) }}</td>
            </tr>
            @endif

            @if($booking->invoice)
            <tr class="item">
                <td>Subtotal</td>
                <td class="text-right">INR {{ number_format($booking->invoice->subtotal, 2) }}</td>
            </tr>
            <tr class="item last">
                <td>Tax (18% GST incl.)</td>
                <td class="text-right">INR {{ number_format($booking->invoice->tax_amount, 2) }}</td>
            </tr>
            @endif

            <tr class="total">
                <td></td>
                <td class="text-right">
                    Total: INR {{ number_format($booking->invoice->total_amount ?? $booking->total_price, 2) }}
                </td>
            </tr>
        </table>

        @if($booking->itineraries && $booking->itineraries->count())
        <h3 style="margin-top: 30px;">Itinerary</h3>
        <table cellpadding="0" cellspacing="0">
            @foreach($booking->itineraries as $itinerary)
            <tr class="item">
                <td>
                    <strong>Day {{ $itinerary->day_number }}:</strong> {{ $itinerary->title }}
                    @if($itinerary->description)
                        <div style="font-size: 12px; color: #666;">{{ $itinerary->description }}</div>
                    @endif
                </td>
                <td class="text-right">Planned</td>
            </tr>
            @endforeach
        </table>
        @endif
        
        <p style="margin-top: 50px; font-size: 12px; color: #777; text-align: center;">
            Thank you for booking with Travelista. This is a computer generated invoice and requires no signature.
        </p>
    </div>
</body>
</html>
