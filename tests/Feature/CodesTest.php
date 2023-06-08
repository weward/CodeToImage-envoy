<?php

namespace Tests\Feature;

use App\Models\Code;
use App\Models\CodeLanguage;
use App\Models\CodeStyle;
use App\Traits\tests\GeneratesCodesData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CodesTest extends TestCase
{
    use RefreshDatabase, GeneratesCodesData;

    /**
     * Store a new Code record
     * 
     * @test
     */
    public function codeSavingWasSuccessful()
    {
        $data = $this->createCodeElements(['codeStyle' => 1, 'codeLanguage' => 1]);

        $response = $this->post(route('code.store'), [
            'title' => 'This is the title',
            'code' => 'This is a test code',
            'style_id' => $data['codeStyle'][0]->id,
            'language_id' => $data['codeLanguage'][0]->id,
            'code_bg' => 'bg-dark',
        ]);

        $response->assertStatus(200);
    }

    /**
     * Store a new Code record failed
     * 
     * @test
     */
    public function codeSavingValidationFailed()
    {
        $response = $this->post(route('code.store'), [
            'title' => '',
            'code' => '',
            'style_id' => null
        ]);

        $response->assertStatus(422);
    }

    /**
     * Get All codes working
     * @test
     */
    public function getAllCodesSuccessful()
    {
        Code::factory()->count(3)->create();

        $response = $this->get(route('code.index'));

        $response->assertJson(fn (AssertableJson $json) => $json->has('data', 3));
    }

    /**
     * Check if list is returning the 
     * proper response key (default = 'data')
     * 
     * @test
     */
    public function getAllCodesHasProperResponseKey()
    {
        
        Code::factory()->count(3)->create();

        $response = $this->get(route('code.index'));

        $response->assertJson(fn (AssertableJson $json) => $json->has('data'));
    }
    
    /**
     * Get Specific Entity record
     * 
     * @test
     */
    public function getSpecificCodeRecordSuccessful()
    {
        Code::factory()->count(1)->create();

        $response = $this->get(route('code.view', ['code' => 1]));

        $response->assertJsonFragment([
            'id' => 1,
        ]);
    }

    /**
     * Check if Specific Entity record is returning the 
     * proper response key (default = 'data')
     * 
     * @test
     */
    public function getSpecificCodeRecordHasProperResponseKey()
    {
        Code::factory()->count(1)->create();

        $response = $this->get(route('code.view', ['code' => 1]));

        $response->assertJson(fn (AssertableJson $json) => $json->has('data'));
    }



}
