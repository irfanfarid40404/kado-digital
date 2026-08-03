<?php

namespace App\Livewire;

use App\Models\Page;
use App\Models\PageMedia;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class PageEditor extends Component
{
    use WithFileUploads;

    public string $theme = 'romantic_classic';
    public int $currentStep = 1;

    // Step 1: Info Dasar
    public string $recipient_name = '';
    public string $title = '';

    // Step 2: Surat / Cerita
    public string $story = '';

    // Step 3: Galeri Foto
    public array $photos = [];
    public array $existingPhotos = [];

    // Step 4: Musik Latar
    public string $preset_music = 'piano';
    public $custom_audio = null;

    // Step 5: Hitung Mundur
    public ?string $countdown_date = null;

    public function mount(string $theme = 'romantic_classic')
    {
        $validThemes = ['romantic_classic', 'playful', 'elegant_night'];
        $this->theme = in_array($theme, $validThemes) ? $theme : 'romantic_classic';

        // Prefill warm default title suggestion
        if ($this->theme === 'romantic_classic') {
            $this->title = 'Untuk Cinta Dalam Hidupku';
        } elseif ($this->theme === 'playful') {
            $this->title = 'Surprise Spesial Buat Kamu! 🎉';
        } else {
            $this->title = 'Malam Spesial Kenangan Kita';
        }
    }

    public function nextStep()
    {
        $this->validateStep();
        if ($this->currentStep < 5) {
            $this->currentStep++;
        }
    }

    public function prevStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function validateStep()
    {
        if ($this->currentStep === 1) {
            $this->validate([
                'recipient_name' => 'required|string|max:100',
                'title' => 'required|string|max:150',
            ], [
                'recipient_name.required' => 'Masukkan nama pasanganmu',
                'title.required' => 'Masukkan judul ucapan / halaman',
            ]);
        } elseif ($this->currentStep === 2) {
            $this->validate([
                'story' => 'required|string|min:10',
            ], [
                'story.required' => 'Tuliskan sedikit cerita / surat romantis',
                'story.min' => 'Surat minimal 10 karakter',
            ]);
        } elseif ($this->currentStep === 3) {
            $this->validate([
                'photos.*' => 'image|max:10240', // 10MB per photo max
            ]);
        } elseif ($this->currentStep === 4) {
            if ($this->preset_music === 'custom' && $this->custom_audio) {
                $this->validate([
                    'custom_audio' => 'file|mimes:mp3,wav,ogg,m4a|max:15360', // 15MB max
                ]);
            }
        }
    }

    public function removePhoto($index)
    {
        if (isset($this->photos[$index])) {
            unset($this->photos[$index]);
            $this->photos = array_values($this->photos);
        }
    }

    public function savePage()
    {
        $this->validate([
            'recipient_name' => 'required|string|max:100',
            'title' => 'required|string|max:150',
            'story' => 'required|string|min:10',
        ]);

        $page = Page::create([
            'session_id' => session()->getId(),
            'theme' => $this->theme,
            'recipient_name' => $this->recipient_name,
            'title' => $this->title,
            'story' => $this->story,
            'countdown_date' => $this->countdown_date ? $this->countdown_date : null,
            'status' => 'draft',
        ]);

        // Save Photos
        $order = 0;
        foreach ($this->photos as $photo) {
            $path = $photo->store('photos', 'public');
            PageMedia::create([
                'page_id' => $page->id,
                'type' => 'photo',
                'path' => $path,
                'order' => $order++,
            ]);
        }

        // Save Audio
        $audioPath = null;
        if ($this->preset_music === 'custom' && $this->custom_audio) {
            $audioPath = $this->custom_audio->store('audio', 'public');
        } else {
            // Preset audio map
            $audioPath = 'audio/preset-' . $this->preset_music . '.mp3';
        }

        PageMedia::create([
            'page_id' => $page->id,
            'type' => 'audio',
            'path' => $audioPath,
            'caption' => ucfirst($this->preset_music),
            'order' => 0,
        ]);

        return redirect()->route('preview', ['page' => $page->id]);
    }

    public function render()
    {
        return view('livewire.page-editor')->layout('components.layouts.app', [
            'title' => 'Buat Halaman Surprise — Step ' . $this->currentStep,
        ]);
    }
}
