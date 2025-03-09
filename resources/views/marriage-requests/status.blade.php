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
                            'bg-green-100 text-green-800' => $request->status === 'engaged',
                            ])>
                            @if($request->status === 'pending') قيد المراجعة من قبل الادمن@endif
                            @if($request->status === 'approved') بانتظار رد الطرف الثاني@endif
                            @if($request->status === 'rejected') مرفوض @endif
                            @if($request->status === 'engaged') مكتمل @endif
                        </span>
                    </p>
                </div>
            </div>
            @else
            @if(Auth::user()->status === 'engaged' || Auth::user()->status === 'pending')
            @if(Auth::user()->status === 'engaged')
            <div class="mt-4 flex justify-center gap-4">
                <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-8 text-center max-w-2xl mx-auto">
                    <p>أنت متزوج بالفعل من {{
                        Auth::user()->activeMarriageRequest()
                        ? Auth::user()->activeMarriageRequest()->target->name
                        : Auth::user()->targetMarriageRequest()->user->name
                        }} ولا يمكنك تقديم طلبات جديدة.</p>
                </div>
            </div>
            @else
            <div class="mt-4 flex justify-center gap-4">
                <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-8 text-center max-w-2xl mx-auto">
                    <p class="text-lg">
                        لديك طلب بالفعل من {{
                        Auth::user()->activeMarriageRequest()
                        ? Auth::user()->activeMarriageRequest()->target->name
                        : Auth::user()->targetMarriageRequest()->user->name
                        }} ولا يمكنك تقديم طلبات جديدة.
                    </p>
                </div>
            </div>
            @endif
            @endif
            @if(Auth::user()->status === 'available')
            <div class="bg-white rounded-xl shadow-lg p-6 border border-purple-100 text-center">
                <div class="flex justify-center text-6xl text-purple-200 mb-4">
                    <i class="fas fa-file-circle-question"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">لا يوجد
                    طلبات مرفوعة حالياً</h3>
                <p class="text-gray-600">يمكنك البدء بإنشاء طلب جديد من خلال:</p>
                <div class="mt-4 flex justify-center gap-4">
                    <a href="{{ route('marriage-requests.boys') }}"
                        class="flex items-center px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all shadow-md hover:shadow-lg">
                        <i class="fas fa-male ml-2"></i>طلب للشباب
                    </a>
                    <a href="{{ route('marriage-requests.girls') }}"
                        class="flex items-center px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all shadow-md hover:shadow-lg">
                        <i class="fas fa-female ml-2"></i>طلب للفتيات
                    </a>
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
                            <span class="badge bg-purple-100 text-purple-800">
                                {{ $targetRequest->request_number}}
                            </span>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 mt-2">
                            <span class="font-medium text-gray-600">المرسل:</span>
                            <span class="text-gray-800">{{ $targetRequest->user->name }}</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 mt-2">
                            <p class="flex items-center gap-2">
                                <span class="font-medium text-gray-600">الحالة:</span>
                                <span @class([ 'px-2 py-1 rounded-full text-sm' , 'bg-yellow-100 text-yellow-800'=>
                                    $targetRequest->status === 'pending',
                                    'bg-blue-100 text-blue-800' => $targetRequest->status === 'approved',
                                    'bg-red-100 text-red-800' => $targetRequest->status === 'rejected',
                                    'bg-green-100 text-green-800' => $targetRequest->status === 'engaged',
                                    ])>
                                    @if($targetRequest->status === 'pending') قيد المراجعة من قبل الادمن@endif
                                    @if($targetRequest->status === 'approved') بانتظار ردك@endif
                                    @if($targetRequest->status === 'rejected') مرفوض @endif
                                    @if($targetRequest->status === 'engaged') مكتمل @endif
                                </span>
                            </p>
                        </div>
                    </div>

                    @if($targetRequest->status === 'approved')
                    <div class="flex flex-wrap gap-4 justify-end">
                        <form method="POST" action="{{ route('marriage-requests.respond', $targetRequest->id) }}"
                            class="w-full md:w-auto">
                            @csrf
                            <div class="flex flex-col md:flex-row gap-3">
                                <button type="submit" name="action" value="accept"
                                    class="flex items-center px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all shadow-md hover:shadow-lg">
                                    <i class="fas fa-check-circle ml-2"></i>
                                    <span>قبول الطلب</span>
                                </button>
                                <button type="submit" name="action" value="reject"
                                    class="flex items-center px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all shadow-md hover:shadow-lg">
                                    <i class="fas fa-times-circle ml-2"></i>
                                    <span>رفض الطلب</span>
                                </button>
                            </div>
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