@extends('masters.main')

@section('title')
Control Panel
@endsection

@section('breadcrumb')
Control Panel
@endsection

@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="page-header__title  display-1">Kontrol Paneli</h1>
        <p class="page-header__subtitle">{{ $user->nickname }} </p>
    </div>
</div>


<div class="row">
	<div class="col-md-12">
		<div style="background: rgb(249, 249, 249) none repeat scroll 0% 0%; padding: 10px;">
			<div class="heading">
			<h3>Navigasyon</h3>
		</div>
		<div class="g-content">
				<ul class="match-list">
				  <a href="{{ url('/Users/'.$user->id.'/edit') }}">Profil Düzenleme</a><br>
				  <a href="{{ url('/Users/'.$user->slug) }}">Profil Görüntüleme</a><br>
				  <a href="{{ url('/Users/logout') }}">Çıkış</a><br>
				</ul>
		</div>
		</div>
	</div>


</div>

<br><br>
		

@endsection