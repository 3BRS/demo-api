<script lang="ts">
    export let show: boolean = false;
    export let message: string = 'Operation successful!';
    export let onClose: () => void = () => {};
</script>

{#if show}
    <div class="popup-overlay">
        <div class="popup-box">
            <p class="popup-message">{message}</p>
            <button class="popup-close" on:click={onClose}>Close</button>
        </div>
    </div>
{/if}

<style>
    .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .popup-box {
        background-color: #fff;
        padding: 20px 30px;
        border-radius: 8px;
        text-align: center;
        max-width: 400px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .popup-message {
        font-size: 18px;
        font-weight: 400;
        margin: 0 0 20px 0;
        color: #5543ca;
        background: linear-gradient(to right, #f4524d 0%, #5543ca 100%);
        -webkit-background-clip: text;
        color: transparent;
    }

    .popup-close {
        background-color: #000;
        background-image: linear-gradient(125deg, #a72879, #064497);
        color: #fff;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 2px;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .popup-close:hover {
        background-color: #444;
    }

    .popup-close:focus {
        outline: none;
    }
</style>
