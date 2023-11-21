<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    	Schema::disableForeignKeyConstraints();
        Module::truncate();
        Schema::enableForeignKeyConstraints();

        $created_at = Carbon::now()->toDateTimeString();

        Module::insert([
        	['name' => 'Customers', 'status' => 1, 'created_at' => $created_at],
        	['name' => 'Electrician', 'status' => 1, 'created_at' => $created_at],
        	['name' => 'Employee', 'status' => 1, 'created_at' => $created_at],
        	['name' => 'Leads', 'status' => 1, 'created_at' => $created_at],
        	['name' => 'Service Activation', 'status' => 1, 'created_at' => $created_at],
        	['name' => 'Payment Details', 'status' => 1, 'created_at' => $created_at],
        	['name' => 'Role Permission', 'status' => 1, 'created_at' => $created_at]
        ]);
    }
}
