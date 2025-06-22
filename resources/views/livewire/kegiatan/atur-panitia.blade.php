<div>
    {{-- Judul Halaman --}}
    <h2 class="text-2xl font-bold dark:text-gray-200">
        Atur Panitia: <span class="text-indigo-600">{{ $kegiatan->nama }}</span>
    </h2>
    <p class="mt-1 text-sm text-gray-500">
        Diselenggarakan oleh: {{ $kegiatan->organisasi->nama_organisasi }}
    </p>

    @if (session()->has('message'))
        <div class="mt-4 rounded-lg bg-green-100 p-4 text-sm text-green-700">
            {{ session('message') }}
        </div>
    @endif

    {{-- Layout 2 Kolom --}}
    <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2">

        {{-- Kolom Kiri: Form Tambah Panitia --}}
        <div class="space-y-4 rounded-lg border border-gray-200 p-6 dark:border-zinc-700">
            <h3 class="text-lg font-medium dark:text-gray-200">Tambah Panitia Baru</h3>
            <form wire:submit.prevent="tambahPanitia" class="space-y-4">
                <div>
                    <label for="anggota_id_panitia" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pilih Anggota</label>
                    <select wire:model="anggota_id" id="anggota_id_panitia" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:border-zinc-600 dark:bg-zinc-800 sm:text-sm">
                        <option value="">-- Pilih dari anggota {{ $kegiatan->organisasi->nama_organisasi }} --</option>
                        @foreach ($anggotaTersedia as $anggota)
                            <option value="{{ $anggota->id }}">{{ $anggota->nama }} ({{ $anggota->nim }})</option>
                        @endforeach
                    </select>
                    @error('anggota_id') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="jabatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jabatan</label>
                    <input wire:model="jabatan" type="text" id="jabatan" placeholder="Contoh: Ketua, Sekretaris, Bendahara" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:border-zinc-600 dark:bg-zinc-800 sm:text-sm">
                    @error('jabatan') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                        Tambahkan
                    </button>
                </div>
            </form>
        </div>

        {{-- Kolom Kanan: Daftar Panitia Terpilih --}}
        <div class="space-y-4 rounded-lg border border-gray-200 p-6 dark:border-zinc-700">
            <h3 class="text-lg font-medium dark:text-gray-200">Daftar Panitia Saat Ini</h3>
            <ul class="space-y-3">
                @forelse ($panitiaTerpilih as $panitia)
                    <li class="flex items-center justify-between rounded-md bg-gray-50 p-3 dark:bg-zinc-800">
                        <div>
                            <p class="font-semibold dark:text-gray-200">{{ $panitia->anggota->nama }}</p>
                            <p class="text-sm text-gray-500">{{ $panitia->jabatan }}</p>
                        </div>
                        <button wire:click="hapusPanitia({{ $panitia->id }})" wire:confirm="Anda yakin ingin menghapus panitia ini?" type="button" class="text-red-500 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" /></svg>
                        </button>
                    </li>
                @empty
                    <li class="text-center text-sm text-gray-500">Belum ada panitia yang ditambahkan.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>