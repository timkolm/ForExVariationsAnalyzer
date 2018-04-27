<?php
namespace Repositories\Eloquent;

use Illuminate\Support\Carbon;
use Repositories\Contracts\SourceRepositoryInterface;

class FixerRepository implements SourceRepositoryInterface
{
  public $startDate;
  public $endDate;
  public $startDateRates;
  public $endDateRates;
  public $error;

  /**
   * initiates connections to the Fixer.io API.
   * @param  string $date 
   * @return bool       
   */
  public function run($date='')
  {
    $this->endDate = $this->dateObject($date);
    $this->startDate = $this->endDate->copy()->subDays(30);
    
    $this->endDateRates = $this->connect($this->endDate);
    if($this->error) return false;
    $this->startDateRates = $this->connect($this->startDate);
    if($this->error) return false;
    return true;
  }

  /**
   * retrieves now day rates or the given date rates
   * @return obj 
   */
  public function getEndDayRates()
  {
    return $this->endDateRates;
  }

  /**
   * retrieves rates which were 30 days before the given date
   * @return obj 
   */
  public function getStartDayRates(){
    return $this->startDateRates;
  }

  /**
   * Format needed for the Fixer.io API
   * @param  obj $date 
   * @return string       
   */
  public function formattedDate($date)
  {
    return $date->format('Y-m-d');
  }

  /**
   * connects to the Fixer.io site and harvests rates for a given date
   * @param  obj $date 
   * @return obj       (rates)
   */
  public function connect($date)
  {
    if(empty(env('FIXER_IO_ACCESS_KEY'))){
      $this->error = 'The Access Key is not installed! Please refer to the Readme.md file.';
      return false;
    }

    try {
      $result = file_get_contents('http://data.fixer.io/api/'.$this->formattedDate($date).'?access_key='.env('FIXER_IO_ACCESS_KEY'));
    } catch (Exception $e) {
      $this->error = $e->getMessage();
      return false;
    }

    if(empty($result)) {
      $this->error = 'Could not establish connection to the Fixer.io.';
      return false;
    }

    $parsed = json_decode($result);

    if(empty($parsed)) $this->error = 'Could not parse data from Fixer.io';
    if(!empty($parsed->error)) $this->error = $parsed->error;

    if(isset($parsed->rates)) return $parsed->rates;
    return false;
  }

  /**
   * Create a Carbon object from a sring date
   * @param  string $date - in format 'Y/m/d'
   * @return obj       
   */
  public function dateObject(string $date='')
  {
    if(!$date) return Carbon::now();
    return Carbon::createFromFormat('Y/m/d', $date);
  }

}