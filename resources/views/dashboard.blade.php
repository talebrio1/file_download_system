<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="md:grid md:grid-cols-3 sm:grid-cols-3 gap-1 md:p-10">




        <div class="py-12 ml-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (session('success'))
                            <span class="text-green-200">{{ session('success') }}</span>
                            @endif
                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <div>
                                    <label for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        name</label>
                                    <input type="text" id="name" name="name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="name">
                                        @error('name')
                                        <span class="text-red-800">{{ $message }}</span>
                                    @enderror
                                </div>
                               
                                <div>
                                    <label for="description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        description</label>
                                    <input type="text" id="description" name="description"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="description">
                                        @error('description')
                                        <span class="text-red-800">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                           
                            <div class="mb-6">

                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="multiple_files">Upload Your files</label>
                                <input  type="file" name="file"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    id="multiple_files" >
                                    @error('file')
                                    <span class="text-red-800">{{ $message }}</span>
                                @enderror
                            </div>
                           
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>


        <div class="  sm:rounded-lg p-6 ">


            <table class="shadow-lg bg-white border-separate text-center table-auto">
                <thead>
                    <tr>
                        <th class="bg-blue-100 border text-left px-8 py-1">Name</th>
                        <th class="bg-blue-100 border text-left px-8 py-1">Description</th>
                        <th class="bg-blue-100 border text-left px-8 py-1">View</th>
                        <th class="bg-blue-100 border text-left px-8 py-1">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($files as $file)
                    <tr>
                        <td class="border px-8 py-1">{{ $file->name ?? "" }}</td>
                        <td class="border px-1 py-1">{{ $file->description ?? "" }}</td>
                        <td class="border px-1 py-1"><a href="{{ route('file.view',$file->id) }}">view</a></td>
                        <td class="border px-8 py-1 text-blue-600">
                            <div class="flex md:flex-row flex-col">
                                <a href="{{ route('file.downloads',$file->file_path) }}" aria-current="page"
                                    class="mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    Download
                                </a>
                                <a href="{{ route('file.delete',$file->file_path) }}" aria-current="page"
                                    class="mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                  

                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
