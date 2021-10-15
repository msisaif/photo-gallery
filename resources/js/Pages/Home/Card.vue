<template>
  <div class="rounded overflow-hidden shadow border">
    <div class="px-4 pt-2">
        <div class="text-center mb-2">
            <span class="text-gray-500 pr-2">Author:</span>
            <span class="text-blue-600">{{ PhotoFormatted.user }}</span>
        </div>
    </div>
    <img :src="PhotoFormatted.link" alt="photo" class="w-full" />
    <div class="px-4 py-2">
        <div class="flex justify-between items-center">
            <div class="flex justify-center items-center text-gray-700">
                <span class="pr-1">{{ this.numberFormate(PhotoFormatted.views) }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </div>
            <div class="flex justify-center items-center text-gray-700">
                <span class="pr-1">{{ this.numberFormate(PhotoFormatted.likes) }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </div>
            <div class="flex justify-center items-center text-gray-700">
                <span class="pr-1">{{ this.numberFormate(PhotoFormatted.downloads) }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
            </div>
        </div>
    </div>
    <!-- <div class="px-4 pb-4">
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2"
            v-for="tag in PhotoFormatted.tags" :key="tag">#{{tag}}</span>
    </div> -->
  </div>
</template>

<script>
import { computed } from 'vue';

export default {
    props: ['photo'],
    methods: {
        numberFormate: (num) => {
            if(Math.abs(num) <= 999) {
                return Math.sign(num)*Math.abs(num);
            }

            if(Math.abs(num) <= 999999) {
                return Math.sign(num)*((Math.abs(num)/1000).toFixed(1)) + 'K';
            }

            if(Math.abs(num) <= 999999999) {
                return Math.sign(num)*((Math.abs(num)/1000000).toFixed(1)) + 'M';
            }

            return Math.sign(num)*((Math.abs(num)/1000000000).toFixed(1)) + 'B';
        }
    },
    setup(props) {
        const PhotoFormatted = computed(() => ({
            ...props.photo,
            tags: props.photo.tags.split(',').map((photo) => photo.trim()),
            views: props.photo.views,
            downloads: props.photo.downloads,
            likes: props.photo.likes,
        }));

        return {
            PhotoFormatted,
        };
    },
};
</script>
