@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">لوحة التحكم</h1>
        <p class="text-gray-500 mt-1">نظرة عامة على إحصائيات الموقع.</p>
    </div>

    <!-- Main Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Users Card -->
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">مجموع الأعضاء</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['userCount'] }}</p>
            </div>
            <div class="bg-blue-100 text-blue-500 rounded-full h-12 w-12 flex items-center justify-center">
                <i class="fas fa-users fa-lg"></i>
            </div>
        </div>

        <!-- Courses Card -->
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">مجموع الدورات</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['courseCount'] }}</p>
            </div>
            <div class="bg-green-100 text-green-500 rounded-full h-12 w-12 flex items-center justify-center">
                <i class="fas fa-chalkboard-teacher fa-lg"></i>
            </div>
        </div>

        <!-- Shops Card -->
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">مجموع المحلات</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['shopCount'] }}</p>
            </div>
            <div class="bg-yellow-100 text-yellow-500 rounded-full h-12 w-12 flex items-center justify-center">
                <i class="fas fa-store fa-lg"></i>
            </div>
        </div>

        <!-- Exams Card -->
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">مجموع الاختبارات</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['examCount'] }}</p>
            </div>
            <div class="bg-purple-100 text-purple-500 rounded-full h-12 w-12 flex items-center justify-center">
                <i class="fas fa-clipboard-list fa-lg"></i>
            </div>
        </div>
    </div>

    <!-- Secondary Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">طلبات زواج معلقة</p>
                <p class="text-3xl font-bold text-orange-500">{{ $stats['pendingMarriageRequests'] }}</p>
            </div>
            <div class="bg-orange-100 text-orange-500 rounded-full h-12 w-12 flex items-center justify-center">
                <i class="fas fa-file-signature fa-lg"></i>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">إجابات الاختبارات</p>
                <p class="text-3xl font-bold text-indigo-500">{{ $stats['examResultCount'] }}</p>
            </div>
            <div class="bg-indigo-100 text-indigo-500 rounded-full h-12 w-12 flex items-center justify-center">
                <i class="fas fa-graduation-cap fa-lg"></i>
            </div>
        </div>
    </div>

    <!-- Lists and Charts Section -->
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Gender Distribution Chart -->
        <div class="lg:col-span-1 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold text-gray-800 mb-4">توزيع الأعضاء</h2>
            <div class="flex justify-center items-center h-64">
                <canvas id="genderChart"></canvas>
            </div>
        </div>

        <!-- Latest Info Lists -->
        <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Latest Users -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-gray-800 mb-4">آخر الأعضاء المسجلين</h2>
                <div class="space-y-4">
                    @forelse($stats['latestUsers'] as $user)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img class="h-10 w-10 rounded-full object-cover mr-4"
                                src="{{ optional($user->profile)->image ? asset('storage/' . $user->profile->image) : '/assets/images/default-avatar.png' }}"
                                alt="{{ $user->name }}">
                            <div>
                                <p class="font-semibold text-gray-700">{{ $user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.users.index') }}" class="text-sm text-blue-500 hover:underline">عرض</a>
                    </div>
                    @empty
                    <p class="text-gray-500">لا يوجد مستخدمون جدد.</p>
                    @endforelse
                </div>
            </div>
            <!-- Latest Marriage Requests -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-gray-800 mb-4">آخر طلبات الزواج</h2>
                <div class="space-y-4">
                    @forelse($stats['latestMarriageRequests'] as $request)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img class="h-10 w-10 rounded-full object-cover mr-4"
                                src="{{ optional($request->user->profile)->image ? asset('storage/' . $request->user->profile->image) : '/assets/images/default-avatar.png' }}"
                                alt="{{ $request->user->name }}">
                            <div>
                                <p class="font-semibold text-gray-700">{{ $request->user->name }}</p>
                                <p class="text-sm text-gray-500">
                                    الحالة: <span
                                        class="font-bold @if($request->status == 'pending') text-orange-500 @elseif($request->status == 'approved') text-green-500 @else text-red-500 @endif">{{
                                        $request->status }}</span>
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('admin.marriage-requests.index') }}"
                            class="text-sm text-blue-500 hover:underline">عرض</a>
                    </div>
                    @empty
                    <p class="text-gray-500">لا توجد طلبات زواج جديدة.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('genderChart').getContext('2d');
        const genderData = @json($stats['genderDistribution']);

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['ذكور', 'إناث', 'غير محدد'],
                datasets: [{
                    label: 'توزيع الأعضاء',
                    data: [
                        genderData['male'] || 0,
                        genderData['female'] || 0,
                        (genderData[''] || 0) + (genderData[null] || 0) // لجمع الحقول الفارغة أو NULL
                    ],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)', // Blue
                        'rgba(236, 72, 153, 0.8)', // Pink
                        'rgba(156, 163, 175, 0.8)'  // Gray
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(236, 72, 153, 1)',
                        'rgba(156, 163, 175, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                family: 'Tajawal, sans-serif' // تأكد من استخدام الخط العربي
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection