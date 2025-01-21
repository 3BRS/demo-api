<script lang="ts">
	export let addressFields;
	export let countryRequired: boolean;
	export let prefix: string;
</script>

<div class="row mt-5">
	<div class="col-md-4">
		<label for="{prefix}Building" class="form-label">Building</label>
		<input
			type="text"
			class="form-control"
			id="{prefix}Building"
			maxlength="255"
			bind:value={addressFields.building}
		/>
	</div>

	<div class="col-md-4">
		<label for="{prefix}Street" class="form-label">Street</label>
		<input
			type="text"
			class="form-control"
			id="{prefix}Street"
			maxlength="255"
			bind:value={addressFields.street}
		/>
	</div>

	<div class="col-md-4">
		<label for="{prefix}Postcode" class="form-label">Postcode</label>
		<input
			type="text"
			class="form-control"
			id="{prefix}Postcode"
			maxlength="8"
			bind:value={addressFields.postcode}
		/>
	</div>

	<div class="row mt-4">
		<div class="col-md-4">
			<label for="{prefix}City" class="form-label">City</label>
			<input
				type="text"
				class="form-control"
				id="{prefix}City"
				maxlength="255"
				bind:value={addressFields.city}
			/>
		</div>

		<div class="col-md-4">
			<label for="{prefix}Country" class="form-label">Country</label>
			<select
				id="{prefix}Country"
				class="form-select"
				required={countryRequired}
				bind:value={addressFields.country}
			>
				<option value="" disabled selected>Select a country</option>
				<option value="GB">GB</option>
				<option value="CZ">CZ</option>
				<option value="FR">FR</option>
				<option value="DE">DE</option>
				<option value="AT">AT</option>
				<option value="" hidden={countryRequired}>none</option>
			</select>
		</div>
	</div>
</div>
