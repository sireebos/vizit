{{-- BOOKING BAR SECTION --}}
@if($home->visible('booking_bar'))
<div class="section background-dark z-too-big">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<form action="{{ route('rooms') }}" method="GET" id="home-booking-form">
				<div class="row justify-content-center home-translate">
					<div class="col-xl-8">
						<div class="row justify-content-center home-shadow">
							<div class="col-md-6 px-sm-0">
								<div class="booking-sep-wrap">
									<div class="input-daterange input-group" id="flight-datepicker-1">
										<div class="form-item">
											<span class="fontawesome-calendar"></span>
											<input class="input-sm" type="text" autocomplete="off" id="start-date" name="check_in" placeholder="check-in" data-date-format="DD, MM d">
											<span class="date-text date-depart"></span>
										</div>
										<div class="form-item">
											<span class="fontawesome-calendar"></span>
											<input class="input-sm" type="text" autocomplete="off" id="end-date" name="check_out" placeholder="check-out" data-date-format="DD, MM d">
											<span class="date-text date-return"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 px-sm-0">
								<div class="quantity">
									<input type="number" name="guests" min="1" max="9999" step="1" value="1">
								</div>
							</div>
							<div class="col-md-3 px-sm-0">
								<button type="submit" class="booking-button-big" style="border: none; cursor: pointer; width: 100%;">{!! $home->content('booking_button_text', 'check<br>availability') !!}</button>
							</div>
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endif
