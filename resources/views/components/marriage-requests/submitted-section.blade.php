@if($submittedRequests->count() > 0)
<div class="bg-white rounded-xl shadow-lg p-6 border border-purple-100 transition-all hover:shadow-xl">
    <div class="flex items-center gap-3 mb-4">
        <i class="fas fa-paper-plane text-blue-600 text-xl"></i>
        <h3 class="text-xl font-semibold text-gray-800">الطلبات التي قمت بتقديمها</h3>
    </div>
    <div class="space-y-4">
        @foreach($submittedRequests as $request)
        <div class="space-y-3 border-b pb-2">
            <x-marriage-requests.request-info :request="$request" />

            @if($request->status === 'approved' && $request->compatibility_test_link)
            <div style="text-align: end; margin: 5px 0;">
                <a href="{{ $request->compatibility_test_link }}"
                    style="display: inline-block; padding: 8px 18px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                    رابط المقياس
                </a>
            </div>
            @endif
        </div>

        @if(Auth::check() && Auth::id() === $request->user_id && ($request->status === 'approved' || $request->status
        === 'pending'))
        <x-target-info-card :target="$request->target" :link="$request->compatibility_test_link" />
        @endif
        @endforeach
    </div>
</div>
@else
<div class="bg-white rounded-xl shadow-lg p-6 border border-purple-100 text-center">
    <div class="flex justify-center text-6xl text-blue-200 mb-4">
        <i class="fas fa-paper-plane"></i>
    </div>
    <h3 class="text-xl font-semibold text-gray-800 mb-2">لم تقم بتقديم أي طلبات حالياً</h3>
</div>
@endif