    <template>
        <div class="flex bg-black text-white min-h-screen justify-between ">
            <!-- RightSidebar -->
            <aside class="w-1/5 p-6 space-y-10 border-r border-gray-800 py-10">
                <h1 class="text-2xl font-bold">Instagram</h1>
                <nav class="flex flex-col space-y-3.5">
                    <a :href="route('Home')"
                        class="custom-button flex items-center space-x-3 text-lg rounded-lg hover:bg-onhovergray p-2">
                        <HomeIcon class="w-6 h-6" />
                        <span>Home</span>
                    </a>
                    <a :href="route('Search')"
                        class="custom-button flex items-center space-x-3 text-lg rounded-lg hover:bg-onhovergray p-2">
                        <SearchIcon class="w-6 h-6" />
                        <span>Search</span>
                    </a>
                    <a :href="route('Explore')"
                        class="custom-button flex items-center space-x-3 text-lg rounded-lg hover:bg-onhovergray p-2">
                        <CompassIcon class="w-6 h-6" />
                        <span>Explore</span>
                    </a>
                    <a :href="route('Reels')"
                        class="custom-button flex items-center space-x-3 text-lg rounded-md hover:bg-onhovergray p-2">
                        <VideoIcon class="w-6 h-6" />
                        <span>Reels</span>
                    </a>

                    <a :href="route('Messages')"
                        class="custom-button flex items-center space-x-3 text-lg rounded-md hover:bg-onhovergray p-2">
                        <SendIcon class="w-6 h-6" />
                        <span>Messages</span>
                    </a>

                    <a :href="route('Notifications')"
                        class=" custom-button flex items-center space-x-3 text-lg rounded-md hover:bg-onhovergray p-2">
                        <HeartIcon class="w-6 h-6" />
                        <span>Notifications</span>
                    </a>
                    <a :href="route('Create')"
                        class="custom-button flex items-center space-x-3 text-lg rounded-md hover:bg-onhovergray p-2">
                        <SquarePlusIcon class="w-6 h-6" />
                        <span>Create</span>
                    </a>
                    <a :href="route('Profile')"
                        class="custom-button flex items-center space-x-3 text-lg rounded-md hover:bg-onhovergray p-2">
                        <UserIcon class="w-6 h-6" />
                        <span>Profile</span>
                    </a>
                </nav>
            </aside>

            <!-- Content -->
            <main class="max-h-screen overflow-auto">
                <slot>

                </slot>
            </main>

            <!-- Right Panel -->
            <aside class="w-1/5 p-4 ">
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
