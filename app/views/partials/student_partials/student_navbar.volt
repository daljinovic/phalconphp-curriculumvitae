<nav class="navbar navbar-inverse">
	<div class="container-fluid">
	
		<div class="navbar-header">
			{{ link_to("student/mycv/personal", "Student", "class": "navbar-brand") }}
		</div>
		
		<div class="collapse navbar-collapse" id="myNavbar">
		
			<ul class="nav navbar-nav navbar-right">
				<li> {{ link_to("student/mycv/publish", "publish CV") }} </li>
			
				<li> {{ link_to("student/account", "account") }} </li>
			
				<li>
					<a href="{{ url('student/logout') }}">
						<span class="glyphicon glyphicon-log-in"></span>
						logout
					</a>
				</li>
			</ul>
			
		</div>
		
	</div>
</nav>