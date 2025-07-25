@if($receivedRequests->count() > 0)
<div class="bg-white rounded-xl shadow-lg p-6 border border-purple-100 transition-all hover:shadow-xl">
    <div class="flex items-center gap-3 mb-4">
        <i class="fas fa-inbox text-purple-600 text-xl"></i>
        <h3 class="text-xl font-semibold text-gray-800">الطلبات المقدمة لك</h3>
    </div>
    <div class="space-y-4">
        @foreach($receivedRequests as $request)
        <div class="space-y-3 border-b pb-2">
            <x-marriage-requests.request-info :request="$request" />

            @if($request->status === 'approved' && $request->compatibility_test_link &&
            ((auth()->user()->gender === 'male' && !$request->exam->male_finished) ||
            (auth()->user()->gender === 'female' && !$request->exam->female_finished)))
            <div class="flex flex-wrap justify-between items-center gap-4">
                <p class="mt-2 text-gray-700">
                    يجب عليك تقديم اختبار التوافق الزواجي لمعرفة مدى التوافق بينك وبين الطرف الآخر
                </p>

                <div style="text-align: end; margin: 5px 0;">
                    <a href="{{ $request->compatibility_test_link }}"
                        style="display: inline-block; padding: 8px 18px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                        رابط المقياس
                    </a>
                </div>
            </div>
            @endif

            @if(Auth::check() && Auth::id() === $request->target_user_id && $request->status === 'pending')
            <x-marriage-requests.response-buttons :request="$request" />
            @endif

            @if(Auth::check() && Auth::id() === $request->target_user_id && ($request->status === 'approved' ||
            $request->status === 'pending'))
            <x-user-info-card :user="$request->user" :link="$request->compatibility_test_link" />
            @endif
        </div>
        @endforeach
    </div>
</div>
@else
<div class="bg-white rounded-xl shadow-lg p-6 border border-purple-100 text-center">
    <div class="flex justify-center text-6xl text-purple-200 mb-4">
        <i class="fas fa-inbox"></i>
    </div>
    <h3 class="text-xl font-semibold text-gray-800 mb-2">لم يتم استلام أي طلبات حالياً</h3>
</div>
@endif