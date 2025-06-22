<?php

namespace App\Livewire\Kegiatan;

use App\Models\Kegiatan;
use App\Models\Lokasi;
use App\Models\Organisasi;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Manajemen Kegiatan')]
class ManageKegiatan extends Component
{
    use WithPagination;

    public $id;
    public $nama;
    public $tgl_pelaksanaan;
    public $organisasi_id;
    public $lokasi_id;
    public $isModalOpen = false;

    public $search = '';
    public $filterOrganisasi = ''; 
    public $filterLokasi = '';     

    public function render()
    {
        $semuaOrganisasi = Organisasi::orderBy('nama_organisasi')->get();
        $semuaLokasi = Lokasi::orderBy('nama_lokasi')->get();

        $kegiatan = Kegiatan::with(['organisasi', 'lokasi'])
            ->when($this->search, function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterOrganisasi, function ($query) {
                $query->where('organisasi_id', $this->filterOrganisasi);
            })
            ->when($this->filterLokasi, function ($query) {
                $query->where('lokasi_id', $this->filterLokasi);
            })
            ->latest('tgl_pelaksanaan')
            ->paginate(10);

        return view('livewire.kegiatan.manage-kegiatan', [
            'semuaKegiatan' => $kegiatan,
            'semuaOrganisasi' => $semuaOrganisasi,
            'semuaLokasi' => $semuaLokasi,
        ]);
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->id = null;
        $this->nama = '';
        $this->tgl_pelaksanaan = '';
        $this->organisasi_id = '';
        $this->lokasi_id = '';
        $this->resetErrorBag();
    }

    public function create()
    {
        $this->resetForm();
        $this->openModal();
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|string|min:5',
            'tgl_pelaksanaan' => 'required|date',
            'organisasi_id' => 'required|exists:organisasi,id',
            'lokasi_id' => 'required|exists:lokasi,id',
        ]);

        Kegiatan::updateOrCreate(['id' => $this->id], [
            'nama' => $this->nama,
            'tgl_pelaksanaan' => $this->tgl_pelaksanaan,
            'organisasi_id' => $this->organisasi_id,
            'lokasi_id' => $this->lokasi_id,
        ]);

        session()->flash('message', $this->id ? 'Kegiatan Berhasil Diperbarui.' : 'Kegiatan Berhasil Ditambahkan.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $this->id = $id;
        $this->nama = $kegiatan->nama;
        $this->tgl_pelaksanaan = $kegiatan->tgl_pelaksanaan;
        $this->organisasi_id = $kegiatan->organisasi_id;
        $this->lokasi_id = $kegiatan->lokasi_id;
        $this->openModal();
    }

    public function delete($id)
    {
        Kegiatan::find($id)->delete();
        session()->flash('message', 'Kegiatan Berhasil Dihapus.');
    }
}