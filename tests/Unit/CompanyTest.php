<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_company()
    {
        $company = Company::factory()->create([
            'name' => 'Test Company',
            'description' => 'This is a test company',
            'location' => 'Test Location',
        ]);

        $this->assertDatabaseHas('companies', [
            'name' => 'Test Company'
        ]);
    }

    public function test_update_company()
    {
        $company = Company::factory()->create();

        $company->name = 'Updated Company Name';
        $company->save();

        $this->assertDatabaseHas('companies', [
            'name' => 'Updated Company Name'
        ]);
    }

    public function test_delete_company()
    {
        $company = Company::factory()->create();

        $company->delete();

        $this->assertDatabaseMissing('companies', [
            'id' => $company->id
        ]);
    }
}
