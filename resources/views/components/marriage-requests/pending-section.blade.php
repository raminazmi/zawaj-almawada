@if($pendingRequests->count() > 0)
<div class="bg-white rounded-xl shadow-lg p-6 border border-purple-100 transition-all hover:shadow-xl">
    <div class="flex items-center gap-3 mb-4">
        <i class="fas fa-hourglass-half text-yellow-600 text-xl"></i>
        <h3 class="text-xl font-semibold text-gray-800">الطلبات المعلقة</h3>
    </div>
    <div class="space-y-4">
        @foreach($pendingRequests as $request)
        <div class="space-y-3 border-b pb-4">
            <x-marriage-requests.request-info :request="$request" />

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
    <div class="flex justify-center text-6xl text-yellow-200 mb-4">
        <i class="fas fa-hourglass-half"></i>
    </div>
    <h3 class="text-xl font-semibold text-gray-800 mb-2">لا توجد طلبات معلقة حالياً</h3>
</div>
@endif