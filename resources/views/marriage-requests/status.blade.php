@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">
                حالة طلبات الخطوبة
            </h1>
        </div>

        @if(session('info'))
        <div
            class="bg-indigo-100 border-l-4 border-indigo-600 text-indigo-800 p-4 mb-6 rounded-lg shadow-sm flex items-center gap-3">
            <i class="fas fa-info-circle text-indigo-600"></i>
            <p>{{ session('info') }}</p>
        </div>
        @endif

        @if(Auth::user()->status === 'engaged')
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-8 text-center">
            <p>تمت خطوبتك بالفعل مع {{
                Auth::user()->activeMarriageRequest()
                ? Auth::user()->activeMarriageRequest()->target->name
                : Auth::user()->targetMarriageRequest()->user->name
                }} ولا يمكنك تقديم طلبات جديدة.</p>
        </div>
        @else
        <div class="space-y-6">
            @if($pendingRequests->count() > 0)
            <div class="bg-white rounded-xl shadow-lg p-6 border border-purple-100 transition-all hover:shadow-xl">
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-hourglass-half text-yellow-600 text-xl"></i>
                    <h3 class="text-xl font-semibold text-gray-800">الطلبات المعلقة (بانتظار الموافقة الإدارية)</h3>
                </div>
                <div class="space-y-4">
                    @foreach($pendingRequests as $request)
                    <div class="space-y-3 border-b pb-4">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="font-medium text-gray-600">رقم الطلب:</span>
                            <span class="badge bg-purple-100 text-purple-800">{{ $request->request_number }}</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="font-medium text-gray-600">المرسل:</span>
                            <span class="text-gray-800">{{ $request->user->name }}</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="font-medium text-gray-600">المستهدف:</span>
                            <span class="text-gray-800">{{ $request->target->name }}</span>
                        </div>
                        <div class="flex items-center gap-2 mt-4">
                            <span class="font-medium text-gray-600">الحالة:</span>
                            @if($request->admin_approval_status === 'approved')
                            <span @class([ 'px-3 py-1 rounded-full text-sm font-medium'
                                , 'bg-green-100 text-green-800'=> $request->admin_approval_status === 'approved',
                                ])>
                                مكتمل ومعتمد
                            </span>
                            @endif
                            @if($request->admin_approval_status === 'rejected')
                            <span @class([ 'px-3 py-1 rounded-full text-sm font-medium' , 'bg-red-100 text-red-800'=>
                                $request->admin_approval_status === 'rejected',
                                ])>
                                مرفوض من الإدارة
                            </span>
                            @endif
                            @if($request->status === 'rejected')
                            <span @class([ 'px-3 py-1 rounded-full text-sm font-medium' , 'bg-red-100 text-red-800'=>
                                $request->status === 'rejected',
                                ])>
                                مرفوض من أحد الطرفين
                            </span>
                            @endif
                            @if($request->status === 'pending')
                            <span @class([ 'px-3 py-1 rounded-full text-sm font-medium'
                                , 'bg-yellow-100 text-yellow-800'=> $request->status === 'pending',
                                ])>
                                قيد المراجعة من قبل أحد الطرفين
                            </span>
                            @endif
                            @if($request->status === 'approved')
                            <span @class([ 'px-3 py-1 rounded-full text-sm font-medium' , 'bg-blue-100 text-blue-800'=>
                                $request->status === 'approved',
                                ])>
                                موافق عليه من الطرفين
                            </span>
                            @endif
                            @if($request->admin_approval_status === 'pending')
                            <span @class([ 'px-3 py-1 rounded-full text-sm font-medium'
                                , 'bg-orange-100 text-orange-800'=> $request->admin_approval_status === 'pending',
                                ])>
                                بانتظار الموافقة النهائية
                            </span>
                            @endif
                        </div>
                        @if(Auth::check() && Auth::id() === $request->target_user_id && $request->status === 'approved')
                        <div class="mt-4 bg-green-100 p-4 rounded-lg">
                            <p><strong>بيانات المرسل:</strong></p>
                            <p>الاسم: {{ $request->user->name ?? 'غير متوفر' }}</p>
                            <p>الولاية: {{ $request->state ?? 'غير متوفر' }}</p>
                            <p>يجب عليك تقديم مقياس التوافق الزواجي لمعرفة مدى التوافق بينك وين شريك حياتك، تقدم من هنا
                                <a href="/dashboard" class="text-blue-500">رابط المقياس</a>
                            </p>
                        </div>
                        @endif
                        @if(Auth::check() && Auth::id() === $request->target_user_id && $request->status === 'pending')
                        <div class="flex gap-3 w-full md:w-auto justify-end">
                            <form method="POST" action="{{ route('marriage-requests.respond', $request->id) }}">
                                @csrf
                                <button type="submit" name="action" value="accept"
                                    class="w-full flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all shadow-md hover:shadow-lg gap-2 text-sm transform hover:scale-[1.02]">
                                    <i class="fas fa-check-circle"></i>
                                    موافق
                                </button>
                            </form>

                            <form method="POST" action="{{ route('marriage-requests.respond', $request->id) }}">
                                @csrf
                                <button type="submit" name="action" value="reject"
                                    class="w-full flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all shadow-md hover:shadow-lg gap-2 text-sm transform hover:scale-[1.02]">
                                    <i class="fas fa-times-circle"></i>
                                    رفض الطلب
                                </button>
                            </form>
                        </div>
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

            @if($submittedRequests->count() > 0)
            <div class="bg-white rounded-xl shadow-lg p-6 border border-purple-100 transition-all hover:shadow-xl">
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-paper-plane text-blue-600 text-xl"></i>
                    <h3 class="text-xl font-semibold text-gray-800">الطلبات التي قمت بتقديمها</h3>
                </div>
                <div class="space-y-4">
                    @foreach($submittedRequests as $request)
                    <div class="space-y-3 border-b pb-4">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="font-medium text-gray-600">رقم الطلب:</span>
                            <span class="badge bg-purple-100 text-purple-800">{{ $request->request_number }}</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="font-medium text-gray-600">المرسل:</span>
                            <span class="text-gray-800">{{ $request->user->name }}</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="font-medium text-gray-600">المستهدف:</span>
                            <span class="text-gray-800">{{ $request->target->name }}</span>
                        </div>
                        <div class="flex items-center gap-2 mt-4">
                            <span class="font-medium text-gray-600">الحالة:</span>
                            @if($request->admin_approval_status === 'approved')
                            <span @class([ 'px-3 py-1 rounded-full text-sm font-medium'
                                , 'bg-green-100 text-green-800'=> $request->admin_approval_status === 'approved',
                                ])>
                                مكتمل ومعتمد
                            </span>
                            @endif
                            @if($request->admin_approval_status === 'rejected')
                            <span @class([ 'px-3 py-1 rounded-full text-sm font-medium' , 'bg-red-100 text-red-800'=>
                                $request->admin_approval_status === 'rejected',
                                ])>
                                مرفوض من الإدارة
                            </span>
                            @endif
                            @if($request->status === 'rejected')
                            <span @class([ 'px-3 py-1 rounded-full text-sm font-medium' , 'bg-red-100 text-red-800'=>
                                $request->status === 'rejected',
                                ])>
                                مرفوض من أحد الطرفين
                            </span>
                            @endif
                            @if($request->status === 'pending')
                            <span @class([ 'px-3 py-1 rounded-full text-sm font-medium'
                                , 'bg-yellow-100 text-yellow-800'=> $request->status === 'pending',
                                ])>
                                قيد المراجعة من قبل أحد الطرفين
                            </span>
                            @endif
                            @if($request->status === 'approved')
                            <span @class([ 'px-3 py-1 rounded-full text-sm font-medium' , 'bg-blue-100 text-blue-800'=>
                                $request->status === 'approved',
                                ])>
                                موافق عليه من الطرفين
                            </span>
                            @endif
                            @if($request->admin_approval_status === 'pending')
                            <span @class([ 'px-3 py-1 rounded-full text-sm font-medium'
                                , 'bg-orange-100 text-orange-800'=> $request->admin_approval_status === 'pending',
                                ])>
                                بانتظار الموافقة النهائية
                            </span>
                            @endif
                        </div>
                    </div>
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

            @if($receivedRequests->count() > 0)
            <div class="bg-white rounded-xl shadow-lg p-6 border border-purple-100 transition-all hover:shadow-xl">
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-inbox text-purple-600 text-xl"></i>
                    <h3 class="text-xl font-semibold text-gray-800">الطلبات المقدمة لك</h3>
                </div>
                <div class="space-y-4">
                    @foreach($receivedRequests as $request)
                    <div class="space-y-3 border-b pb-4">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="font-medium text-gray-600">رقم الطلب:</span>
                            <span class="badge bg-purple-100 text-purple-800">{{ $request->request_number }}</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="font-medium text-gray-600">المرسل:</span>
                            <span class="text-gray-800">{{ $request->user->name }}</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="font-medium text-gray-600">المستهدف:</span>
                            <span class="text-gray-800">{{ $request->target->name }}</span>
                        </div>
                        <div class="flex items-center gap-2 mt-4">
                            <span class="font-medium text-gray-600">الحالة:</span>
                            @if($request->admin_approval_status === 'approved')
                            <span @class([ 'px-3 py-1 rounded-full text-sm font-medium'
                                , 'bg-green-100 text-green-800'=> $request->admin_approval_status === 'approved',
                                ])>
                                مكتمل ومعتمد
                            </span>
                            @endif
                            @if($request->admin_approval_status === 'rejected')
                            <span @class([ 'px-3 py-1 rounded-full text-sm font-medium' , 'bg-red-100 text-red-800'=>
                                $request->admin_approval_status === 'rejected',
                                ])>
                                مرفوض من الإدارة
                            </span>
                            @endif
                            @if($request->status === 'rejected')
                            <span @class([ 'px-3 py-1 rounded-full text-sm font-medium' , 'bg-red-100 text-red-800'=>
                                $request->status === 'rejected',
                                ])>
                                مرفوض من أحد الطرفين
                            </span>
                            @endif
                            @if($request->status === 'pending')
                            <span @class([ 'px-3 py-1 rounded-full text-sm font-medium'
                                , 'bg-yellow-100 text-yellow-800'=> $request->status === 'pending',
                                ])>
                                قيد المراجعة من قبل أحد الطرفين
                            </span>
                            @endif
                            @if($request->status === 'approved')
                            <span @class([ 'px-3 py-1 rounded-full text-sm font-medium' , 'bg-blue-100 text-blue-800'=>
                                $request->status === 'approved',
                                ])>
                                موافق عليه من الطرفين
                            </span>
                            @endif
                            @if($request->admin_approval_status === 'pending')
                            <span @class([ 'px-3 py-1 rounded-full text-sm font-medium'
                                , 'bg-orange-100 text-orange-800'=> $request->admin_approval_status === 'pending',
                                ])>
                                بانتظار الموافقة النهائية
                            </span>
                            @endif
                        </div>
                        @if(Auth::check() && Auth::id() === $request->target_user_id && $request->status === 'pending')
                        <div class="flex gap-3 w-full md:w-auto justify-end">
                            <form method="POST" action="{{ route('marriage-requests.respond', $request->id) }}">
                                @csrf
                                <button type="submit" name="action" value="accept"
                                    class="w-full flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all shadow-md hover:shadow-lg gap-2 text-sm transform hover:scale-[1.02]">
                                    <i class="fas fa-check-circle"></i>
                                    موافقة
                                </button>
                            </form>

                            <form method="POST" action="{{ route('marriage-requests.respond', $request->id) }}">
                                @csrf
                                <button type="submit" name="action" value="reject"
                                    class="w-full flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all shadow-md hover:shadow-lg gap-2 text-sm transform hover:scale-[1.02]">
                                    <i class="fas fa-times-circle"></i>
                                    رفض الطلب
                                </button>
                            </form>
                        </div>
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
        </div>
        @endif
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