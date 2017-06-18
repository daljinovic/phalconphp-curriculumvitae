{% extends "templates/base.volt" %}

{% block title %} Signup {% endblock %}
    
{% block content %}
    
    <div class="container">    
		
		{{ partial("partials/flash", ['flashSession' : flashSession|default(null)]) }}
		
		<form class="form-signin form-horizontal" id="form-signup" method="post" action="{{ url('signup/authorise') }}">
		
            <h1 class="form-signin-heading">SIGNUP</h1>
			
			<label for="email" class="sr-only">Email</label>
			{{ text_field("email", "size": 20, "maxlength": 30, "class": "form-control", "placeholder": "something@mail-provider.com", "required": true, "autofocus": true) }}
			
			<label for="password" class="sr-only">Password</label>
			{{ password_field("password", "size": 20, "maxlength": 30, "class": "form-control", "placeholder": "your password", "required": true) }}
			
			<label for="password_repeat" class="sr-only">Repeat password</label>
			{{ password_field("password_repeat", "size": 20, "maxlength": 30, "class": "form-control", "placeholder": "confirm password", "required": true) }}
			
			<label>Odaberite:</label>
			
			{{ radio_field("role", "value": "student", "checked": true) }}
			<label for="role">Student</label>
			{{ radio_field("role", "value": "employer") }}
			<label for="role">Employer</label>
			
			{{ submit_button("Sign up", "name": "signup", "class": "btn btn-lg btn-primary btn-block") }}
			
			{{ link_to("login", "Already have an account? Log in!") }}
			
		</form>

    </div>
	
{% endblock %}
