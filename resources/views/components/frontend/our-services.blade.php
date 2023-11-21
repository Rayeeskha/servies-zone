<div>
    <section id="services">
	  <div class="container text-center">
	    <h1 class="panel-heading">Our services</h1>
	    <ul class="services-list">
	    @foreach($services  as $service)
	      <li><a href="{{ route('services', $service->slug) }}"><img src="{{ asset($service->image) }}" alt="{{ $service->service_name }}" style="width: 100%; height: 100%; border: 1px solid silver" />
	      	<br />{{ $service->service_name }}</a></li>
	    @endforeach    	     
	    </ul>
	  </div>
	</section>
</div>