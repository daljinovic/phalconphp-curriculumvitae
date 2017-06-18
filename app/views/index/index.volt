{% extends "templates/base.volt" %}

{% block title %} Index {% endblock %}

{% block content %}
    
    <div class="container">    
		<div class="row">
		
		<div class="col-lg-6">		
			{{ link_to("login", "Login", "class": "btn btn-lg btn-primary btn-block") }}			
		</div>
		
		<div class="col-lg-6">		
			{{ link_to("signup", "Signup", "class": "btn btn-lg btn-primary btn-block") }}			
		</div>

		</div>
    </div>
   
{% endblock %}