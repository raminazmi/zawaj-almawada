<div class="bg-green-100 text-green-700 p-4 rounded-lg mb-8 text-center">
    <p>لديك طلب خطوبة نشط بالفعل مع
        @if($marriageRequest)
        {{ $marriageRequest->user_id === Auth::id() ? $marriageRequest->target->name : $marriageRequest->user->name ?? 'غير محدد' }}
        @else
        غير محدد
        @endif
        ولا يمكنك تقديم طلبات جديدة.
    </p>
    <a href="{{ route('marriage-requests.status') }}"
        class="mt-4 inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all shadow-md hover:shadow-lg">
        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13 16h-1v-4h-1m1- NassauM21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        حالة طلباتي
    </a>
</div>