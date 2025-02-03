<template>

    <HomeLayout>
        <!-- Main Content -->
        <main class="flex-grow p-6 space-y-2 place-self-center items-center shrink place-content-center">
            <!-- Header Section -->
            <header class="flex items-start gap-4 font-bold pt-6 text-sm shrink ">
                <button>For You</button>
                <button>Following</button>
            </header>

            <!-- Stories Section -->
            <div class="flex space-x-4 overflow-x-auto shrink p-4 pb-4 border-t border-gray-800">
                <div v-for="i in 8" :key="i"
                    class="w-16 h-16 rounded-full bg-gray-700 flex items-center justify-center">
                    <span>Story</span>
                </div>
            </div>

            <!-- Post Section -->
            <post class="flex flex-col justify-center items-center space-y-4  text-white text-sm">

                <div class="bg-transparent shrink p-4 pb-4 border-b border-gray-800">
                    <div class="flex flex-row gap-2">
                        <div class=" w-10 h-10 rounded-full bg-gray-700 "></div>
                        <p class="place-self-center font-bold">asdasdasd</p>
                        <p class="place-self-center text-gray-400 ">· 23h</p>
                        <button type="btn" class="text-right place-self-end ">···</button>
                    </div>
                    <div class="mt-4 w-[460px] h-[650px] bg-black/85 rounded-sm border-1 border-gray-800"></div>
                    <div class="flex justify-between py-3 flex-col">

                        <!-- CardBottom -->
                        <!-- Icons -->
                        <div class="">
                            <div class="flex space-x-4 mb-2">
                                <HeartIcon class="w-6 h-6 cursor-pointer hover:text-gray-400" />
                                <MessageCircleIcon class="w-6 h-6 cursor-pointer hover:text-gray-400" />
                                <SendIcon class="w-6 h-6 cursor-pointer hover:text-gray-400" />
                                <BookmarkIcon class="w-6 h-6 cursor-pointer hover:text-gray-400 ml-auto" />
                            </div>
                            <p class=" font-bold">X,XXX likes</p>
                            <p><span class="font-bold">account</span> text text text text</p>
                            <!-- to add :if text too long : ...more -->
                            <p class="text-gray-400 text-sm">View all XXX comments</p> <!-- to add :like counter -->
                            <div class="flex items-center mt-2">
                                <input type="text" class="w-full bg-transparent text-white focus:outline-none"
                                    placeholder="Add a comment..." />
                            </div>
                        </div>
                    </div>
                </div>
            </post>
            <post class="flex flex-col justify-center items-center space-y-4  text-white text-sm">

                <div class="bg-transparent shrink p-4 pb-4 border-b border-gray-800">
                    <div class="flex flex-row gap-2">
                        <div class=" w-10 h-10 rounded-full bg-gray-700 "></div>
                        <p class="place-self-center font-bold">asdasdasd</p>
                        <p class="place-self-center text-gray-400 ">· 23h</p>
                        <button type="btn" class="text-right place-self-end ">···</button>
                    </div>
                    <div class="mt-4 w-[460px] h-[650px] bg-black/85 rounded-sm border-1 border-gray-800"></div>
                    <div class="flex justify-between py-3 flex-col">

                        <!-- CardBottom -->
                        <!-- Icons -->
                        <div class="">
                            <div class="flex space-x-4 mb-2">
                                <HeartIcon class="w-6 h-6 cursor-pointer hover:text-gray-400" />
                                <MessageCircleIcon class="w-6 h-6 cursor-pointer hover:text-gray-400" />
                                <SendIcon class="w-6 h-6 cursor-pointer hover:text-gray-400" />
                                <BookmarkIcon class="w-6 h-6 cursor-pointer hover:text-gray-400 ml-auto" />
                            </div>
                            <p class=" font-bold">X,XXX likes</p>
                            <p><span class="font-bold">account</span> text text text text</p>
                            <!-- to add :if text too long : ...more -->
                            <p class="text-gray-400 text-sm">View all XXX comments</p> <!-- to add :like counter -->
                            <div class="flex items-center mt-2">
                                <input type="text" class="w-full bg-transparent text-white focus:outline-none"
                                    placeholder="Add a comment..." />
                            </div>
                        </div>
                    </div>
                </div>
            </post>
        </main>
    </HomeLayout>
</template>

<script setup>
const axios = import('axios');
import {
    HeartIcon,
    MessageCircleIcon,
    SendIcon,
    BookmarkIcon,
} from 'lucide-vue-next';
import HomeLayout from '@/Layouts/HomeLayout.vue';

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
