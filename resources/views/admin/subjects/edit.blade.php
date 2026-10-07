<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Edit Subject</h2></x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.subjects.update', $subject) }}" method="POST" class="space-y-4">
                    @csrf @method('PUT')
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Subject Code</label>
                        <input type="text" name="code" value="{{ $subject->code }}" required class="w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Subject Title</label>
                        <input type="text" name="title" value="{{ $subject->title }}" required class="w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Units</label>
                        <input type="number" name="units" value="{{ $subject->units }}" required class="w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('admin.subjects.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</a>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Update Subject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>