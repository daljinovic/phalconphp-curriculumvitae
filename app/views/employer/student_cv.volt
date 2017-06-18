{% extends "templates/base_employer.volt" %}

{% block title %} Student CV {% endblock %}


{% block navigation %}

	{{ partial("partials/employer_partials/employer_navbar") }}

{% endblock %}


{% block content %}

	<section class="content-section">
		
		<div class="container">
			<div class="row">
			
				<div class="col-lg-6">				
					<h4>Personal information</h4>
					<hr>
					<dl class="dl-horizontal">
						<dt>Name:</dt>				
						<dd>{{ student.fname }} {{ student.lname }}</dd>
					
						<dt>Address:</dt>				
						<dd>{{ student.address }}</dd>
						
						<dt>City:</dt>
						<dd>{{ student.cities.zip_code|default(null) }} {{ student.cities.name|default(null) }} {{ student.cities.country|default(null) }}</dd>
						
						<dt>Birth date:</dt>				
						<dd>{{ student.birth }}</dd>
						
						<dt>Email:</dt>				
						<dd>{{ student.email }}</dd>
						
						<dt>Phone:</dt>				
						<dd>{{ student.phone }}</dd>
						
						<dt>Web:</dt>				
						<dd>{{ student.web }}</dd>
					</dl>
				</div>
					
					
				<div class="col-lg-6">	
					<h4>Skills</h4>
					<hr>					
					<dl class="dl-horizontal">
						<dt>Native language:</dt>
						<dd>{{ student.skills.language|default(null) }}	</dd>
					
						<dt>Additional languages:</dt>				
						<dd>{{ student.skills.language_other|default(null) }}</dd>
						
						<dt>Communication skills:</dt>				
						<dd>{{ student.skills.communication|default(null) }}</dd>
						
						<dt>Organization skills:</dt>				
						<dd>{{ student.skills.organization|default(null) }}</dd>
						
						<dt>Business skills:</dt>				
						<dd>{{ student.skills.business|default(null) }}</dd>
						
						<dt>Other skills:</dt>				
						<dd>{{ student.skills.skills_other|default(null) }}</dd>
						
						<dt>Drivers licence:</dt>
						{% if student.skills.drivers_licence is not empty %}
							<dd>
							{% for i in student.skills.drivers_licence %}
								{{ i }},
							{% endfor %}
							</dd>
						{% endif %}
					</dl>
					
				</div>
				
				
			</div>
			
			<hr>
			
			<div class="row">
				<div class="col-lg-6">
				
					<h4>Education</h4>
					<hr>					
					{% for edu in student.education %}
					<dl class="dl-horizontal">
						<dt> Institution name: </dt>
						<dd>{{ edu.institution_name }}</dd>
						
						<dt> Study: </dt>
						<dd>{{ edu.study }}</dd>
						
						<dt> Title: </dt>
						<dd>{{ edu.title }}</dd>
						
						<dt> City: </dt>
						<dd>{{ edu.city }}</dd>
						
						<dt> Country: </dt>
						<dd>{{ edu.country }}</dd>
						
						<dt> Duration: </dt>
						<dd>{{ edu.duration_from }} - {{ edu.duration_to |default('/') }}</dd>

					</dl>
					{% endfor %}
				</div>	
				
				
				<div class="col-lg-6">				
					<h4>Experience</h4>
					<hr>					
					{% for exp in student.experience %}
					<dl class="dl-horizontal">
						<dt> Institution name: </dt>
						<dd>{{ exp.institution_name }}</dd>
						
						<dt> Position: </dt>
						<dd>{{ exp.position }}</dd>
						
						<dt> Functions: </dt>
						<dd>{{ exp.functions }}</dd>
						
						<dt> City: </dt>
						<dd>{{ exp.city }}</dd>
						
						<dt> Country: </dt>
						<dd>{{ exp.country }}</dd>
						
						<dt> Duration: </dt>
						<dd>{{ exp.duration_from }} - {{ exp.duration_to |default('/') }}</dd>
						
					</dl>
					{% endfor %}
					
					
				</div>
		
			</div>
		</div>
		
	</section>
	

{% endblock %}

