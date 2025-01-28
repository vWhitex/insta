<template>
    <div class="flex bg-black text-white min-h-screen">
      <!-- Sidebar -->
      <aside class="w-1/5 p-6 space-y-10 border-r border-gray-800 py-10 ">
        <h1 class="text-2xl font-bold">Instagram</h1>
        <nav class="flex flex-grow-0 flex-col space-y-2">
          <button class="custom-button flex items-center space-x-3 text-lg rounded-lg hover:bg-onhovergray p-2">
            <HomeIcon class="w-6 h-6" />
            <span>Home</span>
          </button>
          <button class="custom-button flex items-center space-x-3 text-lg rounded-lg hover:bg-onhovergray p-2">
            <SearchIcon class="w-6 h-6" />
            <span>Search</span>
          </button>
          <button class="custom-button flex items-center space-x-3 text-lg rounded-lg hover:bg-onhovergray p-2">
            <CompassIcon class="w-6 h-6" />
            <span>Explore</span>
          </button>
          <button class="custom-button flex items-center space-x-3 text-lg rounded-md hover:bg-onhovergray p-2">
            <VideoIcon class="w-6 h-6" />
            <span>Reels</span>
          </button>
          <button class="custom-button flex items-center space-x-3 text-lg rounded-md hover:bg-onhovergray p-2">
            <SendIcon class="w-6 h-6" />
            <span>Messages</span>
          </button>
          <button class="custom-button flex items-center space-x-3 text-lg rounded-md hover:bg-onhovergray p-2">
            <HeartIcon class="w-6 h-6" />
            <span>Notifications</span>
          </button>
          <button class="custom-button flex items-center space-x-3 text-lg rounded-md hover:bg-onhovergray p-2">
            <SquarePlusIcon class="w-6 h-6" />
            <span>Create</span>
          </button>
          <button class="custom-button flex items-center space-x-3 text-lg rounded-md hover:bg-onhovergray p-2">
            <UserIcon class="w-6 h-6" />
            <span>Profile</span>
          </button>
        </nav>
      </aside>
  
      <!-- Main Content -->
      <main class="flex-grow-7 p-6 space-y-2">
        <!-- Header Section -->
         <header class="flex items-start gap-4 font-bold pt-6 text-sm">
            <button>For You</button>
            <button>Following</button>
         </header>

        <!-- Stories Section -->
        <div class="flex space-x-4 overflow-x-auto pt-4 border-t border-gray-800">
          <div v-for="i in 8" :key="i" class="w-16 h-16 rounded-full bg-gray-700 flex items-center justify-center">
            <span>Story</span>
          </div>
        </div>
  
        <!-- Post Section -->
        <div class="bg-gray-900 p-4 rounded-xl">
          <p class="text-gray-400">thatgoodjdmshit · 23h</p>
          <div class="mt-4 w-full h-64 bg-gray-700 rounded-lg"></div>
        </div>
      </main>
  
      <!-- Right Panel -->
      <aside class="w-1/5 p-4 ">
        <div class="flex items-center mb-6">
          <div class="w-12 h-12 rounded-full bg-gray-700"></div>
          <div class="ml-4">
            <p class="font-bold">jafankin</p>
            <p class="text-gray-400 text-sm">Arhip Jafankin</p>
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
  
  <script>
  import {
    HomeIcon,
    SearchIcon,
    CompassIcon,
    VideoIcon,
    SendIcon,
    HeartIcon,
    SquarePlusIcon,
    UserIcon,
  } from 'lucide-vue-next';
  
  export default {
    components: {
      HomeIcon,
      SearchIcon,
      CompassIcon,
      VideoIcon,
      SendIcon,
      HeartIcon,
      SquarePlusIcon,
      UserIcon,
    },
  };
  </script>
  
  <style>
  body {
    font-family: 'Instagram Sans', sans-serif;
  }

  .custom-button {
  transition: all 0.4s ease;
  position: relative;
}

 /*.custom-button:hover {
  box-shadow: 0px 0px 10px 3px rgba(255, 255, 255, 0.6);
}
*/

.custom-button:active {
  background-color: transparent;
  color: gray;
}
  </style>
  