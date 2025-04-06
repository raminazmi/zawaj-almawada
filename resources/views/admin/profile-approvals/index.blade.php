@extends('layouts.app')

@section('content')
<section class="min-h-screen">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="text-center mb-12">
            <h2 class="text-2xl font-bold text-purple-800 inline-block relative pb-4">
                <i class="fas fa-user-check ml-3"></i>مراجعة الملفات الشخصية
            </h2>
        </div>

        <div class="mb-12">
            <h3 class="text-xl font-semibold text-purple-700 mb-6 flex items-center gap-2">
                <i class="fas fa-hourglass-half text-purple-600"></i>الملفات المعلقة للموافقة
            </h3>

            <div class="bg-white rounded-2xl shadow-xl border border-purple-100 overflow-hidden">
                @forelse($pendingProfiles as $profile)
                <div class="p-6 border-b border-white-50 bg-white transition-all group">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div class="space-y-2">
                            <div class="flex items-center gap-2 text-purple-600">
                                <i class="fas fa-user"></i>
                                <span class="font-medium">الاسم المستعار:</span>
                                <span class="font-bold">{{ $profile->name }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-envelope text-purple-600"></i>
                                <span class="font-medium">البريد:</span>
                                <span class="text-gray-800">{{ $profile->email }}</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-venus-mars text-purple-600"></i>
                                <span class="font-medium">الجنس:</span>
                                <span class="text-gray-800">{{ $profile->gender == 'male' ? 'ذكر' : 'أنثى' }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-clock text-purple-600"></i>
                                <span class="font-medium">تاريخ التسجيل:</span>
                                <span class="text-gray-600">{{ $profile->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-map-marker-alt text-purple-600"></i>
                                <span class="font-medium">البلد:</span>
                                <span class="text-gray-800">{{ $profile->country ?? 'غير محدد' }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-info-circle text-purple-600"></i>
                                <span class="font-medium">حالة الملف:</span>
                                <span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 text-sm">
                                    بانتظار المراجعة
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="pt-4 flex items-center justify-center">
                        <div class="border-t border-green-200 w-[30%]"></div>
                    </div>
                    <div class="mt-6">
                        <div class="flex flex-wrap gap-4 justify-between items-center">
                            <div class="flex-1 min-w-[200px]">
                                <a href="{{ route('admin.profile-approvals.show', $profile->id) }}"
                                    class="text-purple-600 hover:text-purple-800 flex items-center gap-2">
                                    <i class="fas fa-eye"></i>
                                    عرض التفاصيل الكاملة
                                </a>
                            </div>

                            <div class="flex gap-3 w-full md:w-auto">
                                <form method="POST"
                                    action="{{ route('admin.profile-approvals.approve', $profile->id) }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg 
                                                       hover:bg-green-700 transition-all shadow-md hover:shadow-lg gap-2 text-sm
                                                       transform hover:scale-[1.02]">
                                        <i class="fas fa-check-circle"></i>
                                        الموافقة
                                    </button>
                                </form>

                                <form method="POST"
                                    action="{{ route('admin.profile-approvals.reject', $profile->id) }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg 
                                                       hover:bg-red-700 transition-all shadow-md hover:shadow-lg gap-2 text-sm
                                                       transform hover:scale-[1.02]">
                                        <i class="fas fa-times-circle"></i>
                                        الرفض
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center p-12">
                    <div class="text-6xl text-purple-200 mb-4"><i class="fas fa-inbox"></i></div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">لا توجد ملفات معلقة للمراجعة</h3>
                    <p class="text-gray-600">سيظهر هنا أي ملفات جديدة تحتاج لمراجعتك</p>
                </div>
                @endforelse
            </div>

            @if($pendingProfiles->hasPages())
            <div class="mt-6 px-4">
                {{ $pendingProfiles->links('pagination::tailwind') }}
            </div>
            @endif
        </div>

        <div>
            <h3 class="text-xl font-semibold text-purple-700 mb-6 flex items-center gap-2">
                <i class="fas fa-history text-purple-600"></i>الملفات المعالجة سابقاً
            </h3>

            <div class="bg-white rounded-2xl shadow-xl border border-purple-100 overflow-hidden">
                @forelse($processedProfiles as $profile)
                <div class="p-6 border-b border-purple-50 hover:bg-purple-50 transition-all group">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div class="space-y-2">
                            <div class="flex items-center gap-2 text-purple-600">
                                <i class="fas fa-user"></i>
                                <span class="font-medium">الاسم المستعار:</span>
                                <span class="font-bold">{{ $profile->name }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-envelope text-purple-600"></i>
                                <span class="font-medium">البريد:</span>
                                <span class="text-gray-800">{{ $profile->email }}</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-venus-mars text-purple-600"></i>
                                <span class="font-medium">الجنس:</span>
                                <span class="text-gray-800">{{ $profile->gender == 'male' ? 'ذكر' : 'أنثى' }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-clock text-purple-600"></i>
                                <span class="font-medium">تاريخ المعالجة:</span>
                                <span class="text-gray-600">{{ $profile->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-map-marker-alt text-purple-600"></i>
                                <span class="font-medium">البلد:</span>
                                <span class="text-gray-800">{{ $profile->country ?? 'غير محدد' }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-info-circle text-purple-600"></i>
                                <span class="font-medium">حالة الملف:</span>
                                @if($profile->profile_status === 'approved')
                                <span class="px-2 py-1 rounded-full bg-green-100 text-green-800 text-sm">
                                    معتمد
                                </span>
                                @else
                                <span class="px-2 py-1 rounded-full bg-red-100 text-red-800 text-sm">
                                    مرفوض
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end flex-wrap gap-4 mt-4">
                        <a href="{{ route('admin.profile-approvals.show', $profile->id) }}"
                            class="text-purple-600 hover:text-purple-800 flex items-center gap-2">
                            <i class="fas fa-eye"></i>
                            عرض الملف الشخصي
                        </a>
                        <form method="POST" action="{{ route('admin.profile-approvals.pending', $profile->id) }}"
                            class="flex items-center justify-end p-2">
                            @csrf
                            <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-lg 
                                hover:bg-purple-700 transition-all shadow-md hover:shadow-lg gap-3
                                transform hover:scale-[1.02] flex items-center">
                                <i class="fas fa-undo text-white"></i>
                                <span>التراجع عن الإجراء</span>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="text-center p-12">
                    <div class="text-6xl text-purple-200 mb-4"><i class="fas fa-inbox"></i></div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-2">لا توجد ملفات معالجة سابقاً</h3>
                    <p class="text-gray-600">سيظهر هنا أي ملفات تمت معالجتها</p>
                </div>
                @endforelse
            </div>

            @if($processedProfiles->hasPages())
            <div class="mt-6 px-4">
                {{ $processedProfiles->links('pagination::tailwind') }}
            </div>
            @endif
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush