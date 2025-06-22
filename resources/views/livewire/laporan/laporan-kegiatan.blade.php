<div>
    <h2 class="text-2xl font-bold dark:text-gray-200">
        Laporan Jumlah Panitia per Kegiatan
    </h2>

    <div class="mt-6 overflow-x-auto rounded-lg border border-gray-200 dark:border-zinc-700">
        <table class="min-w-full divide-y divide-gray-200 text-sm dark:divide-zinc-700">
            <thead class="bg-gray-50 dark:bg-zinc-800">
                <tr>
                    <th scope="col" class="whitespace-nowrap px-4 py-3 text-left font-semibold text-gray-900 dark:text-gray-200">Nama Kegiatan</th>
                    <th scope="col" class="whitespace-nowrap px-4 py-3 text-left font-semibold text-gray-900 dark:text-gray-200">Penyelenggara</th>
                    <th scope="col" class="whitespace-nowrap px-4 py-3 text-center font-semibold text-gray-900 dark:text-gray-200">Jumlah Panitia</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                @forelse ($semuaKegiatan as $kegiatan)
                    <tr>
                        <td class="whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-gray-200">
                            <div class="flex flex-col">
                                <span>{{ $kegiatan->nama }}</span>
                                <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($kegiatan->tgl_pelaksanaan)->isoFormat('D MMMM Y') }}</span>
                            </div>
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 text-gray-700 dark:text-gray-400">{{ $kegiatan->organisasi->nama_organisasi }}</td>
                        <td class="whitespace-nowrap px-4 py-3 text-center text-lg font-bold text-gray-700 dark:text-gray-400">
                            {{ $kegiatan->kepanitiaan_count }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-4 text-center text-gray-500">
                            Tidak ada data kegiatan untuk ditampilkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $semuaKegiatan->links() }}
    </div>
</div>