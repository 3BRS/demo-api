<script lang="ts">
    export let totalCustomers: number = 0;
  </script>
  
  <footer class="footer mt-4">
    <div class="footer-container">
      <p class="footer-text">
        Total Customers: <span class="footer-highlight">{totalCustomers}</span>
      </p>
    </div>
  </footer>
  
  <style lang="SASS">
    .footer {
      background-color: #fff;
      padding: 15px 0;
      border-top: 1px solid #ddd;
      box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
  
    .footer-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }
  
    .footer-text {
      font-size: 16px;
      font-weight: 700;
      color: #777;
    }
  
    .footer-highlight {
      color: #5543ca;
      font-weight: 900;
      font-size: 18px;
    }
  </style>
  