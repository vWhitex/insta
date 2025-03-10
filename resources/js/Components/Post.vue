<template>
    <div class="bg-transparent shrink p-4 pb-4 border-b border-gray-800">
      <!-- Post Header -->
      <div class="flex flex-row gap-2">
        <div class="w-10 h-10 rounded-full bg-gray-700 overflow-hidden">
          <img v-if="post.user.avatar" :src="post.user.avatar" :alt="post.user.username" class="w-full h-full object-cover" />
        </div>
        <p class="place-self-center font-bold">{{ post.user.username }}</p>
        <p class="place-self-center text-gray-400">· {{ post.time_ago }}</p>
        <button type="button" class="text-right place-self-end">···</button>
      </div>

      <!-- Post Image -->
      <div class="mt-4 w-full aspect-square bg-black/85 rounded-sm border border-gray-800 overflow-hidden">
        <img v-if="post.image_path" :src="'/storage/' + post.image_path" :alt="post.caption" class="w-full h-full object-cover" />
      </div>

      <!-- Post Actions and Content -->
      <div class="flex justify-between py-3 flex-col">
        <div class="py-2">
          <!-- Post Actions -->
          <div class="flex space-x-4 mb-2">
            <HeartIcon
              :class="['w-6 h-6 cursor-pointer', isLiked ? 'text-red-500' : 'hover:text-gray-400']"
              @click="toggleLike"
            />
            <MessageCircleIcon class="w-6 h-6 cursor-pointer hover:text-gray-400" @click="focusCommentInput" />
            <SendIcon class="w-6 h-6 cursor-pointer hover:text-gray-400" />
            <BookmarkIcon class="w-6 h-6 cursor-pointer hover:text-gray-400 ml-auto" />
          </div>

          <!-- Likes -->
          <p class="font-bold">{{ likesCount }} likes</p>

          <!-- Caption -->
          <p>
            <span class="font-bold">{{ post.user.username }}</span>
            {{ post.caption }}
          </p>

          <!-- Comments -->
          <div v-if="post.comments.length > 0" class="mt-1">
            <p
              v-if="!showAllComments && post.comments.length > 2"
              class="text-gray-400 text-sm cursor-pointer"
              @click="showAllComments = true"
            >
              View all {{ post.comments.length }} comments
            </p>

            <div v-for="(comment, index) in displayedComments" :key="comment.id" class="mt-1">
              <p>
                <span class="font-bold">{{ comment.user.username }}</span>
                {{ comment.content }}
              </p>
            </div>
          </div>

          <!-- Add Comment -->
          <div class="flex items-center mt-2">
            <input
              ref="commentInput"
              v-model="newComment"
              type="text"
              class="w-full bg-transparent text-white focus:outline-none"
              placeholder="Add a comment..."
              @keyup.enter="addComment"
            />
          </div>
        </div>
      </div>
    </div>
  </template>

  <script setup>
  import { ref, computed, onMounted } from 'vue';
  import axios from 'axios';
  import {
    HeartIcon,
    MessageCircleIcon,
    SendIcon,
    BookmarkIcon,
  } from 'lucide-vue-next';

  // Props
  const props = defineProps({
    post: {
      type: Object,
      required: true,
      // Structure:
      // {
      //   id: Number,
      //   user_id: Number,
      //   caption: String,
      //   image_path: String,
      //   created_at: String,
      //   updated_at: String,
      //   time_ago: String,
      //   user: {
      //     id: Number,
      //     username: String,
      //     avatar: String
      //   },
      //   comments: Array,
      //   likes_count: Number
      // }
    }
  });

  // Reactive state
  const isLiked = ref(false);
  const likesCount = ref(props.post.likes_count || 0);
  const showAllComments = ref(false);
  const newComment = ref('');
  const commentInput = ref(null);

  // Check if current user has liked the post
  onMounted(async () => {
    try {
      const response = await axios.get(`/api/posts/${props.post.id}/liked`);
      isLiked.value = response.data.liked;
    } catch (error) {
      console.error('Error checking like status:', error);
    }
  });

  // Computed properties
  const displayedComments = computed(() => {
    if (showAllComments.value) {
      return props.post.comments;
    } else {
      return props.post.comments.slice(0, 2);
    }
  });

  // Methods
  const toggleLike = async () => {
    try {
      if (isLiked.value) {
        await axios.delete(`/api/posts/${props.post.id}/likes`);
        likesCount.value--;
      } else {
        await axios.post(`/api/posts/${props.post.id}/likes`);
        likesCount.value++;
      }
      isLiked.value = !isLiked.value;
    } catch (error) {
      console.error('Error toggling like:', error);
    }
  };

  const addComment = async () => {
    if (!newComment.value.trim()) return;

    try {
      const response = await axios.post(`/api/posts/${props.post.id}/comments`, {
        content: newComment.value
      });

      // Add the new comment to the post's comments
      props.post.comments.unshift(response.data);
      newComment.value = '';
      showAllComments.value = true;
    } catch (error) {
      console.error('Error adding comment:', error);
    }
  };

  const focusCommentInput = () => {
    commentInput.value.focus();
  };
  </script>
