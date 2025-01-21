<script lang="ts">
	import { onMount } from 'svelte';
	import { page } from '$app/stores';
	import { goto } from '$app/navigation';

	let customer = undefined as undefined | CustomerType;

	const emptyAddress = { building: '', country: '', street: '', city: '', postcode: '' };

	//basic info fields
	let basicFields = { firstName: '', lastName: '', email: '', phone: '', dateOfBirth: '' };

	//address fields
	let addressFields = {
		addressHome: { ...emptyAddress },
		addressPostal: { ...emptyAddress },
		addressBilling: { ...emptyAddress }
	};

	onMount(() => {
		fetch(`${import.meta.env.VITE_API_URL}/customers/${$page.params.id}`, {
			method: 'GET'
		}).then((response) => {
			response.json().then((data) => {
				customer = data;

				if (customer) {
					//reformat date for prefill
					const date = new Date(customer.dateOfBirth);
					customer.dateOfBirth = date.toISOString().split('T')[0]; // format to yyyy-MM-dd

					//prefill basic info fields
					basicFields = {
						firstName: customer.firstName,
						lastName: customer.lastName,
						email: customer.email,
						phone: customer.phone,
						dateOfBirth: customer.dateOfBirth
					};

					//prefill address fields if they exist
					if (customer.addressHome) {
						addressFields.addressHome.building = customer.addressHome.building || '';
						addressFields.addressHome.street = customer.addressHome.street || '';
						addressFields.addressHome.postcode = customer.addressHome.postcode || '';
						addressFields.addressHome.city = customer.addressHome.city || '';
						addressFields.addressHome.country = customer.addressHome.country || '';
					}

					if (customer.addressBilling) {
						addressFields.addressBilling.building =
							customer.addressBilling.building || '';
						addressFields.addressBilling.street = customer.addressBilling.street || '';
						addressFields.addressBilling.postcode =
							customer.addressBilling.postcode || '';
						addressFields.addressBilling.city = customer.addressBilling.city || '';
						addressFields.addressBilling.country =
							customer.addressBilling.country || '';
					}

					if (customer.addressPostal) {
						addressFields.addressPostal.building =
							customer.addressPostal.building || '';
						addressFields.addressPostal.street = customer.addressPostal.street || '';
						addressFields.addressPostal.postcode =
							customer.addressPostal.postcode || '';
						addressFields.addressPostal.city = customer.addressPostal.city || '';
						addressFields.addressPostal.country = customer.addressPostal.country || '';
					}
				}
			});
		});
	});

	//creates customer formatted for API call
	const formatCustomer = () => {
		let formattedCustomer: {
			firstName: string;
			lastName: string;
			email: string;
			phone: string;
			dateOfBirth: string;
			addressHome?: {
				building?: string;
				country: string;
				street?: string;
				city?: string;
				postcode?: string;
			} | null;
			addressPostal?: {
				building?: string;
				country: string;
				street?: string;
				city?: string;
				postcode?: string;
			} | null;
			addressBilling?: {
				building?: string;
				country: string;
				street?: string;
				city?: string;
				postcode?: string;
			} | null;
		};

		formattedCustomer = { ...basicFields };

		if (addressFields.addressHome.country) {
			formattedCustomer.addressHome = addressFields.addressHome;
		} else {
			formattedCustomer.addressHome = null;
		}

		if (addressFields.addressPostal.country) {
			formattedCustomer.addressPostal = addressFields.addressPostal;
		} else {
			formattedCustomer.addressPostal = null;
		}

		if (addressFields.addressBilling.country) {
			formattedCustomer.addressBilling = addressFields.addressBilling;
		} else {
			formattedCustomer.addressHome = null;
		}

		return formattedCustomer;
	};

	//handles form submission
	const handleSubmit = async () => {
		let editedCustomer = formatCustomer();
		console.log(editedCustomer);
		try {
			const response = await fetch(
				`${import.meta.env.VITE_API_URL}/customers/${$page.params.id}`,
				{
					method: 'PATCH',
					headers: {
						'Content-Type': 'application/merge-patch+json'
					},
					body: JSON.stringify(editedCustomer)
				}
			);

			if (!response.ok) {
				throw new Error();
			}

			const result = await response.json();
			alert('Customer edited successfully!');
			goto(`/customer/${$page.params.id}`);
		} catch (error) {
			alert('Failed to edit customer. Please try again.');
		}
	};
</script>

<div class="container mt-4">
	<div class="my-5 text-center">
		<h2>Customer Edit</h2>
	</div>

	<div class="mb-3 border rounded">
		<ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
			<li class="nav-item" role="presentation">
				<button
					class="nav-link active"
					id="pills-basic-tab"
					data-bs-toggle="pill"
					data-bs-target="#pills-basic"
					type="button"
					role="tab"
					aria-controls="pills-basic"
					aria-selected="true">Basic Info</button
				>
			</li>

			<li class="nav-item" role="presentation">
				<button
					class="nav-link"
					id="pills-home-tab"
					data-bs-toggle="pill"
					data-bs-target="#pills-home, #pills-home-none"
					type="button"
					role="tab"
					aria-controls="pills-home"
					aria-selected="true">Home Address</button
				>
			</li>

			<li class="nav-item" role="presentation">
				<button
					class="nav-link"
					id="pills-billing-tab"
					data-bs-toggle="pill"
					data-bs-target="#pills-billing, #pills-billing-none"
					type="button"
					role="tab"
					aria-controls="pills-billing"
					aria-selected="true">Billing Address</button
				>
			</li>

			<li class="nav-item" role="presentation">
				<button
					class="nav-link"
					id="pills-postal-tab"
					data-bs-toggle="pill"
					data-bs-target="#pills-postal, #pills-postal-none"
					type="button"
					role="tab"
					aria-controls="pills-postal"
					aria-selected="true">Postal Address</button
				>
			</li>
		</ul>
	</div>

	{#if customer}
		<form
			method="POST"
			class="tab-content"
			id="pills-tabContent"
			on:submit|preventDefault={handleSubmit}
		>
			<!-- Basic Information -->
			<div
				class="tab-pane fade show active"
				id="pills-basic"
				role="tabpanel"
				aria-labelledby="pills-basic-tab"
				tabindex="0"
			>
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
			</div>

			<!-- Home Address -->
			<div
				class="tab-pane fade"
				id="pills-home"
				role="tabpanel"
				aria-labelledby="pills-home-tab"
				tabindex="0"
			>
				<div class="row mt-5">
					<div class="col-md-4">
						<label for="inputBuildingHome" class="form-label">Building</label>
						<input
							type="text"
							class="form-control"
							id="inputBuildingHome"
							maxlength="255"
							bind:value={addressFields.addressHome.building}
						/>
					</div>

					<div class="col-md-4">
						<label for="inputStreetHome" class="form-label">Street</label>
						<input
							type="text"
							class="form-control"
							id="inputStreetHome"
							maxlength="255"
							bind:value={addressFields.addressHome.street}
						/>
					</div>

					<div class="col-md-4">
						<label for="inputPostcodeHome" class="form-label">Postcode</label>
						<input
							type="text"
							class="form-control"
							id="inputPostcodeHome"
							maxlength="8"
							bind:value={addressFields.addressHome.postcode}
						/>
					</div>

					<div class="row mt-4">
						<div class="col-md-4">
							<label for="inputCityHome" class="form-label">City</label>
							<input
								type="text"
								class="form-control"
								id="inputCityHome"
								maxlength="255"
								bind:value={addressFields.addressHome.city}
							/>
						</div>

						<div class="col-md-4">
							<label for="inputCountryHome" class="form-label">Country</label>
							<select
								id="inputCountryHome"
								class="form-select"
								bind:value={addressFields.addressHome.country}
							>
								<option value="" disabled selected>Select a country</option>
								<option value="GB">GB</option>
								<option value="CZ">CZ</option>
								<option value="FR">FR</option>
								<option value="DE">DE</option>
								<option value="AT">AT</option>
								<option value="">none</option>
							</select>
						</div>
					</div>
				</div>
			</div>

			<!-- Billing Address -->
			<div
				class="tab-pane fade"
				id="pills-billing"
				role="tabpanel"
				aria-labelledby="pills-billing-tab"
				tabindex="0"
			>
				<div class="row mt-5">
					<div class="col-md-4">
						<label for="inputBuildingBilling" class="form-label">Building</label>
						<input
							type="text"
							class="form-control"
							id="inputBuildingBilling"
							maxlength="255"
							bind:value={addressFields.addressBilling.building}
						/>
					</div>

					<div class="col-md-4">
						<label for="inputStreetBilling" class="form-label">Street</label>
						<input
							type="text"
							class="form-control"
							id="inputStreetBilling"
							maxlength="255"
							bind:value={addressFields.addressBilling.street}
						/>
					</div>

					<div class="col-md-4">
						<label for="inputPostcodeBilling" class="form-label">Postcode</label>
						<input
							type="text"
							class="form-control"
							id="inputPostcodeBilling"
							maxlength="8"
							bind:value={addressFields.addressBilling.postcode}
						/>
					</div>

					<div class="row mt-4">
						<div class="col-md-4">
							<label for="inputCityBilling" class="form-label">City</label>
							<input
								type="text"
								class="form-control"
								id="inputCityBilling"
								maxlength="255"
								bind:value={addressFields.addressBilling.city}
							/>
						</div>

						<div class="col-md-4">
							<label for="inputCountryBilling" class="form-label">Country</label>
							<select
								id="inputCountryBilling"
								class="form-select"
								bind:value={addressFields.addressBilling.country}
							>
								<option value="" disabled selected>Select a country</option>
								<option value="GB">GB</option>
								<option value="CZ">CZ</option>
								<option value="FR">FR</option>
								<option value="DE">DE</option>
								<option value="AT">AT</option>
								<option value="">none</option>
							</select>
						</div>
					</div>
				</div>
			</div>

			<!-- Postal Address -->
			<div
				class="tab-pane fade"
				id="pills-postal"
				role="tabpanel"
				aria-labelledby="pills-postal-tab"
				tabindex="0"
			>
				<div class="row mt-5">
					<div class="col-md-4">
						<label for="inputBuildingPostal" class="form-label">Building</label>
						<input
							type="text"
							class="form-control"
							id="inputBuildingPostal"
							maxlength="255"
							bind:value={addressFields.addressPostal.building}
						/>
					</div>

					<div class="col-md-4">
						<label for="inputStreetPostal" class="form-label">Street</label>
						<input
							type="text"
							class="form-control"
							id="inputStreetPostal"
							maxlength="255"
							bind:value={addressFields.addressPostal.street}
						/>
					</div>

					<div class="col-md-4">
						<label for="inputPostcodePostal" class="form-label">Postcode</label>
						<input
							type="text"
							class="form-control"
							id="inputPostcodePostal"
							maxlength="8"
							bind:value={addressFields.addressPostal.postcode}
						/>
					</div>

					<div class="row mt-4">
						<div class="col-md-4">
							<label for="inputCityPostal" class="form-label">City</label>
							<input
								type="text"
								class="form-control"
								id="inputCityPostal"
								maxlength="255"
								bind:value={addressFields.addressPostal.city}
							/>
						</div>

						<div class="col-md-4">
							<label for="inputCountryPostal" class="form-label">Country</label>
							<select
								id="inputCountryPostal"
								class="form-select"
								bind:value={addressFields.addressPostal.country}
							>
								<option value="" disabled selected>Select a country</option>
								<option value="GB">GB</option>
								<option value="CZ">CZ</option>
								<option value="FR">FR</option>
								<option value="DE">DE</option>
								<option value="AT">AT</option>
								<option value="">none</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="row mb-4 mt-5 justify-content-center">
				<div class="col-2 text-center">
					<a href="/" class="btn btn-secondary">Cancel</a>
				</div>
				<div class="col-2 text-center d-grid gap-2">
					<button type="submit" class="btn btn-success">Save</button>
				</div>
			</div>
		</form>
	{/if}
</div>
