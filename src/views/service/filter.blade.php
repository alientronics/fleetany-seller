@section('filter')

    @include('includes.filter-buttons', [ 'pageActive' => 'service' ])
      
    <form method="get" id="search">
      <div class="demo-drawer mdl-layout__drawer-right">
        <span class="mdl-layout-title mdl-color--primary mdl-color-text--accent-contrast">{{Lang::get('general.Search')}}<span class="mdl-search__div-close"><i class="material-icons">highlight_off</i></span></span>
         <div class="mdl-textfield mdl-js-textfield is-upgraded is-focused mdl-textfield--floating-label mdl-search__div" data-upgraded="eP">
     		{!!Form::text('name', $filters['name'], ['class' => 'mdl-textfield__input mdl-search__input'])!!}
    		{!!Form::label('name', Lang::get('general.name'), ['class' => 'mdl-textfield__label is-dirty'])!!}
         </div>
         <div class="mdl-textfield mdl-js-textfield is-upgraded is-focused mdl-textfield--floating-label mdl-search__div" data-upgraded="eP">
     		{!!Form::text('description', $filters['description'], ['class' => 'mdl-textfield__input mdl-search__input'])!!}
    		{!!Form::label('description', Lang::get('general.description'), ['class' => 'mdl-textfield__label is-dirty'])!!}
         </div>
         <div class="mdl-textfield mdl-js-textfield is-upgraded is-focused mdl-textfield--floating-label mdl-search__div" data-upgraded="eP">
     		{!!Form::text('price', $filters['price'], ['id' => 'price', 'class' => 'mdl-textfield__input mdl-search__input  mdl-textfield__maskmoney'])!!}
    		{!!Form::label('price', Lang::get('general.price'), ['class' => 'mdl-textfield__label is-dirty'])!!}
         </div>
         <button type="submit" class="mdl-button mdl-color--primary mdl-color-text--accent-contrast mdl-js-button mdl-button--raised mdl-button--colored mdl-search__button">
    		{{Lang::get('general.Search')}}
         </button>
      </div>
    </form>

	<script>
    	$( document ).ready(function() {
    		$('#price').maskMoney({!!Lang::get("masks.money")!!});
    	});
    </script>

@stop
