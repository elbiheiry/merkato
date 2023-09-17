<x-mail::message>
    إعادة تعيين كلمة المرور

    {{-- Please use this code to reset your password: {{ $details['code'] }} --}}
    تلقينا طلب إعادة تعيين كلمة المرور من حسابك. لإعادة تعيين كلمة المرور، يرجى فتح التطبيق وإدخال الرمز التالي

    رمز إعادة تعيين كلمة المرور الخاص بك هو : {{ $code }}

    مع تحيات,
    {{ config('app.name') }}
</x-mail::message>
