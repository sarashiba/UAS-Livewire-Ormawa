<x-layouts.app>
    <div class="space-y-6">
        {{-- Salam Pembuka --}}
        <div>
            <h2 class="text-2xl font-bold dark:text-gray-200">
                Selamat Datang, {{ auth()->user()->name }}!
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Berikut adalah ringkasan aktivitas organisasi
            </p>
        </div>

        {{-- Kartu Statistik --}}
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <div class="overflow-hidden rounded-lg bg-white p-5 shadow dark:bg-zinc-800">
                <dt class="truncate text-sm font-medium text-gray-500 dark:text-gray-400">Total Anggota</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">{{ $totalAnggota }}</dd>
            </div>
            <div class="overflow-hidden rounded-lg bg-white p-5 shadow dark:bg-zinc-800">
                <dt class="truncate text-sm font-medium text-gray-500 dark:text-gray-400">Total Kegiatan</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">{{ $totalKegiatan }}</dd>
            </div>
            <div class="overflow-hidden rounded-lg bg-white p-5 shadow dark:bg-zinc-800">
                <dt class="truncate text-sm font-medium text-gray-500 dark:text-gray-400">Total Organisasi</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">{{ $totalOrganisasi }}</dd>
            </div>
        </div>

        {{-- Daftar Kegiatan Terdekat --}}
        <div>
            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-200">Kegiatan Terdekat</h3>
            <div class="mt-4 overflow-hidden rounded-lg border border-gray-200 dark:border-zinc-700">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-zinc-700">
                    @forelse ($kegiatanTerdekat as $kegiatan)
                        <li class="flex items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-zinc-800">
                            <div class="flex flex-col">
                                <p class="font-medium text-gray-900 dark:text-gray-200">{{ $kegiatan->nama }}</p>
                                <span class="text-sm text-gray-500">{{ $kegiatan->organisasi->nama_organisasi }}</span>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-indigo-600 dark:text-indigo-400">{{ \Carbon\Carbon::parse($kegiatan->tgl_pelaksanaan)->isoFormat('dddd, D MMMM Y') }}</p>
                                <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($kegiatan->tgl_pelaksanaan)->diffForHumans() }}</span>
                            </div>
                        </li>
                    @empty
                        <li class="p-4 text-center text-sm text-gray-500">
                            Tidak ada kegiatan yang akan datang.
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-layouts.app>