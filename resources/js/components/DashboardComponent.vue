<template>
    <div class="dashboard-component">
        <h1>Dashboard</h1>

        <div>
            <h2>Welcome, {{ user.name }}!</h2>
            <p>You are logged in as {{ user.email }}</p>
        </div>

        <div>
            <h3>Your Posts</h3>

            <ul v-if="posts.length > 0">
                <li v-for="post in posts" :key="post.id">
                    <a :href="`/posts/${post.id}`">{{ post.title }}</a>
                    <small>in {{ post.category.name }} on {{ formatDate(post.created_at) }}</small>
                    <span v-if="canUpdate(post)">
                        <a :href="`/posts/${post.id}/edit`">Edit</a>
                    </span>
                    <span v-if="canDelete(post)">
                        <form :action="`/posts/${post.id}`" method="POST" style="display:inline;">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" :value="csrfToken">
                            <button type="submit">Delete</button>
                        </form>
                    </span>
                </li>
            </ul>
            <p v-else>You haven't created any posts yet. <a :href="`/posts/create`">Create your first post</a></p>
        </div>

        <div>
            <a :href="`/posts/create`">Create New Post</a>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            user: {},
            posts: [],
            csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Get CSRF token
        };
    },
    methods: {
        fetchDashboardData() {
            axios.get('/api/dashboard')
                .then(response => {
                    this.user = response.data.user;
                    this.posts = response.data.posts;
                })
                .catch(error => {
                    console.error('Error fetching dashboard data:', error);
                });
        },
        formatDate(date) {
            return new Date(date).toLocaleDateString(undefined, {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
        },
        canUpdate(post) {
            return post.user_id === this.user.id || this.user.role === 'admin' || this.user.role === 'editor';
        },
        canDelete(post) {
            return post.user_id === this.user.id || this.user.role === 'admin';
        }
    },
    mounted() {
        this.fetchDashboardData();
    }
}
</script>

<style scoped>
.dashboard-component {
    max-width: 800px;
    margin: 0 auto;
}
</style>
