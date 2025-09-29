<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Kbli;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class KbliControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_store_kbli_data()
    {
        $data = [
            'id_kbli' => ['12345'],
            'jenis_kbli' => ['Industri Makanan'],
        ];

        $response = $this->post(route('data-kbli.store'), $data);

        $response->assertStatus(200);
        $response->assertJson(['success' => 'Data berhasil disimpan.']);

        $this->assertDatabaseHas('kbli', [
            'id_kbli' => '12345',
            'jenis_kbli' => 'Industri Makanan',
        ]);
    }

    #[Test]
    public function it_can_display_edit_kbli_page()
    {
        $kbli = Kbli::factory()->create();
        $response = $this->get(route('data-kbli.edit', $kbli->id_kbli));
        $response->assertStatus(200);
        $response->assertViewHas('kbli', $kbli);
    }

    #[Test]
    public function it_can_update_kbli_data()
    {
        $kbli = Kbli::factory()->create();
        $data = [
            'id_kbli' => '54321',
            'jenis_kbli' => 'Industri Minuman',
        ];

        $response = $this->put(route('data-kbli.update', $kbli->id_kbli), $data);

        $response->assertStatus(200);
        $response->assertJson(['success' => 'Data berhasil diperbarui.']);

        $this->assertDatabaseHas('kbli', [
            'id_kbli' => '54321',
            'jenis_kbli' => 'Industri Minuman',
        ]);
    }

    #[Test]
    public function it_can_delete_kbli_data()
    {
        $kbli = Kbli::factory()->create();
        $response = $this->delete(route('data-kbli.delete', $kbli->id_kbli));

        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Data berhasil dihapus.');

        $this->assertDatabaseMissing('kbli', [
            'id_kbli' => $kbli->id_kbli,
        ]);
    }
}


