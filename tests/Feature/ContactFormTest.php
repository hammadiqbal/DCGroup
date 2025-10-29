<?php

namespace Tests\Feature;

use App\Mail\ContactNotification;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    
    public function test_contact_form_submission_saves_message_to_database(): void
    {
        Mail::fake();

        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'subject' => $this->faker->sentence(4),
            'message' => $this->faker->paragraph(3),
        ];

        $response = $this->postJson('/contact', $data);

        $this->assertDatabaseHas('contacts', [
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'],
            'message' => $data['message'],
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                 ]);
    }

    
    public function test_contact_form_submission_sends_email_to_admin(): void
    {
        Mail::fake();

        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'subject' => $this->faker->sentence(4),
            'message' => $this->faker->paragraph(3),
        ];

        $response = $this->postJson('/contact', $data);

        Mail::assertSent(ContactNotification::class, function ($mail) use ($data) {
            return $mail->contact->email === $data['email'] &&
                   $mail->contact->name === $data['name'] &&
                   $mail->contact->subject === $data['subject'];
        });

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Thank you! Your message has been sent successfully.'
                 ]);
    }

    
    public function test_contact_form_validation_requires_name(): void
    {
        Mail::fake();

        $data = [
            'email' => $this->faker->safeEmail(),
            'subject' => $this->faker->sentence(4),
            'message' => $this->faker->paragraph(3),
        ];

        $response = $this->postJson('/contact', $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);

        $this->assertDatabaseCount('contacts', 0);
        Mail::assertNothingSent();
    }

    public function test_contact_form_validation_requires_email(): void
    {
        Mail::fake();

        $data = [
            'name' => $this->faker->name(),
            'subject' => $this->faker->sentence(4),
            'message' => $this->faker->paragraph(3),
        ];

        $response = $this->postJson('/contact', $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['email']);

        $this->assertDatabaseCount('contacts', 0);
        Mail::assertNothingSent();
    }

  
    public function test_contact_form_validation_requires_valid_email(): void
    {
        Mail::fake();

        $data = [
            'name' => $this->faker->name(),
            'email' => 'invalid-email',
            'subject' => $this->faker->sentence(4),
            'message' => $this->faker->paragraph(3),
        ];

        $response = $this->postJson('/contact', $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['email']);

        $this->assertDatabaseCount('contacts', 0);
        Mail::assertNothingSent();
    }

    public function test_contact_form_validation_requires_subject(): void
    {
        Mail::fake();

        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'message' => $this->faker->paragraph(3),
        ];

        $response = $this->postJson('/contact', $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['subject']);

        $this->assertDatabaseCount('contacts', 0);
        Mail::assertNothingSent();
    }

    public function test_contact_form_validation_requires_message(): void
    {
        Mail::fake();

        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'subject' => $this->faker->sentence(4),
        ];

        $response = $this->postJson('/contact', $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['message']);

        $this->assertDatabaseCount('contacts', 0);
        Mail::assertNothingSent();
    }

   
    public function test_contact_form_validation_requires_all_fields(): void
    {
        Mail::fake();

        $response = $this->postJson('/contact', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'email', 'subject', 'message']);

        $this->assertDatabaseCount('contacts', 0);
        Mail::assertNothingSent();
    }

    public function test_contact_form_saves_ip_address(): void
    {
        Mail::fake();

        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'subject' => $this->faker->sentence(4),
            'message' => $this->faker->paragraph(3),
        ];

        $response = $this->postJson('/contact', $data);

        $contact = Contact::where('email', $data['email'])->first();
        $this->assertNotNull($contact->ip);
        $this->assertNotEmpty($contact->ip);
    }
}
