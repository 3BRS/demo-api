<script lang="ts">
	export let basicFields;
</script>

<div class="row mt-5">
	<div class="col-md-4">
		<label for="firstName" class="form-label">First Name</label>
		<input
			type="text"
			id="firstName"
			class="form-control"
			maxlength="255"
			bind:value={basicFields.firstName}
			required
		/>
	</div>

	<div class="col-md-4">
		<label for="lastName" class="form-label">Last Name</label>
		<input
			type="text"
			id="lastName"
			class="form-control"
			maxlength="255"
			bind:value={basicFields.lastName}
			required
		/>
	</div>

	<div class="col-md-4">
		<label for="email" class="form-label">Email</label>
		<input
			type="email"
			id="email"
			class="form-control"
			maxlength="255"
			bind:value={basicFields.email}
			required
		/>
	</div>

	<div class="row mt-4">
		<div class="col-md-4">
			<label for="phone" class="form-label">Phone</label>
			<input
				type="text"
				id="phone"
				class="form-control"
				maxlength="255"
				bind:value={basicFields.phone}
				required
			/>
		</div>

		<div class="col-md-4">
			<label for="dateOfBirth" class="form-label">Date of Birth:</label>
			<input
				type="date"
				id="dateOfBirth"
				class="form-control"
				bind:value={basicFields.dateOfBirth}
				required
			/>
		</div>
	</div>
</div>
