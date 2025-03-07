@component('mail::message')
# طلب خطوبة جديد

لقد تقدم {{ $sender->name }} بطلب للارتباط بك.

@component('mail::button', ['url' => route('marriage-requests.respond', $request->id)])
عرض التفاصيل والرد
@endcomponent

شكراً لاستخدامك منصة زواج المودة
@endcomponent