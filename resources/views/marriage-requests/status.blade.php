@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12">
    <div class="max-w-4xl mx-auto px-2 sm:px-6 lg:px-8">
        <x-marriage-requests.header />

        @if(session('info'))
        <x-alert.info :message="session('info')" />
        @endif

        @if(Auth::user()->status === 'engaged')
        <x-marriage-requests.engaged-notification :marriageRequest="$marriageRequest" :partner="$partner"
            :totalImportant="$totalImportant" :maleImportantScore="$maleImportantScore"
            :femaleImportantScore="$femaleImportantScore" :testResult="$testResult" />
        @else
        <div class="space-y-6">
            <x-marriage-requests.pending-section :pendingRequests="$pendingRequests" />
            <x-marriage-requests.submitted-section :submittedRequests="$submittedRequests" />
            <x-marriage-requests.received-section :receivedRequests="$receivedRequests" />
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