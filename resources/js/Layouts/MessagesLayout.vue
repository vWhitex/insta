<template>
    <div class="flex bg-black text-white min-h-screen  ">
        <!-- RightSidebar -->
        <aside class="w-min p-4 space-y-10 border-r border-gray-800 py-9">
            <a :href="route('Home')"
                class="custom-button flex items-center space-x-3 text-lg rounded-lg hover:bg-onhovergray p-2">
                <Instagram class="w-6 h-6" />
            </a>
            <nav class="flex flex-col space-y-3.5">
                <a :href="route('Home')"
                    class="custom-button flex items-center space-x-3 text-lg rounded-lg hover:bg-onhovergray p-2">
                    <HomeIcon class="w-6 h-6" />
                </a>
                <a :href="route('Search')"
                    class="custom-button flex items-center space-x-3 text-lg rounded-lg hover:bg-onhovergray p-2">
                    <SearchIcon class="w-6 h-6" />
                </a>
                <a :href="route('Explore')"
                    class="custom-button flex items-center space-x-3 text-lg rounded-lg hover:bg-onhovergray p-2">
                    <CompassIcon class="w-6 h-6" />
                </a>
                <a :href="route('Reels')"
                    class="custom-button flex items-center space-x-3 text-lg rounded-md hover:bg-onhovergray p-2">
                    <VideoIcon class="w-6 h-6" />
                </a>

                <a :href="route('Messages')"
                    class="custom-button flex items-center space-x-3 text-lg rounded-md hover:bg-onhovergray p-2">
                    <SendIcon class="w-6 h-6" />
                </a>

                <a :href="route('Notifications')"
                    class=" custom-button flex items-center space-x-3 text-lg rounded-md hover:bg-onhovergray p-2">
                    <HeartIcon class="w-6 h-6" />
                </a>
                <a :href="route('Create')"
                    class="custom-button flex items-center space-x-3 text-lg rounded-md hover:bg-onhovergray p-2">
                    <SquarePlusIcon class="w-6 h-6" />
                </a>
                <a :href="route('Profile')"
                    class="custom-button flex items-center space-x-3 text-lg rounded-md hover:bg-onhovergray p-2">
                    <UserIcon class="w-6 h-6" />
                </a>
            </nav>
        </aside>


        <!-- LeftMessageAccounts [need to make it fixed, also continue in messages.vue caht part]-->
        <left class=" max-h-screen overflow-auto w-1/5 border-r border-gray-800">
            <!-- AccoutChoser -->
            <div class="flex flex-row mb-0 justify-between pl-4">
                <h1 class="text-xl font-bold mt-8 mb-0">jafankin</h1>
                <a class="custom-button flex items-center space-x-3 text-lg rounded-md p-2">
                    <SquarePenIcon class="w-6 h-6" />
                </a>
            </div>

            <!-- Notes -->
            <div class="flex flex-col">
                <div class="flex space-x-6 m-4 mt-14">
                    <div v-for="i in 2" :key="i" class="flex flex-col items-center">
                        <div class="w-18 h-18 rounded-full bg-gray-700"></div>
                        <p class="text-gray-400 text-xs mt-2">User</p>
                    </div>
                </div>
            </div>

            <!-- Messages -->
            <div class="flex justify-between mb-2 mt-2 mx-4 ">
                <a class=" text-sm font-bold">Messages</a>
                <p class="text-gray-400 text-xs font-bold ">Requests</p>
            </div>
            <div v-for="i in 5" :key="i" class="flex items-center p-2 pl-4">
                <div class="w-14 h-14 rounded-full bg-gray-700"></div>
                <div class="ml-4 flex-grow">
                    <p class="text-sm font-bold">User {{ i }}</p>
                    <p class="text-xs text-gray-400">Active {{ i }}</p>
                </div>
            </div>
        </left>

        <main class="">
            <slot>

            </slot>

        </main>
    </div>

</template>

<script setup>
import {
    Instagram,
    HomeIcon,
    SearchIcon,
    CompassIcon,
    VideoIcon,
    HeartIcon,
    SquarePlusIcon,
    UserIcon,
    SendIcon,
    SquarePenIcon,
} from 'lucide-vue-next';
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
