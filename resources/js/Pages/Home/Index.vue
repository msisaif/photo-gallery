<template>
    <div class="sticky top-0 py-2 bg-white shadow">
        <div class="w-full max-w-sm mx-auto">
            <input
                @input="searchPhoto"
                v-model="text"
                class="bg-transparent w-full text-center text-gray-700 py-1 px-2 leading-tight border-0 focus:outline-none focus:ring-0"
                type="text"
                placeholder="Search Photo ..."
            />
        </div>
    </div>
    <div class="container mx-auto px-10 p-10">
        <div class="text-3xl text-center mx-auto mt-32" v-if="status === 'loading'">Loading...</div>
        <div class="text-3xl text-center mx-auto mt-32 text-red-500" v-else-if="status === 'error'">{{ error }}</div>
        <div class="text-3xl text-center mx-auto mt-32 text-red-500" v-else-if="status === 'success' && !photos.data.length">No Images Found</div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4" v-else>
            <div v-for="photo in photos.data" :key="photo.id">
                <PhotoCard :photo="photo"/>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import PhotoCard from './Card.vue';

export default {
    components: {
        PhotoCard,
    },
    mounted() {
        this.searchPhoto();
    },
    data() {
        return {
            photos: {},
            text: '',
            status: 'loading',
            error: 'Please Try Again',
        }
    },
    methods: {
        searchPhoto() {
            axios.get(this.route('home'), {
                params: {
                    flag: true,
                    search: this.text.trim(),
                }
            })
            .then((response) => {
                this.status = 'success';
                this.photos = response.data;
            })
            .catch((error) => {
                this.status = 'error';
            })
        }
    }
};
</script>
