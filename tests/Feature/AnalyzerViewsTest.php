<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnalyzerViewsTest extends TestCase
{
    /**
     * Just checks if the Analyzer's main page is loading
     *
     * @return void
     */
    public function test_it_comes_to_main_analyzer_page()
    {
        $response = $this->get('analyzer');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_sends_data_to_the_analyze_page_and_returns_a_page()
    {
      $data = array(
        '_token' => csrf_token(),
        'date' => '2018/04/20'
      );

      $response = $this->call('POST', 'analyze-it', $data);

      $response->assertStatus(200);
    }
}
