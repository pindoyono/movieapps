<section class="container p-6 mx-auto font-mono">
    <div class="flex justify-end w-full p-2 mb-4">
        <form class="flex p-2 m-2 space-x-4 bg-white rounded-md shadow">
            <div class="flex items-center p-1">
                <label for="tmdb_id_g" class="block mr-4 text-sm font-medium text-gray-700">Genre Tmdb Id</label>
                <div class="relative rounded-md shadow-sm">
                    <input wire:model="tmdbId" id="tmdb_id_g" name="tmdb_id_g"
                        class="px-3 py-2 border border-gray-300 rounded" placeholder="Cast ID" />
                </div>
            </div>
            <div class="p-1">
                <button type="button" wire:click="generateGenre"
                    class="inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md hover:bg-green-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-green-700 disabled:opacity-50">
                    <span>Generate</span>
                </button>
            </div>
        </form>
    </div>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full p-5 bg-white shadow">
            <div class="relative">
                <div class="absolute flex items-center h-full ml-2">
                    <svg class="w-4 h-4 fill-current text-primary-gray-dark" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15.8898 15.0493L11.8588 11.0182C11.7869 10.9463 11.6932 10.9088 11.5932 10.9088H11.2713C12.3431 9.74952 12.9994 8.20272 12.9994 6.49968C12.9994 2.90923 10.0901 0 6.49968 0C2.90923 0 0 2.90923 0 6.49968C0 10.0901 2.90923 12.9994 6.49968 12.9994C8.20272 12.9994 9.74952 12.3431 10.9088 11.2744V11.5932C10.9088 11.6932 10.9495 11.7869 11.0182 11.8588L15.0493 15.8898C15.1961 16.0367 15.4336 16.0367 15.5805 15.8898L15.8898 15.5805C16.0367 15.4336 16.0367 15.1961 15.8898 15.0493ZM6.49968 11.9994C3.45921 11.9994 0.999951 9.54016 0.999951 6.49968C0.999951 3.45921 3.45921 0.999951 6.49968 0.999951C9.54016 0.999951 11.9994 3.45921 11.9994 6.49968C11.9994 9.54016 9.54016 11.9994 6.49968 11.9994Z">
                        </path>
                    </svg>
                </div>

                <input wire:model="search" type="text" placeholder="Search by title"
                    class="w-full px-8 py-3 text-sm bg-gray-100 border-transparent rounded-md md:w-2/6 focus:border-gray-500 focus:bg-white focus:ring-0" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <p class="font-medium">Filters</p>

                <button wire:click="resetFilters"
                    class="px-4 py-2 text-sm font-medium text-gray-800 bg-gray-100 rounded-md hover:bg-gray-200">Reset
                    Filter</button>
            </div>

            <div>
                <div class="flex justify-between mt-4 space-x-4">
                    <select wire:model="sort"
                        class="w-full px-4 py-3 text-sm bg-gray-100 border-transparent rounded-md focus:border-gray-500 focus:bg-white focus:ring-0">
                        <option value="asc">Asc</option>
                        <option value="desc">Desc</option>
                    </select>

                    <select wire:model="perPage"
                        class="w-full px-4 py-3 text-sm bg-gray-100 border-transparent rounded-md focus:border-gray-500 focus:bg-white focus:ring-0">
                        <option value="5">5 Per Page</option>
                        <option value="10">10 Per Page</option>
                        <option value="15">15 Per Page</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr
                        class="font-semibold tracking-wide text-left text-gray-900 uppercase bg-gray-100 border-b border-gray-600 text-md">
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Slug</th>
                        <th class="px-4 py-3">Manage</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($genres as $genre)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 border">
                                {{ $genre->title }}
                            </td>
                            <td class="px-4 py-3 font-semibold border text-ms">{{ $genre->slug }}</td>

                            <td class="px-4 py-3 text-sm border">
                                <x-m-button wire:click="showEditModal({{ $genre->id }})"
                                    class="text-white bg-green-500 hover:bg-green-700">Edit</x-m-button>
                                <x-m-button wire:click="deleteGenre({{ $genre->id }})"
                                    class="text-white bg-red-500 hover:bg-red-700">Delete</x-m-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            <div class="p-2 m-2">
                {{ $genres->links() }}
            </div>
        </div>
    </div>
    <x-jet.dialog-modal wire:model="showGenreModal">
        <x-slot name="title">Update Genre</x-slot>
        <x-slot name="content">
            <div class="mt-10 sm:mt-0">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form>
                        <div class="overflow-hidden shadow sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="first-name"
                                            class="block text-sm font-medium text-gray-700">Title</label>
                                        <input wire:model="title" type="text" autocomplete="given-name"
                                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                        @error('title')
                                            <span class="text-sm text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-m-button wire:click="closeGenreModal" class="text-white bg-gray-600 hover:bg-gray-800">Cancel
            </x-m-button>

            <x-m-button wire:click="updateGenre">Update</x-m-button>
        </x-slot>
    </x-jet.dialog-modal>
</section>
