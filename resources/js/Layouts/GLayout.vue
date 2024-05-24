<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';

const page = usePage();

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
  <head>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
  </head>
  <div id="app">
    <!-- Welcome Section -->
    <div class="intro">
      <h2>Welcome</h2>
    </div>

    <!-- Main Content Section -->
    <main class="main-content">
      <div>
        <div class="text-white text-5xl pt-2">Online Clearance System</div>
      </div>
      <div class="h-screen flex items-center justify-center shadow">
        <div class="h-[80vh] w-[60vw] flex flex-col bg-white border border-gray-200 rounded-lg shadow md:flex-row dark:border-gray-700 dark:bg-gray-800">
          <img class="h-[100%] w-[25vw] rounded-xl object-cover" src="https://www.shutterstock.com/image-vector/drawing-portrait-young-students-laptop-600nw-2238125795.jpg" alt="">
          <div class="leading-normal w-full">
            <ul class="justify-evenly flex text-sm font-medium text-center text-gray-500 dark:text-gray-400 ">
              <li class="me-2">
                <Link :href="route('login')" :class="{'dark:border-green-600 dark:text-green-600': $page.component == 'Auth/Login'}" class="transition ease-in-out hover:-translate-y-1 hover:scale-110 inline-flex items-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-green-400 hover:border-green-400 group">
                  <svg class="w-6 h-6 me-2 text-gray-600 group-hover:text-green-600 dark:group-hover:text-green-400" :class="{'dark:text-green-600': $page.component === 'Auth/Login'}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                  </svg>Login
                </Link>
              </li>
              <li class="me-2">
                <Link :href="route('register')" :class="{'dark:border-green-600 dark:text-green-600': $page.component == 'Auth/Register'}" class="transition ease-in-out hover:-translate-y-1 hover:scale-110 inline-flex items-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-green-400 hover:border-green-400 group">
                  <svg class="w-6 h-6 me-2 text-gray-600 group-hover:text-green-600 dark:group-hover:text-green-400" :class="{'dark:text-green-600': $page.component === 'Auth/Register'}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                  </svg>Register
                </Link>
              </li>
            </ul>
            <div class="relative">
              <slot />
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<style scoped>
* {
  box-sizing: border-box;
  margin: 0;
}

h1 {
  margin: 1rem 0;
}

h2 {
  font-family: 'Dancing Script', cursive;
  color: white;
  opacity: 0;
  font-size: 10rem;
  animation: fadeIn 2s ease forwards;
}

p {
  font-size: 4rem;
  opacity: 0;
  animation: fadeInText 2s ease forwards 3s;
}

.intro {
  height: 100vh;
  background-color: black;
  display: flex;
  justify-content: center;
  align-items: center;
}

main {
  position: absolute;
  top: 0;
  height: 100vh;
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  background-color: #34495e;
  transform: scale(0, 0);
  animation: animate 1s ease-in forwards 2s;
  overflow: hidden;
}

.content {
  width: 100%;
  text-align: center;
  overflow-y: auto;
}

@keyframes animate {
  0% {
    transform: scale(0, 0.005);
  }
  50% {
    transform: scaleY(0.005);
  }
  100% {
    transform: scale(1, 1);
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(50%);
  }
  to {
    opacity: 1;
    transform: translateY(-50%);
  }
}

@keyframes fadeInText {
  from {
    opacity: 0;
    transform: translateY(50%);
  }
  to {
    opacity: 1;
    transform: translateY(0%);
  }
}

body {
  background-color: #34495e;
}
</style>
