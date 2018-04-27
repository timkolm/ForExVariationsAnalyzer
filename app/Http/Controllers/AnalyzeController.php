<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Repositories\Contracts\SourceRepositoryInterface as Source;

class AnalyzeController extends Controller
{ 
  public $source;

  function __construct(Source $source)
  {
    $this->source = $source;
  }

  /**
   * Checks the input data and shows the Variation Table if data is ok
   * 
   * @param  Request $request 
   * @return view
   */
  public function show(Request $request)
  {
    //Set today's date if empty input was given
    if(empty($request->date)) $request->date = date('Y/m/d');

    //Input validation
    else $this->validate($request, [
      'date' => [
        'regex:/^[0-9\/]+$/',
        'max:10'
      ]
    ]);

    if(!$this->source->run($request->date)) return $this->errorHandler($this->source->error); 
    // No errors? Can continue!


    
    //Now creating and sorting the table data
    $table = collect(
      $this->buildUpTable(
        $this->source->getStartDayRates(), 
        $this->source->getEndDayRates() 
      )
    )->sortByDesc('sorting');

    $endDate = $this->source->endDate;
    $startDate = $this->source->startDate;
    return view('analyzer.chart')->with(compact('table', 'endDate', 'startDate'));
  }

  /**
   * Redirects back if any errors found
   * @param  obj $error 
   * @return redirection        
   */
  public function errorHandler($error)
  {
    return back()->withErrors([$error]);
  }

  /**
   * Setting up all data for the table to present. Calculating variations
   * @param  obj $ratesStart - the Start Date Rates
   * @param  obj $ratesEnd - the End Date Rates
   * @return array            - all currencies with variations in percentage
   */
  function buildUpTable($ratesStart, $ratesEnd)
  { 
    $table = [];
    foreach ($ratesStart as $currency => $rateStart) {
      if(isset($ratesEnd->$currency)) {
        $difference = round(($ratesEnd->$currency - $rateStart) / $rateStart * 100, 4);
        $sorting = abs($difference); //we need to know how badly the currency has been shaken
        $table[$currency] = ['start' => $rateStart, 'end' => $ratesEnd->$currency, 'difference' => $difference, 'sorting' => $sorting];
      }
    }
    return $table;
  }

}
