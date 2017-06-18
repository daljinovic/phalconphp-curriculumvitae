<nav class="navbar navbar-inverse">
	<div class="container-fluid">
	
		<div class="navbar-header">
			{{ link_to("employer/students", "Employer", "class": "navbar-brand") }}
		</div>
		
		<div class="collapse navbar-collapse" id="myNavbar">
		
			<ul class="nav navbar-nav navbar-right">			
				<li> {{ link_to("employer/account", "account") }} </li>
			
				<li>
					<a href="{{ url('employer/logout') }}">
						<span class="glyphicon glyphicon-log-in"></span>
						logout
					</a>
				</li>
			</ul>
			
		</div>
		
	</div>
</nav>