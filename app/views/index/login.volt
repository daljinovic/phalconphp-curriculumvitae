{% extends "templates/base.volt" %}

{% block title %} Login {% endblock %}
    
{% block content %}

    <div class="container"> 
		
		{{ partial("partials/flash", ['flashSession' : flashSession|default(null)]) }}

        <form class="form-signin" id="form-login" method="post" action="{{ url('login/authorise') }}" >
		
            <h1 class="form-signin-heading">LOGIN</h1>
            
            <label for="email" class="sr-only">Email</label>
			{{ text_field("email", "size": 20, "maxlength": 30, "class": "form-control", "placeholder": "something@mail-provider.com", "required": true, "autofocus": true) }}
            
            <label for="password" class="sr-only">Password</label>
            {{ password_field("password", "size": 20, "maxlength": 30, "class": "form-control", "placeholder": "your password", "required": true) }}
			
			{{ submit_button("Login",  "name": "login", "class": "btn btn-lg btn-primary btn-block") }}
			
			{{ link_to("signup", "Don't have an account? Sign up!") }}
			
        </form>
	
    </div>
	
{% endblock %}