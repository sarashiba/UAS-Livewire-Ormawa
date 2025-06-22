<div>
    @if (session()->has('message'))
        <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-700">
            {{ session('message') }}
        </div>
    @endif

    <div class="space-y-4">
        {{-- Bagian Filter dan Tombol --}}
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            {{-- Filters --}}
            <div class="flex flex-grow gap-4">
                <select wire:model.live="filterOrganisasi" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-zinc-600 dark:bg-zinc-800 sm:text-sm">
                    <option value="">Semua Organisasi</option>
                    @foreach ($semuaOrganisasi as $org)
                        <option value="{{ $org->id }}">{{ $org->nama_organisasi }}</option>
                    @endforeach
                </select>
                <select wire:model.live="filterLokasi" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-zinc-600 dark:bg-zinc-800 sm:text-sm">
                    <option value="">Semua Lokasi</option>
                    @foreach ($semuaLokasi as $lok)
                        <option value="{{ $lok->id }}">{{ $lok->nama_lokasi }}</option>
                    @endforeach
                </select>
            </div>
            {{-- Tombol Tambah --}}
            <div class="flex-shrink-0">
                 <button wire:click="create" type="button" class="inline-flex items-center gap-x-2 rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <svg class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" /></svg>
                    Tambah Kegiatan
                </button>
            </div>
        </div>

        {{-- Tabel Data Kegiatan --}}
        <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-zinc-700">
            <table class="min-w-full divide-y divide-gray-200 text-sm dark:divide-zinc-700">
                <thead class="bg-gray-50 dark:bg-zinc-800">
                    <tr>
                        <th scope="col" class="whitespace-nowrap px-4 py-3 text-left font-semibold text-gray-900 dark:text-gray-200">Nama Kegiatan</th>
                        <th scope="col" class="whitespace-nowrap px-4 py-3 text-left font-semibold text-gray-900 dark:text-gray-200">Tanggal</th>
                        <th scope="col" class="whitespace-nowrap px-4 py-3 text-left font-semibold text-gray-900 dark:text-gray-200">Organisasi</th>
                        <th scope="col" class="whitespace-nowrap px-4 py-3 text-left font-semibold text-gray-900 dark:text-gray-200">Jenis</th>
                        <th scope="col" class="whitespace-nowrap px-4 py-3 text-left font-semibold text-gray-900 dark:text-gray-200">Lokasi</th>
                        <th scope="col" class="relative px-4 py-3"><span class="sr-only">Actions</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                    @forelse ($semuaKegiatan as $kegiatan)
                        <tr>
                            <td class="whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-gray-200">{{ $kegiatan->nama }}</td>
                            <td class="whitespace-nowrap px-4 py-3 text-gray-700 dark:text-gray-400">{{ \Carbon\Carbon::parse($kegiatan->tgl_pelaksanaan)->isoFormat('D MMMM Y') }}</td>
                            <td class="whitespace-nowrap px-4 py-3 text-gray-700 dark:text-gray-400">{{ $kegiatan->organisasi->nama_organisasi }}</td>
                            <td class="whitespace-nowrap px-4 py-3 text-gray-700 dark:text-gray-400">{{ $kegiatan->organisasi->jenis }}</td> 
                            <td class="whitespace-nowrap px-4 py-3 text-gray-700 dark:text-gray-400">{{ $kegiatan->lokasi->nama_lokasi }}</td>
                            <td class="whitespace-nowrap px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('kegiatan.panitia', $kegiatan->id) }}" class="rounded bg-blue-600 px-2 py-1 text-xs font-semibold text-white shadow-sm hover:bg-blue-500">Panitia</a>
                                    <button wire:click="edit({{ $kegiatan->id }})" type="button" class="rounded bg-white px-2 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-zinc-800 dark:text-gray-200 dark:ring-zinc-600 dark:hover:bg-zinc-700">Edit</button>
                                    <button wire:click="delete({{ $kegiatan->id }})" wire:confirm="Anda yakin?" type="button" class="rounded bg-red-600 px-2 py-1 text-xs font-semibold text-white shadow-sm hover:bg-red-500">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="py-4 text-center text-gray-500">Tidak ada data untuk ditampilkan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>{{ $semuaKegiatan->links() }}</div>
    </div>

    @if($isModalOpen)
        @include('livewire.kegiatan.modal-kegiatan')
    @endif
</div>