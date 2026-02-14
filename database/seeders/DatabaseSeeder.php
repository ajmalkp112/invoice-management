<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{
  use WithoutModelEvents;

  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // User::factory(10)->create();

    User::factory()->create([
      'name' => 'Test User',
      'email' => 'test@example.com',
    ]);

    Customer::create([
      'name' => 'Deepak Srinivasan',
      'phone' => '9999999999',
      'address' => 'Calicut'
    ]);

    Service::insert([
      ['name' => 'Badminton Court', 'hourly_rate' => 500],
      ['name' => 'Football Turf', 'hourly_rate' => 1500],
      ['name' => 'Cricket Turf', 'hourly_rate' => 800],
    ]);
  }
}
