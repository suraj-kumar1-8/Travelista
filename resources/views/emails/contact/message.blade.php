<x-mail::message>
# New Contact Message

You have received a new contact message from TRAVELISTA.

**Name:** {{ $data['name'] }}  
**Email:** {{ $data['email'] }}  
**Submitted Time:** {{ now()->format('Y-m-d H:i:s') }}

**Message:**  
{{ $data['message'] }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
