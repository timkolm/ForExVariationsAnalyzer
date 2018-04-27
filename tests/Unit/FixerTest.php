<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Repositories\Eloquent\FixerRepository as Fixer;
use App\Http\AnalyzeController;
use Illuminate\Support\Carbon;

class FixerTest extends TestCase
{
  private $fixer;

  function setUp(){
    $this->fixer = new Fixer();
    $this->fixer->run('2018/04/25');
  }

  /** @test */
  public function it_checks_for_errors_from_server()
  {
    $this->assertTrue($this->fixer->error === null);
  }

  /** @test */
  public function it_parses_rates()
  {
    $this->assertTrue(is_float($this->fixer->startDateRates->AED));
    $this->assertTrue(is_float($this->fixer->endDateRates->USD));
  }
}
