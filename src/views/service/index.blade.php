@extends('layouts.default')

@section('header')
      
      <span class="mdl-layout-title">{{Lang::get("general.Service")}}</span>

@stop

@include('service.filter')

@section('content')

<div class="mdl-grid demo-content">

	@include('includes.gridview', [
    	'registers' => $services,
    	'gridview' => [
    		'pageActive' => 'service',
         	'sortFilters' => [
                ["class" => "mdl-cell--2-col", "name" => "name", "lang" => "general.name"], 
                ["class" => "mdl-cell--hide-phone mdl-cell--hide-tablet mdl-cell--4-col", "name" => "description", "lang" => "general.description"], 
    			["class" => "mdl-cell--hide-phone mdl-cell--hide-tablet mdl-cell--4-col", "name" => "price", "lang" => "general.price"], 
    		] 
    	]
    ])
     
</div>

@stop