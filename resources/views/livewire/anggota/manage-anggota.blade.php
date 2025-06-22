<div>
    @if (session()->has('message'))
        <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-700">
            {{ session('message') }}
        </div>
    @endif

    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <div class="w-1/3">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama atau NIM..." class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-zinc-600 dark:bg-zinc-800 dark:focus:border-indigo-600 dark:focus:ring-indigo-600 sm:text-sm">
            </div>
            <button wire:click="create" type="button" class="inline-flex items-center gap-x-2 rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                <svg class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" /></svg>
                Tambah Anggota
            </button>
        </div>

        {{-- Tabel HTML Biasa dengan Style Tailwind --}}
        <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-zinc-700">
            <table class="min-w-full divide-y divide-gray-200 text-sm dark:divide-zinc-700">
                <thead class="bg-gray-50 dark:bg-zinc-800">
                    <tr>
                        <th scope="col" class="whitespace-nowrap px-4 py-3 text-left font-semibold text-gray-900 dark:text-gray-200">Nama</th>
                        <th scope="col" class="whitespace-nowrap px-4 py-3 text-left font-semibold text-gray-900 dark:text-gray-200">NIM</th>
                        <th scope="col" class="whitespace-nowrap px-4 py-3 text-left font-semibold text-gray-900 dark:text-gray-200">Organisasi</th>
                        <th scope="col" class="relative px-4 py-3"><span class="sr-only">Actions</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                    @forelse ($semuaAnggota as $anggota)
                        <tr>
                            <td class="whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-gray-200">{{ $anggota->nama }}</td>
                            <td class="whitespace-nowrap px-4 py-3 text-gray-700 dark:text-gray-400">{{ $anggota->nim }}</td>
                            <td class="whitespace-nowrap px-4 py-3 text-gray-700 dark:text-gray-400">{{ $anggota->organisasi->nama_organisasi }}</td>
                            <td class="whitespace-nowrap px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="edit({{ $anggota->id }})" type="button" class="rounded bg-white px-2 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-zinc-800 dark:text-gray-200 dark:ring-zinc-600 dark:hover:bg-zinc-700">Edit</button>
                                    <button wire:click="delete({{ $anggota->id }})" wire:confirm="Anda yakin?" type="button" class="rounded bg-red-600 px-2 py-1 text-xs font-semibold text-white shadow-sm hover:bg-red-500">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="py-4 text-center text-gray-500">Tidak ada data untuk ditampilkan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div>{{ $semuaAnggota->links() }}</div>
    </div>

    @if($isModalOpen)
        @include('livewire.anggota.modal-anggota')
    @endif
</div>