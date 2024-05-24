<template>
    <div v-if="message" class="flash-message">
      <div class="alert alert-info">
        {{ message }}
      </div>
    </div>
  </template>
  
  <script setup>
  import { computed } from 'vue';
  import { usePage } from '@inertiajs/vue3';
  
  const page = usePage();
  const message = computed(() => {
    return page.props.flash.message || 
           page.props.flash.success || 
           page.props.flash.logout || 
           page.props.flash.edit || 
           page.props.flash.delete;
  });
  </script>
  
  <style scoped>
  .flash-message {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1000;
  }
  
  .alert {
    padding: 1rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #f0f4f8;
    color: #333;
  }
  </style>
  