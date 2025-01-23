<script lang="ts">
	import { onMount } from 'svelte';
	import { page } from '$app/stores';
	import { goto } from '$app/navigation';
	import AddressForm from '$components/AddressForm.svelte';
	import BasicForm from '$components/BasicForm.svelte';
	import PillNav from '$components/PillNav.svelte';

	type addressObject = {
		addressHome: CustomerAddressType;
		addressPostal: CustomerAddressType;
		addressBilling: CustomerAddressType;
	};

	const navTabs: { id: string; label: string; target: string; active?: boolean }[] = [
		{ id: 'pills-basic-tab', label: 'Basic Info', target: '#pills-basic', active: true },
		{ id: 'pills-home-tab', label: 'Home Address', target: '#pills-home' },
		{ id: 'pills-billing-tab', label: 'Billing Address', target: '#pills-billing' },
		{ id: 'pills-postal-tab', label: 'Postal Address', target: '#pills-postal' }
	];

	let customer = undefined as undefined | CustomerType;

	//basic info fields
	let basicFields: CustomerBasicInfoType = {
		firstName: '',
		lastName: '',
		email: '',
		phone: '',
		dateOfBirth: ''
	};

	//address fields
	const emptyAddress: CustomerAddressType = {
		building: '',
		country: '',
		street: '',
		city: '',
		postcode: ''
	};

	let addressFields: addressObject = {
		addressHome: { ...emptyAddress },
		addressPostal: { ...emptyAddress },
		addressBilling: { ...emptyAddress }
	};

	let isHomeCountryRequired = false;
	let isPostalCountryRequired = false;
	let isBillingCountryRequired = false;

	//checks if any field other than country is non-empty
	const isAddressRequired = (fields: CustomerAddressType): boolean => {
		return Object.entries(fields)
			.filter(([key]) => key !== 'country')
			.some(([, value]) => value.trim() !== '');
	};

	//update required status based on other fields
	$: isHomeCountryRequired = isAddressRequired(addressFields.addressHome);
	$: isPostalCountryRequired = isAddressRequired(addressFields.addressPostal);
	$: isBillingCountryRequired = isAddressRequired(addressFields.addressBilling);

	//prefills address fields
	const prefillAddress = (fields: CustomerAddressType, customerAddress: CustomerAddressType) => {
		if (customer) {
			fields.building = customerAddress.building || '';
			fields.street = customerAddress.street || '';
			fields.postcode = customerAddress.postcode || '';
			fields.city = customerAddress.city || '';
			fields.country = customerAddress.country || '';
		}
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
						prefillAddress(addressFields.addressHome, customer.addressHome);
					}

					if (customer.addressBilling) {
						prefillAddress(addressFields.addressBilling, customer.addressBilling);
					}

					if (customer.addressPostal) {
						prefillAddress(addressFields.addressPostal, customer.addressPostal);
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
			addressHome?: CustomerAddressType | null;
			addressPostal?: CustomerAddressType | null;
			addressBilling?: CustomerAddressType | null;
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
			formattedCustomer.addressBilling = null;
		}

		return formattedCustomer;
	};

	//handles form submission
	const handleSubmit = async () => {
		let editedCustomer = formatCustomer();
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

	<PillNav tabs={navTabs} />

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
					countryRequired={isHomeCountryRequired}
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
					countryRequired={isBillingCountryRequired}
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
					countryRequired={isPostalCountryRequired}
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
