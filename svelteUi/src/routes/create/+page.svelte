<script lang="ts">
	let fields: CustomerBasicInfoType = {
		firstName: '',
		lastName: '',
		email: '',
		phone: '',
		dateOfBirth: ''
	};

	//Handles POST request
	const handleSubmit = async () => {
		try {
			const response = await fetch(`${import.meta.env.VITE_API_URL}/customers`, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/ld+json'
				},
				body: JSON.stringify(fields)
			});

			if (!response.ok) {
				throw new Error();
			}

			const result = await response.json();
			alert('Customer added successfully!');

			fields = { firstName: '', lastName: '', email: '', phone: '', dateOfBirth: '' };
		} catch (error) {
			alert('Failed to add customer. Please try again.');
		}
	};
</script>

<div class="container">
	<div class="pt-5 text-center">
		<h3>Add Customer</h3>
	</div>
	<div class="row justify-content-center my-5">
		<form method="POST" on:submit|preventDefault={handleSubmit}>
			<div class="mb-3">
				<label for="firstName" class="form-label">First Name</label>
				<input
					type="text"
					id="firstName"
					class="form-control"
					required
					bind:value={fields.firstName}
				/>
			</div>

			<div class="mb-3">
				<label for="lastName" class="form-label">Last Name</label>
				<input
					type="text"
					id="lastName"
					class="form-control"
					required
					bind:value={fields.lastName}
				/>
			</div>

			<label for="email" class="form-label">Email</label>
			<div class="input-group mb-3">
				<span class="input-group-text"><i class="bi bi-envelope" /></span>
				<input
					type="text"
					id="email"
					class="form-control"
					required
					bind:value={fields.email}
				/>
			</div>

			<label for="phone" class="form-label">Phone</label>
			<div class="input-group mb-3">
				<span class="input-group-text"><i class="bi bi-telephone" /></span>
				<input
					type="text"
					id="phone"
					class="form-control"
					required
					bind:value={fields.phone}
				/>
			</div>

			<div class="mb-3">
				<label for="dateOfBirth" class="form-label">Date of Birth</label>
				<input
					type="date"
					id="dateOfBirth"
					class="form-control"
					required
					bind:value={fields.dateOfBirth}
				/>
			</div>

			<div class="row mb-4 mt-5 justify-content-center">
				<div class="col-2 text-center">
					<a href="/" class="btn btn-secondary">Back</a>
				</div>
				<div class="col-2 text-center d-grid gap-2">
					<button type="submit" class="btn btn-success">Add Customer</button>
				</div>
			</div>
		</form>
	</div>
</div>
