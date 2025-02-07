<template>
  <MessagesLayout>
    <div class="flex flex-col">
      <div v-for="i in 1" :key="i" class="flex items-center p-4 border-b border-gray-700">
                <div class="w-14 h-14 rounded-full bg-gray-700"></div>
                <div class="ml-4 flex-grow">
                    <p class="text-sm font-bold">User {{ i }}</p>
                    <p class="text-xs text-gray-400">Active {{ i }}</p>
                </div>
            </div>
            <div>

            </div>
      
    </div>

  </MessagesLayout>
</template>

<script setup>
import MessagesLayout from '../Layouts/MessagesLayout.vue';


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
