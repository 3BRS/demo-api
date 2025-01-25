<script lang="ts">
	import EditFormT2 from '$components/EditFormT2.svelte';
	import { onMount } from 'svelte';


    const customerUrl = `${import.meta.env.VITE_API_URL}/customers`;

	const addressUrl = `${import.meta.env.VITE_API_URL}/addresses/2`;

	export let dataCustomer: CustomerAddressType = {
		building: '',
		country: '',
		street: '',
		city: '',
		postcode: ''
	};

	export let customer: CustomerType = {

        "@id": "",
        id : 0,
        firstName: '',
		lastName: '',
		email: '',
		phone: '',
		dateOfBirth: '',
		addressHome: {
			building: '',
			country: '',
			street: '',
			city: '',
			postcode: ''
		},
		addressPostal: {
			building: '',
			country: '',
			street: '',
			city: '',
			postcode: ''
		},
		addressBilling: {
			building: '',
			country: '',
			street: '',
			city: '',
			postcode: ''
		},
		fullName: ''
	};
	/* firstName: string;
	lastName: string;
	email: string;
	phone: string;
	dateOfBirth: string;
	addressHome?: CustomerAddressType;
	addressPostal?: CustomerAddressType;
	addressBilling?: CustomerAddressType;
	fullName: string; */

	onMount(async () => {
		dataCustomer = await fetch(addressUrl).then((x) => x.json());
		console.log(dataCustomer);


        customer = await fetch(customerUrl).then((x)=>x.json());
        console.log(customer)

	});
</script>

<div>
	<EditFormT2 address={dataCustomer} />
</div>
