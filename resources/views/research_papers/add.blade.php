{{-- resources/views/research_papers/add.blade.php --}}
<x-app-layout>
    {{-- Header slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Research Paper') }}
        </h2>

        {{-- Main Content --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                {{-- Display validation errors --}}
                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Paper submission form --}}
                <form method="POST" action="{{ route('research-papers.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Title</label>
                        <input name="title" class="form-input rounded-md shadow-sm mt-1 block w-full" required />
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Abstract</label>
                        <textarea name="abstract" class="form-input rounded-md shadow-sm mt-1 block w-full" required></textarea>
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Visibility</label>
                        <select name="visibility" class="form-select mt-1 block w-full">
                            <option value="public">Public</option>
                            <option value="private">Private</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Upload PDF</label>
                        <input type="file" name="pdf" class="form-input mt-1 block w-full" accept="application/pdf" required />
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Submit
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    </x-slot>


</x-app-layout>

