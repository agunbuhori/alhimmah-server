<?php

$user = auth()->user();

?>

<!-- Main sidebar -->
<div class="sidebar sidebar-main">
	<div class="sidebar-content">

		<!-- User menu -->
		<div class="sidebar-user-material">
			<div class="category-content">
				<div class="sidebar-user-material-content">
					<a href="#"><img src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name='.$user->name }}" class="img-circle img-responsive" alt=""></a>
					<h6>{{ $user->name }}</h6>
					<span class="text-size-small">{{ ucwords(implode(", ", $user->getRoleNames()->toArray())) }}</span>
				</div>

				<div class="sidebar-user-material-menu">
					<a href="#user-nav" data-toggle="collapse"><span>@lang('Akun Saya')</span> <i class="caret"></i></a>
				</div>
			</div>

			<div class="navigation-wrapper collapse" id="user-nav">
				<ul class="navigation">
					<li><a href="#"><i class="icon-cog"></i> <span>@lang('Pengaturan')</span></a></li>
					<li><a href="/logout"><i class="icon-switch2"></i> <span>@lang('Keluar')</span></a></li>
				</ul>
			</div>
		</div>
		<!-- /user menu -->


		<!-- Main navigation -->
		<div class="sidebar-category sidebar-category-visible">
			<div class="category-content no-padding">
				<ul class="navigation navigation-main navigation-accordion">

					<!-- Main -->
					<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
					<li><a href="/admin"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
					<li><a href="/admin/classroom"><i class="icon-office"></i> <span>@lang('Manajemen Kelas')</span></a></li>
					<li><a href="/admin/member"><i class="icon-users"></i> <span>@lang('Manajemen Peserta')</span></a></li>
					<li><a href="/admin/bank"><i class="icon-bookmark"></i> <span>@lang('Bank Soal')</span></a></li>
					<li><a href="/admin/media"><i class="icon-folder-search"></i> <span>@lang('Manajemen Media')</span></a></li>
	

				</ul>
			</div>
		</div>
		<!-- /main navigation -->

	</div>
</div>
<!-- /main sidebar -->