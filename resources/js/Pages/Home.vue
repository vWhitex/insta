<template>
    <HomeLayout>
        <!-- Main Content -->
        <main class="flex flex-col items-center w-full max-w-xl mx-auto">
            <!-- Header Section -->
            <header
                class="flex items-center justify-start w-full font-bold pt-12 text-sm border-b border-gray-800 pb-2">
                <div class="flex gap-8">
                    <button class="focus:border-b-2 focus:border-white pb-1 ">For You</button>
                    <button class="focus:border-b-2 focus:border-white pb-1">Following</button>
                </div>
            </header>

            <!-- Stories Section -->
            <div class="flex space-x-4 overflow-x-auto w-full py-4 px-2 max-w-xl">
                <div v-for="i in 8" :key="i" class="flex flex-col items-center space-y-1 flex-shrink-0">
                    <div
                        class="w-16 h-16 rounded-full bg-gray-700 flex items-center justify-center ring-2 ring-pink-500">
                        <span>Story</span>
                    </div>
                    <span class="text-xs text-gray-400">User_{{ i }}</span>
                </div>
            </div>

            <div v-if="loading" class="py-4 text-center w-full">
      <p>Loading posts...</p>
    </div>

            <div v-else class="flex flex-col justify-center items-center space-y-4  text-white text-sm">

                <div v-if="posts.length === 0" class="text-center py-8">
                    <p>No posts found</p>
                </div>
                <Post v-for="post in posts" :key="post.id" :post="post" />

            </div>
        </main>
    </HomeLayout>
</template>

<script setup>
import axios from 'axios';
import {
    HeartIcon,
    MessageCircleIcon,
    SendIcon,
    BookmarkIcon,
} from 'lucide-vue-next';
import { ref, onMounted, watch } from 'vue';
import HomeLayout from '@/Layouts/HomeLayout.vue';
import Post from '@/Components/Post.vue';

const posts = ref([]);
const users = ref([]);
const loading = ref(true);
const activeTab = ref('for-you');

// Fetch posts and users on component mount
onMounted(async () => {
  try {
    // Fetch posts with their relationships
    const postsResponse = await axios.get('/api/posts', {
      params: {
        with: ['user', 'comments.user', 'likes_count'],
        per_page: 10,
        page: 1
      }
    });
    posts.value = postsResponse.data.data;

    // Fetch users for stories
    const usersResponse = await axios.get('/api/users');
    users.value = usersResponse.data;
  } catch (error) {
    console.error('Error fetching data:', error);
  } finally {
    loading.value = false;
  }
});

// Watch for tab changes to load different content
watch(activeTab, async (newTab) => {
  loading.value = true;
  try {
    const endpoint = newTab === 'following' ? '/api/posts/following' : '/api/posts';
    const response = await axios.get(endpoint, {
      params: {
        with: ['user', 'comments.user', 'likes_count'],
        per_page: 10,
        page: 1
      }
    });
    posts.value = response.data.data;
  } catch (error) {
    console.error('Error fetching posts for tab:', error);
  } finally {
    loading.value = false;
  }
});
</script>
