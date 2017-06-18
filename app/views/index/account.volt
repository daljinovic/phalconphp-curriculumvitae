{% extends "templates/base.volt" %}

{% block title %} Account {% endblock %}


{% block navigation %}

	{{ partial("partials/" ~user.role~ "_partials/" ~user.role~ "_navbar") }}
	
{% endblock %}
	
	
{% block content %}

	<section class="content-section">
		<div class="form-horizontal container">

			{{ partial("partials/flash", ['flashSession' : flashSession|default(null)]) }}
		
			<form class="form-signin" method="post" action="{{ url(user.role~ '/account/edit') }}">
				
				<label for="email" >Email/username</label>
				<div class="input-group">
					<span class="input-group-addon">@</span>
					{{ text_field("email", "class": "form-control", "value": user.email) }}
				</div>
				
				<label for="password_current" >Current password</label>
				{{ password_field("password_current", "class": "form-control", "placeholder": "Enter your current password") }}
				
				<label for="password_new" >New password</label>
				{{ password_field("password_new", "class": "form-control", "placeholder": "Enter your new password") }}
				
				<label for="password_new_repeat">Repeat new password</label>
				{{ password_field("password_new_repeat", "class": "form-control", "placeholder": "Repeat new password") }}
				
				{{ submit_button("Save",  "name": "save", "class": "btn btn-lg btn-primary btn-block") }}
			
			</form>
			
		</div>
	</section>
	
{% endblock %}