{{-- Ini adalah pengganti <flux:modal> dengan HTML + Tailwind CSS + sedikit Alpine.js --}}
<div
    x-data="{ show: @entangle('isModalOpen') }"
    x-show="show"
    x-on:keydown.escape.window="show = false"
    class="fixed inset-0 z-50 overflow-y-auto"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true"
    style="display: none;"
>
    {{-- Latar belakang overlay --}}
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" x-show="show" x-transition.opacity></div>

    {{-- Konten Modal --}}
    <div class="flex min-h-full items-center justify-center p-4 text-center">
        <div
            x-show="show"
            x-transition
            x-on:click.outside="show = false"
            class="relative w-full max-w-lg transform overflow-hidden rounded-lg bg-white p-6 text-left shadow-xl dark:bg-zinc-800"
        >
            {{-- Judul Modal --}}
            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100" id="modal-title">
                {{ $id ? 'Edit Anggota' : 'Tambah Anggota' }}
            </h3>

            {{-- Isi Form --}}
            <div class="mt-4 space-y-4">
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                    <input wire:model="nama" type="text" id="nama" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-zinc-600 dark:bg-zinc-900 sm:text-sm">
                    @error('nama') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="nim" class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIM</label>
                    <input wire:model="nim" type="text" id="nim" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-zinc-600 dark:bg-zinc-900 sm:text-sm">
                    @error('nim') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="organisasi_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Organisasi</label>
                    <select wire:model="organisasi_id" id="organisasi_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-zinc-600 dark:bg-zinc-900 sm:text-sm">
                        <option value="">Pilih Organisasi</option>
                        @foreach($semuaOrganisasi as $org)
                            <option value="{{ $org->id }}">{{ $org->nama_organisasi }}</option>
                        @endforeach
                    </select>
                    @error('organisasi_id') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Tombol Aksi (Footer Modal) --}}
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" wire:click="closeModal" class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:bg-zinc-700 dark:text-gray-200 dark:border-zinc-600 dark:hover:bg-zinc-600">
                    Batal
                </button>
                <button type="button" wire:click.prevent="store" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>