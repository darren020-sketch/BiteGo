<?php

namespace Tests\Feature;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Stall;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderingTest extends TestCase
{
    use RefreshDatabase;

    private User $siswa;

    private User $vendor;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();

        $this->siswa = User::where('role', 'siswa')->first();
        $this->vendor = User::where('role', 'vendor')->first();
    }

    public function test_home_page_returns_success(): void
    {
        $this->get('/')->assertStatus(200);
    }

    public function test_menu_and_stall_pages_load(): void
    {
        $this->get('/menu')->assertStatus(200);

        $stall = Stall::first();
        $this->get('/stall/'.$stall->slug)->assertStatus(200);
    }

    public function test_guest_is_redirected_from_orders(): void
    {
        $this->get('/orders')->assertRedirect('/login');
    }

    public function test_siswa_can_place_an_order_with_unique_code(): void
    {
        $menu = Menu::where('is_available', true)->where('stock', '>', 20)->first();

        $this->actingAs($this->siswa)
            ->post('/order/'.$menu->slug, [
                'quantity' => 2,
                'pickup_slot' => 'istirahat_1',
                'notes' => 'Sambal pisah',
            ])
            ->assertRedirect();

        $order = Order::where('user_id', $this->siswa->id)->latest('id')->first();

        expect($order)->not->toBeNull();
        expect($order->pickup_code)->toMatch('/^\d{4}$/');
        expect($order->total_amount)->toBe($menu->price * 2);
        expect($order->items()->count())->toBe(1);

        $this->get("/orders/{$order->id}/success")->assertStatus(200);
    }

    public function test_siswa_cannot_access_vendor_dashboard(): void
    {
        $this->actingAs($this->siswa)->get('/vendor')->assertForbidden();
    }

    public function test_vendor_can_advance_order_status(): void
    {
        $menu = Menu::where('is_available', true)->where('stock', '>', 20)->first();

        $this->actingAs($this->siswa)->post('/order/'.$menu->slug, [
            'quantity' => 1,
            'pickup_slot' => 'istirahat_2',
            'notes' => null,
        ]);

        $order = Order::where('user_id', $this->siswa->id)->latest('id')->first();

        $this->actingAs($this->vendor)
            ->post("/vendor/orders/{$order->id}/status", ['status' => 'dimasak'])
            ->assertRedirect();

        expect($order->fresh()->status)->toBe('dimasak');
    }

    public function test_siswa_can_cancel_order_while_waiting(): void
    {
        $menu = Menu::where('is_available', true)->where('stock', '>', 20)->first();

        $this->actingAs($this->siswa)->post('/order/'.$menu->slug, [
            'quantity' => 1,
            'pickup_slot' => 'istirahat_1',
            'notes' => null,
        ]);

        $order = Order::where('user_id', $this->siswa->id)->latest('id')->first();
        $stockBefore = $menu->fresh()->stock;

        $this->actingAs($this->siswa)
            ->post("/orders/{$order->id}/cancel")
            ->assertRedirect();

        expect($order->fresh()->status)->toBe('dibatalkan');
        expect($menu->fresh()->stock)->toBe($stockBefore + 1);
    }
}
