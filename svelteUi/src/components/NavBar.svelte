<script lang="ts">
    import { onMount } from 'svelte';
  
    let currentDateTime: string;
  
    const formatDate = (date: Date) => {
      const day = date.getDate();
      const month = date.getMonth() + 1; 
      const year = date.getFullYear();
      const hours = date.getHours();
      const minutes = date.getMinutes();
  
      return `${day}.${month < 10 ? '0' + month : month}.${year} ${
        hours < 10 ? '0' + hours : hours
      }:${minutes < 10 ? '0' + minutes : minutes}`;
    };
  
    onMount(() => {
      setInterval(() => {
        currentDateTime = formatDate(new Date());
      }, 60000); 
      currentDateTime = formatDate(new Date()); 
    });
  </script>
  
  <div class="gradient-header">
    <h1 class="title">Customer Management App</h1>
  </div>
  
  <nav class="navbar">
    <div class="container-fluid">
      <div class="d-flex justify-content-between align-items-center w-100">
        <a class="navbar-brand" href="/">Customers</a>
  
        <div class="navbar-text">
          <span>{currentDateTime}</span>
        </div>
      </div>
    </div>
  </nav>
  
  <style lang="SASS">
    .gradient-header {
      background: linear-gradient(to right, #f4524d, #5543ca);
      padding: 20px 0;
      text-align: center;
      color: #fff;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
  
    .title {
      font-size: 2.5rem;
      font-weight: bold;
      margin: 0;
      text-transform: uppercase;
    }
  
    .navbar {
      border-bottom: 1px solid #ddd;
      background-color: #fff;
      padding: 10px 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
  
    .navbar-brand {
      font-size: 1.5rem;
      font-weight: bold;
      color: #5543ca;
      text-decoration: none;
      transition: color 0.3s;
    }
  
    .navbar-brand:hover {
      color: #f4524d;
    }
  
    .navbar-text {
      font-size: 1.2rem;
      color: #777;
      font-family: 'Arial', sans-serif;
      letter-spacing: 0.5px;
    }
  </style>
  