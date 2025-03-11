@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">
                حالة طلب الخطوبة
            </h1>
        </div>

        @if(session('info'))
        <div
            class="bg-indigo-100 border-l-4 border-indigo-600 text-indigo-800 p-4 mb-6 rounded-lg shadow-sm flex items-center gap-3">
            <i class="fas fa-info-circle text-indigo-600"></i>
            <p>{{ session('info') }}</p>
        </div>
        @endif

        <div class="space-y-6">
            @if($request)
            <div class="bg-white rounded-xl shadow-lg p-6 border border-purple-100 transition-all hover:shadow-xl">
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-file-alt text-purple-600 text-xl"></i>
                    <h3 class="text-xl font-semibold text-gray-800">طلبك المقدم</h3>
                </div>
                <div class="space-y-3">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="font-medium text-gray-600">رقم الطلب:</span>
                        <span class="badge bg-purple-100 text-purple-800">{{ $request->request_number }}</span>
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="font-medium text-gray-600">المستهدف:</span>
                        <span class="text-gray-800">{{ $request->target->name }}</span>
                    </div>
                    <p class="flex items-center gap-2">
                        <span class="font-medium text-gray-600">الحالة:</span>
                        <span @class([ 'px-2 py-1 rounded-full text-sm' , 'bg-yellow-100 text-yellow-800'=>
                            $request->status === 'pending',
                            'bg-blue-100 text-blue-800' => $request->status === 'approved',
                            'bg-red-100 text-red-800' => $request->status === 'rejected',
                            'bg-green-100 text-green-800' => $request->status === 'engaged' &&
                            !$request->admin_approved,
                            'bg-purple-100 text-purple-800' => $request->status === 'engaged' &&
                            $request->admin_approved,
                            ])>
                            @if($request->status === 'pending') قيد المراجعة من قبل الفتاة @endif
                            @if($request->status === 'approved') بانتظار إرسال رابط المقياس @endif
                            @if($request->status === 'rejected') مرفوض @endif
                            @if($request->status === 'engaged' && !$request->admin_approved) مكتمل، بانتظار الموافقة
                            النهائية @endif
                            @if($request->status === 'engaged' && $request->admin_approved) مكتمل ومعتمد @endif
                        </span>
                    </p>

                    @if($request->status === 'approved' && !$request->compatibility_test_link)
                    <form method="POST" action="{{ route('marriage-requests.submit-test', $request->id) }}"
                        class="mt-4">
                        @csrf
                        <label class="block text-sm font-medium text-gray-700 mb-2">أرسل رابط اختبار المقياس</label>
                        <input type="url" name="compatibility_test_link" required
                            class="w-full p-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('compatibility_test_link') border-red-500 @enderror"
                            placeholder="https://...">
                        @error('compatibility_test_link')<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="mt-2 btn-success">إرسال</button>
                    </form>
                    @elseif($request->status === 'approved' && $request->compatibility_test_link &&
                    !$request->compatibility_test_result)
                    <p class="mt-4 text-gray-600">تم إرسال الرابط، بانتظار نتيجة المقياس من الفتاة</p>
                    @elseif($request->status === 'approved' && $request->compatibility_test_result)
                    <div class="mt-4">
                        <p class="text-gray-600">نتيجة المقياس: {{ $request->compatibility_test_result }}</p>
                        <form method="POST" action="{{ route('marriage-requests.final-approval', $request->id) }}"
                            class="mt-4 space-y-4">
                            @csrf
                            <div class="flex gap-4">
                                <button type="submit" name="action" value="approve" class="btn-success">الموافقة
                                    النهائية</button>
                                <button type="submit" name="action" value="reject" class="btn-danger">رفض
                                    الخطوبة</button>
                            </div>
                            @if($request->status === 'engaged' && !$request->admin_approved)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">أرسل بياناتك</label>
                                <input type="text" name="real_name" required
                                    class="w-full p-3 rounded-lg border border-gray-200"
                                    placeholder="الاسم الثلاثي مع القبيلة">
                                <input type="text" name="village" required
                                    class="w-full p-3 mt-2 rounded-lg border border-gray-200" placeholder="القرية">
                                <input type="text" name="state" required
                                    class="w-full p-3 mt-2 rounded-lg border border-gray-200" placeholder="الولاية">
                                <button type="submit" name="action" value="approve"
                                    class="mt-2 btn-success">إرسال</button>
                            </div>
                            @endif
                            @if($request->status === 'engaged' && $request->admin_approved)
                            <div class="mt-4 bg-green-100 p-4 rounded-lg">
                                <p><strong>البيانات:</strong></p>
                                <p>الاسم: {{ $request->real_name }}</p>
                                <p>القرية: {{ $request->village }}</p>
                                <p>الولاية: {{ $request->state }}</p>
                            </div>
                            @endif
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            @else
            @if(Auth::user()->status !== 'available')
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-8 text-center">
                <p>لديك طلب خطوبة نشط بالفعل مع {{
                    Auth::user()->activeMarriageRequest()
                    ? Auth::user()->activeMarriageRequest()->target->name
                    : Auth::user()->targetMarriageRequest()->user->name
                    }} ولا يمكنك تقديم طلبات جديدة.</p>
            </div>
            @else
            <div class="bg-white rounded-xl shadow-lg p-6 border border-purple-100 text-center">
                <div class="flex justify-center text-6xl text-purple-200 mb-4">
                    <i class="fas fa-file-circle-question"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">لا يوجد طلبات مرفوعة حالياً</h3>
                <p class="text-gray-600">يمكنك البدء بإنشاء طلب جديد من خلال:</p>
                <div class="mt-4 flex justify-center gap-4">
                    <a href="{{ route('marriage-requests.boys') }}" class="btn-primary"><i
                            class="fas fa-male ml-2"></i>طلب للشباب</a>
                    <a href="{{ route('marriage-requests.girls') }}" class="btn-primary"><i
                            class="fas fa-female ml-2"></i>طلب للفتيات</a>
                </div>
            </div>
            @endif
            @endif

            @if($targetRequest)
            <div class="bg-white rounded-xl shadow-lg p-6 border border-purple-100 transition-all hover:shadow-xl">
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                    <h3 class="text-xl font-semibold text-gray-800">الطلبات الواردة</h3>
                </div>
                <div class="space-y-4">
                    <div class="border-b pb-4">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="font-medium text-gray-600">رقم الطلب:</span>
                            <span class="badge bg-purple-100 text-purple-800">{{ $targetRequest->request_number
                                }}</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 mt-2">
                            <span class="font-medium text-gray-600">المرسل:</span>
                            <span class="text-gray-800">{{ $targetRequest->user->name }}</span>
                        </div>
                        <p class="flex items-center gap-2 mt-2">
                            <span class="font-medium text-gray-600">الحالة:</span>
                            <span @class([ 'px-2 py-1 rounded-full text-sm' , 'bg-yellow-100 text-yellow-800'=>
                                $targetRequest->status === 'pending',
                                'bg-blue-100 text-blue-800' => $targetRequest->status === 'approved',
                                'bg-red-100 text-red-800' => $targetRequest->status === 'rejected',
                                'bg-green-100 text-green-800' => $targetRequest->status === 'engaged' &&
                                !$targetRequest->admin_approved,
                                'bg-purple-100 text-purple-800' => $targetRequest->status === 'engaged' &&
                                $targetRequest->admin_approved,
                                ])>
                                @if($targetRequest->status === 'pending') قيد المراجعة من قبلك @endif
                                @if($targetRequest->status === 'approved') بانتظار إرسال نتيجة المقياس @endif
                                @if($targetRequest->status === 'rejected') مرفوض @endif
                                @if($targetRequest->status === 'engaged' && !$targetRequest->admin_approved) مكتمل،
                                بانتظار الموافقة النهائية @endif
                                @if($targetRequest->status === 'engaged' && $targetRequest->admin_approved) مكتمل ومعتمد
                                @endif
                            </span>
                        </p>
                    </div>

                    @if($targetRequest->status === 'pending')
                    <form method="POST" action="{{ route('marriage-requests.respond', $targetRequest->id) }}"
                        class="flex gap-4">
                        @csrf
                        <button type="submit" name="action" value="accept" class="btn-success"><i
                                class="fas fa-check-circle ml-2"></i>قبول</button>
                        <button type="submit" name="action" value="reject" class="btn-danger"><i
                                class="fas fa-times-circle ml-2"></i>رفض</button>
                    </form>
                    @elseif($targetRequest->status === 'approved' && $targetRequest->compatibility_test_link &&
                    !$targetRequest->compatibility_test_result)
                    <form method="POST" action="{{ route('marriage-requests.submit-test-result', $targetRequest->id) }}"
                        class="mt-4">
                        @csrf
                        <label class="block text-sm font-medium text-gray-700 mb-2">أرسل نتيجة المقياس</label>
                        <input type="text" name="compatibility_test_result" required
                            class="w-full p-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 @error('compatibility_test_result') border-red-500 @enderror"
                            placeholder="نتيجة المقياس">
                        @error('compatibility_test_result')<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="mt-2 btn-success">إرسال</button>
                    </form>
                    @elseif($targetRequest->status === 'approved' && $targetRequest->compatibility_test_result)
                    <div class="mt-4">
                        <p class="text-gray-600">نتيجة المقياس: {{ $targetRequest->compatibility_test_result }}</p>
                        <form method="POST" action="{{ route('marriage-requests.final-approval', $targetRequest->id) }}"
                            class="mt-4 space-y-4">
                            @csrf
                            <div class="flex gap-4">
                                <button type="submit" name="action" value="approve" class="btn-success">الموافقة
                                    النهائية</button>
                                <button type="submit" name="action" value="reject" class="btn-danger">رفض
                                    الخطوبة</button>
                            </div>
                            @if($targetRequest->status === 'engaged' && !$targetRequest->admin_approved)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">أرسل بياناتك</label>
                                <input type="text" name="real_name" required
                                    class="w-full p-3 rounded-lg border border-gray-200"
                                    placeholder="الاسم الثلاثي مع القبيلة">
                                <input type="text" name="village" required
                                    class="w-full p-3 mt-2 rounded-lg border border-gray-200" placeholder="القرية">
                                <input type="text" name="state" required
                                    class="w-full p-3 mt-2 rounded-lg border border-gray-200" placeholder="الولاية">
                                <button type="submit" name="action" value="approve"
                                    class="mt-2 btn-success">إرسال</button>
                            </div>
                            @endif
                            @if($targetRequest->status === 'engaged' && $targetRequest->admin_approved)
                            <div class="mt-4 bg-green-100 p-4 rounded-lg">
                                <p><strong>البيانات:</strong></p>
                                <p>الاسم: {{ $targetRequest->real_name }}</p>
                                <p>القرية: {{ $targetRequest->village }}</p>
                                <p>الولاية: {{ $targetRequest->state }}</p>
                            </div>
                            @endif
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            @else
            <div class="bg-white rounded-xl shadow-lg p-6 border border-purple-100 text-center">
                <div class="flex justify-center text-6xl text-blue-200 mb-4">
                    <i class="fas fa-inbox"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">لا توجد طلبات واردة حالياً</h3>
                <p class="text-gray-600">سيظهر هنا أي طلبات جديدة تتلقاها</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .badge {
        @apply px-3 py-1 rounded-full text-sm font-medium;
    }

    .btn-primary {
        @apply px-6 py-2 bg-purple-600 text-white rounded-lg hover: bg-purple-700 transition-all flex items-center;
    }

    .btn-success {
        @apply px-6 py-2 bg-green-600 text-white rounded-lg hover: bg-green-700 transition-all flex items-center;
    }

    .btn-danger {
        @apply px-6 py-2 bg-red-600 text-white rounded-lg hover: bg-red-700 transition-all flex items-center;
    }
</style>
@endpush