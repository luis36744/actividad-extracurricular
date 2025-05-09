@component('mail::message')
# ¡Te has inscrito!

Te has inscrito al evento **{{ $event->title }}** que empieza el {{ $event->starts_at->format('d/m/Y H:i') }}.

Gracias por participar.

@endcomponent