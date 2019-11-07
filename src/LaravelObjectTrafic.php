<?php

namespace Atiladanvi\LaravelObjectTrafic;

use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Carbon;

/**
 * Class LaravelObjectTrafic
 * @package Atiladanvi\LaravelObjectTrafic
 */
class LaravelObjectTrafic
{

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    private $model;

    /**
     * @var object
     */
    private $options;

    /**
     * LaravelObjectTrafic constructor.
     * @param $options
     * @param $model
     */
    public function __construct($options, $model)
    {
      $this->model = app(config('laravel-object-trafic.widgets')[$model]);
      $this->options = (object) $options;
      $this->options->interval = isset($options['interval']) ? $options['interval'] : 'week';
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getWidget(){

        $betweenDates = $this->betweenDates(
            isset($this->options->startDate) && $this->options->startDate !== ''  ? $this->options->startDate : false,
            isset($this->options->endDate) && $this->options->endDate !== '' ? $this->options->endDate : false
        );

        $trafics =  $this->model->newQuery()
            ->whereBetween('created_at' , [ $betweenDates->from ,  Carbon::createFromFormat('Y-m-d' , $betweenDates->to )->addDay()])
            ->orderBy('created_at' , 'asc')
            ->get(['created_at'])
            ->groupBy(function($date) {
                return \Carbon\Carbon::parse($date->created_at)->format('Y-m-d');
            })->map(function ($obg){
                return count($obg);
            })
            ->toArray();

        $data = [];

        $labels = [];

        $dates = $this->getDatesFromRange( $betweenDates->from , $betweenDates->to);

        foreach ($dates as $date){
            $labels[] = Carbon::createFromFormat('Y-m-d', $date)->format($this->getLabelFormat());
            $data[] = isset($trafics[$date]) ? $trafics[$date] : 0;
        }

        return ['data' => $data, 'labels' => $labels];
    }

    /**
     * @return string
     */
    private function getLabelFormat(){
        if ($this->options->interval === 'month'){
            return 'M-d';
        }
        return 'D-d/m';
    }

    /**
     * @param $start
     * @param $end
     * @param string $format
     * @return array
     * @throws \Exception
     */
    function getDatesFromRange($start, $end, $format = 'Y-m-d') {

        $array = array();

        $interval = new DateInterval('P1D');

        $realEnd = new DateTime($end);
        $realEnd->add($interval);

        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

        foreach($period as $date) {
            $array[] = $date->format($format);
        }

        return $array;
    }

    /**
     * @param $from
     * @param $to
     * @return bool|object
     */
    private function betweenDates($from, $to){

        if ($to === false){
            $to = Carbon::now()->format('Y-m-d');
        }

        if ($from === false){
            $from = Carbon::now()->subDays($this->getDays())->format('Y-m-d');
        }

        $from = Carbon::createFromFormat('Y-m-d' , $from);
        $to = Carbon::createFromFormat('Y-m-d' , $to);

        return ( object ) [
            'from' => $from->format('Y-m-d'),
            'to' => $to->format('Y-m-d')
        ];
    }

    /**
     * @return int
     */
    private function getDays(){

        if ($this->options->interval === 'month'){
           return 30;
        }

        return 6;
    }
}
