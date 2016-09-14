@extends('layouts.default')

@section('header')
	@if ($service->id)
	{{--*/ $operation = 'update' /*--}}
	<span class="mdl-layout-title">{{$service->name}}</span>
	@else
	{{--*/ $operation = 'create' /*--}}
	<span class="mdl-layout-title">{{Lang::get("general.Service")}}</span>
	@endif
@stop

@section('content')

@permission($operation.'.service')

<div class="">
	<section class="demo-section demo-section--textfield demo-page--textfield mdl-upgraded">
		<div class="demo-preview-block">

@if (!$service->id)
{!! Form::open(['route' => 'service.store']) !!}
@else
{!! Form::model('$service', [
        'method'=>'PUT',
        'enctype' => 'multipart/form-data',
        'route' => ['service.update',$service->id]
    ]) !!}
@endif
			
			<div class="mdl-textfield mdl-js-textfield is-upgraded is-focused mdl-textfield--floating-label @if ($errors->has('name')) is-invalid is-dirty @endif"" data-upgraded="eP">
         		{!!Form::text('name', $service->name, ['class' => 'mdl-textfield__input'])!!}
				{!!Form::label('name', Lang::get('general.name'), ['class' => 'mdl-color-text--primary-contrast mdl-textfield__label is-dirty'])!!}
				<span class="mdl-textfield__error">{{ $errors->first('name') }}</span>
			</div>
			
			<div class="mdl-textfield mdl-js-textfield is-upgraded is-focused mdl-textfield--floating-label @if ($errors->has('description')) is-invalid is-dirty @endif"" data-upgraded="eP">
         		{!!Form::text('description', $service->description, ['class' => 'mdl-textfield__input'])!!}
				{!!Form::label('description', Lang::get('general.description'), ['class' => 'mdl-color-text--primary-contrast mdl-textfield__label is-dirty'])!!}
				<span class="mdl-textfield__error">{{ $errors->first('description') }}</span>
			</div>
    
            <div class="mdl-textfield mdl-js-textfield is-upgraded is-focused mdl-textfield--floating-label @if ($errors->has('price')) is-invalid is-dirty @endif"" data-upgraded="eP">
            	{!!Form::tel('price', $service->price, ['id' => 'price', 'class' => 'mdl-textfield__input mdl-textfield__maskmoney'])!!}
            	{!!Form::label('price', Lang::get('general.price'), ['class' => 'mdl-color-text--primary-contrast mdl-textfield__label is-dirty'])!!}
            	<span class="mdl-textfield__error">{{ $errors->first('price') }}</span>
            </div>  
				
			<div class="mdl-card__actions">
				<button type="submit" class="mdl-button mdl-color--primary mdl-color-text--accent-contrast mdl-js-button mdl-button--raised mdl-button--colored">
                  {{ Lang::get('general.Send') }} 
                </button>
			</div>
	
{!! Form::close() !!}

		</div>
	</section>
</div>

<script>
	$( document ).ready(function() {
		$('#price').maskMoney({!!Lang::get("masks.money")!!});
	});
</script>

@else
<div class="alert alert-info">
	{{Lang::get("general.accessdenied")}}
</div>
@endpermission

@stop