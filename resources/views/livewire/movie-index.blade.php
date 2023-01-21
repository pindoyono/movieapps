<!-- component -->
<section class="container p-6 mx-auto font-mono">
    <div class="flex justify-end w-full p-2 mb-4 ">
        <x-jet.button> Create Movie</x-jet.button>
    </div>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr
                        class="font-semibold tracking-wide text-left text-gray-900 uppercase bg-gray-100 border-b border-gray-600 text-md">
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Rating</th>
                        <th class="px-4 py-3">Public</th>
                        <th class="px-4 py-3">Manage</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 border">
                            Title Here
                        </td>
                        <td class="px-4 py-3 font-semibold border text-ms">Date Here</td>
                        <td class="px-4 py-3 text-xs border">
                            Rating Here
                        </td>
                        <td class="px-4 py-3 text-sm border">Public</td>
                        <td class="px-4 py-3 text-sm border">Edit/Delete</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
