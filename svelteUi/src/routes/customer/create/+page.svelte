<script>
// @ts-nocheck

	import Form from '$components/CreateForm.svelte';
	import PopUp from '$components/PopUp.svelte';
    import NavBar from '$components/NavBar.svelte';

    let showModal = true;
    let successMessage = '';
    const closeModal=()=>{};
</script>

<div>
    <div class="nav-bar">
        <NavBar/>
    </div>
	<Form mode ="create"  />
    <PopUp {showModal} {successMessage} onClose={closeModal}/>
</div>

<style>
</style>
