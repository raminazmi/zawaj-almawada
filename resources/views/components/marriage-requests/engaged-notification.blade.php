<div class="bg-green-100 text-green-700 p-4 rounded-lg mb-8 text-center">
    <p>تمت خطوبتك بالفعل مع
        @if(Auth::user()->activeMarriageRequest)
        {{ Auth::user()->activeMarriageRequest->target->name ?? 'غير محدد' }}
        @elseif(Auth::user()->targetMarriageRequest)
        {{ Auth::user()->targetMarriageRequest->user->name ?? 'غير محدد' }}
        @else
        غير محدد
        @endif
        ولا يمكنك تقديم طلبات جديدة.
    </p>
</div>