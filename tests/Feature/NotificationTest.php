<?php

namespace Tests\Feature;

use App\User;
use App\UserNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_create_a_notification()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        Passport::actingAs($user);

        $notification = factory(UserNotification::class)->create()->toArray();

        $response = $this->json('POST','/api/notifications', $notification);
        $response->assertStatus(201);
        $response->assertJsonStructure(['title', 'content', 'is_read', 'user_id']);

        /* we don't need to test the dates */
        unset($notification['created_at']);
        unset($notification['updated_at']);

        $this->assertDatabaseHas('notifications', $notification);
    }


    public function test_list_all_notifications()
    {
        factory(UserNotification::class, 50)->create();
        $user = factory(User::class)->create();
        Passport::actingAs($user);

        $response = $this->json('GET', '/api/notifications');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => ['title', 'content', 'is_read', 'user_id']
            ]
        ]);
    }

    public function test_update_notification_status()
    {
        $this->withoutExceptionHandling();
        $notification = factory(UserNotification::class)->create();
        $user = factory(User::class)->create();
        Passport::actingAs($user);

        $response = $this->json('PUT', "/api/notification-status/$notification->id", [
            "is_read" => true,
        ]);
        $response->assertStatus(200);

        $response->assertJsonStructure(["title", "content", 'is_read']);
        $this->assertDatabaseHas('notifications', ['id' => $notification->id, 'is_read' => true]);
    }

    public function test_show_notification_by_id()
    {
        $notification = factory(UserNotification::class)->create();
        $user = factory(User::class)->create();
        Passport::actingAs($user);

        $response = $this->json('GET', "/api/notifications/$notification->id");
        $response->assertStatus(200);

        $response->assertJsonStructure(['title', 'content', 'is_read', 'user_id']);
    }


}
