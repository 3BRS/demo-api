<script lang="ts">
	import { onMount } from 'svelte';
	import { page } from '$app/stores';
	import { goto } from '$app/navigation';
	import AddressForm from '$components/AddressForm.svelte';
	import BasicForm from '$components/BasicForm.svelte';

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

	let homeCountryRequired = false;
	let postalCountryRequired = false;
	let billingCountryRequired = false;

	//update required status based on other fields
	$: homeCountryRequired =
		addressFields.addressHome.building.trim() != '' ||
		addressFields.addressHome.street.trim() != '' ||
		addressFields.addressHome.city.trim() != '' ||
		addressFields.addressHome.postcode.trim() != '';

	$: postalCountryRequired =
		addressFields.addressPostal.building.trim() != '' ||
		addressFields.addressPostal.street.trim() != '' ||
		addressFields.addressPostal.city.trim() != '' ||
		addressFields.addressPostal.postcode.trim() != '';

	$: billingCountryRequired =
		addressFields.addressBilling.building.trim() != '' ||
		addressFields.addressBilling.street.trim() != '' ||
		addressFields.addressBilling.city.trim() != '' ||
		addressFields.addressBilling.postcode.trim() != '';

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
				<BasicForm bind:basicFields />
			</div>

			<!-- Home Address -->
			<div
				class="tab-pane fade"
				id="pills-home"
				role="tabpanel"
				aria-labelledby="pills-home-tab"
				tabindex="0"
			>
				<AddressForm
					bind:addressFields={addressFields.addressHome}
					countryRequired={homeCountryRequired}
					prefix="home"
				/>
			</div>

			<!-- Billing Address -->
			<div
				class="tab-pane fade"
				id="pills-billing"
				role="tabpanel"
				aria-labelledby="pills-billing-tab"
				tabindex="0"
			>
				<AddressForm
					bind:addressFields={addressFields.addressBilling}
					countryRequired={billingCountryRequired}
					prefix="billing"
				/>
			</div>

			<!-- Postal Address -->
			<div
				class="tab-pane fade"
				id="pills-postal"
				role="tabpanel"
				aria-labelledby="pills-postal-tab"
				tabindex="0"
			>
				<AddressForm
					bind:addressFields={addressFields.addressPostal}
					countryRequired={postalCountryRequired}
					prefix="postal"
				/>
			</div>

			<!-- Bottom Buttons -->
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
