@extends('layouts.app')

@section('content')
<section class="min-h-screen">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-purple-800">
                    <i class="fas fa-hourglass-half text-purple-600 ml-2"></i>الطلبات التي لم يتم الرد عليها
                </h2>
                <p class="text-sm text-gray-600 mt-2">
                    هذه الطلبات التي لم يتم الرد عليها من الطرف الآخر وتم مرور مدة أسبوع من تاريخ إنشائها.
                </p>
            </div>

            @if($pendingRequests->isNotEmpty())
            <form method="POST" action="{{ route('admin.marriage-requests.delete-all-pending-overdue') }}"
                class="delete-all-pending-overdue">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-all">
                    <i class="fas fa-trash ml-2"></i>حذف الكل
                </button>
            </form>
            @endif
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-purple-100 overflow-hidden">
            @forelse($pendingRequests as $request)
            <div class="p-6 border-b border-purple-50 group hover:bg-purple-50 transition-all">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div class="space-y-2">
                        <div class="flex items-center gap-2 text-purple-600">
                            <i class="fas fa-hashtag"></i>
                            <span class="font-medium">رقم الطلب:</span>
                            <span class="font-bold">{{ $request->request_number }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-user text-purple-600"></i>
                            <span class="text-gray-800">{{ $request->user->name }}</span>
                            <span class="text-sm px-2 py-1 rounded-full bg-purple-100 text-purple-800">
                                {{ $request->user->gender === 'male' ? 'شاب' : 'فتاة' }}
                            </span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-bullseye text-purple-600"></i>
                            <span class="text-gray-800">{{ $request->target->name }}</span>
                            <span class="text-sm px-2 py-1 rounded-full bg-purple-100 text-purple-800">
                                {{ $request->target->gender === 'male' ? 'شاب' : 'فتاة' }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <i class="fas fa-clock"></i>
                            {{ $request->created_at->diffForHumans() }}
                        </div>
                    </div>

                    <div class="flex items-center gap-4 justify-end">
                        <form method="POST"
                            action="{{ route('admin.marriage-requests.delete-pending-overdue', $request->id) }}"
                            class="delete-pending-overdue">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        <a href="{{ route('admin.profile-approvals.show', $request->user->id) }}"
                            class="text-purple-600 hover:text-purple-800">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center p-12">
                <div class="text-6xl text-purple-200 mb-4">
                    <i class="fas fa-inbox"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    لا توجد طلبات لم يتم الرد عليها حالياً
                </h3>
            </div>
            @endforelse
        </div>

        @if($pendingRequests->hasPages())
        <div class="mt-6 px-4">
            {{ $pendingRequests->links('pagination::tailwind') }}
        </div>
        @endif
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteForms = document.querySelectorAll('.delete-pending-overdue');
        
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: "سيتم حذف هذا الطلب المعلق نهائيًا!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'حذف',
                    cancelButtonText: 'إلغاء',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        const deleteAllForm = document.querySelector('.delete-all-pending-overdue');
        
        if (deleteAllForm) {
            deleteAllForm.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: "سيتم حذف جميع الطلبات المعلقة المتجاوزة نهائيًا!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'حذف',
                    cancelButtonText: 'إلغاء',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteAllForm.submit();
                    }
                });
            });
        }
    });
</script>
@endsection