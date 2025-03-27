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