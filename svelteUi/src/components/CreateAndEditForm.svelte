<script lang="ts">
    import PopUp from '$components/PopUp.svelte';

   
    export let customer: {
        id?: number;
        firstName: string;
        lastName: string;
        email: string;
        phone: string;
        dateOfBirth: string;
        addressHome?: CustomerAddressType;
        addressPostal?: CustomerAddressType;
        addressBilling?: CustomerAddressType;
    } = {
        firstName: '',
        lastName: '',
        email: '',
        phone: '',
        dateOfBirth: new Date(2000, 0, 1).toISOString().split('T')[0]
    };

    export let mode: 'create' | 'edit' = 'create'; // Default to 'create'

    let showPopup = false;
    let popupMessage = '';

    //helpers
    const closePopup = () => {
        showPopup = false;
    };

    //Client-side validation and used for styling
    const isNotEmpty = (value: string) => value && value.trim().length > 0; 


    const handleSubmit = () => {
        const url = mode === 'edit'
            ? `${import.meta.env.VITE_API_URL}/customers/${customer.id}`
            : `${import.meta.env.VITE_API_URL}/customers`;

        const method = mode === 'edit' ? 'PATCH' : 'POST';

        const bodyData = {
            firstName: customer.firstName,
            lastName: customer.lastName,
            email: customer.email,
            phone: customer.phone,
            dateOfBirth: new Date(customer.dateOfBirth).toISOString(),
            addressHome: customer.addressHome,
            addressPostal: customer.addressPostal,
            addressBilling: customer.addressBilling
        };

        const contentType = method === 'PATCH' ? 'application/merge-patch+json' : 'application/ld+json'; 

        fetch(url, {
            method,
            headers: {
                'Content-Type': contentType
            },
            body: JSON.stringify(bodyData)
        })
            .then((response) => {
                if (!response.ok) {
                    return response.text().then((errorText) => {
                        throw new Error(`Request failed: ${response.status} - ${errorText}`);
                    });
                }
                return response.json();
            })
            .then((data) => {
                popupMessage = mode === 'edit' ? 'Customer updated successfully!' : 'Customer created successfully!';
                showPopup = true;
            })
            .catch((error) => {
                console.error('Error saving user:', error);
                //alert(`Error saving user: ${error.message}`);
            });
    };

   

</script>

<section class="get-in-touch">
    <h1 class="title">{mode === 'edit' ? 'Edit Customer' : 'Create New Customer'}</h1>
    <form class="contact-form row" on:submit|preventDefault={handleSubmit}>
        <div class="form-field col-lg-6">
            <input 
                id="firstname" 
                class="input-text js-input {isNotEmpty(customer.firstName) ? 'not-empty' : ''}"  
                type="text" 
                bind:value={customer.firstName} 
                required>
            <label class="label" for="firstname">First Name</label> <!--  handle form input overlapping  -->
        </div>

        <div class="form-field col-lg-6">
            <input 
                id="lastname" 
                class="input-text js-input {isNotEmpty(customer.lastName) ? 'not-empty' : ''}" 
                type="text" 
                bind:value={customer.lastName} 
                required>
            <label class="label" for="lastname">Last Name</label>
        </div>

        <div class="form-field col-lg-6">
            <input 
                id="email" 
                class="input-text js-input {isNotEmpty(customer.email) ? 'not-empty' : ''}" 
                type="email" 
                bind:value={customer.email} 
                required>
            <label class="label" for="email">Email</label>
        </div>

        <div class="form-field col-lg-6">
            <input 
                id="phone" 
                class="input-text js-input {isNotEmpty(customer.phone) ? 'not-empty' : ''}" 
                type="tel" 
                bind:value={customer.phone} 
                required>
            <label class="label" for="phone">Phone Number</label>
        </div>

        <div class="form-field col-lg-6">
            <input 
                id="dob" 
                class="input-text js-input {isNotEmpty(customer.dateOfBirth) ? 'not-empty' : ''}" 
                type="date" 
                bind:value={customer.dateOfBirth} 
                required>
            <label class="label" for="dob">Date of Birth</label>
        </div>

        

        

        <div class="form-field col-lg-12">
            <input class="submit-btn" type="submit" value={mode === 'edit' ? 'Save Changes' : 'Create Customer'}>
        </div>
    </form>
</section>

{#if showPopup}
    <PopUp show={showPopup} message={popupMessage} onClose={closePopup} />
{/if}

<style>
    .get-in-touch {
        max-width: 800px;
        margin: 50px auto;
    }

    .title {
        text-align: center;
        text-transform: uppercase;
        font-size: 2.5em;
        padding-bottom: 48px;
        color: #5543ca;
        background: linear-gradient(to right, #f4524d 0%, #5543ca 100%);
        -webkit-background-clip: text;
        color: transparent;
    }

    .contact-form .form-field {
        position: relative;
        margin: 32px 0;
    }

    .contact-form .input-text {
        display: block;
        width: 100%;
        height: 36px;
        border-width: 0 0 2px 0;
        border-color: #5543ca;
        font-size: 18px;
        line-height: 26px;
        font-weight: 400;
    }

    .contact-form .input-text:focus {
        outline: none;
    }

    .contact-form .input-text:focus + .label,
    .contact-form .input-text.not-empty + .label {
        transform: translateY(-24px);
    }

    .contact-form .label {
        position: absolute;
        left: 20px;
        bottom: 11px;
        font-size: 18px;
        line-height: 26px;
        font-weight: 400;
        color: #5543ca;
        cursor: text;
        transition: transform 0.2s ease-in-out;
    }

    .contact-form .submit-btn {
        background-color: #000;
        background-image: linear-gradient(125deg, #a72879, #064497);
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 16px;
        padding: 8px 16px;
        border: none;
        width: 200px;
        cursor: pointer;
    }

    .contact-form .submit-btn:focus {
        outline: none;
    }
</style>
