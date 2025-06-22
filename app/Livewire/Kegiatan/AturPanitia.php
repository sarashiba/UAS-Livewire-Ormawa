<?php

namespace App\Livewire\Kegiatan;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\Kepanitiaan;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Atur Panitia Kegiatan')]
class AturPanitia extends Component
{
    public Kegiatan $kegiatan;

    public $anggota_id;
    public $jabatan;

    public function mount(Kegiatan $kegiatan)
    {
        $this->kegiatan = $kegiatan;
    }

    public function render()
    {
        
        $anggotaTersedia = Anggota::where('organisasi_id', $this->kegiatan->organisasi_id)
            ->whereDoesntHave('kepanitiaan', function ($query) {
                $query->where('kegiatan_id', $this->kegiatan->id);
            })
            ->orderBy('nama')
            ->get();

        $panitiaTerpilih = Kepanitiaan::with('anggota')
            ->where('kegiatan_id', $this->kegiatan->id)
            ->get();

        return view('livewire.kegiatan.atur-panitia', [
            'anggotaTersedia' => $anggotaTersedia,
            'panitiaTerpilih' => $panitiaTerpilih,
        ]);
    }

    public function tambahPanitia()
    {
        $this->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'jabatan' => 'required|string|max:255',
        ]);

        Kepanitiaan::create([
            'kegiatan_id' => $this->kegiatan->id,
            'anggota_id' => $this->anggota_id,
            'jabatan' => $this->jabatan,
        ]);

        $this->reset(['anggota_id', 'jabatan']);
        session()->flash('message', 'Panitia berhasil ditambahkan.');
    }

    public function hapusPanitia($panitiaId)
    {
        Kepanitiaan::find($panitiaId)->delete();
        session()->flash('message', 'Panitia berhasil dihapus.');
    }
}