<section class="content-section" id="search-CVs">

	<div class="container">
	
		<form class="search" method="post" action="{{ url('employer/search') }}" >
		
			{{ select('city', cities, 'using': ['id', 'name'],
				"class": "selectpicker", "data-style": "btn-primary", 'useEmpty': true,
				'emptyText': 'Search city..', 'emptyValue': '@') }}
					
			<select name="science_field" class="selectpicker" data-style="btn-primary">
				<option value="@" disabled selected> Search science field... </option>
				{% for i in science_domains %}
					<optgroup label="{{ i.name }}">
						{% for j in science_fields %}
							{% if j.scienceDomains.id == i.id %}
								{% if education.scienceFields.id == j.id %}
									<option value="{{ j.id }}" selected> {{ j.name }} </option>
								{% else %}
									<option value="{{ j.id }}"> {{ j.name }} </option>
								{% endif %}
							{% endif %}
						{% endfor %}
					</optgroup>
				{% endfor %}
			</select>
			
			<button type="submit" name="search" class="btn btn-default">
				<span class="glyphicon glyphicon-search"></span> Search
			</button>
			
			{{ link_to("employer/students", "Reset", "class": "btn btn-default") }}

		</form>
	</div>

</section>