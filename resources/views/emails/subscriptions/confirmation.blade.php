@component('mail::message')
# ¡Inscripción confirmada!

Te has inscrito al evento **{{ $event->title }}**  
Fecha: {{ $event->starts_at->format('d/m/Y H:i') }}

Gracias por participar.
@endcomponent