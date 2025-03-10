<template>
    <div class="flex bg-black text-white min-h-screen justify-between">
      <!-- Left Sidebar -->
      <aside class="sidebar w-1/5 p-6 space-y-10 border-r border-gray-800 py-10">
        <h1 class="text-2xl font-bold logo">Instagram</h1>
        <nav class="flex flex-col space-y-3.5 place-content-center">
          <a :href="route('Home')"
            class="custom-button flex items-center space-x-3 text-lg rounded-lg hover:bg-onhovergray p-2">
            <HomeIcon class="nav-icon w-6 h-6 min-w-6 min-h-6" />
            <span class="nav-text">Home</span>
          </a>
          <a :href="route('Search')"
            class="custom-button flex items-center space-x-3 text-lg rounded-lg hover:bg-onhovergray p-2">
            <SearchIcon class="nav-icon w-6 h-6 min-w-6 min-h-6" />
            <span class="nav-text">Search</span>
          </a>
          <a :href="route('Explore')"
            class="custom-button flex items-center space-x-3 text-lg rounded-lg hover:bg-onhovergray p-2">
            <CompassIcon class="nav-icon w-6 h-6 min-w-6 min-h-6" />
            <span class="nav-text">Explore</span>
          </a>
          <a :href="route('Reels')"
            class="custom-button flex items-center space-x-3 text-lg rounded-md hover:bg-onhovergray p-2">
            <VideoIcon class="nav-icon w-6 h-6 min-w-6 min-h-6" />
            <span class="nav-text">Reels</span>
          </a>
          <a :href="route('Messages')"
            class="custom-button flex items-center space-x-3 text-lg rounded-md hover:bg-onhovergray p-2">
            <SendIcon class="nav-icon w-6 h-6 min-w-6 min-h-6" />
            <span class="nav-text">Messages</span>
          </a>
          <a :href="route('Notifications')"
            class="custom-button flex items-center space-x-3 text-lg rounded-md hover:bg-onhovergray p-2">
            <HeartIcon class="nav-icon w-6 h-6 min-w-6 min-h-6" />
            <span class="nav-text">Notifications</span>
          </a>
          <a :href="route('Create')"
            class="custom-button flex items-center space-x-3 text-lg rounded-md hover:bg-onhovergray p-2">
            <SquarePlusIcon class="nav-icon w-6 h-6 min-w-6 min-h-6" />
            <span class="nav-text">Create</span>
          </a>
          <a :href="route('Profile')"
            class="custom-button flex items-center space-x-3 text-lg rounded-md hover:bg-onhovergray p-2">
            <UserIcon class="nav-icon w-6 h-6 min-w-6 min-h-6" />
            <span class="nav-text">Profile</span>
          </a>
        </nav>
      </aside>

      <!-- Content -->
      <main class="max-h-screen overflow-auto flex-grow">
        <slot></slot>
      </main>

      <!-- Right Panel -->
      <aside class="right-panel w-1/5 p-4">
        <div class="flex items-center mb-6">
          <div class="w-12 h-12 rounded-full bg-gray-700"></div>
          <div class="ml-4">
            <p class="font-bold">user</p>
            <p class="text-gray-400 text-sm">User User</p>
          </div>
        </div>

        <h2 class="text-gray-400 text-sm mb-4">Suggested for you</h2>
        <div v-for="i in 5" :key="i" class="flex items-center mb-4">
          <div class="w-10 h-10 rounded-full bg-gray-700"></div>
          <div class="ml-4 flex-grow">
            <p class="text-sm font-bold">User {{ i }}</p>
            <p class="text-gray-400 text-xs">Followed by someone</p>
          </div>
          <button class="text-blue-500 text-sm">Follow</button>
        </div>
      </aside>
    </div>
  </template>

  <script setup>
  import {
    HomeIcon,
    SearchIcon,
    CompassIcon,
    VideoIcon,
    HeartIcon,
    SquarePlusIcon,
    UserIcon,
    SendIcon,
  } from 'lucide-vue-next';
  import { onMounted, onUnmounted, ref } from 'vue';

  // Function to check window size and apply responsive changes
  const checkWindowSize = () => {
    const windowWidth = window.innerWidth;
    const screenWidthPercent = (windowWidth / window.screen.width) * 100;

    const navTextElements = document.querySelectorAll('.nav-text');
    const rightPanel = document.querySelector('.right-panel');
    const sidebarElement = document.querySelector('.sidebar');
    const logoElement = document.querySelector('.logo');
    const navButtons = document.querySelectorAll('.custom-button');

    // If screen size is 70% or below, hide nav text but keep icons visible
    if (screenWidthPercent <= 70) {
      navTextElements.forEach(el => {
        el.style.display = 'none';
      });

      // Adjust sidebar width when only icons are visible
      if (sidebarElement) {
        sidebarElement.classList.remove('w-1/5');
        sidebarElement.classList.add('w-16');
        sidebarElement.style.padding = '1.5rem 0.5rem';
      }

      // Adjust logo size or hide it
      if (logoElement) {
        logoElement.style.fontSize = '1rem';
        logoElement.style.textAlign = 'center';
      }

      // Center the icons in the buttons
      navButtons.forEach(btn => {
        btn.style.justifyContent = 'center';
      });
    } else {
      navTextElements.forEach(el => {
        el.style.display = 'inline';
      });

      // Restore sidebar width and padding
      if (sidebarElement) {
        sidebarElement.classList.remove('w-16');
        sidebarElement.classList.add('w-1/5');
        sidebarElement.style.padding = '1.5rem';
      }

      // Restore logo size
      if (logoElement) {
        logoElement.style.fontSize = '1.5rem';
        logoElement.style.textAlign = 'left';
      }

      // Restore button alignment
      navButtons.forEach(btn => {
        btn.style.justifyContent = 'flex-start';
      });
    }

    // If screen size is 60% or below, hide right panel
    if (screenWidthPercent <= 60 && rightPanel) {
      rightPanel.style.display = 'none';
    } else if (rightPanel) {
      rightPanel.style.display = 'block';
    }
  };

  // Add event listener for window resize
  onMounted(() => {
    checkWindowSize(); // Check on initial load
    window.addEventListener('resize', checkWindowSize);
  });

  // Clean up event listener on component unmount
  onUnmounted(() => {
    window.removeEventListener('resize', checkWindowSize);
  });



  </script>

  <style>
  body {
    font-family: 'Instagram Sans', sans-serif;
  }

  .custom-button {
    transition: all 0.4s ease;
    position: relative;
  }

  .custom-button:active {
    background-color: transparent;
    color: gray;
  }

  /* Keep icon size consistent */
  .nav-icon {
    width: 1.5rem !important;
    height: 1.5rem !important;
    min-width: 1.5rem !important;
    min-height: 1.5rem !important;
    flex-shrink: 0;

  }

  /* Additional responsive styles */
  @media (max-width: 70vw) {
    .sidebar {
      width: 4rem !important;
      padding: 1.5rem 0.5rem !important;
      align-items: center;
    }

    .nav-text {
      display: none !important;
    }

    .custom-button {
      justify-content: center !important;
    }

    .nav-icon {
      display: block !important;
      margin: 0 auto;
    }

    .logo {
      font-size: 1rem;
      text-align: center;
    }
  }

  @media (max-width: 60vw) {
    .right-panel {
      display: none !important;
    }

    main {
      flex-grow: 1;
    }
  }
  </style>
