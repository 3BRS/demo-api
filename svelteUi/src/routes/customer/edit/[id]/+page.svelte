<script lang="ts">
    import { onMount } from 'svelte';
    import { page } from '$app/stores';
    import EditForm from '$components/EditForm.svelte';
	import NavBar from '$components/NavBar.svelte';

    let customer: CustomerType | undefined = undefined;

    onMount(() => {
        const id = $page.params.id;

        if (!id) {
            console.error('No ID found in route params.');
            return;
        }

        fetch(`${import.meta.env.VITE_API_URL}/customers/${id}`, {
            method: 'GET'
        })
        .then((response) => response.json())
        .then((data) => {
            customer = {
                ...data,
                dateOfBirth: new Date(data.dateOfBirth).toISOString().split('T')[0],
                addressHome: data.addressHome || {},
                addressPostal: data.addressPostal || {},
                addressBilling: data.addressBilling || {},
            };
            console.log(customer);
        })
        .catch((error) => {
            console.error('Error fetching customer:', error);
        });
    });

    const handleUpdate = (updatedUser: CustomerType) => {
        const id = $page.params.id;

        if (!id || !updatedUser) {
            console.error('No ID or user data available for update.');
            return;
        }

        fetch(`${import.meta.env.VITE_API_URL}/customers/${id}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/merge-patch+json'
            },
            body: JSON.stringify({
                ...updatedUser,
                dateOfBirth: new Date(updatedUser.dateOfBirth).toISOString()
            })
        })
        .then((response) => response.json())
        .then((data) => {
            console.log('Customer updated successfully:', data);
            // alert('Customer details updated!');
        })
        .catch((error) => {
            console.error('Error updating customer:', error);
        });
    };
</script>

<NavBar/>

{#if customer === undefined}
    <p>Loading...</p>
{:else}
    <EditForm customer={customer} onSave={handleUpdate} />
{/if}
