<template>
  <MessagesLayout>
    <div class="flex flex-col">
      <div v-for="i in 1" :key="i" class="flex items-center p-3 border-b border-gray-700">
                <div class="size-12 rounded-full bg-gray-700"></div>
                <a class="ml-4 flex-grow ">
                    <p class="text-sm font-bold">User {{ i }}</p>
                    <p class="text-xs text-gray-400">Active {{ i }}</p>
                </a>
                    <div class="flex flex-row gap-4">
                        <Phone class="w-6 h-6" />
                        <Videotape class="w-6 h-6" />
                        <Info class="w-6 h-6" />
                    </div>
            </div>
            <div>

            </div>

    </div>

  </MessagesLayout>
</template>

<script setup>
import MessagesLayout from '../Layouts/MessagesLayout.vue';
import {
    Phone,
    Videotape,
    Info,
}
from 'lucide-vue-next';

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
