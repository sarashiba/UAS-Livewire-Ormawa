<?php

namespace App\Livewire\Laporan;

use App\Models\Kegiatan;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Laporan Kegiatan')]
class LaporanKegiatan extends Component
{
    use WithPagination;

    public function render()
    {
        $kegiatan = Kegiatan::with(['organisasi', 'lokasi'])
            ->withCount('kepanitiaan') 
            ->latest('tgl_pelaksanaan')
            ->paginate(15);

        return view('livewire.laporan.laporan-kegiatan', [
            'semuaKegiatan' => $kegiatan,
        ]);
    }
}