<script lang="ts">
	import Footer from "./Footer.svelte";

    export let homeAddress: CustomerAddressType = {
      building: '',
      country: '',
      street: '',
      city: '',
      postcode: '',
    };
  
    export let billingAddress: CustomerAddressType = {
      building: '',
      country: '',
      street: '',
      city: '',
      postcode: '',
    };
  
    export let postalAddress: CustomerAddressType = {
      building: '',
      country: '',
      street: '',
      city: '',
      postcode: '',
    };
  
    export let readonly: boolean = true; 
  

    let activeTab = 'home';


  </script>
  
  <div class="container mt-5">
   
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button
          class="nav-link {activeTab === 'home' ? 'active' : ''}"
          id="home-tab"
          data-bs-toggle="tab"
          data-bs-target="#home"
          type="button"
          role="tab"
          aria-controls="home"
          aria-selected={activeTab === 'home' ? 'true' : 'false'}
          on:click={() => activeTab = 'home'}
        >
          Home Address
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button
          class="nav-link {activeTab === 'billing' ? 'active' : ''}"
          id="billing-tab"
          data-bs-toggle="tab"
          data-bs-target="#billing"
          type="button"
          role="tab"
          aria-controls="billing"
          aria-selected={activeTab === 'billing' ? 'true' : 'false'}
          on:click={() => activeTab = 'billing'}
        >
          Billing Address
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button
          class="nav-link {activeTab === 'postal' ? 'active' : ''}"
          id="postal-tab"
          data-bs-toggle="tab"
          data-bs-target="#postal"
          type="button"
          role="tab"
          aria-controls="postal"
          aria-selected={activeTab === 'postal' ? 'true' : 'false'}
          on:click={() => activeTab = 'postal'}
        >
          Postal Address
        </button>
      </li>
    </ul>
  

    <div class="tab-content mt-4">
   
      <div
        class="tab-pane fade {activeTab === 'home' ? 'show active' : ''}"
        id="home"
        role="tabpanel"
        aria-labelledby="home-tab"
      >
        <div class="card p-4 shadow-sm rounded-lg">
          <form>
            <div class="mb-3">
              <label for="home-street" class="form-label">Street</label>
              <input
                type="text"
                class="form-control form-control-lg"
                id="home-street"
                bind:value={homeAddress.street}
                readonly={readonly}
              />
            </div>
            <div class="mb-3">
              <label for="home-city" class="form-label">City</label>
              <input
                type="text"
                class="form-control form-control-lg"
                id="home-city"
                bind:value={homeAddress.city}
                readonly={readonly}
              />
            </div>
            <div class="mb-3">
              <label for="home-postcode" class="form-label">Postcode</label>
              <input
                type="text"
                class="form-control form-control-lg"
                id="home-postcode"
                bind:value={homeAddress.postcode}
                readonly={readonly}
              />
            </div>
            <div class="mb-3">
              <label for="home-country" class="form-label">Country</label>
              <input
                type="text"
                class="form-control form-control-lg"
                id="home-country"
                bind:value={homeAddress.country}
                readonly={readonly}
              />
            </div>
          </form>
        </div>
      </div>
  
      
      <div
        class="tab-pane fade {activeTab === 'billing' ? 'show active' : ''}"
        id="billing"
        role="tabpanel"
        aria-labelledby="billing-tab"
      >
        <div class="card p-4 shadow-sm rounded-lg">
          <form>
            <div class="mb-3">
              <label for="billing-street" class="form-label">Street</label>
              <input
                type="text"
                class="form-control form-control-lg"
                id="billing-street"
                bind:value={billingAddress.street}
                readonly={readonly}
              />
            </div>
            <div class="mb-3">
              <label for="billing-city" class="form-label">City</label>
              <input
                type="text"
                class="form-control form-control-lg"
                id="billing-city"
                bind:value={billingAddress.city}
                readonly={readonly}
              />
            </div>
            <div class="mb-3">
              <label for="billing-postcode" class="form-label">Postcode</label>
              <input
                type="text"
                class="form-control form-control-lg"
                id="billing-postcode"
                bind:value={billingAddress.postcode}
                readonly={readonly}
              />
            </div>
            <div class="mb-3">
              <label for="billing-country" class="form-label">Country</label>
              <input
                type="text"
                class="form-control form-control-lg"
                id="billing-country"
                bind:value={billingAddress.country}
                readonly={readonly}
              />
            </div>
          </form>
        </div>
      </div>
  
   
      <div
        class="tab-pane fade {activeTab === 'postal' ? 'show active' : ''}"
        id="postal"
        role="tabpanel"
        aria-labelledby="postal-tab"
      >
        <div class="card p-4 shadow-sm rounded-lg">
          <form>
            <div class="mb-3">
              <label for="postal-street" class="form-label">Street</label>
              <input
                type="text"
                class="form-control form-control-lg"
                id="postal-street"
                bind:value={postalAddress.street}
                readonly={readonly}
              />
            </div>
            <div class="mb-3">
              <label for="postal-city" class="form-label">City</label>
              <input
                type="text"
                class="form-control form-control-lg"
                id="postal-city"
                bind:value={postalAddress.city}
                readonly={readonly}
              />
            </div>
            <div class="mb-3">
              <label for="postal-postcode" class="form-label">Postcode</label>
              <input
                type="text"
                class="form-control form-control-lg"
                id="postal-postcode"
                bind:value={postalAddress.postcode}
                readonly={readonly}
              />
            </div>
            <div class="mb-3">
              <label for="postal-country" class="form-label">Country</label>
              <input
                type="text"
                class="form-control form-control-lg"
                id="postal-country"
                bind:value={postalAddress.country}
                readonly={readonly}
              />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="footer">
    <Footer/>
  </div>
  
  <style>
    .nav-tabs .nav-link.active {
      background-color: #28a745;
      color: white;
    }
  
    .form-label {
      font-weight: 600;
    }
  
    .tab-content {
      margin-top: 20px;
    }
  
    .card {
      background-color: #f8f9fa;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
  
    .shadow-sm {
      box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
    }
  </style>
  