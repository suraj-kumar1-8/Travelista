<x-mail::message>
# Special Offer: {{ $offer->title }}

We have an exciting new offer for you!

**Offer Code:** {{ $offer->code }}
**Discount:** {{ $offer->discount_type === 'fixed' ? '₹'.$offer->discount_value : $offer->discount_value.'%' }}
**Valid Until:** {{ $offer->valid_until->format('d M, Y') }}

{{ $offer->description }}

<x-mail::button :url="url('/offers/' . $offer->slug)">
View Offer
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
