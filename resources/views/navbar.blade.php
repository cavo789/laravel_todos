<nav class="navbar sticky-top navbar-light" style="background-color: #e3f2fd;">
	<ul class="nav navbar-nav navbar-right">
@guest
		<li><a href="/login"><i class="fas fa-sign-in-alt"></i> Login</a></li>
@else
  		<li><a href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
@endauth
	</ul>
</nav>
