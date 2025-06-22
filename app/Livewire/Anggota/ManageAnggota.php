<?php

namespace App\Livewire\Anggota;

use App\Models\Anggota;
use App\Models\Organisasi;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Manajemen Anggota')]
class ManageAnggota extends Component
{
    use WithPagination;

    public $id;
    public $nama;
    public  $nim;
    public $organisasi_id;
    public $isModalOpen = false;

    public $search = '';

    public function render()
    {
        $semuaOrganisasi = Organisasi::all();
        $anggota = Anggota::with('organisasi')
            ->where('nama', 'like', '%' . $this->search . '%')
            ->orWhere('nim', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.anggota.manage-anggota', [
            'semuaAnggota' => $anggota,
            'semuaOrganisasi' => $semuaOrganisasi
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
        $this->nim = '';
        $this->organisasi_id = '';
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
            'nama' => 'required|string|min:3',
            'nim' => 'required|unique:anggota,nim,' . $this->id,
            'organisasi_id' => 'required|exists:organisasi,id',
        ]);

        Anggota::updateOrCreate(['id' => $this->id], [
            'nama' => $this->nama,
            'nim' => $this->nim,
            'organisasi_id' => $this->organisasi_id,
        ]);

        session()->flash('message', $this->id ? 'Anggota Berhasil Diperbarui.' : 'Anggota Berhasil Ditambahkan.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        $this->id = $id;
        $this->nama = $anggota->nama;
        $this->nim = $anggota->nim;
        $this->organisasi_id = $anggota->organisasi_id;
        $this->openModal();
    }

    public function delete($id)
    {
        Anggota::find($id)->delete();
        session()->flash('message', 'Anggota Berhasil Dihapus.');
    }
}