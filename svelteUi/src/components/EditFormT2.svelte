<script lang="ts">
	export let address: CustomerAddressType;
</script>

<div class=" container main-wrapper">
	<div class="title">
		<h1>Edit Customer</h1>
	</div>
	<div class=" container form-container">
		<div class="row">
			<form action="GET">
				<div class="mb-3">
					<label for="building" class="form-label">Building</label>
					<input
						type="text"
						bind:value={address.building}
						class="form-control"
						id="building"
						placeholder="building"
					/>
				</div>

				<div class="mb-3">
					<label for="country" class="form-label">Country</label>
					<input
						type="text"
						class="form-control"
						bind:value={address.country}
						id="country"
						placeholder="country"
					/>
				</div>
				<div class="mb-3">
					<label for="street" class="form-label">Street</label>
					<input
						type="text"
						bind:value={address.street}
						class="form-control"
						id="street"
						placeholder="building"
					/>
				</div>

				<div class="mb-3">
					<label for="city" class="form-label">City</label>
					<input
						type="text"
						bind:value={address.city}
						class="form-control"
						id="city"
						placeholder="city"
					/>
				</div>
				<div class="mb-3">
					<label for="postcode" class="form-label">Post Code</label>
					<input
						type="text"
						class="form-control"
						id="postcode"
						placeholder="post code"
						bind:value={address.postcode}
					/>
				</div>

				<div class="submit-btn">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
