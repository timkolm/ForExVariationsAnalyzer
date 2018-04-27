<?php
namespace Repositories\Contracts;

interface SourceRepositoryInterface
{
  /**
   * gets the raw data by date as a string
   * 
   * @param  [string] $date in the form 'YYYY/MM/DD'
   * @return [Json string]       
   */
  public function run($date);

  public function getStartDayRates();

  public function getEndDayRates();
}