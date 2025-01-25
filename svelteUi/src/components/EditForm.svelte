<script lang="ts">
    export let customer: CustomerType;
    export let onSave: (updatedCustomer: CustomerType) => void;

    let editedCustomer: CustomerType = { ...customer };

    let homeAddress = editedCustomer.addressHome || { country: '' };
    let postalAddress = editedCustomer.addressPostal || { country: '' };
    let billingAddress = editedCustomer.addressBilling || { country: '' };

    const saveChanges = () => {
        if (onSave) {
            onSave(editedCustomer);
        } else {
            console.error('onSave is not a function');
        }
    };

    const updateAddress = (
        addressType: 'addressHome' | 'addressPostal' | 'addressBilling',
        field: keyof CustomerAddressType,
        value: any
    ) => {
        if (!editedCustomer[addressType]) {
            editedCustomer[addressType] = { country: '' };
        }
        editedCustomer[addressType]![field] = value;
    };
</script>

<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
    <div class="row  mb-3 mt-2" >   
         <h3 >Edit Customer Addresses</h3>

    </div>

    <ul class="nav nav-tabs" id="addressTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="postal-tab" data-bs-toggle="tab" href="#postal" role="tab" aria-controls="postal" aria-selected="false">Postal</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="billing-tab" data-bs-toggle="tab" href="#billing" role="tab" aria-controls="billing" aria-selected="false">Billing</a>
        </li>
    </ul>

    <div class="tab-content" id="addressTabsContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <h4>Home Address</h4>
            <div class="form-group">
                <label for="home-country">Country</label>
                <select
                    id="home-country"
                    class="form-control"
                    bind:value={homeAddress.country}
                    on:change={(e) => {
                        const target = e.target as HTMLSelectElement | null;
                        if (target) updateAddress('addressHome', 'country', target.value);
                    }}
                >
                    <option value="">Select Country</option>
                    <option value="GB">GB</option>
                    <option value="CZ">CZ</option>
                    <option value="FR">FR</option>
                    <option value="DE">DE</option>
                    <option value="AT">AT</option>
                </select>
            </div>

            <div class="form-group">
                <label for="home-street">Street</label>
                <input
                    type="text"
                    id="home-street"
                    class="form-control"
                    bind:value={homeAddress.street}
                    on:input={(e) => {
                        const target = e.target as HTMLInputElement | null;
                        if (target) updateAddress('addressHome', 'street', target.value);
                    }}
                />
            </div>

            <div class="form-group">
                <label for="home-city">City</label>
                <input
                    type="text"
                    id="home-city"
                    class="form-control"
                    bind:value={homeAddress.city}
                    on:input={(e) => {
                        const target = e.target as HTMLInputElement | null;
                        if (target) updateAddress('addressHome', 'city', target.value);
                    }}
                />
            </div>

            <div class="form-group">
                <label for="home-postcode">Postcode</label>
                <input
                    type="text"
                    id="home-postcode"
                    class="form-control"
                    bind:value={homeAddress.postcode}
                    on:input={(e) => {
                        const target = e.target as HTMLInputElement | null;
                        if (target) updateAddress('addressHome', 'postcode', target.value);
                    }}
                />
            </div>

            <div class="form-group">
                <label for="home-building">Building</label>
                <input
                    type="text"
                    id="home-building"
                    class="form-control"
                    bind:value={homeAddress.building}
                    on:input={(e) => {
                        const target = e.target as HTMLInputElement | null;
                        if (target) updateAddress('addressHome', 'building', target.value);
                    }}
                />
            </div>
        </div>

        <div class="tab-pane fade" id="postal" role="tabpanel" aria-labelledby="postal-tab">
            <h4>Postal Address</h4>
            <div class="form-group">
                <label for="postal-country">Country</label>
                <select
                    id="postal-country"
                    class="form-control"
                    bind:value={postalAddress.country}
                    on:change={(e) => {
                        const target = e.target as HTMLSelectElement | null;
                        if (target) updateAddress('addressPostal', 'country', target.value);
                    }}
                >
                    <option value="">Select Country</option>
                    <option value="GB">GB</option>
                    <option value="CZ">CZ</option>
                    <option value="FR">FR</option>
                    <option value="DE">DE</option>
                    <option value="AT">AT</option>
                </select>
            </div>

            <div class="form-group">
                <label for="postal-street">Street</label>
                <input
                    type="text"
                    id="postal-street"
                    class="form-control"
                    bind:value={postalAddress.street}
                    on:input={(e) => {
                        const target = e.target as HTMLInputElement | null;
                        if (target) updateAddress('addressPostal', 'street', target.value);
                    }}
                />
            </div>

            <div class="form-group">
                <label for="postal-city">City</label>
                <input
                    type="text"
                    id="postal-city"
                    class="form-control"
                    bind:value={postalAddress.city}
                    on:input={(e) => {
                        const target = e.target as HTMLInputElement | null;
                        if (target) updateAddress('addressPostal', 'city', target.value);
                    }}
                />
            </div>

            <div class="form-group">
                <label for="postal-postcode">Postcode</label>
                <input
                    type="text"
                    id="postal-postcode"
                    class="form-control"
                    bind:value={postalAddress.postcode}
                    on:input={(e) => {
                        const target = e.target as HTMLInputElement | null;
                        if (target) updateAddress('addressPostal', 'postcode', target.value);
                    }}
                />
            </div>

            <div class="form-group">
                <label for="postal-building">Building</label>
                <input
                    type="text"
                    id="postal-building"
                    class="form-control"
                    bind:value={postalAddress.building}
                    on:input={(e) => {
                        const target = e.target as HTMLInputElement | null;
                        if (target) updateAddress('addressPostal', 'building', target.value);
                    }}
                />
            </div>
        </div>
 
        <div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="billing-tab">
            <h4>Billing Address</h4>
            <div class="form-group">
                <label for="billing-country">Country</label>
                <select
                    id="billing-country"
                    class="form-control"
                    bind:value={billingAddress.country}
                    on:change={(e) => {
                        const target = e.target as HTMLSelectElement | null;
                        if (target) updateAddress('addressBilling', 'country', target.value);
                    }}
                >
                    <option value="">Select Country</option>
                    <option value="GB">GB</option>
                    <option value="CZ">CZ</option>
                    <option value="FR">FR</option>
                    <option value="DE">DE</option>
                    <option value="AT">AT</option>
                </select>
            </div>

            <div class="form-group">
                <label for="billing-street">Street</label>
                <input
                    type="text"
                    id="billing-street"
                    class="form-control"
                    bind:value={billingAddress.street}
                    on:input={(e) => {
                        const target = e.target as HTMLInputElement | null;
                        if (target) updateAddress('addressBilling', 'street', target.value);
                    }}
                />
            </div>

            <div class="form-group">
                <label for="billing-city">City</label>
                <input
                    type="text"
                    id="billing-city"
                    class="form-control"
                    bind:value={billingAddress.city}
                    on:input={(e) => {
                        const target = e.target as HTMLInputElement | null;
                        if (target) updateAddress('addressBilling', 'city', target.value);
                    }}
                />
            </div>

            <div class="form-group">
                <label for="billing-postcode">Postcode</label>
                <input
                    type="text"
                    id="billing-postcode"
                    class="form-control"
                    bind:value={billingAddress.postcode}
                    on:input={(e) => {
                        const target = e.target as HTMLInputElement | null;
                        if (target) updateAddress('addressBilling', 'postcode', target.value);
                    }}
                />
            </div>

            <div class="form-group">
                <label for="billing-building">Building</label>
                <input
                    type="text"
                    id="billing-building"
                    class="form-control"
                    bind:value={billingAddress.building}
                    on:input={(e) => {
                        const target = e.target as HTMLInputElement | null;
                        if (target) updateAddress('addressBilling', 'building', target.value);
                    }}
                />
            </div>
        </div>
    </div>

    <button on:click={saveChanges} class="btn btn-primary mt-3">Save Changes</button>
</div>
<div class="col-md-2">

</div>
</div>



<style>
    .form-group {
        margin-bottom: 1rem;
    }

    .form-control {
        width: 100%;
        padding: 0.5rem;
        margin-top: 0.25rem;
    }

    .nav-tabs .nav-link.active {
        background-color: #0d6efd;
        color: white;
    }
</style>